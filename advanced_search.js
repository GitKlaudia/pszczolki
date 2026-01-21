document.addEventListener('DOMContentLoaded', () => {

    const searchBtn = document.getElementById('finalSearchBtn');

    searchBtn.addEventListener('click', () => {

        const selectedCategories = Array.from(document.querySelectorAll('.searchSection'))
            .filter(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'kategoria')[0]
            .querySelectorAll('.searchTag.active');
        const categories = Array.from(selectedCategories).map(tag => tag.textContent);

        const directorInput = document.getElementById('directorInput');
        const director = directorInput.value.trim();

        const selectedActors = Array.from(document.querySelectorAll('.castSearchRow .selectedTags .searchTag'));
        const actors = Array.from(selectedActors).map(tag => tag.textContent);

        const selectedPlatforms = Array.from(document.querySelectorAll('.searchSection'))
            .filter(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'platforma')[0]
            .querySelectorAll('.searchTag.active');
        const platforms = Array.from(selectedPlatforms).map(tag => tag.textContent);

        const selectedTypeTag = Array.from(document.querySelectorAll('.searchSection'))
            .filter(sec => sec.querySelector('.searchSectionHeader').innerText.toLowerCase() === 'typ')[0]
            .querySelector('.searchTag.active');
        const type = selectedTypeTag ? selectedTypeTag.textContent.toLowerCase() : 'film';

        let table = type === 'film' ? 'filmy' : 'seriale';

        let sql = "SELECT * FROM " + table + " WHERE 1=1";

        if (categories.length > 0) {
            sql += " AND id IN (SELECT id_tresci FROM kategorie_tresci kt JOIN kategorie k ON kt.id_kategorii = k.id WHERE k.nazwa IN ('" + categories.join("','") + "'))";
        }

        if (director !== "") {
            sql += " AND id IN (SELECT id_tresci FROM produkcje_rezyserow pr JOIN rezyserzy r ON pr.id_rezysera = r.id WHERE CONCAT(r.imie,' ',r.nazwisko) = '" + director + "')";
        }

        if (actors.length > 0) {
            sql += " AND id IN (SELECT id_tresci FROM wystepy_aktorow wa JOIN aktorzy a ON wa.id_aktora = a.id WHERE CONCAT(a.imie,' ',a.nazwisko) IN ('" + actors.join("','") + "'))";
        }

        if (platforms.length > 0) {
            sql += " AND id IN (SELECT id_tresci FROM dostepnosc_na_platformach dp JOIN platformy p ON dp.id_platformy = p.id WHERE p.nazwa IN ('" + platforms.join("','") + "'))";
        }

        const newWindow = window.open();
        newWindow.document.write("<!DOCTYPE html><html><head></head><body><pre style='white-space: pre-wrap;'>"  + sql + "</pre></body></html>");
        newWindow.document.close();
    });

});
