// DOM element selections
const heroSection = document.querySelector(".hero-section");
const leftLeaf = document.querySelector(".h1_left_leaf");
const rightLeaf = document.querySelector(".h2_right_leaf");
const sprinkleImage = document.querySelector(".h_sprinkle");
const mushroomImage = document.querySelector(".h2_mushroom");
const tomatoImage = document.querySelector(".h1_tomato");
const mintImage = document.querySelector(".h1_mint");
const pizzaImage = document.querySelector(".pizza-image");

// Scroll-based animations
function updateLeafPosition() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

  if (scrollTop < heroBottom) {
    const translateY = scrollTop * 0.2;
    const translateY2 = scrollTop * 0.3;
    leftLeaf.style.transform = `translateY(${translateY}px)`;
    rightLeaf.style.transform = `translateY(${translateY2}px)`;
  }
}

function rotateSprinkle() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

  if (scrollTop < heroBottom) {
    const rotation = scrollTop * -0.02;
    const rotation2 = scrollTop * -0.04;
    const translateY = scrollTop * -0.1; // Keep the same downward movement speed
    sprinkleImage.style.transform = `rotate(${rotation}deg) translateY(${translateY}px)`;
    mushroomImage.style.transform = `rotate(${rotation2}deg) translateY(${translateY}px)`;
  }

  lastScrollTop = scrollTop;
}

function updatePizzaPosition() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

  if (scrollTop < heroBottom) {
    const translateY = scrollTop * 0.1; // Adjust this value to control the speed of translation
    pizzaImage.style.setProperty("--translateY", `${translateY}px`);
  }

  lastScrollTop = scrollTop;
}

// Mouse movement animations
function handleMouseMove(e) {
  const rect = heroSection.getBoundingClientRect();
  const mouseX = e.clientX - rect.left;
  const mouseY = e.clientY - rect.top;

  // Tomato parallax effect
  const tomatoXAxis = (window.innerWidth / 2 - e.pageX) / 50;
  const tomatoYAxis = (window.innerHeight / 2 - e.pageY) / 50;
  tomatoImage.style.transform = `translateX(${tomatoXAxis}px) translateY(${tomatoYAxis}px)`;

  // Mint 2D effect
  const mintRect = mintImage.getBoundingClientRect();
  const mintCenterX = mintRect.left + mintRect.width / 2 - rect.left;
  const mintCenterY = mintRect.top + mintRect.height / 2 - rect.top;

  const maxRotation = 6; // Maximum rotation in degrees
  const maxTranslation = 6; // Maximum translation in pixels

  const rotateX = ((mouseY - mintCenterY) / mintRect.height) * maxRotation;
  const rotateY = ((mouseX - mintCenterX) / mintRect.width) * -maxRotation;

  const translateX = ((mouseX - mintCenterX) / mintRect.width) * maxTranslation;
  const translateY =
    ((mouseY - mintCenterY) / mintRect.height) * maxTranslation;

  mintImage.style.transform = `
    rotateX(${rotateX}deg) 
    rotateY(${rotateY}deg)
    translateX(${translateX}px)
    translateY(${translateY}px)
`;
}

function handleMouseEnter() {
  tomatoImage.style.transition = "none";
  mintImage.style.transition = "none";
}

function handleMouseLeave() {
  tomatoImage.style.transition = "transform 0.5s ease";
  tomatoImage.style.transform = "translateX(0) translateY(0)";

  mintImage.style.transition = "transform 1s ease";
  mintImage.style.transform =
    "rotateX(0) rotateY(0) translateX(0) translateY(0)";
}

// Initial animations on page load
function startAnimations() {
  const elements = [
    ".h1_tomato",
    ".h1_left_leaf",
    ".h2_right_leaf",
    ".h1_mint",
    ".h2_mushroom",
  ];

  elements.forEach((selector) => {
    const element = document.querySelector(selector);
    if (element) {
      element.classList.add("animate");
    }
  });
}

function setupInitialAnimations() {
  // Set initial styles for elements
  leftLeaf.style.transform = "translateY(100px)";
  rightLeaf.style.transform = "translateY(100px)";
  sprinkleImage.style.transform = "rotate(0deg) translateY(0px)";
  mushroomImage.style.transform = "rotate(0deg) translateY(0px)";
  tomatoImage.style.transform = "translateX(0) translateY(0)";
  mintImage.style.transform =
    "rotateX(0) rotateY(0) translateX(0) translateY(0)";
  pizzaImage.style.transform = "translateY(0)";

  // Add transition properties for smooth animations
  leftLeaf.style.transition = "transform 0.5s ease-out";
  rightLeaf.style.transition = "transform 0.5s ease-out";
  sprinkleImage.style.transition = "transform 0.5s ease-out";
  mushroomImage.style.transition = "transform 0.5s ease-out";
  tomatoImage.style.transition = "transform 0.5s ease";
  mintImage.style.transition = "transform 1s ease";
  pizzaImage.style.transition = "transform 0.5s ease-out";
}

// Event listeners
window.addEventListener("scroll", () => {
  updateLeafPosition();
  rotateSprinkle();
  updatePizzaPosition();
});

heroSection.addEventListener("mousemove", handleMouseMove);
heroSection.addEventListener("mouseenter", handleMouseEnter);
heroSection.addEventListener("mouseleave", handleMouseLeave);

// Initialize animations
document.addEventListener("DOMContentLoaded", () => {
  setupInitialAnimations();
  setTimeout(startAnimations, 100);
});

// Add transition for smooth movement
leftLeaf.style.transition = "transform 0.1s ease-out";
sprinkleImage.style.transition = "transform 0.1s ease-out";
pizzaImage.style.transform = "translateY(var(--translateY))";
pizzaImage.style.setProperty("--e-transform-transition-duration", "100ms");

document.addEventListener("DOMContentLoaded", function () {
  const products = document.querySelectorAll(".product-cat");
  let delay = 0; // Initialize delay

  // Create an IntersectionObserver to detect when elements are visible in the viewport
  let observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Add a delay to each product before making it visible
          setTimeout(() => {
            entry.target.classList.add("visible"); // Add class to animate
          }, delay);
          delay += 150; // Increase delay for the next product (150ms)
        }
      });
    },
    { threshold: 0.1 }
  ); // Trigger when 10% of the element is in view

  // Observe each product category
  products.forEach((product) => {
    observer.observe(product);
  });
});

