
  // function showTab(tab) {
  //   document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
  //   document.querySelectorAll('.tab-header div').forEach(el => el.classList.remove('active'));

  //   document.getElementById(tab).classList.add('active');
  //   document.getElementById(tab + 'Tab').classList.add('active');
  // }
  function showTab(tab) {
  $('.tab-content').removeClass('active');
  $('.tab-header div').removeClass('active');

  $('#' + tab).addClass('active');
  $('#' + tab + 'Tab').addClass('active');
}
