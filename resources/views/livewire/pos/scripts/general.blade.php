<script>
    function Confirm(id,eventName, text){
        Swal.fire({
            title: 'Confirmar',
            text: text,
            showCancelButton: true,
            cancelButtonText: 'CERRAR',
            cancelButtonColor: '#f00',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit(eventName, id);                
                swal.close();
            }
        });
    }
</script>