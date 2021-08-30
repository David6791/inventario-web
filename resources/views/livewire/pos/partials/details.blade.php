<div class="card border-left-primary shadow mb-4" style="font-size:15px">
    <div class="card-body">
        @if($total > 0 )
        <div class="table-responsive tblscroll" style="max-heigth: 650px; overflow:hidden">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white" style="background: #003471">
                    <tr>
                        <th width="10%"></th>
                        <th class="table-th text-left text-white">DESCRIPCION</th>
                        <th class="table-th text-left text-white">PRECIO</th>
                        <th class="table-th text-left text-white" width="13%">CANT.</th>
                        <th class="table-th text-left text-white">IMPORTES</th>
                        <th class="table-th text-left text-white">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td class="text-center table-th">
                                @if(count($item->attributes) > 0 )
                                <span>
                                    <img src="{{asset('storage/productos/'. $item->attributes[0])}}" alt="Imagen de Producto" heigth="90" width="90" class="rounded">
                                </span>
                                @endif
                            </td>
                            <td>
                                <h6>{{$item->name}}</h6>
                            </td>
                            <td class="text-center">
                                Bs.{{number_format($item->price,2)}}
                            </td>
                            <td>
                                <input type="number" id="r{{$item->id}}"
                                whire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}) .val() )"
                                style="font-size: 1rem !important"
                                class="form-control text-center"
                                value="{{ $item->quantity }}"
                                >
                            </td>
                            <td class="text-center">
                                <h6>
                                    Bs.{{ number_format($item->price * $item->quantity),2 }}
                                </h6>
                            </td>
                            <td class="text-center">
                                <button onclick="Confirm('{{$item->id}}','removeItem','CONFIRMAS ELIMINAR EL REGISTRO')" class="btn btn-dark btn-mbmobile btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button wire:click.prevent="decreaseQty({{$item->id}})"class="bnt-sm btn-success mbmobile"> <i class="fas fa-minus"></i> </button>
                                <button wire:click.prevent="increaseQty({{$item->id}})"class="bnt-sm btn-warning mbmobile"> <i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h5 class="text-center text-muted"> Agregar Productos para la Venta</h5>
        @endif
        <div wire:loading.inline wire:target="saveSale">
            <h4 class="text-danger text-center">Guardando Venta...</h4>
        </div>
    </div>
</div>

