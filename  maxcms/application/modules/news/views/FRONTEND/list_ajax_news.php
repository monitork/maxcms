<script type="text/javascript">
$(document).ready(function(){
	$('#submit').bind('click',function(){
	var view_page_first = $("#view_page_first").val();
	var view_page_last = $("#view_page_last").val();

	$.post(
			root+'news/list_ajax_category/'+'<?=$CATEGORY->slug?>',
			{
				view_page_first: view_page_first,
				view_page_last: view_page_last,
			},
			function(data){
				$('.wrap_news').html(data);	
			}
		);
	});
});
</script>
	<?php
		$LINK= ($CATEGORY->type==1)?LINK_NEWS:LINK_NEWS;
	?>
				
				<?php
					//for($i=1;$i<=$pageSize;$i++){
						if(!empty($RESULT_LIST)){
						$total_new = count($RESULT_LIST);
						foreach($RESULT_LIST as $list_new){
				?>
				<div class="wrap_news">
					<div class="clearAll"></div>
					<div class="left news_detail_img">
						<a href="<?=$LINK.$CATEGORY->slug.'/'.$list_new->slug?>" title="<?=SEO_TITLE($list_new->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$list_new->image,258,145)?>" alt="<?=SEO_TITLE($list_new->title)?>" /></a>
					</div>
					<div class="right w353">
						<div class="fwb fs14"><a href="<?=$LINK.$CATEGORY->slug.'/'.$list_new->slug?>" title="<?=SEO_TITLE($list_new->title)?>" class="color_333"><?=CutText($list_new->title,90)?></a></div>
						<div class="fs11 color_90 pt5"><?=datepost($list_new->datepost)?> | <span class="viewed mr10">2000</span><span class="comments">2000</span></div>
						<div class="color_333 pt9"><?=CutText($list_new->description,200)?></div>
						<div class="view_all mt7"><a href="<?=$LINK.$CATEGORY->slug?>">Xem tất cả</a></div>
					</div>
				</div>
					<?php
					}
				}
			?>
				
				