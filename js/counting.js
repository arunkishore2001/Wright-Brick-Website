document.addEventListener("DOMContentLoaded", function() {
    const counts = document.querySelectorAll('.count');
    
    counts.forEach(count => {
      const target = +count.getAttribute('data-target');
      let current = 0;
      const interval = setInterval(() => {
        count.textContent = current;
        if (current === target) {
          clearInterval(interval);
        } else {
          current++;
        }
      }, 300); // Adjust the interval for the speed of counting
    });
  });
  