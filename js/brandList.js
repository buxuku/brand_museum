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
			bar.style.height = (listHeight- searchHeight - 100)+'px';
			var barItemHeight = ((listHeight- searchHeight - 140) / barItem.length) + 'px';
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
				item.style.height=item.offsetWidth+'px';
			});
			var cardImg=document.querySelectorAll(".gaia-table-view .mui-card-content img");
			cardImg.forEach(function(item){
				item.style.width=cardContent[0].offsetWidth+'px';
				item.style.height=cardContent[0].offsetWidth+'px';
			});
	}
	window.onresize=listHeight;
});