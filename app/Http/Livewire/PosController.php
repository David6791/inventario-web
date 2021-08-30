<?php
//Video para usar select con livewire es el numero 52
namespace App\Http\Livewire;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Denomination;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;
use DB;

class PosController extends Component
{
    public $total, $itemsQuantity,$efectivo,$change;
    

    public function mount(){
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }
    public function render()
    {
        $this->denominations = Denomination::all();
        return view('livewire.pos.component',[
            'denominations' => Denomination::orderBy('id','asc')->get(),
            'cart' => Cart::getContent()->sortBy('name')
        ])->extends('layouts.theme.app')->section('content');
    }
    //funcion para 
    public function ACash($value){
        $this->efectivo+=($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }
    public function changeCero(){
        $this->change = 0;
        $this->efectivo = 0;
    }
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
        'changeCero' => 'changeCero'
    ];
    public function ScanCode($barcode, $cant = 1){
        $product = Product::where('barcode',$barcode)->first();  
        if($product == null || empty($product)){
            $this->emit('scan-notfound','El producto no esta Registrado');
        }else{
            $stock = Stock::where('product_id',$product->id)->first();
            if($this->InCart($product->id)){
                $this->increaseQty($product->id);
                return;
            }
            if($stock == NULL){
                $this->emit('no-stock','Este producto no tiene Stock Registrado.');
                return;
            }
            if($stock->quantity < 1){
                $this->emit('no-stock','Stock no Suficiente');
                return;
            }
            Cart::add($product->id,$product->name,$stock->price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok',$product->name.' Agregado al carrito');
        }
    }
    public function InCart($productId){
        $exist = Cart::get($productId);
        if($exist)
            return true;
        else
            return false;
    }
    public function increaseQty($productId, $cant = 1){
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title = 'Cantidad Actualizada';
        else
            $title = 'Producto Agregado';
        if($exist){            
            $stock = Stock::where('product_id',$product->id)->first();
            if($stock->quantity < ($cant + $exist->quantity)){
                $this->emit('no-stock','Estock insuficiente');
                return;
            }
        }
        Cart::add($product->id,$product->name, $stock->price, $cant,$product->image);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok',$title);
    }
    public function updateQty($productId, $cant = 1){
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title = 'Cantidad Actualizada';
        else
            $title = 'Producto Agregado';
        $stock = Stock::where('product_id',$product->id)->first();
        if($stock){
            if($stock->quantity < $cant){
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
        }
        $this->removeItem($productId);
        if($cant > 0){
            Cart::add($produc->id,$product->name,$stock->price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok',$title);
        }
    }
    public function removeItem($productId){
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok','Producto Eliminado.');
    }
    public function decreaseQty($productId){
        $item = Cart::get($productId);
        Cart::remove($productId);
        $new_Qty = ($item->quantity) - 1;
        if($new_Qty > 0)
            Cart::add($item->id,$item->name,$item->price,$new_Qty,$item->attributes[0]);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok','Cantidad Actualizada');
    }
    public function clearCart(){
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok','Carrito vacio');
    }
    public function saveSale(){
        if($this->total <= 0){
            $this->emit('save-error','Agrega Productos a la Venta');
            return;
        }
        if($this->efectivo <= 0){
            $this->emit('save-error','Ingrese el Efectivo');
            return;
        }
        if($this->total > $this->efectivo){
            $this->emit('save-error','AEl Efectivo debe ser MAYOT o IGUAL al total');
            return;
        }
        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->total,
                'cash' => $this->total,
                'change' => $this->total,
                'user_id' => Auth()->user()->id,
            ]);
            if($sale){
                $items = Cart::getContent();
                foreach($items as $item){
                    SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale' => $sale->id,
                    ]);
                    $stock = Stock::where('product_id',$item->id);
                    $stock->quantity = $stock->quantity - $item->quantity;
                    $stock->save();
                }
            }
            DB::commit();
            Cart::clear();
            $this->efectivo = 0 ;
            $this->change = 0 ;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok','Venta registrada con Exito');
            $this->emit('print-ticket',$sale->id);
        } catch(Exception $e){
            DB::rollback();
            $this->emit('sale-error',$e->getMessage());
        }
    }
    public function printTicket($venta){
        return Redirect::to("print://$sale->id");
    }
}
