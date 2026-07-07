// Dark mode - aplicar al cargar
function applyTheme() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

// Aplicar al cargar la página
applyTheme();

// Aplicar después de cada navegación de Livewire
document.addEventListener('livewire:navigated', applyTheme);

window.toggleDarkMode = function () {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');

    const logo = document.querySelector('.chameleon-logo');
    if (logo) {
        logo.classList.remove('chameleon-pulse');
        void logo.offsetWidth; // fuerza el reflow para reiniciar la animación
        logo.classList.add('chameleon-pulse');
        logo.addEventListener('animationend', () => {
            logo.classList.remove('chameleon-pulse');
        }, { once: true });
    }
}