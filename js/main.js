document.addEventListener("click", function (e) {
	if (e.target.classList.contains("gallery-item")) {
		const src = e.target.getAttribute("src");
		document.querySelector(".modal-img").src = src;
		const myModal = new bootstrap.Modal(document.getElementById('gallery-modal'));
		myModal.show();
	}
})
document.addEventListener("click", function (e) {
	if (e.target.classList.contains("gallery-item1")) {
		const src = e.target.getAttribute("src");
		document.querySelector(".modal-img1").src = src;
		const myModal1 = new bootstrap.Modal(document.getElementById('gallery-modal1'));
		myModal1.show();
	}
})