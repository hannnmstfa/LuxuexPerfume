<x-guest-layout title="Home">
    <section class="bg-center w-full bg-no-repeat bg-gray-400 bg-blend-multiply"
        style="background-image: url('{{ asset('assets/test.png') }}')">
        <div class=" animate-swipeUp mx-auto max-w-screen-xl flex flex-col justify-center items-center py-6 md:py-24">
            <img src="{{ asset('assets/logo_nobg.png') }}" class="w-[25%] md:w-[15%]" alt="">
            <div class="relative text-center">
                <p class="absolute inset-0 font-bold text-5xl md:text-7xl lg:text-9xl text-white sm:px-16 lg:px-48 translate-x-[2px] translate-y-[2px] md:translate-x-1 md:translate-y-1">
                    LUXUEXPERFUME
                </p>
                <p class="relative font-bold text-5xl md:text-7xl lg:text-9xl text-yellow-600 sm:px-16 lg:px-48">
                    LUXUEXPERFUME
                </p>
            </div>
            <p class="text-white text-xl font-semibold">#IngatParfumIngatLuxuex</p>
            <a href="{{ route('produk') }}"
                class="py-3 px-5 rounded-xl bg-yellow-300 gap-2 hover:bg-yellow-400 flex justify-center items-center font-semibold mt-4">
                Jelajahi Produk
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>
    </section>
    <div class="bg-gray-200 mx-auto">
gfgf
    </div>
</x-guest-layout>