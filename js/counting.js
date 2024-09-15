document.addEventListener("DOMContentLoaded", function() {
  const counts = document.querySelectorAll('.count');
  const duration = 7000; // Duration for all counters to finish (in ms)
  
  counts.forEach(count => {
    const target = +count.getAttribute('data-target');
    const frameRate = 16; // 16ms per frame (~60fps)
    const totalFrames = duration / frameRate;
    const increment = target / totalFrames; // Increment per frame
    
    let current = 0;

    const interval = setInterval(() => {
      current += increment;
      
      if (current >= target) {
        count.textContent = target; // Ensure the final value matches the target
        clearInterval(interval); 
      } else {
        count.textContent = Math.floor(current); // Update the text content with rounded current value
      }
    }, frameRate); // Run at ~60fps
  });
});
