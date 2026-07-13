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
import 'quill/dist/quill.snow.css';
import Quill from 'quill';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

window.ApexCharts = ApexCharts;
window.Quill = Quill;
window.simpleDatatables = { DataTable, exportCSV };
window.FilePond = FilePond;
FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);
window.Livewire = Livewire;
window.Alpine = Alpine;

Livewire.start();

document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function () {
        let submitButton = form.querySelector('button[type="submit"]');

        if (submitButton) {
            let spinner = document.createElement("span");
            spinner.innerHTML = `
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="opacity-75" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path>
                </svg>`;

            submitButton.classList.add('flex', 'justify-center', 'items-center', 'gap-1');
            submitButton.textContent = '';
            submitButton.appendChild(spinner);
            submitButton.disabled = true;
        }
    });
});

// CHATBOT HANDLE
function escapeHtml(str) {
    return String(str ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function parseMarkdown(text) {
    return String(text ?? '')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\n/g, '<br>');
}

function parseMessage(raw) {
    try {
        const parsed = JSON.parse(raw);

        return parsed.reply_to_user
            || parsed.output
            || parsed.text
            || parsed.message
            || '';
    } catch {
        return raw ?? '';
    }
}

function formatTime(value) {
    if (!value) return '';
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return '';

    return date.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
    });
}

function messageTemplate(msg) {
    const isUser = msg.sender_type === 'user';
    const rawText = parseMessage(msg.message).trim();
    const text = parseMarkdown(escapeHtml(rawText));

    if (!rawText) return '';

    return `
        <div class="mb-3 flex ${isUser ? 'justify-end' : 'justify-start'}">
            <div
                class="max-w-[80%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed shadow"
                style="
                    background:${isUser ? '#10b981' : '#1e293b'};
                    color:#ffffff;
                    border-bottom-${isUser ? 'right' : 'left'}-radius:6px;
                "
            >
                <div>${text}</div>
                <div class="mt-1 text-right text-[11px] text-white/70">
                    ${escapeHtml(formatTime(msg.created_at))}
                </div>
            </div>
        </div>
    `;
}

function renderMessages(messages) {
    const box = document.getElementById('chatBot-messages');
    if (!box) return;
    const firstName = (user.name || '').split(' ')[0];
    const html = (messages || [])
        .map(messageTemplate)
        .filter(Boolean)
        .join('');

    box.innerHTML = html || `
        <div class="flex h-full items-center justify-center px-6 text-center text-sm text-slate-400">
            Halo, ${firstName} 👋<br>Mulai percakapan pertamamu.
        </div>
    `;

    box.scrollTop = box.scrollHeight;
}

function appendTemporaryUserMessage(message) {
    const box = document.getElementById('chatBot-messages');
    if (!box) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'mb-3 flex justify-end';
    wrapper.innerHTML = `
        <div
            class="max-w-[80%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed text-white shadow"
            style="
                background:#10b981;
                border-bottom-right-radius:6px;
            "
        >
            <div>${escapeHtml(message)}</div>
            <div class="mt-1 text-right text-[10px] text-white/70">Baru saja</div>
        </div>
    `;

    box.appendChild(wrapper);
    box.scrollTop = box.scrollHeight;
}

function setTypingIndicator(show = true) {
    const box = document.getElementById('chatBot-messages');
    if (!box) return;

    const existing = document.getElementById('chatBot-typing');

    if (show) {
        if (existing) return;

        const typing = document.createElement('div');
        typing.id = 'chatBot-typing';
        typing.className = 'mb-3 flex justify-start';
        typing.innerHTML = `
            <div class="max-w-[80%] rounded-2xl px-4 py-3 shadow" style="background:#1e293b;color:#fff;border-bottom-left-radius:6px;">
                <div style="display:flex;align-items:center;gap:6px;">
                    <span class="lux-dot" style="animation-delay:0s"></span>
                    <span class="lux-dot" style="animation-delay:0.2s"></span>
                    <span class="lux-dot" style="animation-delay:0.4s"></span>
                </div>
            </div>
        `;
        box.appendChild(typing);
        box.scrollTop = box.scrollHeight;
    } else if (existing) {
        existing.remove();
    }
}

async function fetchChatHistory() {
    const res = await fetch('/chat/history', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'same-origin',
    });

    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
        throw new Error(data.message || `HTTP ${res.status}`);
    }

    return Array.isArray(data.messages) ? data.messages : [];
}

async function sendChatMessage(message) {
    const res = await fetch('/n8n/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'same-origin',
        body: JSON.stringify({
            action: 'sendMessage',
            sessionId: 'chat_user_' + window.user.id,
            chatInput: message,
            metadata: {
                sessionId: 'chat_user_' + window.user.id,
            },
        }),
    });

    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
        throw new Error(data.message || `HTTP ${res.status}`);
    }

    return data;
}

let luxChatPolling = null;
let luxChatBusy = false;

async function reloadChatHistory() {
    try {
        const messages = await fetchChatHistory();
        renderMessages(messages);
    } catch (error) {
        console.error('reloadChatHistory error:', error);
    }
}



async function initLuxCustomChat() {
    if (!window.user?.login) return;

    const form = document.getElementById('chatBot-form');
    const input = document.getElementById('chatBot-input');
    const sendButton = document.getElementById('chatBot-send');
    const messagesBox = document.getElementById('chatBot-messages');

    if (!form || !input || !sendButton || !messagesBox) return;

    await reloadChatHistory();


    if (!window.__luxChatBound) {
        window.__luxChatBound = true;

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const message = input.value.trim();
            if (!message || luxChatBusy) return;

            luxChatBusy = true;
            input.disabled = true;
            sendButton.disabled = true;

            appendTemporaryUserMessage(message);
            input.value = '';
            setTypingIndicator(true);

            try {
                await sendChatMessage(message);
                setTypingIndicator(false);
                await reloadChatHistory();
            } catch (error) {
                setTypingIndicator(false);
                console.error('sendChatMessage error:', error);
                alert(error.message || 'Gagal mengirim pesan');
                await reloadChatHistory();
            } finally {
                luxChatBusy = false;
                input.disabled = false;
                sendButton.disabled = false;
                input.focus();
            }
        });
    }

    // if (luxChatPolling) {
    //     clearInterval(luxChatPolling);
    // }

    // luxChatPolling = setInterval(async () => {
    //     if (!luxChatBusy) {
    //         await reloadChatHistory();
    //     }
    // }, 2500);
}

window.addEventListener('load', initLuxCustomChat);
document.addEventListener('livewire:navigated', initLuxCustomChat);

