// Animated Button Component - Auto Letter Splitting
document.addEventListener('DOMContentLoaded', function() {
    // Find all buttons with class 'btn-simple' and initialize them
    const animatedButtons = document.querySelectorAll('.btn-simple[data-text]');

    animatedButtons.forEach(button => {
        initializeAnimatedButton(button);
    });
});

function initializeAnimatedButton(button) {
    const text = button.dataset.text || button.textContent.trim();

    // Clear the button content
    button.innerHTML = '';

    // Split text into individual letters and wrap each in a span
    const letters = text.split('').map((letter, index) => {
        const span = document.createElement('span');
        span.className = 'letter';
        span.textContent = letter === ' ' ? '\u00A0' : letter; // Use non-breaking space
        span.style.animationDelay = `${index * 0.08}s`; // Stagger animation
        return span;
    });

    // Add all letters to the button
    letters.forEach(letter => button.appendChild(letter));

    // Add focus event listeners for enhanced animations
    button.addEventListener('focus', () => {
        letters.forEach((letter, index) => {
            letter.style.animationDelay = `${index * 0.08}s`;
        });
    });
}

// Function to create animated button programmatically
function createAnimatedButton(text, className = '') {
    const wrapper = document.createElement('div');
    wrapper.className = 'btn-wrapper';

    const button = document.createElement('button');
    button.className = `btn-simple ${className}`.trim();
    button.dataset.text = text;

    wrapper.appendChild(button);

    // Initialize the button
    initializeAnimatedButton(button);

    return wrapper;
}

// Export for use in other scripts
window.AnimatedButton = {
    init: initializeAnimatedButton,
    create: createAnimatedButton
};
