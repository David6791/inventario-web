<div class="row mt-2">
    <div class="col-sm-12 card border-left-primary shadow h-100 py-2">
        <h5 class="text-center card-title">DENOMINACIONES</h5>
        <div class="card-body car-now float-right">
            <div class="row">
                @foreach($denominations as $d)
                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <button wire:click.prevent="ACash({{$d->value}})" class="">
                            <small> {{ $d->value > 0 ? number_format($d->value,2,'.', '') : 'Exacto' }}</small>
                        </button>
                    </div>
                @endforeach
            </div>            
        </div>
        <div class="card-footer">
            <div class="input-group input-group-md mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text input-gp-hideon" style="backgroud:#3b3f5c" color="white">Bs.</span>
                        <input type="number" id="cash" wire:model="efectivo"
                        wire:keydown:enter="saveSale"
                        class="form-control text-center" value="{{$efectivo}}">
                    <div class="input-group-append">
                        <span wire:click="$set('efectivo',0)" class="input-group-text" style="backgroud:#3b3f5c">
                            <i class="fas fa-backspace"></i> <small>(F8)</small>
                        </span>
                    </div>
                </div>
            </div>
            <h4 class="text-muted">Cambio: {{number_format($change,2)}}</h4>
            <div class="row justify-content-between mt-2">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    @if($total > 0)
                    <button onclick="Confirm('','clearCart','Seguro de Cancelar la Compra')"                    
                    class="btn btn-danger">
                        CANCELAR <small>(F4)</small>
                    </button>
                    @endif
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    @if($efectivo >= $total && $total > 0)
                    <button wire:click.prevent="saveSale"
                    class="btn btn-dark btn-md btn-block">GUARDAR <small>(F9)</small></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .car-now{
        align:right;
    }
    .car-now button{
        style:none;
        border:none;
        background-color:#dadce0;
        border-radius: 5px;
        width:110%;
        height: 80%;
        margin: 10px;
    }
</style>