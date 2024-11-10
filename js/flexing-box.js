let carouselItems = document.querySelectorAll(".custom-carousel-item");
let carouselContainer = document.querySelector(".custom-carousel-container");
let visibleItemCount = 3; // Number of items to show at a time

let currentItemIndex = 0;
let endItemIndex = visibleItemCount - 1;
let lastClickedItemIndex = 1;

let translateXPosition = 0;
const itemWidthPercent = 100; // Width of each item in percentage

// Show only the first 3 items initially
carouselItems.forEach((item, index) => {
  if (index < visibleItemCount) {
    item.classList.add("visible");
  }

  if(index === 1) item.classList.add('active');
});

const totalItems = carouselItems.length;

// Add event listeners to each item
carouselItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    carouselItems[lastClickedItemIndex].classList.remove("active");
    item.classList.add("active");
    lastClickedItemIndex = index;

    const nextIndex = (endItemIndex + 1) % totalItems;
    const prevIndex = (currentItemIndex - 1 + totalItems) % totalItems;
    const centerIndex = (currentItemIndex + 1) % totalItems;

    // Skip action if the center item is clicked
    if (index === centerIndex) {
      return;
    }

    // Move forward
    if (endItemIndex === index) {
      carouselItems[currentItemIndex].classList.remove("visible");
      carouselItems[nextIndex].classList.add("visible");
      carouselContainer.appendChild(carouselItems[nextIndex]);

      currentItemIndex = (currentItemIndex + 1) % totalItems;
      endItemIndex = nextIndex;

      // Move backward
    } else if (!carouselItems[prevIndex].classList.contains("visible")) {
      carouselItems[endItemIndex].classList.remove("visible");
      carouselItems[prevIndex].classList.add("visible");
      carouselContainer.insertBefore(carouselItems[prevIndex], carouselContainer.firstChild);

      endItemIndex = (endItemIndex - 1 + totalItems) % totalItems;
      currentItemIndex = prevIndex;
    }
  });
});
