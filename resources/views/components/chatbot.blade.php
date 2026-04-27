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
                <a href="{{ route('chat.reset', session()->id()) }}" data-confirm="true"
                    data-caption="Semakin banyak history chat dapat mempengaruhi kecepatan akses halaman. Mulai percakapan baru?"
                    data-title="Konfirmasi !!!" data-icon="warning"
                    class="bg-gold rounded py-1 px-2 text-xs font-semibold hover:opacity-85">Reset Chat</a>
            </div>

            <!-- BODY CHAT -->
            <div class="flex flex-col max-h-[70dvh]">

                <!-- MESSAGES (overflow di sini) -->
                <div id="chatBot-messages" class="flex-1 overflow-y-auto px-3 py-4 bg-slate-950 scroll-style"></div>
                <div class="w-full flex flex-col relative">
                    <div
                        class="flex justify-start items-center overflow-x-auto text-white text-xs m-2 scroll-style gap-2 px-1 pb-2">
                        <button class="p-2 border rounded-xl hover:bg-gray-800 text-nowrap"
                            data-value="bagaimana cara order ?" id="chat-001">cara order barang</button>
                        <button class="p-2 border rounded-xl hover:bg-gray-800 text-nowrap"
                            data-value="berikan saya rekomendasi barang dengan buget ... , kategori pria/wanita"
                            id="chat-002">Rekomendasi Produk</button>
                        <button class="p-2 border rounded-xl hover:bg-gray-800 text-nowrap"
                            data-value="cara refund barang gimana" id="chat-003">kebijakan refund</button>
                        <button class="p-2 border rounded-xl hover:bg-gray-800 text-nowrap"
                            data-value="saya butuh admin,kendala...." id="chat-004">menghubungi admin</button>
                    </div>
                    <!-- INPUT -->
                    <form id="chatBot-form" class="border-t border-white/10 bg-slate-900 p-3">
                        <div class="flex items-center justify-between gap-2">
                            <textarea id="chatBot-input" rows="1" placeholder="Tulis pesan..."
                                class="w-full rounded-2xl border border-white/10 bg-slate-800 px-4 py-2 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none resize-none overflow-hidden"></textarea>
                            <button id="chatBot-send"
                                class="h-11 w-max rounded-full bg-gold px-4 text-sm font-semibold text-black hover:opacity-85">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
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
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const chat001 = document.getElementById('chat-001');
            const chat002 = document.getElementById('chat-002');
            const chat003 = document.getElementById('chat-003');
            const chat004 = document.getElementById('chat-004');
            const inputChat = document.getElementById('chatBot-input');

            inputChat.addEventListener('input', function () {
                this.style.height = 'auto'; // reset dulu
                this.style.height = this.scrollHeight + 'px';
            });

            document.querySelectorAll('[id^="chat-"]').forEach(btn => {
                btn.addEventListener('click', function () {
                    inputChat.value = this.dataset.value;
                    inputChat.focus();
                    inputChat.dispatchEvent(new Event('input')); // biar auto resize ikut jalan
                });
            });
        });
    </script>
@endif