<!-- Modal Proses -->
<div id="prosesModal" wire:ignore.self data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full animate-swipeDown scroll-style">
    <div class="relative p-4 w-full max-w-screen-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-800 border border-gray-600 rounded-lg shadow-sm p-4 md:p-6 ">
            <div wire:loading.remove.class="hidden" wire:loading.class="flex" id="loader"
                class="absolute z-50 hidden justify-center items-center h-full w-full bg-gray-700 rounded-lg opacity-50 top-0 right-0 left-0 bottom-0">
                <x-loader />
            </div>
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-600 pb-4 md:pb-5">
                <h3 class="text-lg text-gold font-bold">
                    Proses Pengajuan
                </h3>
                <button type="button"
                    class=" hover:bg-gray-500 hover:opacity-80 text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="prosesModal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="form" action="{{ route('admReturn.update', $data->return_code) }}" method="post" class="py-3">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <p class="font-semibold mb-2">Status<span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-1">
                            <input type="radio" name="status" id="disetujui" value="disetujui" class="hidden peer" {{ $data->status == 'disetujui' ? 'checked' : '' }} required>
                            <label for="disetujui"
                                class="border rounded py-4 text-sm font-bold border-gray-500 flex justify-center items-center bg-gray-900 shadow text-green-400 hover:cursor-pointer hover:opacity-85 peer-checked:border-green-500 peer-checked:border-2">
                                Terima Pengajuan
                            </label>
                        </div>
                        <div class="col-span-1">
                            <input type="radio" name="status" id="ditolak" value="ditolak" class="hidden peer" {{ $data->status == 'ditolak' ? 'checked' : '' }} required>
                            <label for="ditolak"
                                class="border  rounded py-4 text-sm font-bold border-gray-500 flex justify-center items-center bg-gray-900 shadow text-red-400 hover:cursor-pointer hover:opacity-85 peer-checked:border-red-500 peer-checked:border-2">
                                Tolak Pengajuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-4" x-cloak>
                    <p class="font-semibold mb-2">Catatan<span class="text-red-500">*</span></p>
                    <ul class="flex justify-start items-center text-xs">
                        <li
                            class="rounded-t -mb-px ml-2 mr-0.5 {{ $tabAktif == 'manual' ? 'border border-b-0 bg-gray-800' : 'hover:bg-gray-700 border-b' }}">
                            <button type="button" wire:click="setTab('manual')"
                                class="inline-flex items-center justify-center p-2 group">
                                <svg class="w-4 h-4 me-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="square" stroke-width="2"
                                        d="M8 15h7.01v.01H15L8 15Z" />
                                    <path stroke="currentColor" stroke-linecap="square" stroke-width="2"
                                        d="M20 6H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1Z" />
                                    <path stroke="currentColor" stroke-linecap="square" stroke-width="2"
                                        d="M6 9h.01v.01H6V9Zm0 3h.01v.01H6V12Zm0 3h.01v.01H6V15Zm3-6h.01v.01H9V9Zm0 3h.01v.01H9V12Zm3-3h.01v.01H12V9Zm0 3h.01v.01H12V12Zm3 0h.01v.01H15V12Zm3 0h.01v.01H18V12Zm0 3h.01v.01H18V15Zm-3-6h.01v.01H15V9Zm3 0h.01v.01H18V9Z" />
                                </svg>
                                Manual
                            </button>
                        </li>
                        <li
                            class="rounded-t -mb-px ml-0.5 {{ $tabAktif == 'template' ? 'border border-b-0 bg-gray-800' : 'hover:bg-gray-700 border-b' }}">
                            <button type="button" wire:click="setTab('template')"
                                class="inline-flex items-center justify-center p-2 group" aria-current="page">
                                <svg class="w-4 h-4 me-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                                </svg>
                                Template
                            </button>
                        </li>
                    </ul>
                    <hr class="mb-2">
                    <div class="{{ $tabAktif == 'manual' ? 'block' : 'hidden' }}">
                        <x-quill-editor name="konten" id="konten-catatan" :value="old('konten', $data->catatan)"
                            :disabled="$tabAktif == 'manual' ? '' : 'true'" />
                    </div>
                    @if ($tabAktif == 'template')
                        <div class="w-full flex flex-col gap-2 py-1 max-h-[40dvh] overflow-auto scroll-style pe-1">
                            @if ($template->isNotEmpty())
                                @foreach ($template as $i => $catatan)
                                    <div class="flex">
                                        <input type="radio" name="konten" id="catatan-{{ $i }}" value="{{ $catatan->konten }}"
                                            class="hidden peer">
                                        <label for="catatan-{{ $i }}"
                                            class="w-full border rounded-lg p-2 border-gray-600 bg-gray-900 shadow-xl hover:opacity-80 hover:cursor-pointer peer-checked:bg-gold ">
                                            <p class="text-sm">{{ $catatan->nama }}</p>
                                            <p class="text-xs text-gray-500">{{ Str::limit(strip_tags($catatan->konten), 100) }}</p>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-center items-center py-2 w-full">
                                    <span class="text-gray-500 italic">Belum ada template</span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end border-t border-gray-600 space-x-4 pt-4">
                    <button data-modal-hide="prosesModal" type="button"
                        class="text-white bg-gray-900 rounded-lg border border-gray-600 shadow-xs text-sm px-4 py-2.5 hover:opacity-85">Batal</button>
                    <button type="submit"
                        class="text-black rounded-lg font-bold bg-gold border border-gray-600 shadow text-sm px-4 py-2.5 hover:opacity-85">{{ $data->catatan ? 'Simpan Perubahan' : 'Proses' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>