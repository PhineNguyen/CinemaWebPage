const cinemaDetails = {
  "Hồ Chí Minh": ["CINETIX GO! Quận 1", "CINETIX VINCOM Thủ Đức"],
  "Hà Nội": ["CINETIX GO! Hoàn Kiếm", "CINETIX VINCOM Long Biên"],
  "Đà Nẵng": ["CINETIX GO! Hải Châu"],
  "Cần Thơ": ["CINETIX GO! Ninh Kiều"],
  "Đồng Nai": ["CINETIX VINCOM Biên Hòa"],
  "Tiền Giang": ["CINETIX GO! Mỹ Tho", "CINETIX VINCOM Mỹ Tho"],
  "Bình Dương": ["CINETIX GO! Thủ Dầu Một"],
  "Vũng Tàu": ["CINETIX GO! Vũng Tàu"],
  "Bạc Liêu": ["CINETIX GO! Bạc Liêu"],
  "Nghệ An": ["CINETIX GO! Vinh"]
};

const cinemaItems = document.querySelectorAll('.cinema-item');
const detailContainer = document.getElementById('cinema-detail-container');

cinemaItems.forEach(item => {
  item.addEventListener('click', function() {
    cinemaItems.forEach(i => i.classList.remove('selected'));
    this.classList.add('selected');
    const province = this.textContent.trim();
    showCinemaDetails(province);
  });
});

function showCinemaDetails(province) {
  detailContainer.innerHTML = '';
  if (cinemaDetails[province]) {
    const detailDiv = document.createElement('div');
    detailDiv.className = 'cinema-detail';
    cinemaDetails[province].forEach(name => {
      const detailItem = document.createElement('div');
      detailItem.className = 'detail-item';
      detailItem.textContent = name;
      detailItem.onclick = function() {
        detailDiv.querySelectorAll('.detail-item').forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
      };
      detailDiv.appendChild(detailItem);
    });
    detailContainer.appendChild(detailDiv);
  }
}
