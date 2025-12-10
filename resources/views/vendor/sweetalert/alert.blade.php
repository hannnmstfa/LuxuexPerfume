@if (config('sweetalert.alwaysLoadJS') === true || Session::has('alert.config') || Session::has('alert.delete'))
    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif

    @if (config('sweetalert.theme') != 'default')
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-{{ config('sweetalert.theme') }}" rel="stylesheet">
    @endif

    @if (config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @endif

    @if (Session::has('alert.delete') || Session::has('alert.config'))
        <script>
            document.addEventListener('click', function (event) {
                // Check if the clicked element or its parent has the attribute
                var target = event.target;
                var confirmDeleteElement = target.closest('[data-confirm-delete]');
                var confirmDeleteElement2 = target.closest('[data-confirm-delete2]');
                var confirmElement = target.closest('[data-confirm]');

                if (confirmDeleteElement) {
                    event.preventDefault();
                    Swal.fire({!! Session::pull('alert.delete') !!}).then(function (result) {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            form.action = confirmDeleteElement.href;
                            form.method = 'POST';
                            form.innerHTML = `
                                            @csrf
                                            @method('DELETE')
                                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
                if (confirmDeleteElement2) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Konfirmasi !!!",
                        text: confirmDeleteElement2.dataset.caption,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        confirmButtonText: "Ya, lanjutkan!",
                        cancelButtonText: "Batal"
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            form.action = confirmDeleteElement2.href;
                            form.method = 'POST';
                            form.innerHTML = `
                                            @csrf
                                            @method('DELETE')
                                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
                if (confirmElement) {
                    event.preventDefault();
                    Swal.fire({
                        title: confirmElement.dataset.title,
                        text: confirmElement.dataset.caption,
                        icon: confirmElement.dataset.icon,
                        showCancelButton: true,
                        confirmButtonColor: confirmElement.dataset.color,
                        confirmButtonText: "Ya, lanjutkan!",
                        cancelButtonText: "Batal"
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            form.action = confirmElement.href;
                            form.method = 'POST';
                            form.innerHTML = `
                                            @csrf
                                            @method('PUT')
                                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });

            @if (Session::has('alert.config'))
                Swal.fire({!! Session::pull('alert.config') !!});
            @endif
        </script>
    @endif
@endif