
document.addEventListener('DOMContentLoaded', function () {
  const profile = document.querySelector('.admin-profile');
  const logoutBtn = document.getElementById('.logout-btn');
  const authButtons = document.getElementById('.auth-buttons');
  profile.addEventListener('click', function (e) {
    e.stopPropagation();
    this.classList.toggle('active');
  });
  document.addEventListener('click', function () {
    profile.classList.remove('active');
  });
  logoutBtn.addEventListener('click',function(e){
      e.preventDefault(); //ngăn chuyển trang nếu là tab a
      profile.style.display='none'; // ẩn khối admin
      authButtons.style.display ="flex";
  });
});

document.addEventListener('active', function(){
  

});
