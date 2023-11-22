window.addEventListener("load", () => {
    document.getElementById("loader").style.display = "none";

    const toggleDarkMode = (el, selector) => {
        selector === '.card' ? el.classList.toggle('bg-black') : el.classList.toggle('bg-dark');
    };

    const darkModeSwitch = document.querySelector('.dark-mode-switch input');

    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    darkModeSwitch.checked = isDarkMode;

    if (isDarkMode) {
        toggleDarkModeStyles();
    }

    darkModeSwitch.addEventListener('change', (e) => {
        toggleDarkModeStyles();

        // Save the user's dark mode preference to localStorage
        localStorage.setItem('darkMode', darkModeSwitch.checked);
    });

    function toggleDarkModeStyles() {
        const elementsToToggle = ['.main-sidebar', '#app', 'section','input[type="text"]','input[type="file"]','input[type="color"]','input[type="number"]','select','textarea','.dropdown', '.section .section-header', '.section .section-body', '.card','.not-found'];

        elementsToToggle.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => toggleDarkMode(element, selector));
        });
    }
});
