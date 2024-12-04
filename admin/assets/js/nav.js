// Fullscreen Toggle
const fullscreenBtn = document.getElementById("toggleFullscreen");

fullscreenBtn.addEventListener("click", () => {
    if (!document.fullscreenElement) {
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            // Firefox
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            // Chrome, Safari and Opera
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) {
            // IE/Edge
            document.documentElement.msRequestFullscreen();
        }
        fullscreenBtn.innerHTML = '<svg height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18 7H22V9H16V3H18V7ZM8 9H2V7H6V3H8V9ZM18 17V21H16V15H22V17H18ZM8 15V21H6V17H2V15H8Z"></path></svg>';
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            // Firefox
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            // Chrome, Safari and Opera
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            // IE/Edge
            document.msExitFullscreen();
        }
        fullscreenBtn.innerHTML = '<svg height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"> <path d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z"></path> </svg>';
    }
});

// Optional: Update fullscreen icon if fullscreen state changes externally
document.addEventListener("fullscreenchange", () => {
    if (!document.fullscreenElement) {
        fullscreenBtn.innerHTML = '<svg height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"> <path d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z"></path> </svg>';
    }
});

// Toggle sidebar
const toggleBtns = document.querySelectorAll("#toggleSidebar");
toggleBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
});

// Handle responsive behavior
function handleResize() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("close");
  } else {
    sidebar.classList.remove("close");
  }
}

const menuItems = document.querySelectorAll(".nav-links li");
const sidebar = document.querySelector(".sidebar");

// Submenu functionality
menuItems.forEach((item) => {
  if (item.querySelector(".sub-menu")) {
    const arrow = item.querySelector(".arrow");
    item.style.cursor = "pointer";

    // Hover events for closed sidebar
    item.addEventListener("mouseenter", () => {
      if (sidebar.classList.contains("close")) {
        if (arrow) {
          arrow.style.transform = "rotate(90deg)";
          arrow.style.transition = "transform 0.4s ease";
        }
        item.classList.add("showMenu");
      }
    });

    item.addEventListener("mouseleave", () => {
      if (sidebar.classList.contains("close")) {
        if (arrow) {
          arrow.style.transform = "rotate(0deg)";
          arrow.style.transition = "transform 0.4s ease";
        }
        item.classList.remove("showMenu");
      }
    });

    // Click event for open sidebar and mobile
    item.addEventListener("click", (e) => {
      // Only handle click when sidebar is open or on mobile
      if (!sidebar.classList.contains("close") || window.innerWidth <= 768) {
        // Don't trigger if clicking submenu items
        if (!e.target.closest(".sub-menu")) {
          // Close other submenus
          menuItems.forEach((i) => {
            if (i !== item) {
              i.classList.remove("showMenu");
              const arrowIcon = i.querySelector(".arrow");
              if (arrowIcon) {
                arrowIcon.style.transform = "rotate(0deg)";
              }
            }
          });

          // Toggle current submenu
          item.classList.toggle("showMenu");

          // Rotate arrow
          if (arrow) {
            arrow.style.transform = item.classList.contains("showMenu")
              ? "rotate(90deg)"
              : "rotate(0deg)";
            arrow.style.transition = "transform 0.4s ease";
          }
        }
      }
    });
  }
});

// Handle responsive behavior
function handleResize() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("close");
  } else {
    sidebar.classList.remove("close");
  }
}

window.addEventListener("resize", handleResize);
handleResize(); // Initial check