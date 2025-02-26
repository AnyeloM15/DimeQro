<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                    <img src="{{ DB::table('site_settings')->first()->logo }}" width="100px" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                


                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('dashboard')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Administrar</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/categories')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Categorias</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/subcategories')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Subcategorias</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/brands')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Marcas</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/products')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Productos</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/settings')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Configuraci&oacute;n</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/faqs')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Preguntas Frecuentes</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/contacts')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Contacto</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/users')}}" aria-expanded="false">
                        <span>
                        <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Administrar Usuarios</span>
                    </a>
                </li>
                @endif
                

                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- Sidebar End -->
