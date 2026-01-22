document.addEventListener('DOMContentLoaded', () => {

    const searchBtn = document.getElementById('finalSearchBtn');

    searchBtn.addEventListener('click', () => {


        const categorySection = Array.from(document.querySelectorAll('.searchSection'))
            .find(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'kategoria');
        const selectedCategories = categorySection ? categorySection.querySelectorAll('.searchTag.active') : [];
        const categories = Array.from(selectedCategories).map(tag => tag.textContent.trim());

        const directorInput = document.getElementById('directorInput');
        const director = directorInput ? directorInput.value.trim() : '';

        const selectedActors = document.querySelectorAll('.castSearchRow .selectedTags .searchTag');
        const actors = Array.from(selectedActors).map(tag => tag.textContent.trim());

        const platformSection = Array.from(document.querySelectorAll('.searchSection'))
            .find(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'platforma');
        const selectedPlatforms = platformSection ? platformSection.querySelectorAll('.searchTag.active') : [];
        const platforms = Array.from(selectedPlatforms).map(tag => tag.textContent.trim());

        const typeSection = Array.from(document.querySelectorAll('.searchSection'))
            .find(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'typ');
        const selectedTypeTag = typeSection ? typeSection.querySelector('.searchTag.active') : null;
        const type = selectedTypeTag ? selectedTypeTag.textContent.trim().toLowerCase() : 'serial';

        const params = new URLSearchParams();
        params.set('type', type);
        
        if (categories.length > 0) {
            params.set('categories', categories.join(','));
        }
        if (director) {
            params.set('director', director);
        }
        if (actors.length > 0) {
            params.set('actors', actors.join(','));
        }
        if (platforms.length > 0) {
            params.set('platforms', platforms.join(','));
        }

        window.location.href = 'search.php?' + params.toString();
    });

});