<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Sale;
use DB;
class UsersController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $customFileName,$password,$profile, $name, $phone, $email, $status, $image,$selected_id,$fileLoaded,$role,$pageTitle, $componentName,$search;
    private $pagination = 10;
    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Elegir';
    }
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    
    public function render()
    {
        if(strlen($this->search) > 0){
            $data = User::where('name','like','%'.$this->search.'%')
                    ->select('*')->orderBy('name','asc')->paginate($this->pagination);
        }else{
            $data = User::select('*')->orderBy('name','asc')->paginate($this->pagination);
        }
        return view('livewire.users.component',[
            'data' => $data,
            'roles' => Role::orderBy('name','asc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }    
    public function Edit(User $user){
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';
        $this->emit('show-modal','open');
    }
    protected $listeners = [
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];
    public function Stored(){
        $rules = [
            'name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3',
        ];
        $messages = [
            'name.required' => 'Ingrese el Nombre',
            'name.min' => 'El Nombre de Usuario debe tener al menos 3 caracteres.',
            'email.required' => 'Ingrese el email',
            'email.unique' => 'El email ingresado ya esta en uso.',
            'status.required' => 'Seleccione un estado.',
            'status.not_in' => 'Seleccione un estado diferente.',
            'profile.required' => 'Seleccione un perfil.',
            'profile.not_in' => 'Seleccione un perfil diferente.',
            'password.required' => 'Debe ingresar una Contraseña.',
            'password.min' => 'Su contraseña debe tener al menos 3 caracteres.',
        ];
        $this->validate($rules,$messages);
        $user = USer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/usuarios',$customFileName);
            $user->image = $customFileName;
            $user->save();
        }
        $this->resetUI;
        $this->emit('user-added','Usuario registrado exitosamente');
    }
    public function Updated(){
        $rules = [
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',            
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3',
        ];
        $messages = [
            'name.required' => 'Ingrese el Nombre',
            'name.min' => 'El Nombre de Usuario debe tener al menos 3 caracteres.',
            'email.required' => 'Ingrese el email',
            'email.unique' => 'El email ingresado ya esta en uso.',
            'status.required' => 'Seleccione un estado.',
            'status.not_in' => 'Seleccione un estado diferente.',
            'profile.required' => 'Seleccione un perfil.',
            'profile.not_in' => 'Seleccione un perfil diferente.',
            'password.required' => 'Debe ingresar una Contraseña.',
            'password.min' => 'Su contraseña debe tener al menos 3 caracteres.',
        ];
        $this->validate($rules,$messages);
        $user = User::find($this->selected_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'status' => $this->status,
            'password' => bcrypt($this->password),
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/usuarios',$customFileName);
            $imageTemp = $user->image;
            $user->image = $customFileName;
            $user->save();
            if($imageTemp != null){
                if(file_exists('storage/usuarios/'.$imageTemp)){
                    unlink('storage/usuarios/'.$imageTemp);
                }
            }
        }
        $this->resetUI();
        $this->emit('user-updated','Usuario actualizado exitosamente');
    }
    public function destroy(User $user){
        if($user){
            $sales = Sale::where('user_id',$user->id)->count();
            if($sales > 0){
                $this->emit('user-withsales','No se puede eliminar este Usuario por que tiene ventas registradas.');
            }else{
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted','Usuario eliminado correctamente.');
            }
        }
    }
    public function resetUI(){
        $this->resetValidation();
        $this->name='';
        $this->phone='';
        $this->email='';
        $this->password='';
        $this->image='';
        $this->search='';
        $this->status='';
        $this->selected_id='';
        //para poder volver al indice de la pagina
        $this->resetPage();
    }
}
