$(document).ready(function () {
  const $vipSeats = $('.seat-vip');
  if ($vipSeats.length === 0) return;

  let top = Infinity, left = Infinity, right = 0, bottom = 0;

  const $container = $('.seating-container');
  const containerRect = $container[0].getBoundingClientRect();

  $vipSeats.each(function () {
    const rect = this.getBoundingClientRect();

    const relTop = rect.top - containerRect.top;
    const relLeft = rect.left - containerRect.left;
    const relRight = rect.right - containerRect.left;
    const relBottom = rect.bottom - containerRect.top;

    if (relTop < top) top = relTop;
    if (relLeft < left) left = relLeft;
    if (relRight > right) right = relRight;
    if (relBottom > bottom) bottom = relBottom;
  });

  const $zone = $('<div>', { id: 'vip_zone' }).css({
    position: 'absolute',
    top: `${top - 5}px`,
    left: `${left - 5}px`,
    width: `${right - left + 10}px`,
    height: `${bottom - top + 10}px`,
    border: '2px dashed red', // bạn có thể tùy chỉnh thêm
    pointerEvents: 'none'
  });

  $container.append($zone);
  // Chuyển trang chonbapnuoc
  $('.button-continute').click(function(){
    window.location.href = 'chonbapnuoc.php';
  })
});
