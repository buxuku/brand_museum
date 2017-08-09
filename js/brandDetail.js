mui.init();
mui.ready(function() {
	var ad=document.querySelector(".ad");
	var adClose=document.querySelector(".gaia-ad-close");
	/*先设定初值宽高*/
	setSize();
	/*在设置位置初始位置：默认影藏*/
	adDown();
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
			goodsImgBox[i].style.width=bodyWidth+'px';
			goodsImgBox[i].style.height=bodyWidth+'px';
			
			var goodsImg=goodsImgBox[i].getElementsByTagName('img')[0];
			var img = new Image();
			// 改变图片的src
			img.src = goodsImg.getAttribute('src');
			img.style.width=bodyWidth+'px';
			var check = function(i){
				if(img.width!=0){
					img.style.marginTop=(-(bodyWidth/img.width*img.height-bodyWidth)/2)+'px';
					img.style.visibility="visible";
					goodsImgBox[i].innerHTML='';
					goodsImgBox[i].appendChild(img);
					console.log('正在加载'+img.src+''+img.offsetHeight);
				}
			};
			var set = setInterval(check(i),40);
			// 加载完成获取宽高
			function onload(i){
				if(img.offsetHeight==0){
					img.src='img/default_img.jpg';
				}
				img.style.marginTop=(-(bodyWidth/img.width*img.height-bodyWidth)/2)+'px';
				img.style.visibility="visible";
				goodsImgBox[i].innerHTML='';
				goodsImgBox[i].appendChild(img);
				// 取消定时获取宽高
				clearInterval(set);
				console.log('加载成功'+img.src+img.offsetHeight);
			};
			img.onload=onload(i);
			
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
