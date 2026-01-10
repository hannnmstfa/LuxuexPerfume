<nav
    class="fixed w-full z-40 top-0 start-0 border-b border-gray-200 bg-white/20 backdrop-blur-xl backdrop-saturate-150">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('/') }}" class="flex items-center space-x-3 ">
            <div class="rounded-full overflow-hidden">
                <img src="{{ asset('assets/logo.jpg') }}" class="h-12" alt="Logo" />
            </div>
            <span
                class="self-center text-lg md:text-2xl font-bold whitespace-nowrap">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <div class="flex justify-between gap-2 items-center lg:hidden">
            @auth
                <button type="button" class="flex text-sm rounded-full md:me-0 focus:ring-4 focus:ring-neutral-tertiary"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden bg-gray-200 border border-default-medium rounded-md shadow-lg w-44"
                    id="user-dropdown">
                    <div class="px-4 py-3 text-sm border-b border-default">
                        <span class="block text-heading font-medium">{{ Auth::user()->name }}</span>
                        <span class="block text-body truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="p-2 text-sm text-body font-medium" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('profile') }}"
                                class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Profile</a>
                        </li>
                        <li>
                            <a class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded" 
                            href="{{ route('trx.index') }}">Transaksi</a>
                        </li>
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Admin
                                    Panel</a>
                            <li>
                        @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Sign
                                    out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base lg:hidden"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </button>
        </div>
        <div class="hidden w-full lg:block lg:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col space-y-1 lg:space-y-0 p-4 lg:p-0 mt-4 border border-gray-300 rounded-md lg:flex-row lg:items-center lg:justify-center lg:space-x-6 lg:mt-0 lg:border-0">
                <li>
                    <a href="{{ route('/') }}"
                        class="block py-2 px-3 rounded  md:px-2 {{ request()->is('/') ? 'md:border-b-2 md:border-yellow-800' : 'md:hover:border-b-2 md:hover:border-yellow-800' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('produk') }}"
                        class="block py-2 px-3 rounded  md:px-2 {{ request()->is('produk*') ? 'md:border-b-2 md:border-yellow-800' : 'md:hover:border-b-2 md:hover:border-yellow-800' }}">Produk</a>
                </li>
                <li>
                    <livewire:produk.search />
                </li>
                @guest
                    <li>
                        <a href="{{ route('login') }}"
                            class="border border-gray-400 bg-yellow-800 hover:bg-yellow-700 flex gap-1 justify-center items-center text-gray-50 font-semibold rounded py-2 px-4">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                            </svg>
                            <span>Masuk</span>
                        </a>
                    </li>
                @else
                    <button type="button" class="hidden lg:flex text-sm w-max rounded-full lg:me-0 focus:ring-2"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-menu-lg"
                        data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-20 lg:w-10 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                            alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden bg-gray-100 border border-default-medium rounded-md shadow-lg w-44"
                        id="user-menu-lg">
                        <div class="px-4 py-3 text-sm border-b border-gray-300">
                            <span class="block text-heading font-medium">{{ Auth::user()->name }}</span>
                            <span class="block text-gray-500 truncate">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="p-2 text-sm text-body font-medium " aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('profile') }}"
                                    class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Profile</a>
                            </li>
                            <li>
                            <a class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded" 
                            href="{{ route('trx.index') }}">Transaksi</a>
                        </li>
                            @if (Auth::user()->role == 'admin')
                                <li>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Admin
                                        Panel</a>
                                </li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center w-full p-2 hover:bg-gray-200 rounded">Sign
                                        out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>