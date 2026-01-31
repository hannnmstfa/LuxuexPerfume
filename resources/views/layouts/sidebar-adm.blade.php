<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-100 border-r border-gray-300 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2  rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-800 text-white dark:bg-gray-700' : 'text-gray-900 hover:text-white hover:bg-yellow-800 dark:text-white dark:hover:bg-gray-700 group' }}">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 {{ request()->routeIs('admin.dashboard') ? 'text-white dark:text-white' : 'text-gray-900 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admProduk.index') }}"
                    class="flex items-center p-2  rounded-lg {{ request()->routeIs('admProduk.*') ? 'bg-yellow-800 text-white dark:bg-gray-700' : 'text-gray-900 hover:text-white hover:bg-yellow-800 dark:text-white dark:hover:bg-gray-700 group' }}">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 {{ request()->routeIs('admProduk.*') ? 'text-white dark:text-white' : 'text-gray-900 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admTrx.index') }}"
                    class="flex items-center p-2  rounded-lg {{ request()->routeIs('admTrx.*') ? 'bg-yellow-800 text-white dark:bg-gray-700' : 'text-gray-900 hover:text-white hover:bg-yellow-800 dark:text-white dark:hover:bg-gray-700 group' }}">
                    <svg class="shrink-0 w-6 h-6 transition duration-75 {{ request()->routeIs('admTrx.*') ? 'text-white dark:text-white' : 'text-gray-900 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white' }}" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.99999 10.8571 12 13.1428m-4.00001-2.2857L4 13.1428m3.99999-2.2857.00004-4.57139M12 13.1428v4.5715m0-4.5715-4.00001 2.2857M12 13.1428l4-2.2857m-4 2.2857V8.57143m0 4.57137 4 2.2858m-4 2.2857L7.99999 20M12 17.7143 16 20m-8.00001 0L4 17.7143v-4.5715M7.99999 20v-4.5715M4 13.1428l3.99999 2.2857M16 6.28571 12 4 8.00003 6.28571m7.99997 0v4.57139m0-4.57139-4 2.28572m4 2.28567 4 2.2858M8.00003 6.28571 12 8.57143m8 4.57147v4.5714L16 20m4-6.8571-4 2.2857M16 20v-4.5714" />
                    </svg>
                    <span class="ms-3">Transaksi</span>
                </a>
            </li>
            <hr class="my-2">
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full  rounded-lg dark:text-white hover:bg-yellow-800 dark:hover:bg-gray-700 group {{ request()->routeIs('users.*') ? 'bg-yellow-800 dark:bg-gray-700' : 'text-gray-100 hover:text-gray-900' }}"
                    aria-controls="users-menu" data-collapse-toggle="users-menu">
                    <svg class="shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('users.*') ? 'text-gray-900 dark:text-white' : 'text-gray-500' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Users</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="users-menu" class="hidden py-2 space-y-2">
                    <li>
                        <a href=""
                            class="flex justify-between items-center p-2 w-full  rounded-lg dark:text-white dark:hover:bg-gray-700 pl-11 group {{ request()->routeIs('users.index') ? 'bg-yellow-800 dark:bg-gray-700' : 'text-gray-100 hover:text-gray-900 hover:bg-yellow-800' }}">
                            Active Users
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">

                            </span>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="flex justify-between items-center p-2 w-full  rounded-lg dark:text-white dark:hover:bg-gray-700 pl-11 group {{ request()->routeIs('users.delete') ? 'bg-yellow-800 dark:bg-gray-700' : 'text-gray-100 hover:text-gray-900 hover:bg-yellow-800' }}">
                            Deleted Users
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">

                            </span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</aside>