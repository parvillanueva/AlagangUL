
$(function () {
	//CUSTOM SCROLLBAR
	$("").overlayScrollbars({
		className: "os-theme-dark",

		overflowBehavior: {
			x: "hidden",
			y: "scroll"
		},
	});
})

function menuBtn() {

	$("#sideNav").toggleClass("nav-align");
	$("#leftPanel").toggleClass("ml-0");
	$(".menu-open").toggleClass("hide");

}

