mui.init();
mui.ready(function() {
	var ad=document.querySelector(".ad");
	var adClose=document.querySelector(".gaia-ad-close");
	/*先设定初值宽高*/
	setSize();
	/*在设置位置初始位置：默认影藏*/
	adDown();
	/*这里添加判断，如果不是我们自己的添加广告*/
	setTimeout(adUp,1000);/*页面加载完毕之后1s后广告出现*/
	
	/*点击关闭ad隐藏*/
	adClose.onclick=adDown;
	
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
	/*广告*/
		ad.style.height=ad.offsetWidth/20*3+'px';
		ad.style.padding=ad.offsetWidth/200*3+'px';
		/*广告close*/
		var adClose=document.querySelector(".gaia-ad-close-box");
		var adDownload=document.querySelector(".gaia-ad-download-box");
		var adText=document.querySelector(".gaia-ad-text");
		
		var adLineheight=ad.offsetHeight-ad.offsetWidth/200*6;
		
		adClose.style.lineHeight=adLineheight+'px';
		adDownload.style.lineHeight=adLineheight+'px';
		adText.style.paddingTop=(adLineheight-adText.offsetHeight)/2+'px';
	}
	
	function adDown(){
		ad.style.transition='bottom linear 0.2s'; 
		ad.style.bottom=-ad.offsetHeight+'px';
	}
	
	function adUp(){
		ad.style.transition='bottom ease-out 0.2s'; 
		ad.style.bottom=0+'px';
	}
	
	window.onresize=setSize;
})