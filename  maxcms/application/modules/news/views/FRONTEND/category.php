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
			$('#left_ajax').hide();
			$('.loading').show();
			 
				setTimeout(function(){
					 $('.main').html(data);
				},800);				
				
			}
		);
	});
});
</script>
	<?php
		$LINK= ($CATEGORY->type==1)?LINK_NEWS:LINK_NEWS;
	?>
<div class="main">
			<div class="loading" style="display:none;"><img src="<?=PATH_URL?>/static/images/loading.gif" /></div>
			<div class="left w630 pr10 pl10" id="left_ajax">
				<div class="color_cyan left fs14 fwb pb12 pt30"><?=$CATEGORY->name?></div>
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
				
				<div class="clearAll"></div>
				<!--<div class="view_more mb45"><a href="" class="fwb color_fff">Xem thêm</a></div>-->
				<?php 
				if(!empty($TOTAL_LIST)){
				if(count($TOTAL_LIST) == count($RESULT_LIST)){?>
				
				<?php }else{?>
				<input type="hidden" id="view_page_first" value="<?=$total_new?>" />
				<input type="hidden" id="view_page_last" value="3" />
				<input type="submit" class="view_more mb45" id="submit" value="Xem thêm" />
				<?php }}?>
			</div>
			<div class="right w330 pb30">
			
					<?=Modules::run('news/list_new_update');?>
					
					<div class="top_rating">
						<p class="fs14 color_cyan fwb">Top rating</p>
						<div class="wrap_rank">
							<a href="" class="top1_img">
								<img src="<?=PATH_URL?>/static/images/icon/top_game.png" alt="" />
								<img src="<?=PATH_URL?>/static/images/icon/top1.png" alt="" class="top1_icon" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
								<img src="<?=PATH_URL?>/static/images/icon/star_icon.png" alt="" /> <span class="fwb color_333">9</span>
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank top3 left">
								2
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank top3 left">
								3
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								4
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								5
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								6
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								7
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								8
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								9
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
						<div class="wrap_rank">
							<span class="rank left">
								10
							</span>
							<a href="" class="top2_img">
								<img src="<?=PATH_URL?>/static/images/icon/game_icon.png" alt="" />
							</a>
							<div class="left fwb pl8">
								<a class="color_333" href="">Bắn Cá</a><br />
							</div>
							<div class="right mt5"><a href="" class="vote dib"></a></div>
						</div>
						<div class="clearAll"></div>
					</div>
					<div class="ads">
						<img src="<?=PATH_URL?>/static/images/icon/ads.jpg" alt="" />
					</div>
					<div class="forum">
						<div class="color_cyan left fs14 fwb pb12">Game</div>
						<div class="right view_all"><a href="">Xem tất cả</a></div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
						<div class="w183 left pb9">
							<a class="color_5d list_item" href="">Gunz Thần Thoại - VERSION 1.0 CỰC HOT</a>
						</div>
						<div class="color_5d right">27/02/2013</div>
						<div class="clearAll"></div>
					</div>
					<div class="ads">
						<img src="<?=PATH_URL?>/static/images/icon/ads2.jpg" alt="" />
					</div>
				</div>
				<div class="clearAll"></div>
			</div>