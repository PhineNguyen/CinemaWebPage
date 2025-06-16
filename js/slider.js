<script>
  $(document).ready(function(){
    $('.slider').slick({
      arrows: false,       // Ẩn mũi tên mặc định
      autoplay: true,
      autoplaySpeed: 3000
    });

    $('.muitentrai').click(function(){
      $('.slider').slick('slickPrev');
    });

    $('.muitenphai').click(function(){
      $('.slider').slick('slickNext');
    });
  });
</script>
