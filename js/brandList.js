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
			var barItemLen=barItem.length;
			
			var withoutSearchHeight = (listHeight- searchHeight) + 'px';
			inner.style.height = withoutSearchHeight;
			var barItemHeight;
			var responseBarItemHeight=(listHeight- searchHeight - 140)/26;
			if(responseBarItemHeight<20){
				barItemHeightNum=20;
				barItemHeight=barItemHeightNum+'px';
				bar.style.height = (barItemHeightNum*barItem.length+40)+'px';
			}else{
				barItemHeight = responseBarItemHeight + 'px';
				bar.style.height = (responseBarItemHeight*barItem.length+40)+'px';
			}

			for(var i=0; i<barItemLen;i++){
				barItem[i].style.height = barItemHeight;
				barItem[i].style.lineHeight = barItemHeight;
			}
			
			var barWidth=(bar.offsetWidth+2);
			var cardItem=document.querySelectorAll(".gaia-table-view .mui-indexed-list-item");
			var cardItemLen=cardItem.length;
			var innerWidth=document.body.offsetWidth-barWidth;
			for(var i=0;i<cardItemLen;i++){
				cardItem[i].style.width=innerWidth/3+'px';
				cardItem[i].style.padding=innerWidth/60+'px';
				
				/*设置img外框大小*/
				var cardContent=cardItem[i].getElementsByClassName('mui-card-content')[0];
				cardContent.style.width=innerWidth/20*6+'px';
				cardContent.style.height=innerWidth/20*6+'px';
				/*垂直居中*/
				var vertical=cardContent.getElementsByClassName('vertical')[0];
				vertical.style.height=innerWidth/20*6+'px';
				/*设置img大小*/
				var cardImg=cardContent.getElementsByTagName('img')[0];
				cardImg.style.width=(innerWidth/20*6-0.1)+'px';
				cardImg.style.visibility="visible";
				
			}
	}
	window.onresize=listHeight;
});