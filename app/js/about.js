const aboutContainer = document.querySelector(".about-container");

const observe = new IntersectionObserver((entries) => {
  entries.forEach((entry) => { //  Перебираем  элементы  в  массиве  entries
    if (entry.isIntersecting) {
      entry.target.style.opacity = 1;
      entry.target.style.transform = "translateY(0)";
    }
  });
}, { threshold: 0.5 }); //  Отображать  при  50%  видимости

if (aboutContainer) { //  Проверяем,  существует  ли  aboutContainer
  observe.observe(aboutContainer); 
}
