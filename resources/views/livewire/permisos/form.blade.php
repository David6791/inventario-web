@include('common.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre del Rol</label>
            <input type="text" wire:model.lazy="permissionName" class="form-control" placeholder="ej. Admin">
            @error('permissionName') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('livewire.permisos.partials.modalFooter')