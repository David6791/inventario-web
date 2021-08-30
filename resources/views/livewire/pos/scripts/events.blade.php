<script>
    
    document.addEventListener('DOMContentLoaded', function(){
        //para escuchar eventos
        window.livewire.on('scan-ok',msg => {
            Toast.fire({
                icon: 'success',
                title: msg
            })
        });
        window.livewire.on('no-stock',msg => {
            Toast.fire({
                icon: 'error',
                title: msg
            })
        });
        window.livewire.on('scan-notfound',msg => {
            Toast.fire({
                icon: 'error',
                title: msg
            })
        });
        
        window.livewire.on('print-ticket',saleId => {
            window.open("print//"+saleId,'_blank')
        });
    });
</script>