<span class="newest dib mt30 color_fff">
				Mới nhất
			</span>
			
			<div class="newest_content">
			<?php
				if(!empty($news_created_update)){
				foreach($news_created_update as $VIEW){
			?>
				<div class="left newest_item">
					<div class="news_thumb left pb6">
						<a href="<?=LINK_NEWS.$VIEW->c_slug.'/'.$VIEW->slug?>" title="<?=SEO_TITLE($VIEW->title)?>"><img src="<?=img(DIR_NEWS_IMAGES.$VIEW->image,25,25)?>" alt="" /></a>
					</div>
					<div class="right w263 color_333 pb6">
						<a href="<?=LINK_NEWS.$VIEW->c_slug.'/'.$VIEW->slug?>" title="<?=SEO_TITLE($VIEW->title)?>" class="color_333"><?=CutText($VIEW->title,200)?></a>
					</div>
					<div class="fs11 color_90 left pl12">
						<?=datepost($VIEW->datepost)?>
					</div>
					<div class="comments fs11 color_90 right">
						3000
					</div>
					<div class="viewed fs11 color_90 right mr16">
						3000
					</div>
				</div>
			<?php
						}
					}
			?>
				<div class="clearAll"></div>
			</div>
