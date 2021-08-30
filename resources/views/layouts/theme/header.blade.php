<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/ventas.png') }}" alt="" width="80" alt="logo" class="navbar-logo">
            <b>MANIA</b>
        </div>
        
    </a>
    <hr class="sidebar-divider my-10">    
    
    <li class="nav-item">
        <a class="nav-link" href="{{ url('categories') }}">
            <i class="fab fa-buromobelexperte fa-3x"></i>
            <span>CATEGORIAS</span></a>
    </li>   
    <li class="nav-item">
        <a class="nav-link" href="{{ url('products') }}">
            <i class="fas fa-cubes fa-3x"></i>
            <span>PRODUCTOS</span></a>
    </li>  
    <li class="nav-item">
        <a class="nav-link" href="{{ url('stocks') }}">            
            <i class="fas fa-shopping-cart fa-3x"></i>
            <span>STOCKS</span></a>
    </li>  
    <li class="nav-item">
        <a class="nav-link" href="{{ url('ventas') }}">            
            <i class="fas fa-store fa-3x"></i>
            <span>VENTAS</span></a>
    </li>  
    <li class="nav-item">
        <a class="nav-link" href="{{ url('roles') }}">
            <i class="fas fa-key fa-3x"></i>
            <span>ROLES</span></a>
    </li>     
    <li class="nav-item">
        <a class="nav-link" href="{{ url('permisos') }}">
            <i class="far fa-calendar-check fa-3x"></i>
            <span>PERMISOS</span></a>
    </li>  
    <li class="nav-item">
        <a class="nav-link" href="{{ url('asignar') }}">
            <i class="far fa-list-alt fa-3x"></i>
            <span>ASIGNAR</span></a>
    </li>  
    <li class="nav-item">
        <a class="nav-link" href="{{ url('usuarios') }}">
            <i class="fas fa-users fa-3x"></i>
            <span>USUARIOS</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('coins') }}">
            <i class="fas fa-coins fa-3x"></i>
            <span>MONEDAS</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-hand-holding-usd fa-3x"></i>
            <span>ARQUEOS</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-chart-pie fa-3x"></i>
            <span>REPORTES</span></a>
    </li>
</ul>