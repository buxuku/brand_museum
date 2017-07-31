mui.init();
mui.ready(function() {
	//create
	window.indexedList = new mui.IndexedList(list);
	
	listHeight();
	function listHeight() {
			//var header = document.querySelector('header.mui-bar');/*js查找DOM又一方法*/
			var list = document.getElementById('list');
			//calc hieght
			list.style.height = (document.body.offsetHeight /*- header.offsetHeight*/) + 'px';
			
			/*设置整体*/
			var listHeight=list.offsetHeight;
			var searchHeight=document.querySelector('.gaia-indexed-list-search').offsetHeight;
			var inner=document.querySelector('.mui-indexed-list-inner');
			var bar=document.querySelector('.gaia-indexed-list-bar');
			var barItem=document.querySelectorAll('.gaia-indexed-list-bar a');
			
			var withoutSearchHeight = (listHeight- searchHeight) + 'px';
			inner.style.height = withoutSearchHeight;
			var barItemHeight = ((listHeight- searchHeight - 140)/26) + 'px';
			bar.style.height = ((listHeight- searchHeight - 140)/26*barItem.length+40)+'px';
			/*console.log(bar);*/
			barItem.forEach(function(item) {
				item.style.height = barItemHeight;
				item.style.lineHeight = barItemHeight;
			});	
			
			var barWidth=(bar.offsetWidth+2);
			var cardItem=document.querySelectorAll(".gaia-table-view .mui-indexed-list-item");
			/*console.log((document.body.offsetWidth-barWidth)/3);*/
			cardItem.forEach(function(item){
				item.style.width=(document.body.offsetWidth-barWidth)/3+'px';
				item.style.padding=(document.body.offsetWidth-barWidth)/60+'px';
			})
			
			/*设置img外框大小和img大小*/
			var cardContent=document.querySelectorAll(".gaia-table-view .mui-card-content");
			cardContent.forEach(function(item){
				item.style.width=(document.body.offsetWidth-barWidth)/20*6+'px';
				item.style.height=item.offsetWidth+'px';
			});
			var cardImg=document.querySelectorAll(".gaia-table-view .mui-card-content img");
			cardImg.forEach(function(item){
				item.style.width=cardContent[0].offsetWidth+'px';
				// 创建对象
				var img = new Image();
				// 改变图片的src
				img.src = item.getAttribute('src');
				// 定时执行获取宽高
				var check = function(){
					if(img.width!=0){
						item.style.marginTop=(-(item.offsetWidth/img.width*img.height-item.offsetWidth)/2)+'px';
						item.style.visibility="visible";
					}
				};
				var set = setInterval(check,40);
				// 加载完成获取宽高
				img.onload = function(){
				    item.style.marginTop=(-(item.offsetWidth/img.width*img.height-item.offsetWidth)/2)+'px';
				    item.style.visibility="visible";
				    // 取消定时获取宽高
				    clearInterval(set);
				};
			});
	}
	window.onresize=listHeight;
});