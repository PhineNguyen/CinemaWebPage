
window.addEventListener('DOMContentLoaded', () => {
  const vipSeats = document.querySelectorAll('.seat-vip');
  if (vipSeats.length === 0) return;

  let top = Infinity, left = Infinity, right = 0, bottom = 0;

  vipSeats.forEach(seat => {
    const rect = seat.getBoundingClientRect();
    const containerRect = document.querySelector('.seating-container').getBoundingClientRect();

    const relTop = rect.top - containerRect.top;
    const relLeft = rect.left - containerRect.left;
    const relRight = rect.right - containerRect.left;
    const relBottom = rect.bottom - containerRect.top;

    if (relTop < top) top = relTop;
    if (relLeft < left) left = relLeft;
    if (relRight > right) right = relRight;
    if (relBottom > bottom) bottom = relBottom;
  });

  const zone = document.createElement('div');
  zone.id = 'vip_zone';
  zone.style.top = `${top - 5}px`;
  zone.style.left = `${left - 5}px`;
  zone.style.width = `${right - left + 10}px`;
  zone.style.height = `${bottom - top + 10}px`;

  document.querySelector('.seating-container').appendChild(zone);
});
