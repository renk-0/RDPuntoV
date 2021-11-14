let categories = document.getElementsByClassName("catg");

for(let e of categories) {
	let color = e.getAttribute("catg_color");
	e.style["background"]= color;
}
