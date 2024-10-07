@extends('layouts.app-guest')
@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100xx dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-11">
                @auth
                    @role('admin')
                        <a href="{{ route('admin.auditions.index') }}?audition=TNDS-S1&status=&sort=highest-rating"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Hello {{ Auth::user()->name }}
                        </a>
                    @elseif (Auth::user()->hasRole('guru'))
                        <a href="{{ route('admin.videos.index') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Hello {{ Auth::user()->name }}
                        </a>
                    @elseif (Auth::user()->hasRole('user'))
                        <a href="{{ route('upload-video', ['TNDS-S1']) }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Hello {{ Auth::user()->name }}
                        </a>
                    @endrole


                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8  z-10">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo-or.png') }}" width="150px"
                    alt="{{ config('app.name', 'Battle of the Beats') }}">
            </div>

            <div class="mt-16">
                @if (session('error'))
                    <div class="alert alert-danger  text-gray-900 dark:text-white">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success  text-gray-900 dark:text-white">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-info  text-gray-900 dark:text-white">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    @foreach ($plans as $plan)
                        @php
                            $plan_active =
                                $plan->is_active && ($plan->audition_start <= now() && $plan->audition_end >= now())
                                    ? 1
                                    : 0;
                        @endphp
                        <a @if ($plan_active)
                        @role('admin') 
                        href="{{ route('admin.auditions.index') }}?audition={{ $plan->name }}&status=&sort=highest-rating" 
                    @else
                        @role('guru') 
                            href="{{ route('admin.videos.index') }}" 
                        @else
                            href="{{ route('upload-video', [$plan->name]) }}" 
                        @endrole
                    @endrole
                        
                        @else  style="cursor: not-allowed" href="#" @endif
                            class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="flex items-center justify-center rounded-full">
                                    <!-- <span class="mdi mdi-human-female-dance mdi-24px"></span> -->
                                    <img src="{{ asset($plan->logo) }}" class="aud-img" alt="$plan->name">
                                </div>

                                <!-- <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Dancing Competition</h2> -->

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed  dark:text-white">
                                    Upload Your Audition by clicking here, you will be redirected to the registration
                                    and payment page
                                </p>
                            </div>

                            <div
                                style="display: flex;justify-content: space-between;flex-direction: column; min-width: 200px">
                                @if (!$plan_active)
                                    <p class="text-sm font-semibold text-red text-right">
                                        Auditions closed
                                    </p>
                                @else
                                    <h2 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        @foreach ($plan->prices as $price_name => $price_amount)
                                            @php

                                                echo $price_name .
                                                    " $" .
                                                    $price_amount['Price'] .
                                                    ' ' .
                                                    $price_amount['Note'];
                                                echo "<hr style='border-style: dashed; margin-bottom: 10px !important' />";
                                            @endphp
                                        @endforeach

                                    </h2>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="self-end shrink-0 stroke-green-500 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                @endif


                            </div>
                        </a>
                    @endforeach
                    {{-- <a href="{{ route('goToPayment', ['Singing Super Star TUP 2024']) }}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="flex items-center rounded-full">
                                <!-- <span class="mdi mdi-microphone-settings mdi-24px"></span> -->
                                <img src="{{ asset('images/singinglogo-768x432.png') }}" class="aud-img" alt="Singing Competition">
                            </div>

                            <!-- <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Singing Competition</h2> -->

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed  dark:text-white">
                                Upload Your Audition by clicking here, you will be redirected to the registration and payment page
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">$10.00</h2>
                    </a> --}}
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-xl text-white font-bold mx-4">Powered by:</h2>
                <div class="flex justify-center items-center space-x-8">
                    <a target="_blank" rel="no-follow" href="https://cizzara.com"
                        class="flex justify-center items-center bg-gray-200 rounded-lg pwrd-img">
                        <img src="{{ asset('images/powered-by/Roshani-Black.png') }}" alt="Roshani">
                    </a>
                    <a target="_blank" rel="no-follow" href="https://cizzara.com"
                        class="flex justify-center items-center bg-gray-200 rounded-lg pwrd-img">
                        <img style="max-height: 90px;" src="{{ asset('images/powered-by/Cizzara-Black.jpg') }}"
                            alt="Cizzara">
                    </a>
                    <!-- Add more logos as needed -->
                </div>
            </div>


            <hr style="border: 1px solid rgba(100,100,100,0.1);
  margin-top: 100px;" />
            <div class="flex justify-center items-center" style="flex-direction: column; margin-top: 2rem">

                {{-- <div class="text-center text-sm sm:text-center"> --}}
                <img src="{{ asset('images/cards.png') }}" alt="all payment cards">
                <img src="{{ asset('images/secure.png') }}" style="max-width: 120px;" alt="100% secure">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Copyright &copy; <?php echo date('Y'); ?> Battle of the Beats.<br />All rights reserved. Powered by
                    Cizzara Studios.
                </div>
                {{-- </div> --}}


            </div>
        </div>
        <div class="overlay"></div>
    </div>
@endsection
