document.addEventListener('DOMContentLoaded', () => {
    const containers = document.querySelectorAll('.inputWithSuggestions');

    containers.forEach(container => {
        const input = container.querySelector('input');
        const suggestionsBox = container.querySelector('.suggestionsBox');
        const suggestions = Array.from(suggestionsBox.querySelectorAll('.suggestion'));

        suggestions.forEach(item => item.style.display = 'none');

        function filterSuggestions() {
            const term = input.value.toLowerCase();
            suggestions.forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(term) ? 'block' : 'none';
            });
        }

        input.addEventListener('focus', filterSuggestions);

        input.addEventListener('input', filterSuggestions);

        suggestions.forEach(item => {
            item.addEventListener('mousedown', e => {
                input.value = e.target.innerText.trim();
                
                suggestions.forEach(s => s.style.display = 'none');
            });
        });
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const castRows = document.querySelectorAll('.castSearchRow');

    function normalizeText(str) {
        return str
            .trim()
            .normalize('NFD')              
            .replace(/[\u0300-\u036f]/g, '') 
            .toLowerCase();
    }

    castRows.forEach(row => {
        const addBtn = row.querySelector('.addActorBtn');
        const input = row.querySelector('input');
        const selectedTags = row.querySelector('.selectedTags');

        addBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (!value) return;

            const match = allActors.find(actor => normalizeText(actor) === normalizeText(value));

            if (!match) {
                return;
            }

            const exists = Array.from(selectedTags.querySelectorAll('.searchTag'))
                .some(tag => normalizeText(tag.textContent) === normalizeText(match));

            if (exists) {
                return;
            }

            const newTag = document.createElement('button');
            newTag.classList.add('searchTag', 'active');
            newTag.textContent = match.trim();

            selectedTags.appendChild(newTag);
            input.value = '';
        });
    });
});




