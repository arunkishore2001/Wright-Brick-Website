function animateStackCards() {
  var top = this.element.getBoundingClientRect().top;
  var offsetTop = 100,
      cardHeight = 100, // Adjusted to match the card height
      marginY = 14; // Adjusted margin

  for (var i = 0; i < this.items.length; i++) {
    var scrolling = offsetTop - top - i * (cardHeight + marginY);

    if (scrolling > 0) {
      this.items[i].setAttribute(
        "style",
        "transform: translateY(" +
          marginY * i +
          "px) scale(" +
          (cardHeight - scrolling * 0.05) / cardHeight +
          ");"
      );
    }
  }

  this.scrolling = false;
}
