<div class="main">
				<div class="left w630 pr10 pl10">
				<?php
						if(!empty($CATEGORY_2)){
							
								foreach($CATEGORY_2 as $CATE_2){
						?>
					<ul class="bxslider">
					<?php foreach($news_created as $news_view_created){?>
					  <li>
						<a href="<?=LINK_NEWS.$CATE_2->slug.'/'.$news_view_created->slug?>" title="<?=SEO_TITLE($news_view_created->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$news_view_created->image,630,283)?>" alt="" /></a>
						<div class="caption">
							<p class="caption_title">
								<a href="<?=LINK_NEWS.$CATE_2->slug.'/'.$news_view_created->slug?>" title="<?=SEO_TITLE($news_view_created->title)?>"><?=CutText($news_view_created->title,90)?></a>
							</p>
							<p class="caption_content">
								<?=CutText($news_view_created->description,120)?><a href="<?=LINK_NEWS.$CATE_2->slug.'/'.$news_view_created->slug?>" class="xem_them"> Xem thêm</a>
							</p>
						</div>
					  </li>
					 <?php }?>
					</ul>
					<?php
							}
						}
						?>
					<div class="clearAll"></div>
					<div style="height: 14px;"></div>
					
					<div class="left w630">
					<?php
					if(!empty($CATEGORY)){
						$count_category= count($CATEGORY);$count=1;
						foreach($CATEGORY as $CATE){
							if(!empty($CATE->news)){
					?>
						<div class="border pb9"></div>
						<div class="color_cyan left fs14 fwb pb12"><?=$CATE->name?></div>
						<div class="right view_all"><a href="<?=LINK_NEWS.$CATE->slug?>" title="<?=SEO_TITLE($CATE->name)?>">Xem tất cả</a></div>
						<div class="clearAll"></div>
						<div class="left w365">
							<div class="main_news mb6">
								<a href="<?=LINK_NEWS.$CATE->slug.'/'.$CATE->news[0]->slug?>" title="<?=SEO_TITLE($CATE->news[0]->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$CATE->news[0]->image,194,135)?>" alt="" /></a>
							</div>
							<div class="left fwb fs14 pb4 w_100">
								<a href="<?=LINK_NEWS.$CATE->slug.'/'.$CATE->news[0]->slug?>" title="<?=SEO_TITLE($CATE->news[0]->title)?>" class="color_333"><?=CutText($CATE->news[0]->title,90)?></a>
							</div>
							<div class="left fs11 color_90">
								<?=datepost($CATE->news[0]->datepost)?> | 12 bình luận
							</div>
						</div>
						<?php
							for($i=1;$i<=3;$i++){
								if(!empty($CATE->news[$i])){
						?>
						<div class="right w265">
							<div class="news_img left mb10">
								<a href="<?=LINK_NEWS.$CATE->slug.'/'.$CATE->news[$i]->slug?>" title="<?=SEO_TITLE($CATE->news[$i]->title)?>"><img src="<?=PATH_URL?>/static/images/icon/other_news.png" height="62" width="62" alt="" /></a>
							</div>
							<div class="right w196">
								<div class="">
									<a class="fwb color_333 pb4 dib" href="<?=LINK_NEWS.$CATE->slug.'/'.$CATE->news[$i]->slug?>"><?=CutText($CATE->news[$i]->title,95)?></a>
								</div>
								<div class="fs11 color_90">
									<?=datepost($CATE->news[$i]->datepost)?> | 24 bình luận
								</div>
							</div>
							<div class="clearAll"></div>				
						</div>
						<?php
								}
							}
						?>
						<div class="clearAll"></div>
						<div style="height: 27px;"></div>
						
						<?php
						}
							$count++;
							}
						}
						?>
					</div>
						<div class="clearAll"></div>
						<?php
						if(!empty($CATEGORY_2)){
								foreach($CATEGORY_2 as $CATE_2){
									if(!empty($CATE_2)){
						?>
						<div class="border pb9"></div>
						<div class="color_cyan left fs14 fwb pb12"><?=$CATE_2->name?></div>
						<div class="right view_all"><a href="<?=LINK_NEWS.$CATE_2->slug?>" title="<?=SEO_TITLE($CATE_2->name)?>">Xem tất cả</a></div>
						<div class="clearAll"></div>
						<?php foreach($category_new_2 as $new_2){?>
						<div class="girls left">
							<a href="<?=LINK_NEWS.$CATE_2->slug.'/'.$new_2->slug?>" title="<?=SEO_TITLE($new_2->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$new_2->image,203,136)?>" alt="" /></a>
							<a href="<?=LINK_NEWS.$CATE_2->slug.'/'.$new_2->slug?>" title="<?=SEO_TITLE($new_2->title)?>" class="fwb color_333 w183 pt13 pb4 dib">
								<?=CutText($new_2->title,90)?>
							</a>
							<p class="fs11 color_90"><?=datepost($new_2->datepost)?> | 12 bình luận</p>
						</div>
						<?php }?>
						<div class="clearAll"></div>
						<div style="height: 27px;"></div>
						<?php
								}
							}
						}
						?>
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