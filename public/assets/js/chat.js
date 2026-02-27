import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

createChat({
  webhookUrl: '/n8n/chat',
  mode: 'window',
  showWelcomeScreen: true,
  initialMessages: ['Halo 👋', 'Ada yang bisa saya bantu?'],
});

function qs(sel) {
  return document.querySelector(sel);
}

function getChatWindow() {
  return qs('#n8n-chat .chat-window');
}

function getToggle() {
  return qs('#n8n-chat .chat-window-toggle');
}

function setOpenState(isOpen) {
  document.body.classList.toggle('chat-open', isOpen);
}

function ensureCloseButton() {
  const win = getChatWindow();
  if (!win) return;

  if (getComputedStyle(win).position === 'static') {
    win.style.position = 'relative';
  }

  if (win.querySelector('.chat-close-btn')) return;

  const btn = document.createElement('button');
  btn.className = 'chat-close-btn';
  btn.type = 'button';
  btn.textContent = '✕';

  btn.addEventListener('click', () => {
    const toggle = getToggle();

    // penting: pakai toggle bawaan biar icon balik normal
    if (toggle) toggle.click();
    else win.style.display = 'none';

    setOpenState(false);
  });

  win.appendChild(btn);
}

function syncState() {
  const win = getChatWindow();
  if (!win) return;

  const isOpen = getComputedStyle(win).display !== 'none';
  if (isOpen) {
    ensureCloseButton();
    setOpenState(true);
  } else {
    setOpenState(false);
  }
}

const observer = new MutationObserver(syncState);
observer.observe(document.documentElement, {
  childList: true,
  subtree: true,
  attributes: true,
});

window.addEventListener('load', syncState);

function setHeaderText(title, subtitle) {
  const header = document.querySelector('#n8n-chat .chat-header');
  if (!header) return;

  const h1 = header.querySelector('h1');
  const p = header.querySelector('p');

  if (h1) h1.textContent = title;
  if (p) p.textContent = subtitle;
}

setHeaderText('Customer Service', 'Online •   24 jam');