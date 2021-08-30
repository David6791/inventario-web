@include('livewire.users.partials.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nombre Usuario</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="">
            @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder="">
            @error('phone') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Correo Electronico</label>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="">
            @error('email') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" wire:model.lazy="password" class="form-control" placeholder="ej. *****">
            @error('password') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estado</label>
            <select name="" wire:model.lazy="status" class="form-control" id="">
                <option value="Elegir">Elegir</option>
                <option value="Active">Activo</option>
                <option value="Locked">Bloqueado</option>
            </select>
            @error('status') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Perfil</label>
            <select name="" wire:model.lazy="profile" class="form-control" id="">
                <option value="Elegir">Elegir</option>
                @foreach ($roles as $rol)
                    <option value="{{$rol->name}}">{{$rol->name}}</option>    
                @endforeach                
            </select>
            @error('profile') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" wire:model.lize="image" accept="image/x-png, image/jpeg, image/gif" class="form-control">
            @error('image') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('livewire.users.partials.modalFooter')