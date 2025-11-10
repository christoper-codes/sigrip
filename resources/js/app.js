import './components/animated-button.js';
import JSConfetti from 'js-confetti';

window.JSConfetti = JSConfetti;

/* Appearance by default */
(function() {
    const preference = localStorage.getItem('flux.appearance');
    if (!preference) localStorage.setItem('flux.appearance', 'dark');
})();
