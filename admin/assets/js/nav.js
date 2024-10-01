$(".menu > ul > li").click(function (e) {
  // Remove active from other items
  $(this).siblings().removeClass("active");
  // Toggle active for clicked item
  $(this).toggleClass("active");
  // SlideToggle the submenu of the clicked item
  $(this).find("ul").slideToggle();
  // SlideUp other submenus
  $(this).siblings().find("ul").slideUp();
  // Remove active class from all sub-items
  $(this).siblings().find("ul").find("li").removeClass("active");
});

// Toggle sidebar on clicking the menu button
$(".menu-btn").click(function () {
  $(".sidebar").toggleClass("active");
});
