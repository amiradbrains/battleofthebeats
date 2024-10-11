<!DOCTYPE html>

<html lang="en" class="dark-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-dark"
    data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Battle of the Beats</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/auth-style.css') }}">
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->

    @yield('head')
</head>

<body>
    <div class="main-overlay-bg"></div>

    <div class="position-relative">

        @if (auth()->user())
            <div class="layout-page">
                <!-- Navbar -->

                @include('partials.navbar')
            </div>
        @endif


        <div class="authentication-wrapper authentication-basic container-p-y pt-0" style="flex-direction: column;">


            <div class="col-10">
                @if ($step ?? null)
                    @include('partials.steps', ['active' => $step])
                @endif
            </div>


            <div class="justify-content-center d-flex {{ $width ?? 'col-md-8' }}">
                <div class="authentication-inner py-4">

                    <!-- Register Card -->
                    <div class="card p-2">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mt-5">
                            <a href="{{ route('welcome') }}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('images/dancelogo-768x432.png') }}" width="190px"
                                        alt="{{ config('app.name', 'Battle of the Beats') }}">
                                </span>
                            </a>

                        </div>
                        <!-- /Logo -->
                        <div class="card-body mt-2">
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
                            @if ($form_title ?? null)
                                <h4 class="mb-2">{{ $form_title }}</h4>
                                <p class="mb-4">{{ $form_description }}</p>
                            @endif
                            @yield('content')

                        </div>
                    </div>
                    <!-- Register Card -->
                    <!-- <img src="{{ asset('assets/img/illustrations/tree-3.png') }}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block hue" />
                    <img src="{{ asset('assets/img/illustrations/auth-basic-mask-light.png') }}" class="authentication-image d-none d-lg-block hue" alt="triangle-bg" data-app-light-img="illustrations/auth-basic-mask-light.png" data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
                    <img src="{{ asset('assets/img/illustrations/tree.png') }}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block hue" /> -->
                </div>
            </div>
        </div>
    </div>



    <div class="buy-now" style="display: none;">
        <a href="https://themeselection.com/item/materio-bootstrap-html-admin-template/" rel="no-follow">Upgrade to
            Pro</a>
    </div>
    <div class="floating_btn">
        <a target="_blank" href="https://wa.me/+916357995799?text=Hi">
            <div class="contact_icon">
                <i class="mdi mdi-36px mdi-whatsapp my-float"></i>
            </div>
        </a>
        <p class="text_icon">Need Help?</p>
    </div>

    <hr style="border: 1px solid rgba(100,100,100,0.1);
  margin-top: 40px;" />
    <div class="d-flex justify-content-center align-items-center position-relative"
        style="flex-direction: column; margin-top: 2rem">

        {{-- <div class="text-center text-sm sm:text-center"> --}}
        <img src="{{ asset('images/cards.png') }}" alt="all payment cards">
        <img src="{{ asset('images/secure.png') }}" style="max-width: 120px;" alt="100% secure">
        <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
            Copyright &copy; <?php echo date('Y'); ?> Battle of the Beats.<br />All rights reserved. Powered by
            Cizzara Studios.
        </div>
        {{-- </div> --}}

        {{-- <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Copyright &copy; <?php echo date('Y'); ?> Battle of the Beats.<br/>All rights reserved. Powered by Cizzara Studios.
                </div> --}}
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
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    @yield('bottom')
    @yield('custom-js')
</body>

</html>
