<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('/') }}" class="flex items-center space-x-3 ">
            <div class="rounded-full overflow-hidden">
                <img src="{{ asset('assets/logo.jpg') }}" class="h-12" alt="Flowbite Logo" />
            </div>
            <span
                class="self-center text-lg md:text-2xl font-bold whitespace-nowrap">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <div class="flex flex-col md:flex-row">
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 ">
                @auth
                    <button type="button"
                        class="flex text-sm bg-neutral-primary rounded-full md:me-0 focus:ring-4 focus:ring-neutral-tertiary"
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
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Earnings</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Sign
                                        out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="hidden md:flex border border-gray-400 bg-yellow-800 hover:bg-yellow-700 gap-1 justify-center items-center text-gray-50 font-semibold rounded py-2 px-4">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        <span>Masuk</span>
                    </a>
                @endauth
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
                <ul
                    class="font-medium hidden md:flex md:items-center  p-4 md:p-0 mt-4 border rounded-md  md:space-x-8  md:mt-0 md:border-0">
                    <li>
                        <a href="#" class="block py-2 px-3 rounded  md:border-0  md:p-0" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 rounded  md:border-0  md:p-0">About</a>
                    </li>
                    @guest
                        <li class="md:hidden">
                            <a href="{{ route('login') }}"
                                class="border border-gray-400 bg-yellow-800 hover:bg-yellow-700 flex gap-1 justify-center items-center text-gray-50 font-semibold rounded py-2 px-4">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                </svg>
                                <span>Masuk</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        <div class="hidden" id="navbar-user">
            <ul
            class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-md  md:flex-row md:space-x-8  md:mt-0 md:border-0 md:hidden">
            <li>
                <a href="#"
                class="block py-2 px-3 rounded  md:border-0  md:p-0"
                aria-current="page">Home</a>
            </li>
            <li>
                <a href="#"
                class="block py-2 px-3 rounded  md:border-0  md:p-0">About</a>
            </li>
                @guest
                <li class="md:hidden">
                    <a href="{{ route('login') }}"
                    class="border border-gray-400 bg-yellow-800 hover:bg-yellow-700 flex gap-1 justify-center items-center text-gray-50 font-semibold rounded py-2 px-4">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        <span>Masuk</span>
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>