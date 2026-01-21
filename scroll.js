function scrollMore(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;

  const card = container.querySelector('.itemCard');
  if (!card) return;

  const cardStyle = getComputedStyle(card);
  const cardWidth = card.offsetWidth;
  const marginRight = parseInt(cardStyle.marginRight) || 0;
  const gap = 50;
  const scrollAmount = cardWidth + gap;
  container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
}

function scrollLess(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;

  const card = container.querySelector('.itemCard');
  if (!card) return;

  const cardStyle = getComputedStyle(card);
  const cardWidth = card.offsetWidth;
  const marginRight = parseInt(cardStyle.marginRight) || 0;
  const gap = 50;
  const scrollAmount = cardWidth + gap;
  container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
}
