document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const submitBtn = document.getElementById('submitRatingBtn');
    const deleteBtn = document.getElementById('deleteRatingBtn');
    const title = document.getElementById('movieRatingTitle');
    const ratingDisplay = document.getElementById('rating');
    const movieRating = document.getElementById('movieRating');
    
    const itemType = movieRating.dataset.type;
    const itemId = movieRating.dataset.id;
    const storageKey = `${itemType}_${itemId}`;
    
    let selectedRating = 0;

    const getCookie = name => {
        const match = document.cookie.match(new RegExp(`(^| )${name}=([^;]+)`));
        return match ? decodeURIComponent(match[2]) : '';
    };

    const setCookie = (name, value, days) => {
        const d = new Date();
        d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = `${name}=${encodeURIComponent(value)};expires=${d.toUTCString()};path=/`;
    };

    const getRatings = () => {
        try {
            return JSON.parse(getCookie('userRatings') || '{}');
        } catch {
            return {};
        }
    };

    const saveRating = rating => {
        const ratings = getRatings();
        ratings[storageKey] = rating;
        setCookie('userRatings', JSON.stringify(ratings), 400);
    };

    const deleteRating = () => {
        const ratings = getRatings();
        delete ratings[storageKey];
        setCookie('userRatings', JSON.stringify(ratings), 400);
    };

    const updateStars = rating => {
        stars.forEach((star, i) => {
            star.classList.toggle('filled', i < rating);
        });
    };

    const setRatedState = isRated => {
        deleteBtn.style.display = isRated ? 'inline-block' : 'none';
        submitBtn.textContent = isRated ? 'Zmień ocenę' : 'Oceń';
        submitBtn.disabled = !isRated && selectedRating === 0;
        updateTitle(selectedRating, isRated);
    };

    const updateTitle = (rating, isRated) => {
        if (rating > 0) {
            title.textContent = `Twoja ocena: ${rating}/10`;
        } else {
            title.textContent = isRated ? `Twoja ocena: ${selectedRating}/10` : `Oceń ${itemType}`;
        }
    };

    stars.forEach((star, i) => {
        star.addEventListener('mouseenter', () => {
            stars.forEach((s, idx) => s.classList.toggle('filled', idx <= i));
            updateTitle(i + 1, selectedRating > 0); 
        });
        star.addEventListener('click', () => {
            selectedRating = i + 1;
            updateStars(selectedRating);
            updateTitle(selectedRating, true);
            submitBtn.disabled = false;
        });
    });

    document.getElementById('stars').addEventListener('mouseleave', () => {
        updateStars(selectedRating);
        updateTitle(selectedRating, selectedRating > 0); 
    });

    submitBtn.addEventListener('click', async () => {
        if (selectedRating === 0) return alert('Proszę wybrać ocenę');

        try {
            const res = await fetch('index.php?controller=details&action=rateItem', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `type=${itemType}&id=${itemId}&rating=${selectedRating}`
            });
            const data = await res.json();

            if (data.success) {
                saveRating(selectedRating);
                setRatedState(true);
                if (data.newAverage) ratingDisplay.textContent = `Ocena: ${data.newAverage}/10`;
                alert(data.message || 'Ocena zapisana!');
            } else {
                alert(data.message || 'Błąd podczas zapisywania');
            }
        } catch (err) {
            console.error(err);
            alert('Wystąpił błąd');
        }
    });

    deleteBtn.addEventListener('click', async () => {
        if (!confirm('Usunąć swoją ocenę?')) return;

        try {
            const res = await fetch('index.php?controller=details&action=deleteRating', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `type=${itemType}&id=${itemId}`
            });
            const data = await res.json();

            if (data.success) {
                deleteRating();
                selectedRating = 0;
                updateStars(0);
                setRatedState(false);
                ratingDisplay.textContent = data.newAverage ? `Ocena: ${data.newAverage}/10` : 'Ocena: Brak ocen';
                alert('Ocena usunięta');
            } else {
                alert(data.message || 'Błąd podczas usuwania');
            }
        } catch (err) {
            console.error(err);
            alert('Wystąpił błąd');
        }
    });

    const existingRating = getRatings()[storageKey];
    if (existingRating) {
        selectedRating = existingRating;
        updateStars(selectedRating);
        setRatedState(true);
    }
});