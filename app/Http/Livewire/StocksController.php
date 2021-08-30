<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; //subir imagenes
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;

class StocksController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name, $barcode,$alert,$productid,$categoryid,$search,$image,$selected_id,$componentName,$pageTitle,$products;
    private $pagination=5;
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Stock de Productos';
        $this->categoryid = 'Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $products_stock = Stock::join('products as p','p.id','stocks.product_id')
                ->select('stocks.*','p.name as product')
                ->where('stocks.cost', 'like', '%' . $this->search . '%')
                ->orWhere('p.name', 'like', '%' . $this->search . '%')
                ->orderBy('stocks.id', 'asc')
                ->paginate($this->pagination);
        else
            $products_stock = Stock::join('products as p','p.id','stocks.product_id')
                ->select('stocks.*','p.name as product')
                ->orderBy('stocks.id', 'asc')
                ->paginate($this->pagination);
        return view('livewire.stocks.stocks',[
            'data' => $products_stock,
            'categories' => Category::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function load_products($id){
        dd($id);
        $record = Product::where('category_id','=',$id)->get();
        $this->emit('load_p',$record);
    }
    public function load_productss($id){
        dd("sadsadsadsadasd");
    }
}
