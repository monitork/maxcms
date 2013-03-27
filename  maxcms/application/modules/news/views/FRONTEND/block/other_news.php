<?php
	if(!empty($OTHER_NEWS)){
?>
<div class="title news">
	<div class="left text fwb upc">Các tin khác</div>
</div>	
<div class="other_news">
	<ul>
		<?php
			foreach($OTHER_NEWS as $N){
		?>
		<li>
			<a class="a_list_news" href="<?=($N->type==1)?LINK_NEWS.$N->c_slug.'/'.$N->slug:LINK_EXPERIENCE.$N->c_slug.'/'.$N->slug?>" title="<?=SEO_TITLE($N->title)?>"><span class="bg"></span><?=CutText($N->title,50)?></a>
		</li>
		<?php
			}
		?>
	</ul>
</div>
<?php
	}
?>