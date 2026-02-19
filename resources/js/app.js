import './components/animated-button.js';
import JSConfetti from 'js-confetti';
import Aos from 'aos';
import 'aos/dist/aos.css';

window.JSConfetti = JSConfetti;

/* Appearance by default */
(function() {
    const preference = localStorage.getItem('flux.appearance');
    if (!preference) localStorage.setItem('flux.appearance', 'dark');
})();

/* Initialize AOS */
document.addEventListener('DOMContentLoaded', () => {
    Aos.init();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

/**
 * Animate words
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('typeWords', (text) => ({
        words: [],
        visibleWords: [],
        index: 0,
        typing: true,

        start() {
            this.words = text.split(' ')
            this.visibleWords = []
            this.index = 0
            this.typing = true
            this.typeNext()
        },

        typeNext() {
            if (this.index < this.words.length) {
                this.visibleWords.push(this.words[this.index])
                this.index++
                setTimeout(() => this.typeNext(), 120)
            } else {
                this.typing = false
            }
        }
    }))
})
