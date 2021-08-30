<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    @csrf
    <div class="input-group">
        <input type="text" wire:keydown.enter.prevent="$emit('scan-code',$('#code').val())" id="code" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
<script>
       document.addEventListener('DOMContentLoaded', function(){
        //para escuchar eventos
        livewire.on('scan-code',action => {
            $('#code').val('');
        });       
    });
</script>