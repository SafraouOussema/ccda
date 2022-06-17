
var swiper1 = new Swiper(".mySwiper1", {
  slidesPerView: 3,
  spaceBetween: 30,
  slidesPerGroup: 1,
  autoplay: {
          delay: 2000,
          disableOnInteraction: false,
      },
  loop: true,
  loopFillGroupWithBlank: true, 
   
  });

  var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    
});