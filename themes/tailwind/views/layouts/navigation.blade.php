<!-- <nav class="bg-white border-b border-gray-100">-->
    <!-- Primary Navigation Menu -->
    <!--<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-gray-500 hover:text-gray-700 text-sm font-medium leading-5">
            <div class="flex">-->
                <!-- Logo -->
                <!-- <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto h-10 text-gray-600 fill-current" />
                    </a>
                </div> -->

                <!-- Navigation Links -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900 focus:border-indigo-700' : 'border-transparent hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 focus:outline-none">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div> -->

            <!-- Settings -->
            <!-- <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div>{{ Auth::user()->name }}</div>

                    <a href="{{ route('logout') }}"
                        class="h-16 ml-4 border-transparent hover:border-gray-300 focus:text-gray-700 focus:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 focus:outline-none"
                        onclick="event.preventDefault();logoutFB();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav> -->
<!-- component -->
<!-- <nav class="bg-white border-b border-gray-100"> -->
    <!-- Primary Navigation Menu -->
    <!-- <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center"> -->
            <!-- Logo -->
            <!-- <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block w-auto h-10 text-gray-600 fill-current" />
                </a>
            </div> -->

            <!-- Desktop Navigation Links -->
            <!-- <div class="hidden space-x-8 sm:flex">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900 focus:border-indigo-700' : 'border-transparent hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 focus:outline-none">
                    {{ __('Dashboard') }}
                </a>
            </div> -->

            <!-- Desktop Settings -->
            <!-- <div class="hidden sm:flex sm:items-center">
                @auth
                    <div class="text-gray-500 hover:text-gray-700">{{ Auth::user()->name }}</div>

                    <a href="{{ route('logout') }}"
                        class="ml-4 border-transparent hover:border-gray-300 focus:text-gray-700 focus:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 focus:outline-none"
                        onclick="event.preventDefault();logoutFB();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </div> -->

            <!-- Mobile Menu Button -->
            <!-- <div class="sm:hidden">
                <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div> -->

        <!-- Mobile Menu -->
        <!-- <div x-show="open" class="sm:hidden">
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900 focus:border-indigo-700' : 'border-transparent hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }} block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    {{ __('Dashboard') }}
                </a>
            </div>

            @auth
                <div class="border-t border-gray-200">
                    <div class="px-4 py-2 text-gray-500">{{ Auth::user()->name }}</div>
                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                        onclick="event.preventDefault();logoutFB();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav> -->
<!-- Navbar -->

<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
        <form id="changePasswordForm"><!-- class="bg-white p-6 rounded-lg shadow-md"-->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Change Password</h3>
                            <!-- Current Password -->
                            <div id="currentPasswordContainer" class="mt-2 mb-4">
                                <label for="current_password" class="block text-sm font-medium text-gray-700">
                                    Current Password
                                </label>
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                    required
                                />
                            </div>

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">
                                    New Password
                                </label>
                                <input 
                                    type="password" 
                                    id="new_password" 
                                    name="new_password" 
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                    required
                                />
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm New Password
                                </label>
                                <input 
                                    type="password" 
                                    id="new_password_confirmation" 
                                    name="new_password_confirmation" 
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="submitPasswordChange" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Update Password</button><!-- data-close-modal-->
                <button data-close-modal type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
                <!-- Feedback -->
                <div id="feedback" class="mt-4 text-sm"></div>
            </div>
        </form>
    </div>
  </div>
</div>


