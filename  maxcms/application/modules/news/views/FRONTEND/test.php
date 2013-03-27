<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "c58eb8c9-2fa7-4d25-9618-ba137c0ea250"});</script>
<div class="breadcrumbs mt10">
	<a href="<?=PATH_URL?>" title="<?=SEO_TITLE('Trang chủ')?>">Trang chủ</a><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" /><?php if($NEWS->type==1){?><a href="<?=LINK_NEWS?>" title="<?=SEO_TITLE('Tin tức')?>">Tin tức</a><?php }else{?><a href="<?=LINK_EXPERIENCE?>" title="<?=SEO_TITLE('Kinh nghiệm')?>">Kinh nghiệm</a><?php }?>
	<img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" /><a href="<?=($NEWS->type==1)?LINK_NEWS.$NEWS->c_slug:LINK_EXPERIENCE.$NEWS->c_slug?>" title="<?=SEO_TITLE($NEWS->name)?>"><?=$NEWS->name?></a><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" /><span><?=$NEWS->title?></span>
	<div class="clearAll"></div>
</div>
<div class="kinhnghiem">
	<div class="content_kinhnghiem content_new">
		<div class="left content_kinhnghiem_left">
			<div class="date"><?=datepostvn($NEWS->datepost)?></div>
			<div class="block_share">
				<div class="tool_share"><a href="javascript: void(0);" onclick="window.print()" class="print"><img src="<?=PATH_URL?>static/images/print_icon.png" alt="" /></a></div>
				<span class='st_googleplus_hcount' displayText="&nbsp;"></span>
				<span class='st_facebook_hcount' displayText="Facebook"></span>
				<span class='st_fblike_hcount' displayText="Like"></span>
				
			</div>
			<div class="clearAll"></div>
			<div class="news_details">
				<div class="details_title"><?=$NEWS->title?></div>
				<br />
				<div class="details_des"><?=$NEWS->description?></div>
				<?php
					if(!empty($NEWS->video)){
				?>
					<div class="youtube-player" style="text-align:center;">
					<iframe width="560" height="315" src="http://www.youtube.com/embed/<?=$NEWS->video?>"></iframe>	
					</div>
				<?php
					}
				?>				
				<div class="content_news"><?=EDITOR($NEWS->content)?></div>
			</div>
			<?php
				if(!empty($NEWS->tags)){
			?>
			<div class="tags">Tags: 
				<?php
					$count=1;$count_tags= count($NEWS->tags);
					foreach($NEWS->tags as $tags){
				?>
				<a href="<?=($NEWS->type==1)?LINK_NEWS_TAGS.$tags->slug:LINK_EXPERIENCE_TAGS.$tags->slug?>" class="tagname"><?=$tags->tags?></a>
				<?php
					if($count!=$count_tags) echo ',';
					$count++;
					}
				?>
			</div>
			<?
				}
			?>
		</div>
		<div class="right content_kinhnghiem_right">
			<?=Modules::run('news/other', $NEWS->id)?>
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