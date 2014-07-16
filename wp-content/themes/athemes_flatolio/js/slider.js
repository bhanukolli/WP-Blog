jQuery(document).ready(function(){
	jQuery("#myController").jFlow({
		slides: "#slides",
		controller: ".jFlowControl",
		slideWrapper : "#jFlowSlide",
		selectedWrapper: "jFlowSelected",
		auto: true,
		width: "100%",
		height: "200px",
		duration: 200,
		prev: ".jFlowPrev",
		next: ".jFlowNext"
	});
});