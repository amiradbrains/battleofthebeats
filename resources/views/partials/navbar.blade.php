<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                        <a class="dropdown-item pb-2 mb-1" href="#">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2 pe-1">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Hello</h6>
                                    <small class="text-muted">{{auth()->user()->name ?? ''}}</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    @role('user')

                    @php
                    $is_paid = App\Models\Payment::where('user_id', auth()->user()->id)->with('plan')->first();
                    @endphp
                    <li>
                        <a class="dropdown-item" href="{{route('upload-video', ['plan' => 'TNDS-S1', 'step' => 'profile'])}}">
                            <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    @endrole
                    @can('admin')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.videos.index') }}">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 mdi mdi-credit-card-outline me-1 mdi-20px"></i>
                                <span class="flex-grow-1 align-middle ms-1">Pending</span>
                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">
                                    <?php
                                    echo $pendings = App\Models\Video::where('state', 'pending')->count() ?? 0;
                                    ?>
                                </span>
                            </span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else


                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-power me-1 mdi-20px"></i>
                            <span class="align-middle">{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
