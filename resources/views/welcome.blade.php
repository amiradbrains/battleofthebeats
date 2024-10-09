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

        <div class="main-overlay-bg"></div>
        <div class="social-icon-group">
            <ul>

            <li><a href="https://www.youtube.com/@BattleoftheBeatsOfficial" target="_blank"><svg fill="#ffffff" width="35px" height="35px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M24.325 8.309s-2.655-.334-8.357-.334c-5.517 0-8.294.334-8.294.334A2.675 2.675 0 0 0 5 10.984v10.034a2.675 2.675 0 0 0 2.674 2.676s2.582.332 8.294.332c5.709 0 8.357-.332 8.357-.332A2.673 2.673 0 0 0 27 21.018V10.982a2.673 2.673 0 0 0-2.675-2.673zM13.061 19.975V12.03L20.195 16l-7.134 3.975z"></path></g></svg></a></li>


                <li><a href="https://www.instagram.com/battleofthebeatsofficial/" target="_blank"><svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#ffffff"></path> <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#ffffff"></path> </g></svg></a></li>

                <li><a href="https://www.facebook.com/battleofthebeatsofficial" target="_blank"><svg width="30px" height="30px" viewBox="-5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>facebook [#ffffff]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-385.000000, -7399.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z" id="facebook-[#ffffff]"> </path> </g> </g> </g> </g></svg></a></li>
 
            </ul>
        </div>
         <div class="max-w-7xl mx-auto p-6 lg:p-8  z-10">
            <div class="flex justify-center mt-6 video-section">
                <!-- <img src="{{ asset('images/logo-or.png') }}" width="150px"
                    alt="{{ config('app.name', 'Battle of the Beats') }}"> -->
                    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/TlFGfcujzHQ?si=nQuPcAXrM59BJ07f&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>  </div>

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
                        <div class="box-content scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="flex items-center justify-center rounded-full">
                                    <!-- <span class="mdi mdi-human-female-dance mdi-24px"></span> -->
                                    <img src="{{ asset($plan->logo) }}" class="aud-img" alt="$plan->name">
                                </div>

                                <!-- <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Dancing Competition</h2> -->

                               
                            </div>

                            <div
                                style="display: flex;justify-content: space-between;flex-direction: column; align-items: center; min-width: 200px">
                                @if (!$plan_active)
                                    <p class="text-sm font-semibold text-red text-right">
                                        Auditions closed
                                    </p>
                                @else
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
                            class="register-btn"><span><svg fill="#000000" height="24px" width="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 297 297" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M148.5,0C66.485,0,0,66.485,0,148.5S66.485,297,148.5,297S297,230.515,297,148.5S230.515,0,148.5,0z M159.083,231.5H90.75 l74.25-84l-74.25-81h68.333l71.917,81L159.083,231.5z"></path> </g> </g></svg></span> REGISTER NOW</a>
                                   
                                @endif

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed  dark:text-white">
                                   <span style="color: #C3A37D;">ROUND 1:</span> ONLINE AUDITION SUBMISSION IS FREE OF COST
                                </p>
                            </div>
                        </div>
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
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed  dark:text-white">
                               <a href="https://www.battleofthebeats.in/privacy-policy">PRIVACY POLICY</a> - <a href="https://www.battleofthebeats.in/refundandcancellation">REFUND & CANCELLATION</a> - <a href="https://www.battleofthebeats.in/termsandconditions">TERMS & CONDITIONS</a> - <a href="https://www.battleofthebeats.in/faq">FAQ'S</a>
                            </p>
                <h2 class="text-xl text-white font-bold mx-4">Powered by:</h2>
                <div class="flex justify-center items-center space-x-8">
                <a target="_blank" rel="no-follow" href="https://cizzara.com"
                        class="flex justify-center items-center bg-gray-200 rounded-lg pwrd-img">
                        <img style="max-height: 90px;" src="{{ asset('images/powered-by/Cizzara-White.png') }}"
                            alt="Cizzara">
                    </a>
                    <a target="_blank" rel="no-follow" href="https://cizzara.com"
                        class="flex justify-center items-center bg-gray-200 rounded-lg pwrd-img">
                        <img src="{{ asset('images/powered-by/united-logo.png') }}" alt="Roshani">
                    </a>
                    
                    <!-- Add more logos as needed -->
                </div>
            </div>


            <hr style="border: 1px solid rgba(100,100,100,0.1);
  margin-top: 40px;" />
            <div class="flex justify-center items-center" style="flex-direction: column; margin-top: 2rem">

                {{-- <div class="text-center text-sm sm:text-center"> --}}
                <!-- <img src="{{ asset('images/cards.png') }}" alt="all payment cards">
                <img src="{{ asset('images/secure.png') }}" style="max-width: 120px;" alt="100% secure"> -->
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:ml-0">
                    Copyright &copy; <?php echo date('Y'); ?> Battle of the Beats.<br />All rights reserved. Powered by
                    Cizzara Studios.
                </div>
                {{-- </div> --}}


            </div>
         </div>
        


        <!-- <div class="overlay"></div> -->
    </div>
@endsection
