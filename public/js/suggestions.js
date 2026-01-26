document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('searchInput');
    const form = document.getElementById('searchForm');
    const suggestionsBox = document.querySelector('.suggestionsBox');
    const suggestions = Array.from(suggestionsBox.querySelectorAll('.suggestion'));

    suggestionsBox.style.display = 'none';

    input.addEventListener('input', () => {
        const term = input.value.toLowerCase().trim();

        let hasMatch = false;
        suggestions.forEach(s => {
            const match = s.innerText.toLowerCase().includes(term);
            s.style.display = match ? 'block' : 'none';
            if (match) hasMatch = true;
        });

        suggestionsBox.style.display = (term && hasMatch) ? 'block' : 'none';
    });

    suggestions.forEach(s => {
        s.addEventListener('mousedown', e => {
            input.value = e.target.innerText.trim();
            suggestionsBox.style.display = 'none';
        });
    });

    document.addEventListener('click', e => {
        if (!input.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });

    form.addEventListener('submit', e => {
        e.preventDefault();
        const query = input.value.trim();
        if (!query) return;
        const params = new URLSearchParams();
        params.set('controller', 'search');
        params.set('action', 'index');
        params.set('q', query);
        window.location.href = 'index.php?' + params.toString();
    });
});
