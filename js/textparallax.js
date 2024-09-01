window.addEventListener('scroll', () => {
    let scrollY = window.scrollY;
    let maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    let translateValue = -300 + (scrollY / maxScroll) * 480;

    // Select all elements with the class 'project-right'
    let elements = document.querySelectorAll('.project-right');

    // Apply the transformation to each element
    elements.forEach(element => {
      element.style.transform = `translateY(${translateValue * 2}px)`;
    });
  });