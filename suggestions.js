document.addEventListener('DOMContentLoaded', () => {
    const containers = document.querySelectorAll('.inputWithSuggestions');

    containers.forEach(container => {
        const input = container.querySelector('input');
        const suggestionsBox = container.querySelector('.suggestionsBox');
        
        if (!suggestionsBox) return;
        
        suggestionsBox.style.display = 'none';
        
        const suggestions = Array.from(suggestionsBox.querySelectorAll('.suggestion'));

        function showSuggestions() {
            const term = input.value.toLowerCase().trim();
            
            if (term === '') {
                hideSuggestions();
                return;
            }
            
            suggestions.forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(term) ? 'block' : 'none';
            });
            suggestionsBox.style.display = 'block';
        }

        function hideSuggestions() {
            suggestionsBox.style.display = 'none';
        }

        input.addEventListener('input', showSuggestions);
        input.addEventListener('blur', () => setTimeout(hideSuggestions, 200));

        suggestions.forEach(item => {
            item.addEventListener('mousedown', e => {
                input.value = e.target.innerText.trim();
                hideSuggestions();
            });
        });
    });

    document.addEventListener('click', (e) => {
        containers.forEach(container => {
            if (!container.contains(e.target)) {
                const suggestionsBox = container.querySelector('.suggestionsBox');
                if (suggestionsBox) suggestionsBox.style.display = 'none';
            }
        });
    });

    const castRows = document.querySelectorAll('.castSearchRow');

    castRows.forEach(row => {
        const addBtn = row.querySelector('.addActorBtn');
        const input = row.querySelector('input');
        const selectedTags = row.querySelector('.selectedTags');

        if (!addBtn || !input || !selectedTags) return;

        addBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (!value || typeof allActors === 'undefined') return;

            const normalize = str => str.trim().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            const match = allActors.find(actor => normalize(actor) === normalize(value));

            if (!match) return;

            const exists = Array.from(selectedTags.querySelectorAll('.searchTag'))
                .some(tag => normalize(tag.textContent) === normalize(match));

            if (exists) return;

            const newTag = document.createElement('button');
            newTag.classList.add('searchTag', 'active');
            newTag.textContent = match.trim();
            selectedTags.appendChild(newTag);
            input.value = '';
        });
    });
});