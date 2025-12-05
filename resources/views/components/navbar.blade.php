<header 
    x-data="{ mobileOpen: false, searchOpen: false }" 
    class="w-full sticky top-0 z-50 bg-[#000000] border-b border-white/10 py-5"
>
    <div class="w-full flex items-center justify-between px-4 md:px-8 lg:px-12">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <span class="text-2xl font-semibold text-white tracking-tight" style="font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    CellMart
</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            @php
                $navItems = [
                    'Home' => '/',
                    'Products' => 'products',
                    'Contact Us' => 'contact',
                    'About Us' => 'about',
                ];
            @endphp

            @foreach ($navItems as $name => $path)
                @php
                    $isActive = request()->is(trim($path, '/')) || ($path === '/' && request()->is('/'));
                @endphp

                <a href="{{ url($path) }}"
                   class="relative group text-white/90 hover:text-white text-sm font-normal tracking-tight px-2 py-2 transition">
                    {{ $name }}
                    <span class="absolute left-1/2 -bottom-0.5 w-4/5 h-[2px] bg-white 
                        transform -translate-x-1/2 
                        transition-all duration-300
                        {{ $isActive ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                    </span>
                </a>
            @endforeach
        </nav>

        <!-- Desktop Icons -->
        <div class="hidden md:flex items-center gap-5">

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative text-white/90 hover:text-white hover:scale-110 transition p-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.5 3.5h2l2.5 12h11l2.5-8H6.5"/>
                    <circle cx="10" cy="19" r="1"/>
                    <circle cx="17" cy="19" r="1"/>
                </svg>
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = 0;
                    foreach ($cart as $item) {
                        if (is_array($item) && isset($item['quantity'])) {
                            $cartCount += $item['quantity'];
                        }
                    }
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            

            <!-- Auth Buttons -->
            @if (Route::has('login'))
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                           class="text-white/90 hover:text-white text-sm px-3 py-2 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('profile.edit') }}"
                           class="text-white/90 hover:text-white text-sm px-3 py-2 transition">
                            Profile
                        </a>
                    @endif
                    
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white/90 hover:text-white text-sm px-3 py-2 transition">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-white/90 hover:text-white text-sm px-3 py-2 transition">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="text-white/90 hover:text-white text-sm px-3 py-2 transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center gap-4">
            <button @click="mobileOpen = !mobileOpen" 
                class="focus:outline-none flex flex-col gap-1 p-2">
                <span class="block w-[18px] h-[1px] bg-white transition"
                      :class="{ 'rotate-45 translate-y-[5px]': mobileOpen }"></span>
                <span class="block w-[18px] h-[1px] bg-white transition"
                      :class="{ 'opacity-0': mobileOpen }"></span>
                <span class="block w-[18px] h-[1px] bg-white transition"
                      :class="{ '-rotate-45 -translate-y-[5px]': mobileOpen }"></span>
            </button>
        </div>

    </div>

    <!-- MOBILE MENU -->
    <div 
        x-show="mobileOpen"
        x-transition
        class="md:hidden bg-black backdrop-blur-2xl px-6 py-4"
        style="display: none;"
    >
        <nav class="space-y-1">
            @foreach ($navItems as $name => $link)
            <a href="{{ url($link) }}"
               class="block text-white/90 hover:text-white hover:pl-2 text-lg py-4 border-b border-white/10 transition">
               {{ $name }}
            </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-6 pt-6 mt-6 border-t border-white/10">

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative text-white/90 hover:text-white hover:scale-110 transition p-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.5 3.5h2l2.5 12h11l2.5-8H6.5"/>
                    <circle cx="10" cy="19" r="1"/>
                    <circle cx="17" cy="19" r="1"/>
                </svg>
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = 0;
                    foreach ($cart as $item) {
                        if (is_array($item) && isset($item['quantity'])) {
                            $cartCount += $item['quantity'];
                        }
                    }
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <!-- User -->
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}"
                       class="text-white/90 hover:text-white hover:scale-110 transition p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="text-white/90 hover:text-white hover:scale-110 transition p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="text-white/90 hover:text-white hover:scale-110 transition p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
            @endauth
        </div>

        <!-- Auth Buttons -->
        @if (Route::has('login'))
        <div class="pt-4 mt-4 border-t border-white/10">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}"
                       class="block px-4 py-3 text-center text-sm text-white bg-white/10 hover:bg-white/20 rounded-lg transition mb-2">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-3 text-center text-sm text-white bg-white/10 hover:bg-white/20 rounded-lg transition mb-2">
                        Profile
                    </a>
                @endif
                
                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full block px-4 py-3 text-center text-sm text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition">
                        Log out
                    </button>
                </form>
            @else
            <a href="{{ route('login') }}"
               class="block px-4 py-3 mb-2 text-center text-sm text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="block px-4 py-3 text-center text-sm text-white bg-white/10 hover:bg-white/20 rounded-lg transition">
                Register
            </a>
            @endif
            @endauth
        </div>
        @endif
    </div>
</header>
