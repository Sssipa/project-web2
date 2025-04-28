<nav x-data="{ isOpen: false }" class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="shrink-0 text-white">
                    <h1>SecondChange</h1>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    @auth
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ route('dashboard') }}" class=" {{ request()->is('/dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}}  no-underline rounded-md  px-3 py-2 text-sm font-medium ">
                                    {{ __('Dashboard') }}
                                </a>
                                <a href="{{ route('barangs.index') }}" class=" {{ request()->is('barangs') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} no-underline rounded-md px-3 py-2 text-sm font-medium ">
                                    {{ __('Beli') }}
                                </a>
                                <a href="{{ route('barangs.jual') }}" class="{{ request()->is('barangs/jual') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} no-underline rounded-md px-3 py-2 text-sm font-medium">
                                    {{ __('Jual Barang') }}
                                </a>
                            </div>
                    @endauth
                    @guest
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('login') }}" class=" no-underline rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="'no-underline rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3" x-data="{ isOpen: false }">
                        <button type="button" @click="isOpen = !isOpen" :aria-expanded="isOpen.toString()" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button">
                            <span class="sr-only">Open user menu</span>
                            @auth
                            <img class="size-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_photo_url) }}" alt="{{ Auth::user()->name }}">
                            @endauth
                        </button>
                        <div 
                            x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                            @auth
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">{{ __('Sign out') }}</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" :aria-expanded="isOpen.toString()">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="{{ route('dashboard') }}" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
            <a href="{{ route('barangs.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Beli</a>
            <a href="{{ route('barangs.jual') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Jual Barang</a>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    @auth
                    <img class="size-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_photo_url) }}" alt="{{ Auth::user()->name }}">
                    @endauth
                </div>
                <div class="ml-3">
                    @auth
                        <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                    @endauth
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                @auth
                    <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                            {{ __('Sign out') }}
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>