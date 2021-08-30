<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithFileUploads; //subir imagenes
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name, $barcode,$alert,$categoryid,$search,$image,$selected_id,$componentName,$pageTitle;
    private $pagination=5;
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->categoryid = 'Elegir';
    }
    public function render()
    {
        if(strlen($this->search) > 0)
            $products = Product::join('categories as c','c.id','products.category_id')
                ->select('products.*','c.name as category')
                ->where('products.barcode', 'like', '%' . $this->search . '%')
                ->orWhere('c.name', 'like', '%' . $this->search . '%')
                ->orderBy('products.name', 'asc')
                ->paginate($this->pagination);
        else
            $products = Product::join('categories as c','c.id','products.category_id')
                ->select('products.*','c.name as category')                
                ->orderBy('products.name', 'asc')
                ->paginate($this->pagination);
        return view('livewire.products.products',[
            'data' => $products,
            'categories' => Category::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
            'alert' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];
        $messages = [
            'name.required' => 'El Nombre de producto es Requerido.',
            'name.unique' => 'El nombre de producto ya esta siendo Utilizado.',
            'name.min' => 'El nombre de producto debe contener al menos 3 caracteres.',
            'alert.required' => 'Ingresar un valor minino.',
            'categoryid.required' => 'Selecciones una opcion.',
            'categoryid.not_in' => 'Elige una Categoria diferente.',
            
        ];
        $this->validate($rules,$messages);

        $product = Product::create([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'alert' => $this->alert,
            'category_id' => $this->categoryid,
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos',$customFileName);
            $product->image = $customFileName;
            $product->save();
        }
        $this->resetUI();
        $this->emit('product-added','Producto Registrado Correctamente.');
    }
    public function Edit(Product $product){
        $this->selected_id = $product->id;
        $this->name = $product->name;
        $this->barcode = $product->barcode;
        $this->alert = $product->alert;
        $this->categoryid = $product->category_id;
        $this->image = null;
        $this->emit('show-modal','Show Modal');
    }
    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}",
            'alert' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];
        $messages = [
            'name.required' => 'El Nombre de producto es Requerido.',
            'name.unique' => 'El nombre de producto ya esta siendo Utilizado.',
            'name.min' => 'El nombre de producto debe contener al menos 3 caracteres.',
            'alert.required' => 'Ingresar un valor minino.',
            'categoryid.required' => 'Selecciones una opcion.',
            'categoryid.not_in' => 'Elige una Categoria diferente.',
            
        ];
        $this->validate($rules,$messages);
        $product = Product::find($this->selected_id);
        $product->update([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'alert' => $this->alert,
            'category_id' => $this->categoryid,
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos/',$customFileName);
            $imageTemp = $product->image;
            $product->image = $customFileName;            
            $product->save();
            if($imageTemp!=null){
                if(file_exists('storage/productos/'.$imageTemp)){
                    unlink('storage/productos/'.$imageTemp);
                }
            }
        }
        $this->resetUI();
        $this->emit('product-updated','Producto Actualizado Correctamente.');
    }
    public function resetUI(){
        $this->name = '';
        $this->barcode = '';
        $this->alert = '';
        $this->search = '';
        $this->categoryid = 'Elegir';
        $this->image = null;
        $this->slected_id = 0;
    }
    protected $listeners = [
        'deleteRow' =>'Destroy'
    ];
    public function Destroy(Product $product){
        $imageTemp = $product->image;
        $product->delete();
        if($imageTemp!=null){
            if(file_exists('storage/productos/'.$imageTemp)){
                unlink('storage/productos/'.$imageTemp);
            }
            $this->resetUI();
            $this->emit('product-deleted','Producto Eliminado');
        }
    }
}
