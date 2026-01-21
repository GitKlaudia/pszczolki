const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const body = document.body;

function updateIcon(isLight) {
    if (isLight) {
        themeIcon.src = 'styles/dark.svg'; 
    } else {
        themeIcon.src = 'styles/light.svg'; 
    }
}

if (localStorage.getItem('theme') === 'light') {
    body.classList.add('light-mode');
    updateIcon(true);
}

themeToggle.addEventListener('click', () => {
    body.classList.toggle('light-mode');
    const isLight = body.classList.contains('light-mode');
    
    if (isLight) {
        localStorage.setItem('theme', 'light');
    } else {
        localStorage.setItem('theme', 'dark');
    }
    
    updateIcon(isLight);
});