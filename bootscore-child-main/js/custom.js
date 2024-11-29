jQuery(function ($) {
  jQuery(document).ready(function ($) {
    AOS.init();
    feather.replace();

    let removeCatTimeout;
    jQuery("#menu-item-16")
      .mouseenter(function () {
        jQuery(".product-category-wrapper").addClass("active");
      })
      .mouseleave(function () {
        removeCatTimeout = setTimeout(removeCategory, 300);
      });

    jQuery(".product-category-wrapper")
      .mouseenter(function () {
        jQuery(".product-category-wrapper").addClass("active");
        clearTimeout(removeCatTimeout);
      })
      .mouseleave(function () {
        setTimeout(removeCategory(), 300);
        removeCatTimeout = "";
      });
    function removeCategory() {
      jQuery(".product-category-wrapper").removeClass("active");
    }
    jQuery(".tab-pane.fade.active.show .row .product-item").addClass(
      "aos-animate"
    );
    jQuery(".product-category-wrapper .nav-pills button").mouseover(
      function () {
        jQuery(".tab-pane.fade")
          .not(".active")
          .find(".row .product-item")
          .removeClass("aos-animate");
        setTimeout(() => {
          jQuery(this).click();
        }, 100);
        setTimeout(() => {
          jQuery(".tab-pane.fade.active.show .row .product-item").addClass(
            "aos-animate"
          );
        }, 300);
      }
    );

    jQuery(".owl-carousel.products").owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      center: true,
      nav: true,
      navText: [
        '<i class="fa-solid fa-arrow-left"></i>',
        '<i class="fa-solid fa-arrow-right"></i>',
      ],
      responsive: {
        0: {
          items: 1,
          nav: true,
        },
      },
    });
    $(".owl-carousel.inner-page-products").owlCarousel({
      loop: true,
      margin: 20,
      responsiveClass: true,
      navText: [
        '<i class="fa-solid fa-arrow-left"></i>',
        '<i class="fa-solid fa-arrow-right"></i>',
      ],
      responsive: {
        0: {
          items: 1.5,
          nav: true,
        },
        600: {
          items: 2,
          nav: true,
        },
        1000: {
          items: 4,
          nav: true,
        },
      },
    });
    $(".owl-carousel.client-review").owlCarousel({
      loop: true,
      margin: 15,
      responsiveClass: true,
      navText: [
        '<i class="fa-solid fa-arrow-left"></i>',
        '<i class="fa-solid fa-arrow-right"></i>',
      ],
      responsive: {
        0: {
          items: 1,
          nav: true,
        },
        600: {
          items: 2,
          nav: true,
        },
        1000: {
          items: 3,
          nav: true,
        },
      },
    });

    $("#wpforms-form-834 .wpforms-field-container")
      .children(":lt(3)")
      .wrapAll('<div class="wrapper-div"></div>');
    $("#wpforms-form-834 .wpforms-field-container")
      .children()
      .slice(-2)
      .wrapAll('<div class="another-wrapper-div"></div>');
    $("#wpforms-form-733 .wpforms-field-container")
      .children(":lt(3)")
      .wrapAll('<div class="wrapper-div"></div>');
    $("#wpforms-form-733 .wpforms-field-container")
      .children(":last")
      .wrap('<div class="another-wrapper-div"></div>');

    $("#itemList").on("click", ".item", function () {
      $("#itemList .item").removeClass("active");
      $(this).addClass("active");
      var imageUrl = $(this).data("image");
      $("#selectedImage").fadeOut(400, function () {
        $(this).attr("src", imageUrl).fadeIn(400);
      });
    });
    let ctrAnim = 1;
    let offerAnimation = setInterval(offerAnimationFunc, 4000);
    function offerAnimationFunc() {
      jQuery(`#itemList li`).removeClass("active");
      jQuery(`#itemList li[data-number="${ctrAnim}"]`).addClass("active");
      let imageUrl = jQuery(`#itemList li.active`).attr("data-image");
      $("#selectedImage").fadeOut(400, function () {
        $(this).attr("src", imageUrl).fadeIn(400);
      });
      ctrAnim++;
      if (ctrAnim > jQuery("#itemList li").length) {
        ctrAnim = 1;
      }
    }
    jQuery(".item.list-group-item").mouseover(function () {
      jQuery(`#itemList li`).removeClass("active");
      jQuery(this).addClass("active");
      ctrAnim = jQuery(this).attr("data-number");
      clearInterval(offerAnimation);
    });
    jQuery(".item.list-group-item").mouseout(function () {
      offerAnimation = setInterval(offerAnimationFunc, 4000);
    });

    $(".image").on("click", function () {
      var src = $(this).attr("src");
      $("#modalImg").attr("src", src);
      $("#myModal").css("display", "block");
      $("#myModal").fadeIn(4000);
    });
    $(".close, #myModal").on("click", function () {
      $("#myModal").css("display", "none");
      $("#myModal").fadeOut(4000);
    });

    $("#menu-item-20").hover(
      function () {
        if ($(window).width() > 992) {
          $(this).children("ul.dropdown-menu").slideDown("300");
        }
      },
      function () {
        if ($(window).width() > 992) {
          $(this).children("ul.dropdown-menu").slideUp("300");
        }
      }
    );

    $(".dropdown-toggle").click(function (e) {
      e.preventDefault();
      if ($(window).width() <= 992) {
        var submenu = $(this)
          .siblings("#menu-item-16 ul.dropdown-menu.depth_0")
          .slideDown("300");
        if (submenu.hasClass("show")) {
          submenu.css("display", "block");
        } else {
          submenu.hide();
        }
      }
    });

    function activateGridView() {
      $(".view-toggle button.grid-view").addClass("active");
      $(".products-grid").show();
      $(".products-list").hide();
    }
    activateGridView();
    $(".view-toggle button").click(function () {
      $(".view-toggle button").removeClass("active");
      $(this).addClass("active");
      if ($(this).hasClass("grid-view")) {
        $(".products-grid").show();
        $(".products-list").hide();
      } else if ($(this).hasClass("list-view")) {
        $(".products-grid").hide();
        $(".products-list").show();
      }
    });

    let slideIndex = 1;
    showSlides(slideIndex);
    function plusSlides(n) {
      showSlides((slideIndex += n));
    }
    function currentSlide(n) {
      showSlides((slideIndex = n));
    }
    function showSlides(n) {
      let slides = $(".mySlides");
      let dots = $(".column");
      let captionText = $("#caption");
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      slides.hide();
      dots.removeClass("active");
      $(slides[slideIndex - 1]).show();
      $(dots[slideIndex - 1]).addClass("active");
      captionText.html($(dots[slideIndex - 1]).attr("alt"));
    }
    window.currentSlide = currentSlide;

    $(".number-range-buttons button").each(function () {
      var min = parseInt($(this).data("min"));
      var max = parseInt($(this).data("max"));
      var itemCount = countProducts(min, max);
      $(this)
        .find(".item-count")
        .text("(" + itemCount + ")");
    });
    function resetFilter() {
      $(".products-grid .col-lg-4").show();
    }
    $(".number-range-buttons button").click(function () {
      var min = parseInt($(this).data("min"));
      var max = parseInt($(this).data("max"));
      filterProducts(min, max);
    });
    function countProducts(min, max) {
      var count = 0;
      $(".products-grid .col-lg-4").each(function () {
        var modelNumber = parseInt($(this).find("h2").text().match(/\d+/)[0]);
        if (modelNumber >= min && modelNumber <= max) {
          count++;
        }
      });
      return count;
    }
    $("#reset-filter").click(function () {
      console.log("Resetting filter");
      resetFilter();
    });
    function filterProducts(min, max) {
      $(".products-grid .col-lg-4").show();
      $(".products-grid .col-lg-4").each(function () {
        var modelNumber = parseInt($(this).find("h2").text().match(/\d+/)[0]);
        if (modelNumber < min || modelNumber > max) {
          $(this).hide();
        }
      });
    }
    $(".number-range").click(function () {
      $(".number-range").removeClass("active");
      $(this).addClass("active");
    });
    $("#reset-filter").click(function () {
      $(".number-range").removeClass("active");
    });

    $(".prev.page-numbers").html('<i class="fa-solid fa-chevron-left"></i>');
    $(".next.page-numbers").html('<i class="fa-solid fa-chevron-right"></i>');

    $("#searchIcon").click(function (e) {
      e.stopPropagation();
      $("#dropdownContent").toggle();
      $(this).toggleClass("fa-magnifying-glass fa-times");
    });
    $(document).click(function (e) {
      if (!$(e.target).closest(".dropdown").length) {
        $("#dropdownContent").hide();
        $("#searchIcon")
          .removeClass("fa-times")
          .addClass("fa-magnifying-glass");
      }
    });

    $("#searchIcon-mobile").click(function (e) {
      e.stopPropagation();
      $("#dropdownContent-mobile").toggle();
      $(this).toggleClass("fa-magnifying-glass fa-times");
    });
    $(document).click(function (e) {
      if (!$(e.target).closest(".dropdown-mobile").length) {
        $("#dropdownContent-content").hide();
        $("#searchIcon-content")
          .removeClass("fa-times")
          .addClass("fa-magnifying-glass");
      }
    });

    $("#wpforms-submit-834").html("Apply Now");
    $("#wpforms-submit-733").html("Send");

    $("#offcanvas-navbar").on("hidden.bs.offcanvas", function () {
      $(".hamburger").removeClass("is-active");
    });
    $("#offcanvas-navbar").on("shown.bs.offcanvas", function () {
      $(".hamburger").addClass("is-active");
    });
    $(".hamburger").click(function () {
      $(this).toggleClass("is-active");
    });

    const urlParams = new URLSearchParams(window.location.search);
    const item = urlParams.get("item");
    if (item) {
      const section = $("#section-" + item);
      if (section.length) {
        $("html, body").animate(
          {
            scrollTop: section.offset().top,
          },
          "slow"
        );
      }
    }
  });
});
