$(function () {
  // Sticky Header on scroll down
  $(window).on("scroll", function () {
    var header = $(".landing_page_header");
    if ($(window).scrollTop() > 0) {
      header.addClass("sticky");
    } else {
      header.removeClass("sticky");
    }
  });

  // Show/hide scrollToTop button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".scrollToTop").fadeIn();
    } else {
      $(".scrollToTop").fadeOut();
    }
  });

  // Scroll to top on click
  $(".scrollToTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 800);
    return false;
  });

  // Set year
  document.getElementById("year").textContent = new Date().getFullYear();

  // Swiper initialization (fixed location)
  const slider = new Swiper(".init-swiper", {
    loop: true,
    speed: 600,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1.4,
        centeredSlides: true,
        spaceBetween: 10,
      },
      480: {
        slidesPerView: 1.5,
        centeredSlides: true,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 4,
        centeredSlides: false,
        spaceBetween: 20,
      },
      992: {
        slidesPerView: 4.3,
        centeredSlides: false,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 4.3,
        centeredSlides: false,
        spaceBetween: 20,
      },
    },
  });

  console.log("Swiper initialized:", slider);

//calculate slider height for responsive
$(function () {
  function applySliderHeight() {
    const $slider = $(".tb-img-slider");
    const $content = $slider.find(".swiper-wrapper"); // or use .swiper-slide:first-child

    if (!$slider.length || !$content.length) return;

    const contentHeight = $content.outerHeight(true); // includes padding + margin
    if (contentHeight) {
      $slider.css("height", contentHeight + "px");
    }
  }

  // Initial call (delay in case images/swiper take time to load)
  setTimeout(applySliderHeight, 300);

  // On window resize
  $(window).on("resize", function () {
    applySliderHeight();
  });

  // On full load (e.g., images fully loaded)
  $(window).on("load", function () {
    applySliderHeight();
  });
});


//logo slider
const logoslider = new Swiper(".initlogo-swiper", {
    loop: true,
    speed: 600,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        centeredSlides: true,
        spaceBetween: 10,
      },
      480: {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 4,
        centeredSlides: false,
        spaceBetween: 20,
      },
      992: {
        slidesPerView: 6,
        centeredSlides: false,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 9,
        centeredSlides: false,
        spaceBetween: 20,
      },
    },
});

});
