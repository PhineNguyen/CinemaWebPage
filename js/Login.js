
  function showTab(tab) {
  $('.tab-content').removeClass('active');
  $('.tab-header div').removeClass('active');

  $('#' + tab).addClass('active');
  $('#' + tab + 'Tab').addClass('active');
}
