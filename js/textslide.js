const phrases = ["Interiors", "Designs", "Spaces", "Decor"];
const highlight = document.getElementById('dynamic-text');

let index = 0;

function changeText() {
  // Remove the highlight class to reset the animation
  highlight.classList.remove('highlight');
 
  
  // Trigger a reflow to restart the animation
  void highlight.offsetWidth;
  
  // Update the text
  index = (index + 1) % phrases.length;
  highlight.textContent = phrases[index];
  
  
  // Reapply the highlight class to trigger the animation
  highlight.classList.add('highlight');
}



// Change text every 3 seconds
setInterval(changeText, 2000);
