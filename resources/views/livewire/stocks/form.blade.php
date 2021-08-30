@include('common.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Categoria</label>
            <select class="form-control" id="select" wire:change="load_productss($event.target.value)">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('categoryid') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Productos</label>
            <select wire:model="productid" class="form-control" id="select_p">
                <option value="Elegir" disabled>Elegir</option>
            </select>
            @error('productyid') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('common.modalFooter')
