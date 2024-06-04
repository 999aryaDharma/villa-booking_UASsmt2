//navbar blur
window.addEventListener("scroll", function () {
	const navbar = document.querySelector("nav");
	if (window.scrollY > 50) {
		navbar.classList.add("scrolled");
	} else {
		navbar.classList.remove("scrolled");
	}
});

const items = document.querySelectorAll(".carousel-item");
let index = 0;

setInterval(() => {
	items[index].classList.remove("active");
	index = (index + 1) % items.length;
	items[index].classList.add("active");
}, 3000);
