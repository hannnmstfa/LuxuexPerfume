@props([
    'id' => 'quill-' . uniqid(),
    'name' => 'konten',
    'value' => '',
    'placeholder' => 'Tulis konten disini...',
    'disabled' => false
])

<div id="{{ $id }}-container" class="border border-gray-500 rounded" style="display: none;" wire:ignore>
    <div id="{{ $id }}-toolbar" class="bg-gold border-0 text-black" style="display: none;">
        <span class="ql-formats">
            <!-- <select class="ql-font"></select> -->
            <select class="ql-size"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-header" value="1"></button>
            <button class="ql-header" value="2"></button>
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <!-- <button class="ql-video"></button> -->
            <!-- <button class="ql-formula"></button> -->
        </span>
        <!-- <span class="ql-formats">
            <button class="ql-clean"></button>
        </span> -->
    </div>

    <div id="{{ $id }}-editor" class="w-full bg-gray-50 dark:bg-gray-900 border-0"></div>
</div>

<textarea name="{{ $name }}" id="{{ $id }}-input" hidden @disabled($disabled)>{{ old($name, $value) }}</textarea>

<div id="{{ $id }}-loader" style="display: none;">
    <x-loader />
</div>

@once
    @push('scripts')
        <script>
            window.quillEditors = window.quillEditors || {};

            function initQuillEditor(id, placeholder) {
                const editor = document.getElementById(id + '-editor');
                const toolbar = document.getElementById(id + '-toolbar');
                const input = document.getElementById(id + '-input');
                const container = document.getElementById(id + '-container');
                const loader = document.getElementById(id + '-loader');

                if (!editor || !toolbar || !input || !container) {
                    return;
                }

                if (window.quillEditors[id]) {
                    if (loader) loader.style.display = 'none';
                    container.style.display = 'block';
                    toolbar.style.display = 'block';
                    return;
                }

                const quill = new Quill(editor, {
                    theme: 'snow',
                    modules: {
                        toolbar: toolbar
                    },
                    placeholder: placeholder
                });

                 if (input.value) {
                    quill.root.innerHTML = input.value;
                }

                quill.on('text-change', function() {
                    input.value = quill.root.innerHTML;
                });

                const form = input.closest('form');

                if (form) {
                    form.addEventListener('submit', function() {
                        input.value = quill.root.innerHTML;
                    });
                }

                window.quillEditors[id] = quill;

                if (loader) {
                    loader.style.display = 'none';
                    console.log('Loader hilang');
                }

                container.style.display = 'block';
                toolbar.style.display = 'block';
            }

            // Global queue untuk track editor yang perlu di-init
            window.quillInitQueue = window.quillInitQueue || [];
            
            document.addEventListener('DOMContentLoaded', function () {
                if (window.quillInitQueue && window.quillInitQueue.length > 0) {
                    window.quillInitQueue.forEach(function(config) {
                        initQuillEditor(config.id, config.placeholder);
                    });
                }
            });

            let quillHookRegistered = false;
            document.addEventListener('livewire:update', function () {
                if (!quillHookRegistered) {
                    Livewire.hook('morph.finished', function () {
                        if (window.quillInitQueue && window.quillInitQueue.length > 0) {
                            window.quillInitQueue.forEach(function(config) {
                                setTimeout(function() {
                                    initQuillEditor(config.id, config.placeholder);
                                }, 50);
                            });
                        }
                    });
                    quillHookRegistered = true;
                }
            });
        </script>
    @endpush
@endonce

@push('scripts')
    <script>
        // Register editor untuk di-init
        if (!window.quillInitQueue) {
            window.quillInitQueue = [];
        }
        
        window.quillInitQueue.push({
            id: @json($id),
            placeholder: @json($placeholder)
        });

        // Trigger init jika sudah ada in DOM
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(function () {
                    initQuillEditor(@json($id), @json($placeholder));
                }, 50);
            });
        } else {
            setTimeout(function () {
                initQuillEditor(@json($id), @json($placeholder));
            }, 50);
        }
    </script>
@endpush