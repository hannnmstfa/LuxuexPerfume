<div id="container-editor" class="border border-gray-500 rounded" style="display: none;">
    <div id="toolbar-container" class="bg-gold border-0 text-black" style="display: none;">
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
    <div id="text-editor" class="w-full bg-gray-50 dark:bg-gray-900 border-0"></div>
</div>
<div id="loader-quill">
    <x-loader/>
</div>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const quill = new Quill('#text-editor', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar-container'
                },
                placeholder: 'Tulis konten disini...',

            });

            // sebelum form submit, isi textarea hidden
            document.getElementById('form').addEventListener('submit', function () {
                document.getElementById('konten').value = quill.root.innerHTML
            });

            // kalau mau isi awal dari DB
            const oldContent = document.getElementById('konten').value;
            if (oldContent) {
                quill.root.innerHTML = oldContent;
            }
            document.getElementById('loader-quill').style.display = 'none';
            document.getElementById('container-editor').style.display = 'block';
            document.getElementById('toolbar-container').style.display = 'block';
        }, 2000);
    });
</script>