@include('common.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Nombre Producto">
            @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Codigo</label>
            <input type="text" wire:model.lazy="barcode" class="form-control" placeholder="Codigo Producto">
            @error('barcode') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Inventario Minino</label>
            <input type="number" wire:model.lazy="alert" class="form-control" placeholder="Cantidad Minima">
            @error('alert') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Categoria</label>
            <select wire:model="categoryid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select> 
            @error('categoryid') <span class="text-danger er">{{ $message }}</span> @enderror           
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="form-group custom-file">
            <input type="file" wire:model.lazy="image" class="custom-file-input" accept="image/x-png, image/gif, image/jpeg" placeholder="Cantidad Minima">
            <label class="custom-file-label form-control"> Imagen {{$image}}</label>
            @error('image') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')