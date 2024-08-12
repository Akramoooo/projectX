
const cards = document.querySelectorAll(".service-card");

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = "translateY(0)";
        }
    });
}, { threshold: 0.5 }); //  Отображать  при  50%  видимости

cards.forEach((card) => {
    observer.observe(card);
});
