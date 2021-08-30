<div>

    <style>

    </style>
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div class="col-sm-12 col-md-8">
                <!--Dettalles-->
                @include('livewire.pos.partials.details')
            </div>
            <div class="col-sm-12 col-md-4">
                <!--Total-->
                @include('livewire.pos.partials.total')
                <!--Monedas-->
                @include('livewire.pos.partials.coins')
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/js/keypress_fast.js') }}"></script>
@include('livewire.pos.scripts.general')
@include('livewire.pos.scripts.shortcuts')
@include('livewire.pos.scripts.events')
<script>

</script>