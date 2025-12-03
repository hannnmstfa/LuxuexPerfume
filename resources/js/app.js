import './bootstrap';
import 'flowbite';
// import '@fontsource/poppins/400.css';
// import '@fontsource/poppins/500.css';
// import '@fontsource/poppins/600.css';
// import '@fontsource/poppins/700.css';
// import '@fontsource/inter/400.css';
// import '@fontsource/inter/500.css';
// import '@fontsource/inter/600.css';
// import '@fontsource/inter/700.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Button Loading
window.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            let submitButton = form.querySelector('button[type="submit"]');

            if (submitButton) {
                let spinner = document.createElement("span");
                spinner.innerHTML = /*html*/ `
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="opacity-75" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path>
                </svg>`;

                submitButton.classList.add('flex', 'justify-center', 'items-center', 'gap-1');

                submitButton.textContent = '';
                // submitButton.classList.add('w-auto');
                submitButton.appendChild(spinner);
                submitButton.disabled = true;
            }
        });
    });
});
