<script>
    window.addEventListener('DOMContentLoaded', function () {
        // FilePond
        FilePond.setOptions({
            server: {
                url: "{{ config('filepond.server.url') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            }
        });
        // Ambil semua input file
        const inputs = document.querySelectorAll('input[type="file"]');
        const loaders = document.querySelectorAll('#loader');

        function initFilepond(){
            setTimeout(() => {
                loaders.forEach(loader => {
                    loader.classList.add('hidden');
                });
                inputs.forEach(input => {
                    input.classList.remove('hidden');
                    FilePond.create(input);
                });
            }, 1000);   
        }
        initFilepond();
    });
</script>