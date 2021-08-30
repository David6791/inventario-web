<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName, $search,$selected_id,$pageTitle, $componentName;
    private $pagination = 10;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $permisos = Permission::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        else
            $permisos = Permission::orderby('name','asc')->paginate($this->pagination);
        return view('livewire.permisos.component',[
            'permisos' => $permisos,
        ])->extends('layouts.theme.app')
        ->section('content');
    }
    public function CreatePermission(){
        $rules = [
            'permissionName' => 'required|min:2|unique:permissions,name'
        ];
        $messages = [
            'permissionName.required' => 'El nombre del Permisos es Requerido',
            'permissionName.unique' => 'El rol ya esta Registrado',
            'permissionName.min' => 'El nombre del Permisos debe tener al menos 2 caracteres'
        ];
        $this->validate($rules,$messages);
        Permission::create([
            'name' => $this->permissionName
        ]);
        $this->emit('permiso-added','El Permiso fue Registrado Exitosamente.');
        $this->resetUI();
    }
    public function Edit($id){
        $permiso = Permission::find($id);
        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;

        $this->emit('show-modal','show-modal');
    }
    public function UpdatePermission(){
        $rules = [
            'permissionName' => "required|min:2|unique:permissions,name,{$this->selected_id}"
        ];
        $messages = [
            'permissionName.required' => 'El nombre del Permiso es Requerido',
            'permissionName.unique' => 'Este permiso ya esta Registrado',
            'permissionName.min' => 'El nombre del Permiso debe tener al menos 2 caracteres'
        ];
        $this->validate($rules,$messages);
        $permission = Permission::find($this->selected_id);
        $permission->name = $this->permissionName;
        $permission->save();
        $this->emit('permiso-updated','Se Actualizo el Permiso correctamente');
        $this->resetUI();
    }
    protected $listeners = ['destroy' => 'Destroy'];
    public function Destroy($id){
        $rolesCount = Permission::find($id)->getRoleNames()->count();
        if($rolesCount>0){
            $this->emit('permiso-error','No se pude eliminar el permisos por que tiene roles asociados');
            return;
        }
        Permission::find($id)->delete();
        $this->emit('permiso-deleted','Se Elimino el Permiso correctamente');
    }
    public function resetUI(){
        $this->resetValidation();
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
    }
}
