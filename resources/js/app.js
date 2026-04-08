import './bootstrap';
import 'flowbite';
import ApexCharts from 'apexcharts'
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import * as FilePond from 'filepond';
import '@n8n/chat/style.css'
import { createChat } from '@n8n/chat';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import { DataTable, exportCSV } from "simple-datatables";
window.ApexCharts = ApexCharts;
window.simpleDatatables = { DataTable, exportCSV };
window.FilePond = FilePond;
FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

window.Livewire = Livewire
window.Alpine = Alpine

Livewire.start()

if (window.user.login) {
    console.log('Login: ' + user.login);

    createChat({
        webhookUrl: '/n8n/chat',
        webhookConfig: {
            method: 'POST',
            headers: {}
        },
        target: '#n8n-chat',
        mode: 'window',
        chatInputKey: 'chatInput',
        chatSessionKey: 'sessionId',
        loadPreviousSession: true,
        metadata: {
            sessionId: user.id
        },
        showWelcomeScreen: true,
        defaultLanguage: 'id',

        initialMessages: [
            `Halo, ${user.name} 👋`,
            'Ada yang bisa saya bantu hari ini?'
        ],

        i18n: {
            id: {
                title: '24 Jam Online Assistant',
                subtitle: "Mulai chat dan kami akan membantumu",
                footer: '',
                getStarted: 'Pesan Baru',
                inputPlaceholder: 'Tulis pesanmu disini..',
            },
        },
        enableStreaming: false,
    });

} else {
    console.log('Login: ' + user.login);
}
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
