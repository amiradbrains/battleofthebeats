<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Battle of the Beats</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <style>
        nav svg {
            max-width: 25px !important;
        }

        ul.pagination {
            justify-content: center;
        }

        .main-overlay-bg{
            background-image: url({{ asset('assets/img/backgrounds/dance-bg.png') }});
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: fixed;
    top: 0;
    left: 0;
    min-height: 100vh;
    min-width: 100%;
    opacity: 0.9;
    z-index: -1;
        }

        .main-overlay-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7); /* blue color with 50% opacity */
    z-index: -1; /* Ensure the overlay doesn't cover content */
}

h4{
    color: #ffffff;
}

.card {
    background: rgba(0, 0, 0, 0.1); /* Semi-transparent background */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    backdrop-filter: blur(10px); /* Frosted glass blur effect */
    -webkit-backdrop-filter: blur(10px); /* Safari support */
}

.btn-primary {
    background-color: #5CE2E5;
        border-radius: 3rem;
        padding: 10px 20px 10px 20px;
        color: #44647D;
        font-weight: 900;
        width: fit-content;
        display: flex;
        column-gap: 10px;
        border: none;
}

.btn-primary:hover {
    background-color: #44647D !important;
        border-radius: 3rem;
        padding: 10px 20px 10px 20px;
        color: #44647D;
        font-weight: 900;
        width: fit-content;
        display: flex;
        column-gap: 10px;
        color: #5CE2E5 !important;
        border: none;
}

a{
    color: #5CE2E5;
}

a:hover{
    color: #44647D;

}

.page-item.active .page-link, .page-item.active .page-link:hover, .page-item.active .page-link:focus, .pagination li.active > a:not(.page-link), .pagination li.active > a:not(.page-link):hover, .pagination li.active > a:not(.page-link):focus {
    border-color: #5CE2E5;
    background-color: #5CE2E5;
    color: #44647D !important;
}

.pagination:not([class*=pagination-outline-]) .page-link {
    color: #ffffff;

}

.card-header {
   
    color: #ffffff;
    
}

.bg-menu-theme .menu-item.active > .menu-link:not(.menu-toggle) {
    background: linear-gradient(270deg, #5CE2E5 0%, #5CE2E5 100%);
    color: #44647D !important;
}

.bg-menu-theme .menu-item .menu-link>div{
    color: #44647D !important;
}

.bg-menu-theme .menu-item .menu-link .menu-icon{
    color: #44647D !important;
}

.menu-vertical.bg-menu-theme {
    background-color: #1B2D4B !important;
    color: #544f5a;
}

.btn-outline-primary {
    color: #5CE2E5;
    border-color: #5CE2E5;
    background: transparent;
}

.form-check-input:checked {
    background-color: #5CE2E5;
    border-color: #5CE2E5;
}

.btn-outline-primary:hover {
    color: #44647D !important;
    background-color: #fff3f3 !important;
    border-color: #5CE2E5 !important;
}




        
    </style>
    @yield('head')
</head>

<body>
<div class="main-overlay-bg"></div>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('partials.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('partials.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif

                        @yield('content')




                        <!--/ Responsive Table -->
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('partials.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now" style="display: none;">
        <a href="https://themeselection.com/item/materio-bootstrap-html-admin-template/" rel="no-follow">Upgrade to Pro</a>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            iconColor: '#ffcc99',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
        });
    </script>
    <!-- Page JS -->

    @yield('bottom')
</body>

</html>
