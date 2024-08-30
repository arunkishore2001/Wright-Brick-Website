document.addEventListener("DOMContentLoaded", function () {
  const stepRight = document.querySelector(".step-right");
  const cardDeck = document.querySelector(".scard-deck-js");

  window.addEventListener("scroll", function () {
    const cardDeckRect = cardDeck.getBoundingClientRect();

    // You may still check for conditions if you need further behavior changes
    if (cardDeckRect.bottom <= window.innerHeight) {
      stepRight.style.position = "relative";
    } else {
      stepRight.style.position = "sticky";
      stepRight.style.top = "20px";
    }
  });
});
