<!DOCTYPE html>

<html lang="en" class="dark-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-dark" data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template-free">

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
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" class="template-customizer-theme-css" />
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
    .required {
        color: red !important;
    }
        nav svg {
            max-width: 25px !important;
        }

        .floating_btn a {
            text-decoration: none;
        }

        .floating_btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 100px;
            height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        @keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(232, 76, 61, 0);
            }
        }

        .contact_icon {
            background-color: #42db87;
            color: #fff;
            width: 60px;
            height: 60px;
            font-size: 30px;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translatey(0px);
            animation: pulse 1.5s infinite;
            box-shadow: 0 0 0 0 #42db87;
            -webkit-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -moz-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -ms-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            font-weight: normal;
            font-family: sans-serif;
            text-decoration: none !important;
            transition: all 300ms ease-in-out;
        }


        .text_icon {
            margin-top: 8px;
            color: #707070;
            font-size: 13px;
        }
        body {
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: unset;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(58, 53, 65, 0);

}

.main-overlay-bg {
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

.card {
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    backdrop-filter: blur(10px); /* Frosted glass blur effect */
    -webkit-backdrop-filter: blur(10px); /* Safari support */
    border: 1px solid rgba(255, 255, 255, 0.59); /* Slight border for emphasis */
}

    </style>
    @yield('head')
</head>

<body>
<div class="main-overlay-bg"></div>

    <div class="position-relative">

    @if(auth()->user())
    <div class="layout-page">
                <!-- Navbar -->

                @include('partials.navbar')
</div>
@endif


        <div class="authentication-wrapper authentication-basic container-p-y pt-0" style="flex-direction: column;">


            <div class="col-10">
                @if($step ?? null)
                @include('partials.steps', ['active' => $step])
                @endif
            </div>


            <div class="justify-content-center d-flex {{$width ?? 'col-md-6'}}">
                <div class="authentication-inner py-4">

                    <!-- Register Card -->
                    <div class="card p-2">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mt-5">
                            <a href="{{ route('welcome') }}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <img class="invert" src="{{ asset('images/logo-or.png') }}" width="190px" alt="{{ config('app.name', 'Battle of the Beats') }}">
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
                            @if($form_title ?? null)
                            <h4 class="mb-2">{{$form_title}}</h4>
                            <p class="mb-4">{{$form_description}}</p>
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
        <a href="https://themeselection.com/item/materio-bootstrap-html-admin-template/" rel="no-follow">Upgrade to Pro</a>
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
            <div class="d-flex justify-content-center align-items-center position-relative" style="flex-direction: column; margin-top: 2rem" >

                {{-- <div class="text-center text-sm sm:text-center"> --}}
                    <!-- <img src="{{ asset('images/cards.png') }}" alt="all payment cards">
                    <img src="{{ asset('images/secure.png') }}" style="max-width: 120px;" alt="100% secure"> -->
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
</body>

</html>
