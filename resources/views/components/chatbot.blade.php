@if (Auth::check())
    <div x-data="{ open: false }" class="relative">

        <!-- CHAT BOX -->
        <div x-show="open" x-transition
            class="absolute bottom-16 right-0 w-[350px] max-w-[90vw] overflow-hidden rounded-2xl border border-white/10 bg-slate-950 shadow-2xl"
            style="display: none;">
            <!-- HEADER -->
            <div class="flex items-center justify-between border-b border-white/10 bg-slate-900 px-4 py-3">
                <div>
                    <div class="text-sm font-semibold text-white">24 Jam Online Assistant</div>
                    <div class="mt-0.5 text-xs text-slate-400">Online</div>
                </div>
            </div>

            <!-- BODY CHAT -->
            <div class="flex flex-col h-[28rem]">

                <!-- MESSAGES (overflow di sini) -->
                <div id="chatBot-messages" class="flex-1 overflow-y-auto px-3 py-4 bg-slate-950 scroll-style"></div>

                <!-- INPUT -->
                <form id="chatBot-form" class="border-t border-white/10 bg-slate-900 p-3">
                    <div class="flex items-center gap-2">
                        <input id="chatBot-input" type="text" placeholder="Tulis pesan..." autocomplete="false"
                            class="h-11 flex-1 rounded-full border border-white/10 bg-slate-800 px-4 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none">
                        <button id="chatBot-send"
                            class="h-11 rounded-full bg-gold px-4 text-sm font-semibold text-black hover:opacity-85">
                            Kirim
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- FLOATING BUTTON -->
        <button @click="open = !open"
            class="h-14 w-14 rounded-full bg-gray-700 text-white shadow-lg hover:opacity-85 flex items-center justify-center text-2xl">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                    clip-rule="evenodd" />
                <path fill-rule="evenodd"
                    d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                    clip-rule="evenodd" />
            </svg>

        </button>

    </div>
@endif