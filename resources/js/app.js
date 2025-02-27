import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.onload = () => {
    const truncatedTexts = document.querySelectorAll(".truncated-text")

    if (!truncatedTexts || truncatedTexts.length === 0) return

    truncatedTexts.forEach(text => {
        const truncatedText = text.innerHTML.split(' ', 7).join(' ')
        text.innerHTML = `${truncatedText}...`
    })
}

Alpine.start();
