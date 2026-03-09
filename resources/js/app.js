import './bootstrap';
import 'flowbite';
import ApexCharts from 'apexcharts'
import { DataTable, exportCSV } from "simple-datatables";
import { createChat } from '@n8n/chat';
window.ApexCharts = ApexCharts;
window.simpleDatatables = { DataTable, exportCSV };
createChat({
    webhookUrl: '/n8n/chat',
    mode: 'window',
    showWelcomeScreen: true,
    initialMessages: ['Halo 👋', 'Ada yang bisa saya bantu?'],
    target: '#n8n-chat',
    chatInputKey: 'chatInput',
    chatSessionKey: 'sessionId',
    loadPreviousSession: true,
    metadata: {},
    defaultLanguage: 'id',
    i18n: {
		id: {
			title: 'Halooo! 👋',
			subtitle: "Mulai chat. Asisten kami online 24 Jam.",
			footer: '',
			getStarted: 'Percakapan baru',
			inputPlaceholder: 'Ketik petanyaanmu..',
		},
	},
    // enableStreaming: true,
});

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
