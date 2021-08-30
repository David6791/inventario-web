<script>    
    var listener = new window.keypress.Listener();
    listener.simple_combo("shift s", function() {
    console.log("You pressed shift and s");
    });
    listener.simple_combo("f9", function(){
        livewire.emit('saveSale')
    });
    listener.simple_combo("f8", function(){
        document.getElementById('cash').value = '';
        document.getElementById('cash').focus()
        window.livewire.emit('changeCero');  
    });
    listener.simple_combo("f4", function(){
        var total = (document.getElementById('hiddenTotal').value);
        if(total > 0){
            Confirm(0, 'clearCart','Segur@? de Eliminar el Carrito');
        }else{
            Toast.fire({
                icon: 'error',
                title: 'Agrega Productos a la Venta'
            })
        }
    });
</script>