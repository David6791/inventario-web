<script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('vendor/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('vendor/js/all.min.js') }}"></script>


<script src="{{ asset('vendor/plugins/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/js/snackbar.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/js/currency.js') }}"></script>
<script src="{{ asset('vendor/js/onscan.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    function Noty(msg, option = 1)    
    {
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#fff',
            backgroundColor: option == 1 ? '#3b3f5c' : '$e7515a',
            pos: 'top-right'
        });
    }
</script>
@livewireScripts