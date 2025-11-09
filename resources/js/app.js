import './components/animated-button.js';

/* Appearance by default */
(function() {
    const preference = localStorage.getItem('flux.appearance');
    if (!preference) localStorage.setItem('flux.appearance', 'dark');
})();
