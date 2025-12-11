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
