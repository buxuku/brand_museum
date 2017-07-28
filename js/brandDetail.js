mui.init();
mui.ready(function() {
	setSize();
	function setSize(){
		var bodyWidth=(document.body.offsetWidth-38)/3;
		var goodsImg=document.querySelectorAll(".gaia-brandDetail-content .mui-card-content img");
		goodsImg.forEach(function(item){
			item.style.width=bodyWidth+"px";
			var img = new Image();
				// 改变图片的src
				img.src = item.getAttribute('src');
				var check = function(){
					if(img.width!=0){
						item.style.marginTop=(-(item.offsetWidth/img.width*img.height-item.offsetWidth)/2)+'px';
					}
				};
				var set = setInterval(check,40);
				// 加载完成获取宽高
				img.onload = function(){
				    item.style.marginTop=(-(item.offsetWidth/img.width*img.height-item.offsetWidth)/2)+'px';
				    // 取消定时获取宽高
				    clearInterval(set);
				};
		});
	}
	window.onresize=setSize;
})