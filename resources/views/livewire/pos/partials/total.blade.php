<div class="row">
    <div class="col-sm-12 card py-2 border-left-primary">
        <div>
            <div class="connect-sorting">
                <h5 class="text-center card-title">RESUMEN DE VENTA</h5>
                <div class="">
                    <div class="card-body text-white" style="background: #003471">
                        <div class="">
                            <div>
                                <h3>TOTAL: Bs. {{ number_format($total,2) }}</h3>
                                <input type="hidden" id="hiddenTotal" value="{{$total}}">
                            </div>
                            <div>
                                <h5 class="mt-2">Articulos: {{ $itemsQuantity }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>