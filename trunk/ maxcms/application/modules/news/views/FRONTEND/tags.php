<div class="breadcrumbs mt10">
	<a href="<?=PATH_URL?>" title="<?=SEO_TITLE('Trang chủ')?>">Trang chủ</a><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" />
	<?php if($TYPE==1){?><a href="<?=LINK_NEWS?>" title="<?=SEO_TITLE('Tin tức')?>">Tin tức</a><?php }else{?><a href="<?=LINK_EXPERIENCE?>" title="<?=SEO_TITLE('Kinh nghiệm')?>">Kinh nghiệm</a><?php }?>
	<img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" />	
	<span>Tags: <?=$TAGS->tags?></span>
	<div class="clearAll"></div>
	<?php
		$LINK= ($TYPE==1)?LINK_NEWS:LINK_EXPERIENCE;
	?>	
</div>
<div class="kinhnghiem">
	<div class="content_kinhnghiem content_new">
		<div class="left content_kinhnghiem_left">
			<div class="title news">
				<div class="left text fwb upc">Tags: <?=$TAGS->tags?></div>
			</div>
			<div class="news_order">
				<div class="label">Sắp xếp theo</div>
				<div class="wrap_select">
					<form action="" method="get" enctype="multipart/form-data">
						<select name="o" class="order-news order_select">
							<option value="moi-nhat" <?=($this->input->get('o')=='moi-nhat')?'selected':''?>>Bài mới nhất</option>
							<option value="cu-nhat" <?=($this->input->get('o')=='cu-nhat')?'selected':''?>>Bài cũ nhất</option>
						</select>
					</form>
					<span class="span_select"></span>
				</div>
				<?=$PAGINATION?>
			</div>
			
			<div class="oto_show">
				<div class="pic_view">
					<a href="<?=$LINK.$RESULT_LIST[0]->c_slug.'/'.$RESULT_LIST[0]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[0]->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$RESULT_LIST[0]->image,250,140)?>" alt="<?=SEO_TITLE($RESULT_LIST[0]->title)?>" /></a>
				</div>
				<div class="pic_text">
					<div><a href="<?=$LINK.$RESULT_LIST[0]->c_slug.'/'.$RESULT_LIST[0]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[0]->title)?>" class="color_07549c upc fwb"><?=CutText($RESULT_LIST[0]->title,60)?></a></div>
					<div class="color_555555 f11"><?=datepost($RESULT_LIST[0]->datepost)?></div>
					<div class="color_333333 mt6"><?=CutText($RESULT_LIST[0]->description,410)?></div>
					<div class="mt7"><a href="<?=$LINK.$RESULT_LIST[0]->c_slug.'/'.$RESULT_LIST[0]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[0]->title)?>" class="btn_view_more">Xem chi tiết</a></div>

				</div>
				<div class="clearAll"></div>
			</div>
			
			<div class="border_dashed mt20"></div>
			<?php
				for($i=1;$i<=$pageSize;$i++){
					if(!empty($RESULT_LIST[$i])){
			?>
			<div class="item">
				<div class="content_item">
					<div><a href="<?=$LINK.$RESULT_LIST[$i]->c_slug.'/'.$RESULT_LIST[$i]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[$i]->title)?>" class="color_145ca5 fwb"><?=CutText($RESULT_LIST[$i]->title,90)?></a> <span class="datepost"> | <?=datepost($RESULT_LIST[$i]->datepost)?></span></div>
					<div class="descript mt8">
						<div>
							<div class="img left">
								<a href="<?=$LINK.$RESULT_LIST[$i]->c_slug.'/'.$RESULT_LIST[$i]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[$i]->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$RESULT_LIST[$i]->image,113,75)?>" alt="<?=SEO_TITLE($RESULT_LIST[$i]->title)?>" /></a>
							</div>
							<div class="text left">
								<div><?=$RESULT_LIST[$i]->description,300?></div>
								<div class="mt4"><a href="<?=$LINK.$RESULT_LIST[0]->c_slug.'/'.$RESULT_LIST[$i]->slug?>" title="<?=SEO_TITLE($RESULT_LIST[$i]->title)?>" class="btn_view_more">Xem chi tiết</a></div>
							</div>
							<div class="clearAll"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="border_dashed mt11"></div>
			<?php
					}
				}
			?>
			<div class="news_order pt0">
				<div class="label">Sắp xếp theo</div>
				<div class="wrap_select">
					<form action="" method="get" enctype="multipart/form-data">
						<select name="o" class="order-news order_select">
							<option value="moi-nhat" <?=($this->input->get('o')=='moi-nhat')?'selected':''?>>Bài mới nhất</option>
							<option value="cu-nhat" <?=($this->input->get('o')=='cu-nhat')?'selected':''?>>Bài cũ nhất</option>
						</select>
					</form>
					<span class="span_select"></span>
				</div>
				<?=$PAGINATION?>
			</div>
		</div>
		<div class="right content_kinhnghiem_right">
			<div>
				<?=(isset($banner[0])) ? $banner[0] : ''?>
				<div class="clearAll"></div>
			</div>
			<div class="mt10">
				<?=(isset($banner[1])) ? $banner[1] : ''?>
				<div class="clearAll"></div>
			</div>
			<div class="mt10">
				<?=(isset($banner[2])) ? $banner[2] : ''?>
				<div class="clearAll"></div>
			</div>
			<div class="clearAll"></div>
		</div>
		<div class="clearAll"></div>
	</div>
</div>