mui.init();
mui.ready(function() {
	var ad=document.querySelector(".ad");
	var adClose=document.querySelector(".gaia-ad-close");
	/*在设置位置初始位置：默认影藏*/
	adDown();
	/*先设定初值宽高*/
	setSize();
	/*这里添加判断，如果不是我们自己的添加广告*/
	var userAgent=navigator.userAgent;
	if(userAgent.indexOf('gaiaUserAgent')<0){
	/*	alert(userAgent);*/
		setTimeout(adUp,1000);/*页面加载完毕之后1s后广告出现*/
	}
	/*alert(userAgent);*/
	/*点击关闭ad隐藏*/
	adClose.onclick=adDown;
	
	function setSize(){
		var bodyWidth=(document.body.offsetWidth-38)/3;
		var goodsImgBox=document.querySelectorAll(".gaia-brandDetail-content .gaia-card-img-box");
		var imgBoxLen=goodsImgBox.length;
		for(var i=0;i<imgBoxLen;i++){
			/*设置img外框大小*/
			goodsImgBox[i].style.width=bodyWidth+'px';
			goodsImgBox[i].style.height=bodyWidth+'px';
			/*垂直居中*/
			var vertical=goodsImgBox[i].getElementsByClassName('vertical')[0];
			vertical.style.height=innerWidth/20*6+'px';
			/*设置img大小*/
			var goodsImg=goodsImgBox[i].getElementsByTagName('img')[0];
			goodsImg.style.width=(bodyWidth-1)+'px';
			goodsImg.style.visibility="visible";
			
			
		}
		
		/*广告*/
		ad.style.height=ad.offsetWidth/20*3+'px';
		ad.style.padding=ad.offsetWidth/200*3+'px';
		/*广告close*/
		var adClose=document.querySelector(".gaia-ad-close-box");
		var adLogo=document.querySelector(".gaia-ad-logo-box");
		var adLogoImg=document.querySelector(".gaia-ad-logo-box img");
		var adDownload=document.querySelector(".gaia-ad-download-box");
		var adText=document.querySelector(".gaia-ad-text");
		
		var adLineheight=ad.offsetHeight-ad.offsetWidth/200*6;
		
		adClose.style.lineHeight=adLineheight+'px';
		adLogo.style.height=adLineheight+'px';
		adLogoImg.style.height=adLineheight+'px';
		adLogoImg.style.padding=adLineheight/10+'px';
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
