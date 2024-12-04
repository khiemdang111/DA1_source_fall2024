(function ($) {
  "use strict";

  $(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: "scroll",
  });

  var fullHeight = function () {
    $(".js-fullheight").css("height", $(window).height());
    $(window).resize(function () {
      $(".js-fullheight").css("height", $(window).height());
    });
  };
  fullHeight();

  // loader
  var loader = function () {
    setTimeout(function () {
      if ($("#ftco-loader").length > 0) {
        $("#ftco-loader").removeClass("show");
      }
    }, 1);
  };
  loader();

  var carousel = function () {
    $(".carousel-testimony").owlCarousel({
      center: true,
      loop: true,
      autoplay: true,
      autoplaySpeed: 2000,
      items: 1,
      margin: 30,
      stagePadding: 0,
      nav: false,
      navText: [
        '<span class="ion-ios-arrow-back">',
        '<span class="ion-ios-arrow-forward">',
      ],
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 2,
        },
        1000: {
          items: 3,
        },
      },
    });
  };
  carousel();

  $("nav .dropdown").hover(
    function () {
      var $this = $(this);
      // 	 timer;
      // clearTimeout(timer);
      $this.addClass("show");
      $this.find("> a").attr("aria-expanded", true);
      // $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
      $this.find(".dropdown-menu").addClass("show");
    },
    function () {
      var $this = $(this);
      // timer;
      // timer = setTimeout(function(){
      $this.removeClass("show");
      $this.find("> a").attr("aria-expanded", false);
      // $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
      $this.find(".dropdown-menu").removeClass("show");
      // }, 100);
    }
  );

  $("#dropdown04").on("show.bs.dropdown", function () {
    console.log("show");
  });

  // scroll
  var scrollWindow = function () {
    $(window).scroll(function () {
      var $w = $(this),
        st = $w.scrollTop(),
        navbar = $(".ftco_navbar"),
        sd = $(".js-scroll-wrap");

      if (st > 150) {
        if (!navbar.hasClass("scrolled")) {
          navbar.addClass("scrolled");
        }
      }
      if (st < 150) {
        if (navbar.hasClass("scrolled")) {
          navbar.removeClass("scrolled sleep");
        }
      }
      if (st > 350) {
        if (!navbar.hasClass("awake")) {
          navbar.addClass("awake");
        }

        if (sd.length > 0) {
          sd.addClass("sleep");
        }
      }
      if (st < 350) {
        if (navbar.hasClass("awake")) {
          navbar.removeClass("awake");
          navbar.addClass("sleep");
        }
        if (sd.length > 0) {
          sd.removeClass("sleep");
        }
      }
    });
  };
  scrollWindow();

  var counter = function () {
    $("#section-counter, .wrap-about, .ftco-counter").waypoint(
      function (direction) {
        if (
          direction === "down" &&
          !$(this.element).hasClass("ftco-animated")
        ) {
          var comma_separator_number_step =
            $.animateNumber.numberStepFactories.separator(",");
          $(".number").each(function () {
            var $this = $(this),
              num = $this.data("number");
            console.log(num);
            $this.animateNumber(
              {
                number: num,
                numberStep: comma_separator_number_step,
              },
              1000
            );
          });
        }
      },
      { offset: "95%" }
    );
  };
  counter();

  var contentWayPoint = function () {
    var i = 0;
    $(".ftco-animate").waypoint(
      function (direction) {
        if (
          direction === "down" &&
          !$(this.element).hasClass("ftco-animated")
        ) {
          i++;

          $(this.element).addClass("item-animate");
          setTimeout(function () {
            $("body .ftco-animate.item-animate").each(function (k) {
              var el = $(this);
              setTimeout(
                function () {
                  var effect = el.data("animate-effect");
                  if (effect === "fadeIn") {
                    el.addClass("fadeIn ftco-animated");
                  } else if (effect === "fadeInLeft") {
                    el.addClass("fadeInLeft ftco-animated");
                  } else if (effect === "fadeInRight") {
                    el.addClass("fadeInRight ftco-animated");
                  } else {
                    el.addClass("fadeInUp ftco-animated");
                  }
                  el.removeClass("item-animate");
                },
                k * 50,
                "easeInOutExpo"
              );
            });
          }, 100);
        }
      },
      { offset: "95%" }
    );
  };
  contentWayPoint();

  // magnific popup
  $(".image-popup").magnificPopup({
    type: "image",
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: "mfp-no-margins mfp-with-zoom", // class to remove default margin from left and right side
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true,
    },
    zoom: {
      enabled: true,
      duration: 300, // don't foget to change the duration also in CSS
    },
  });

  $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
    disableOn: 700,
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false,
  });

  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
})(jQuery);