<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
<!-- npm install @headlessui/vue @heroicons/vue -->
<div class="bg-blue-500"><!--https://freefrontend.com/tailwind-navbars/ https://www.creative-tim.com/twcomponents/component/navbar-hamburger-menu -->
	<nav class="relative px-4 py-4 flex justify-between items-center bg-white">
		<a class="text-3xl font-bold leading-none items-center flex" style="gap: 0.5rem;" href="{{ route('dashboard') }}">
			<!-- <svg class="h-10" alt="logo" viewBox="0 0 10240 10240">
				<path xmlns="http://www.w3.org/2000/svg" d="M8284 9162 c-2 -207 -55 -427 -161 -667 -147 -333 -404 -644 -733 -886 -81 -59 -247 -169 -256 -169 -3 0 -18 -9 -34 -20 -26 -19 -344 -180 -354 -180 -3 0 -29 -11 -58 -24 -227 -101 -642 -225 -973 -290 -125 -25 -397 -70 -480 -80 -22 -3 -76 -9 -120 -15 -100 -13 -142 -17 -357 -36 -29 -2 -98 -7 -153 -10 -267 -15 -436 -28 -525 -40 -14 -2 -45 -7 -70 -10 -59 -8 -99 -14 -130 -20 -14 -3 -41 -7 -60 -11 -19 -3 -39 -7 -45 -8 -5 -2 -28 -6 -50 -10 -234 -45 -617 -165 -822 -257 -23 -10 -45 -19 -48 -19 -7 0 -284 -138 -340 -170 -631 -355 -1107 -842 -1402 -1432 -159 -320 -251 -633 -308 -1056 -26 -190 -27 -635 -1 -832 3 -19 7 -59 10 -89 4 -30 11 -84 17 -120 6 -36 12 -77 14 -91 7 -43 33 -174 39 -190 3 -8 7 -28 9 -45 6 -35 52 -221 72 -285 7 -25 23 -79 35 -120 29 -99 118 -283 189 -389 67 -103 203 -244 286 -298 75 -49 178 -103 196 -103 16 0 27 16 77 110 124 231 304 529 485 800 82 124 153 227 157 230 3 3 28 36 54 74 116 167 384 497 546 671 148 160 448 450 560 542 14 12 54 45 90 75 88 73 219 172 313 238 42 29 77 57 77 62 0 5 -13 34 -29 66 -69 137 -149 405 -181 602 -7 41 -14 82 -15 90 -1 8 -6 46 -10 83 -3 37 -8 77 -10 88 -2 11 -7 65 -11 122 -3 56 -8 104 -9 107 -2 3 0 12 5 19 6 10 10 8 15 -10 10 -34 167 -346 228 -454 118 -210 319 -515 340 -515 4 0 40 18 80 40 230 128 521 255 787 343 118 40 336 102 395 113 28 5 53 11 105 23 25 5 59 12 75 15 17 3 41 8 55 11 34 7 274 43 335 50 152 18 372 29 565 29 194 0 481 -11 489 -19 2 -3 -3 -6 -12 -6 -9 -1 -20 -2 -24 -3 -33 -8 -73 -16 -98 -21 -61 -10 -264 -56 -390 -90 -649 -170 -1243 -437 -1770 -794 -60 -41 -121 -82 -134 -93 l-24 -18 124 -59 c109 -52 282 -116 404 -149 92 -26 192 -51 220 -55 17 -3 64 -12 105 -21 71 -14 151 -28 230 -41 19 -3 46 -7 60 -10 14 -2 45 -7 70 -10 25 -4 56 -8 70 -10 14 -2 53 -7 88 -10 35 -4 71 -8 81 -10 10 -2 51 -6 92 -9 101 -9 141 -14 147 -21 3 -3 -15 -5 -39 -6 -24 0 -52 -2 -62 -4 -21 -4 -139 -12 -307 -22 -242 -14 -700 -7 -880 13 -41 4 -187 27 -250 39 -125 23 -274 68 -373 111 -43 19 -81 34 -86 34 -4 0 -16 -8 -27 -17 -10 -10 -37 -33 -59 -52 -166 -141 -422 -395 -592 -586 -228 -257 -536 -672 -688 -925 -21 -36 -43 -66 -47 -68 -4 -2 -8 -7 -8 -11 0 -5 -24 -48 -54 -97 -156 -261 -493 -915 -480 -935 2 -3 47 -21 101 -38 54 -18 107 -36 118 -41 58 -25 458 -138 640 -181 118 -27 126 -29 155 -35 14 -2 45 -9 70 -14 66 -15 137 -28 300 -55 37 -7 248 -33 305 -39 28 -3 84 -9 125 -13 163 -16 792 -8 913 12 12 2 58 9 102 15 248 35 423 76 665 157 58 19 134 46 170 60 86 33 344 156 348 166 2 4 8 7 13 7 14 0 205 116 303 184 180 126 287 216 466 396 282 281 511 593 775 1055 43 75 178 347 225 455 100 227 236 602 286 790 59 220 95 364 120 485 6 28 45 245 50 275 2 14 7 41 10 60 3 19 8 49 10 65 2 17 6 46 9 65 15 100 35 262 40 335 3 39 8 89 10 112 22 225 33 803 21 1043 -3 41 -7 129 -11 195 -3 66 -8 136 -10 155 -2 19 -6 76 -10 125 -3 50 -8 101 -10 115 -2 14 -6 57 -10 95 -7 72 -12 113 -20 175 -2 19 -7 55 -10 80 -6 46 -43 295 -51 340 -2 14 -9 54 -15 90 -5 36 -16 97 -24 135 -8 39 -17 84 -20 100 -12 68 -18 97 -50 248 -19 87 -47 204 -61 260 -14 56 -27 109 -29 117 -30 147 -232 810 -253 832 -4 4 -7 -23 -8 -60z"></path>
			</svg> -->
            <img class="h-10" src="/logo/website.png" alt="ICE logo"><span>ICE</span>
		</a>
		<div class="lg:hidden">
			<button class="navbar-burger flex items-center text-blue-600 p-3"><!-- data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"-->
				<svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<title>Mobile menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
		<ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<!-- <li><a class="text-sm text-blue-600 font-bold" href="#">About Us</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Services</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Pricing</a></li>
			<li class="text-gray-300">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
				</svg>
			</li>
			<li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Contact</a></li> -->
		</ul>
         
        @auth
		<!-- <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200" href="#">{{ Auth::user()->name }}</a> -->

            <!-- User Name Button -->
            <a 
                id="dropdownToggleAuthName" 
                class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold rounded-xl transition duration-200 cursor-pointer" 
                onclick="toggleDropdown()"
            >
                {{ Auth::user()->name }}
            </a>

            <!-- Dropdown Menu -->
            <div 
                id="dropdownMenuAuthName" 
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden" style="top:3rem;right:7.5rem"
            >
                <ul class="py-2 text-sm text-gray-700">
                    <li>
                        <a  id="openModalButton" 
                            href="#" 
                            class="block px-4 py-2 hover:bg-gray-100"
                        >
                            Change Password
                        </a>
                    </li>
                    <!-- <li>
                        <a 
                            href="{{-- route('settings') --}}" 
                            class="block px-4 py-2 hover:bg-gray-100"
                        >
                            Settings
                        </a>
                    </li>
                    <li>
                        <a 
                            href="{{-- route('logout') --}}" 
                            class="block px-4 py-2 hover:bg-gray-100"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li> -->
                </ul>
            </div>


		<a class="hidden lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();logoutFB();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        @endauth
	</nav>
    
    

    <!--Bootstrap-->
    <!-- <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header"> -->
            <!-- <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5> -->
            <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex flex-col"> -->
            <!-- <p>Try scrolling the rest of the page to see this option in action.</p> -->
            <!-- <div>
                <ul>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold hover:bg-blue-50 hover:text-blue-600 rounded {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-400' }}"  href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                </ul>
            </div>
            <div class="mt-auto">
                <div class="pt-6">
                    @auth
                    <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="#">{{ Auth::user()->name }}</a>
                    <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();logoutFB();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endauth
                </div>
                <p class="my-4 text-xs text-center text-gray-400">
                    <span>Copyright © ICE 2025</span>
                </p>
            </div>
        </div>
    </div> -->
    <!--END of Bootstrap-->

	<div class="navbar-menu fixed inset-0 z-50 hidden bg-black bg-opacity-50 transition-all duration-300 opacity-0 translate-x-full"><!--navbar-menu relative z-50 hidden transition-all duration-300-->
		<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
		<nav class="fixed top-0 right-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
			<div class="flex items-center mb-8">
				<a class="mr-auto text-3xl font-bold leading-none flex items-center" style="gap: 0.5rem;" href="{{ route('dashboard') }}">
					<!-- <svg class="h-12" alt="logo" viewBox="0 0 10240 10240">
				        <path xmlns="http://www.w3.org/2000/svg" d="M8284 9162 c-2 -207 -55 -427 -161 -667 -147 -333 -404 -644 -733 -886 -81 -59 -247 -169 -256 -169 -3 0 -18 -9 -34 -20 -26 -19 -344 -180 -354 -180 -3 0 -29 -11 -58 -24 -227 -101 -642 -225 -973 -290 -125 -25 -397 -70 -480 -80 -22 -3 -76 -9 -120 -15 -100 -13 -142 -17 -357 -36 -29 -2 -98 -7 -153 -10 -267 -15 -436 -28 -525 -40 -14 -2 -45 -7 -70 -10 -59 -8 -99 -14 -130 -20 -14 -3 -41 -7 -60 -11 -19 -3 -39 -7 -45 -8 -5 -2 -28 -6 -50 -10 -234 -45 -617 -165 -822 -257 -23 -10 -45 -19 -48 -19 -7 0 -284 -138 -340 -170 -631 -355 -1107 -842 -1402 -1432 -159 -320 -251 -633 -308 -1056 -26 -190 -27 -635 -1 -832 3 -19 7 -59 10 -89 4 -30 11 -84 17 -120 6 -36 12 -77 14 -91 7 -43 33 -174 39 -190 3 -8 7 -28 9 -45 6 -35 52 -221 72 -285 7 -25 23 -79 35 -120 29 -99 118 -283 189 -389 67 -103 203 -244 286 -298 75 -49 178 -103 196 -103 16 0 27 16 77 110 124 231 304 529 485 800 82 124 153 227 157 230 3 3 28 36 54 74 116 167 384 497 546 671 148 160 448 450 560 542 14 12 54 45 90 75 88 73 219 172 313 238 42 29 77 57 77 62 0 5 -13 34 -29 66 -69 137 -149 405 -181 602 -7 41 -14 82 -15 90 -1 8 -6 46 -10 83 -3 37 -8 77 -10 88 -2 11 -7 65 -11 122 -3 56 -8 104 -9 107 -2 3 0 12 5 19 6 10 10 8 15 -10 10 -34 167 -346 228 -454 118 -210 319 -515 340 -515 4 0 40 18 80 40 230 128 521 255 787 343 118 40 336 102 395 113 28 5 53 11 105 23 25 5 59 12 75 15 17 3 41 8 55 11 34 7 274 43 335 50 152 18 372 29 565 29 194 0 481 -11 489 -19 2 -3 -3 -6 -12 -6 -9 -1 -20 -2 -24 -3 -33 -8 -73 -16 -98 -21 -61 -10 -264 -56 -390 -90 -649 -170 -1243 -437 -1770 -794 -60 -41 -121 -82 -134 -93 l-24 -18 124 -59 c109 -52 282 -116 404 -149 92 -26 192 -51 220 -55 17 -3 64 -12 105 -21 71 -14 151 -28 230 -41 19 -3 46 -7 60 -10 14 -2 45 -7 70 -10 25 -4 56 -8 70 -10 14 -2 53 -7 88 -10 35 -4 71 -8 81 -10 10 -2 51 -6 92 -9 101 -9 141 -14 147 -21 3 -3 -15 -5 -39 -6 -24 0 -52 -2 -62 -4 -21 -4 -139 -12 -307 -22 -242 -14 -700 -7 -880 13 -41 4 -187 27 -250 39 -125 23 -274 68 -373 111 -43 19 -81 34 -86 34 -4 0 -16 -8 -27 -17 -10 -10 -37 -33 -59 -52 -166 -141 -422 -395 -592 -586 -228 -257 -536 -672 -688 -925 -21 -36 -43 -66 -47 -68 -4 -2 -8 -7 -8 -11 0 -5 -24 -48 -54 -97 -156 -261 -493 -915 -480 -935 2 -3 47 -21 101 -38 54 -18 107 -36 118 -41 58 -25 458 -138 640 -181 118 -27 126 -29 155 -35 14 -2 45 -9 70 -14 66 -15 137 -28 300 -55 37 -7 248 -33 305 -39 28 -3 84 -9 125 -13 163 -16 792 -8 913 12 12 2 58 9 102 15 248 35 423 76 665 157 58 19 134 46 170 60 86 33 344 156 348 166 2 4 8 7 13 7 14 0 205 116 303 184 180 126 287 216 466 396 282 281 511 593 775 1055 43 75 178 347 225 455 100 227 236 602 286 790 59 220 95 364 120 485 6 28 45 245 50 275 2 14 7 41 10 60 3 19 8 49 10 65 2 17 6 46 9 65 15 100 35 262 40 335 3 39 8 89 10 112 22 225 33 803 21 1043 -3 41 -7 129 -11 195 -3 66 -8 136 -10 155 -2 19 -6 76 -10 125 -3 50 -8 101 -10 115 -2 14 -6 57 -10 95 -7 72 -12 113 -20 175 -2 19 -7 55 -10 80 -6 46 -43 295 -51 340 -2 14 -9 54 -15 90 -5 36 -16 97 -24 135 -8 39 -17 84 -20 100 -12 68 -18 97 -50 248 -19 87 -47 204 -61 260 -14 56 -27 109 -29 117 -30 147 -232 810 -253 832 -4 4 -7 -23 -8 -60z"></path>
			        </svg> -->
                    <img class="h-10" src="/logo/website.png" alt="ICE logo"><span>ICE</span>
				</a>
				<button class="navbar-close">
					<svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
			<div>
				<ul>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
					</li>
					<!-- <li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">About Us</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Services</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Pricing</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Contact</a>
					</li> -->
				</ul>
			</div>
			<div class="mt-auto">
				<div class="pt-6">
					<!-- <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="#">Sign in</a>
					<a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="#">Sign Up</a> -->
                    @auth
                    <a id="dropdownToggleAuthNameCollapse" onclick="toggleDropdownCollapse()" class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="#">{{ Auth::user()->name }}</a>
					<!-- Dropdown Menu -->
                    <div 
                        id="dropdownMenuAuthNameCollapse" 
                        class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg hidden" style="bottom: 4.15rem; right: 1.5rem; width: 18.5rem;"
                    >
                        <ul class="py-2 text-sm text-gray-700">
                            <li>
                                <a  id="openModalButtonCollapse" 
                                    href="#" 
                                    class="block px-4 py-2 hover:bg-gray-100"
                                >
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();logoutFB();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endauth
				</div>
				<p class="my-4 text-xs text-center text-gray-400">
					<span>Copyright © ICE 2025</span>
				</p>
			</div>
		</nav>
	</div>
</div>

<!-- <script>
// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});
</script> -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const toggleDropdown = () => {
        const dropdownMenuAuthName = document.getElementById('dropdownMenuAuthName');
        dropdownMenuAuthName.classList.toggle('hidden'); // Show or hide the dropdown
    };
    const toggleDropdownCollapse = () => {
        const dropdownMenuAuthNameCollapse = document.getElementById('dropdownMenuAuthNameCollapse');
        dropdownMenuAuthNameCollapse.classList.toggle('hidden'); // Show or hide the dropdown
    };

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        const dropdownMenuAuthName = document.getElementById('dropdownMenuAuthName');
        const dropdownToggleAuthName = document.getElementById('dropdownToggleAuthName');

        if (
            dropdownMenuAuthName && 
            dropdownToggleAuthName && 
            !dropdownMenuAuthName.contains(event.target) && 
            !dropdownToggleAuthName.contains(event.target)
        ) {
            dropdownMenuAuthName.classList.add('hidden');
        }

        const dropdownMenuAuthNameCollapse = document.getElementById('dropdownMenuAuthNameCollapse');
        const dropdownToggleAuthNameCollapse = document.getElementById('dropdownToggleAuthNameCollapse');

        if (
            dropdownMenuAuthNameCollapse && 
            dropdownToggleAuthNameCollapse && 
            !dropdownMenuAuthNameCollapse.contains(event.target) && 
            !dropdownToggleAuthNameCollapse.contains(event.target)
        ) {
            dropdownMenuAuthNameCollapse.classList.add('hidden');
        }
    });

    let currentPasswordContainer = true;
    axios.get('{{ route("cPD") }}').then(response => {
        //console.log(response.data);
        if (response.data.success==200)
        {
            document.getElementById('currentPasswordContainer').classList.add('hidden');
            currentPasswordContainer = false;
        }
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        // Get modal and buttons
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModalButton');
        const openModalButtonCollapse = document.getElementById('openModalButtonCollapse');
        const closeModalButtons = document.querySelectorAll('[data-close-modal]');

        // Function to show modal
        const showModal = () => {
            modal.classList.remove('hidden');
        };

        // Function to hide modal
        const hideModal = () => {
            modal.classList.add('hidden');
        };

        // Attach event listener to open modal button
        if (openModalButton) {
            openModalButton.addEventListener('click', showModal);
        }
        if (openModalButtonCollapse) {
            openModalButtonCollapse.addEventListener('click', showModal);
        }

        // Attach event listener to close modal buttons
        closeModalButtons.forEach((button) => {
            button.addEventListener('click', hideModal);
        });

        // Close modal on clicking outside the modal content
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                hideModal();
            }
        });

        document.getElementById('submitPasswordChange').addEventListener('click', function () {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const newPasswordConfirmation = document.getElementById('new_password_confirmation').value;

            // Clear feedback
            const feedback = document.getElementById('feedback');
            feedback.innerHTML = '';

            // Validate inputs
            if (!newPassword || !newPasswordConfirmation) {
                //feedback.innerHTML = '<p class="text-red-500">All fields are required.</p>';
                feedback.innerHTML = `<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">All fields are required.</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" 
                    onclick="document.getElementById('alert').style.display='none'">
                        <span class="text-red-500 hover:text-red-700">&times;</span>
                    </button>
                </div>
                `;
                return;
            }else if(currentPasswordContainer && !currentPassword){
                //feedback.innerHTML = '<p class="text-red-500">All fields are required.</p>';
                feedback.innerHTML = `<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">All fields are required.</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" 
                    onclick="document.getElementById('alert').style.display='none'">
                        <span class="text-red-500 hover:text-red-700">&times;</span>
                    </button>
                </div>
                `;
                return;
            }

            // Send the request
            axios.post('{{ route("updatePassword") }}', {
                current_password: currentPassword,
                new_password: newPassword,
                new_password_confirmation: newPasswordConfirmation,
            }).then(response => {
                //feedback.innerHTML = `<p class="text-green-500">${response.data.message}</p>`;
                feedback.innerHTML = `<div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">${response.data.message}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" 
                    onclick="document.getElementById('alert').style.display='none'">
                        <span class="text-green-500 hover:text-green-700">&times;</span>
                    </button>
                </div>
                `;
                document.getElementById('changePasswordForm').reset();
                //modal.classList.add('hidden');
            }).catch(error => {
                if (error.response.status === 422) {
                    //feedback.innerHTML = `<p class="text-red-500">${error.response.data.message}</p>`;
                    feedback.innerHTML = `<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">${error.response.data.message}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" 
                        onclick="document.getElementById('alert').style.display='none'">
                            <span class="text-red-500 hover:text-red-700">&times;</span>
                        </button>
                    </div>
                    `;
                } else {
                    //feedback.innerHTML = `<p class="text-red-500">An error occurred. Please try again.</p>`;
                    feedback.innerHTML = `<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">An error occurred. Please try again.</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close" 
                        onclick="document.getElementById('alert').style.display='none'">
                            <span class="text-red-500 hover:text-red-700">&times;</span>
                        </button>
                    </div>
                    `;
                }
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Open and close functions with transition effects
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (burger.length && menu.length) {
        burger.forEach((btn) => {
            btn.addEventListener('click', function() {
                menu.forEach((offcanvas) => {
                    // Remove "hidden" initially and apply transition classes
                    offcanvas.classList.remove('hidden');
                    offcanvas.classList.add('transition-all', 'duration-300', 'opacity-0', 'translate-x-full');

                    // Trigger the transition
                    setTimeout(() => {
                        offcanvas.classList.remove('opacity-0', 'translate-x-full');
                        offcanvas.classList.add('opacity-100', 'translate-x-0');
                    }, 10);
                });
            });
        });
    }

    if (close.length) {
        close.forEach((btn) => {
            btn.addEventListener('click', function() {
                menu.forEach((offcanvas) => {
                    // Apply transition classes for hiding
                    offcanvas.classList.remove('opacity-100', 'translate-x-0');
                    offcanvas.classList.add('opacity-0', 'translate-x-full');

                    // After the transition, add "hidden" to fully hide
                    setTimeout(() => {
                        offcanvas.classList.add('hidden');
                    }, 300); // Match the duration-300 class
                });
            });
        });
    }

    if (backdrop.length) {
        backdrop.forEach((el) => {
            el.addEventListener('click', function() {
                menu.forEach((offcanvas) => {
                    // Apply transition classes for hiding
                    offcanvas.classList.remove('opacity-100', 'translate-x-0');
                    offcanvas.classList.add('opacity-0', 'translate-x-full');

                    // After the transition, add "hidden" to fully hide
                    setTimeout(() => {
                        offcanvas.classList.add('hidden');
                    }, 300); // Match the duration-300 class
                });
            });
        });
    }
});

</script>

<script>
    function logoutFB() {
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                FB.logout(function (response) {
                    // Perform additional actions here, like redirecting the user
                    console.log('User logged out from Facebook');
                    //window.location.href = "/logout"; // Redirect to your app's logout route
                });
            } else {
                console.log('User is not logged in with Facebook');
            }
        });
    }
</script>
<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v21.0&appId=1025483438685335"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->