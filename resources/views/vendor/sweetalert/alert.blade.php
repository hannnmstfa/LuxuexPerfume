@if (config('sweetalert.animation.enable'))
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
@endif

@if (config('sweetalert.theme') != 'default')
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-{{ config('sweetalert.theme') }}" rel="stylesheet">
@endif

@if (config('sweetalert.neverLoadJS') === false)
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endif

<script>
    document.addEventListener('click', function (event) {
        var target = event.target;

        var cDel1 = target.closest('[data-confirm-delete]');
        var cDel2 = target.closest('[data-confirm-delete2]');
        var cPut = target.closest('[data-confirm]');
        var cModal = target.closest('[data-confirm-modal]');

        // DELETE 1
        if (cDel1) {
            event.preventDefault();
            Swal.fire({!! Session::get('alert.delete') !!}).then(r => {
                if (r.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = cDel1.href;
                    form.method = "POST";
                    form.innerHTML = `@csrf @method('DELETE')`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            return;
        }

        // DELETE 2
        if (cDel2) {
            event.preventDefault();
            Swal.fire({
                title: "Konfirmasi !!!",
                text: cDel2.dataset.caption,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "red",
                confirmButtonText: "Ya, lanjutkan!",
                cancelButtonText: "Batal",
            }).then(r => {
                if (r.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = cDel2.href;
                    form.method = "POST";
                    form.innerHTML = `@csrf @method('DELETE')`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            return;
        }

        // PUT / UPDATE
        if (cPut) {
            event.preventDefault();
            Swal.fire({
                title: cPut.dataset.title,
                text: cPut.dataset.caption,
                icon: cPut.dataset.icon,
                showCancelButton: true,
                confirmButtonColor: cPut.dataset.color,
                confirmButtonText: "Ya, lanjutkan!",
                cancelButtonText: "Batal"
            }).then(r => {
                if (r.isConfirmed) {
                    let form = document.createElement('form');
                    form.action = cPut.href;
                    form.method = "POST";
                    form.innerHTML = `@csrf @method('PUT')`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            return;
        }

        if (cModal) {
            event.preventDefault();
            Swal.fire({
                title: cModal.dataset.title,
                text: cModal.dataset.caption,
                icon: cModal.dataset.icon,
                showCancelButton: true,
                confirmButtonColor: cModal.dataset.color,
                confirmButtonText: "Ya, lanjutkan!",
                cancelButtonText: "Batal"
            }).then(r => {
                if (r.isConfirmed) {
                    let modalId = cModal.dataset.modal;
                    let toggleBtn = document.querySelector(
                        `[data-modal-target="${modalId}"], [data-modal-toggle="${modalId}"]`
                    );
                    if (toggleBtn) toggleBtn.click();
                    else console.error("Modal not found:", modalId);
                }
            });
        }

    });

    // AUTO POPUP MESSAGE
    @if(Session::has('alert.config'))
        Swal.fire({!! Session::pull('alert.config') !!});
    @endif
</script>