window.addEventListener("beforeunload", function () {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "index.php", true);
  xhr.send();
});

function shuffle(array) {
  let currentIndex = array.length,
    randomIndex;
  while (currentIndex != 0) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex],
      array[currentIndex],
    ];
  }
  return array;
}

let isSpinning = false; // Biến để kiểm tra trạng thái vòng quay

async function spin() {
  const path = window.location.pathname; // ví dụ: "/users/123"

  // Tách phần id người dùng từ đường dẫn
  const userId = path.split("/").pop(); // Tách chuỗi và lấy phần cuối, ví dụ: "123"

  console.log(userId);
  wheel.play();
  if (isSpinning) return; // Ngăn không cho người dùng nhấn nhiều lần khi đang quay

  isSpinning = true; // Đặt trạng thái đang quay
  const box = document.getElementById("box");
  const spinButton = document.getElementById("spinButton");
  // let selectedItem = "";
  try {
    const response = await fetch("/lucky_wheel/spin", { method: "GET" });
    if (!response.ok) {
      throw new Error("Có lỗi khi lấy dữ liệu từ server.");
    }
    const contentType = response.headers.get("Content-Type");
    if (!contentType || !contentType.includes("application/json")) {
      throw new Error("Server không trả về JSON hợp lệ.");
    }
    const result = await response.json();

    const { prize, angle, unit } = result;
    const prizeAngle = angle;

    spinButton.disabled = true;

    box.style.transition = "all ease 11s";
    box.style.transform = `rotate(${prizeAngle + 1440}deg)`;
    setTimeout(() => {
      applause.play();
      if (prize === "Chúc bạn may mắn lần sau") {
        swal({
          title: "Chúc bạn may mắn lần sau!",
          icon: "error",
        }).then(() => {
          window.location.href = "/users/" + userId ;
        });
      } else {
        swal({
          text: "Chúc mừng bạn!",
          title: "Voucher " + prize + ".",
          icon: "success",
        }).then(() => {
          window.location.href = "/users/" + userId ;
        });
      }

      box.style.transition = "none";
      box.style.transform = "rotate(0deg)";
      spinButton.disabled = false; // Kích hoạt lại nút
      isSpinning = false; // Đặt trạng thái quay xong
    }, 11000);
  } catch (error) {
    console.log(error);
    alert("Lỗi: " + error.message); // Hiển thị lỗi nếu có vấn đề với fetch
    spinButton.disabled = false; // Đảm bảo bật lại nút quay
  }
}
// Các góc quay tương ứng với các ô
// const prizes = {
//   90: "Chúc mừng bạn đã trúng được mã giảm giá 10k",
//   180: "Chúc mừng bạn đã trúng được mã giảm giá 50k",
//   270: "Chúc mừng bạn đã trúng được mã giảm giá 100k",
//   360: "Chúc bạn may mắn lần sau"
// };

// Random chọn góc trúng thưởng
// const angles = [90, 180, 270, 360];
// const randomIndex = Math.floor(Math.random() * angles.length);
// const rotation = angles[randomIndex];

// Lấy giá trị giải thưởng
// selectedItem = prizes[rotation];

// Xoay vòng quay
// Thêm 1440° để vòng quay xoay nhiều lần

// Hiển thị kết quả
