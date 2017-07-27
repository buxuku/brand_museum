mui.init();
mui.ready(function() {
	setSize();
	function setSize(){
		var bodyWidth=(document.body.offsetWidth-38)/3;
		var goodsImg=document.querySelectorAll(".gaia-brandDetail-content .mui-card-content img");
		goodsImg.forEach(function(item){
			item.style.width=bodyWidth+"px";
			item.style.height=bodyWidth+"px";
		});
	}
	window.onresize=setSize;
})