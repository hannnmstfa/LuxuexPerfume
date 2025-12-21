<x-guest-layout title="Home">
    <section class="bg-center fixed w-full bg-no-repeat bg-gray-400 bg-blend-multiply"
        style="background-image: url('{{ asset('assets/test.png') }}')">
        <div class=" animate-swipeUp mx-auto max-w-screen-xl flex flex-col justify-center items-center py-6 lg:py-10">
            <img src="{{ asset('assets/logo_nobg.png') }}" class="w-[25%] md:w-[15%]" alt="">
            <p class="mb-8 text-base font-bold text-shadow text-center text-yellow-700 md:text-7xl sm:px-16 lg:px-48">
                LUXUEXPERFUME
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 md:space-x-4">
                <button type="button"
                    class="inline-flex items-center justify-center text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                    Getting started
                    <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </button>
                <button type="button"
                    class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-base px-5 py-3 focus:outline-none">Learn
                    more</button>
            </div>
        </div>
    </section>

</x-guest-layout>