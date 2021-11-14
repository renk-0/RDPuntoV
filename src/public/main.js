let categories = document.getElementsByClassName("catg");

for(let e of categories) {
	let color = e.getAttribute("catg_color");
	let text = e.getElementsByClassName("catg-name")[0];
	if(text) {
		e.style.background = color;
		text.style.color = color;
		text.style.filter = "invert(100%)";
	}
}
