@include('common.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Tipo</label>
            <select name="" wire:model="type" id="" class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="MONEDA">Moneda</option>
                <option value="BILLETE">Billete</option>
                <option value="OTROS">Otros</option>
            </select>
            @error('type') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <label>Valor</label>
        <div class="input-group">            
            <div class="input-group-append">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="value" class="form-control" placeholder="Valor.">
        </div>
        @error('value') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input" wire:model="image" accept="image/x-png, image/gif, image/jpeg">
            <label for="" class="custom-file-label">Imagen {{ $image }}</label>
            @error('image') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')