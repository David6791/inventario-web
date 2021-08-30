<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" }}>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link href="{{ asset('vendor/fontawesome-free/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<style>
    aside{
        display: none!important;
    }
    @media(max-width: 480px){
        .mtmobile{
            margin-bottom: 20px!important;
        }
        .mbmobile{
            margin-bottom: 10px!important;
        }
        .hideonsm{
            display: none!important;
        }
        .inblock{
            display: block;
        }
    }
    .bg-dark-color{
        background-color: #003471;
    }
    .bg-gradient-primary {
    background-color: #003471!important;
    background-image: linear-gradient(180deg,#003471 10%,#003471 100%);
    background-size: cover;
    }
    .sidebar .sidebar-brand {
    height: 7.375rem!important;
    }
    footer.sticky-footer {
    color:#fff;
    padding: 0.5rem 0!important;
    background-color: #429b9b!important;
   }
   .card-header {
    padding-top: 0.75rem;
    padding-right: 1.25rem !important;
    padding-left: 1.25rem;
    margin-bottom: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    }
</style>
@livewireStyles