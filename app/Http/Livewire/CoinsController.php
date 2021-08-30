<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; //subir imagenes
use Livewire\WithPagination;
use App\Models\Denomination;

class CoinsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search, $image, $selected_id, $pageTitle, $componentName,$type,$value;
    private $pagination = 6;
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Denominaciones';
    }
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    public function render()
    {
        if(strlen($this->search) > 0 )
            $data = Denomination::where('type', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Denomination::orderBy('id', 'asc')->paginate($this->pagination);
        return view('livewire.denominations.coins', ['data' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    public function Edit($id){
        $record = Denomination::find($id, ['id','type','value','image']);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;
        $this->emit('show-modal','Show Modal!');
    }
    public function Store(){
        $rules = [
            'type' => 'required|not_in:Elegir',
            'value' => 'required'
        ];
        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Selecciona un tipo distinto',
            'value.unique' => 'El valor ya esta siendo Utilizado',
            'value.required' => 'El valor es Requerido'
        ];
        $this->validate($rules,$messages);
        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value,
        ]);
        $customFileName;
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominaciones',$customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }
        $this->resetUI();
        $this->emit('denomination-added','Denominacion Registrada.');
    }
    public function Update(){
        $rules = [
            'type' => 'required|not_in:Elegir',
            'value' => "required|unique:denominations,value,{$this->selected_id}"
        ];
        $messages = [
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Selecciona un tipo distinto',
            'value.unique' => 'El valor ya esta siendo Utilizado',
            'value.required' => 'El valor es Requerido'
        ];
        $this->validate($rules,$messages);
        $denomination = Denomination::find($this->selected_id);
        $denomination->update([
            'type' => $this->type,
            'value' => $this->value
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominaciones',$customFileName);
            $imageName = $denomination->image;
            $denomination->image = $customFileName;
            $denomination->save();
            if($imageName != null){
                if(file_exists('storage/denominaciones' . $imageName)){
                    inlink('storage/denominaciones' . $imageName);
                }
            }
        }
        $this->resetUI();
        $this->emit('denomination-updated', 'Denominacion Actualizada Correctamente.');
    }
    public function resetUI(){
        $this->type = '';
        $this->value = '';
        $this->image = '';
        $this->select_id = 0;
        $this->search = '';
    }
    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];
    public function Destroy(Denomination $denomination){
        //$category = Category::find($id);
        $imageName = $denomination->image; //imagen temporal
        $denomination->delete();
        if($imageName != null){
            unlink('storage/denominaciones/' . $imageName);
        }
        $this->resetUI();
        $this->emit('denomination-delete','La Denominacion fue Eliminada.');
    }
}
