<div class="breadcrumbs mt10">
	<a href="<?=PATH_URL?>" title="<?=SEO_TITLE('Trang chủ')?>">Trang chủ</a><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" /> <span>Kinh nghiệm</span>
	<div class="clearAll"></div>
</div>
<div class="kinhnghiem">
	<!--slider kinh nghiem-->
	<div id="jslidernews2" class="lof-slidecontent mt12">
		<div class="preload"><div></div></div>
		<!-- MAIN CONTENT --> 
		<div class="border_top_left"></div>
		<div class="main-slider-content" style="width:648px; height:300px;">
			<?php
				if(!empty($NEW)){
			?>
			<ul class="sliders-wrap-inner">
				<?php
					foreach($NEW as $N){
				?>
				<li>
					<img src="<?=img(DIR_NEWS_IMAGES.$N->image,648,300)?>" alt='<?=$N->title?>' title="Newsflash 2" >           
					<div class="slider-description">
						<div class="mt6"><a href="<?=LINK_EXPERIENCE.$N->c_slug.'/'.$N->slug?>" title="<?=SEO_TITLE($N->title)?>" class="title"><?=CutText($N->title,50)?></a></div>
						<div class="mt6"><?=CutText($N->description,205)?></div>
					</div>
				</li> 
				<?php
					}
				?>
			</ul>  
			<?php
				}
			?>
		</div>
	   <!-- END MAIN CONTENT --> 
	   <!-- NAVIGATOR -->
		<div class="navigator-content">
			<div class="navigator-wrapper">
				<?php
					if(!empty($NEW)){
				?>			
				<ul class="navigator-wrap-inner">
					<?php
						foreach($NEW as $N){
					?>				
					<li>
						<div>
							<table style="border-spacing:0;border-collapse:collapse;border: none;">
								<tr>
									<td class="img"><img src="<?=img(DIR_NEWS_IMAGES.$N->image,27,27)?>" alt='<?=$N->title?>' /></td>
									<td><?=CutText($N->title,50)?></td>
								</tr>
							</table>
						</div>    
					</li>
					<?php
						}
					?>
				</ul>
				<?php
					}
				?>
			</div>
		</div>
	</div>
	<!--End slider kinh nghiem-->
	<div class="content_kinhnghiem">
		<div class="left content_kinhnghiem_left">
			<?php
			
				if(!empty($CATEGORY)){
					foreach($CATEGORY as $C){
						if(!empty($C->news)){	
			?>
			<div class="item">
				<div class="title">
					<div class="left text fwb"><a href="<?=LINK_EXPERIENCE.$C->slug?>" title="<?=SEO_TITLE($C->name)?>"><?=$C->name?></a></div>
					<div class="right f11 mt10"><a href="<?=LINK_EXPERIENCE.$C->slug?>" title="<?=SEO_TITLE($C->name)?>">Xem tất cả <img src="<?=PATH_URL?>static/images/icon/icon_muiten.png" alt="" class="png" /></a></div>
					<div class="clearAll"></div>
				</div>
				<div class="content_item">
					<div class="title_content_list">
					<?php if($C->slug == 'kien-thuc'){?>
						<div class="left img"><img src="<?=PATH_URL?>static/images/icon/icon_kienthuc.png" alt="" class="" /></div>
					<?php }else{?>
						<div class="left img"><img src="<?=PATH_URL?>static/images/icon/icon_kinhnghiem.png" alt="" class="" /></div>
					<?php }?>
						<div class="left text"><a href="<?=LINK_EXPERIENCE.$C->news[0]->c_slug.'/'.$C->news[0]->slug?>" title='<?=SEO_TITLE($C->news[0]->title)?>'><?=$C->news[0]->title?></a></div>
						<div class="clearAll"></div>
						<div class="bg_title_kinhnghiem bg_left_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_right_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_bottom_right_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_bottom_left_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_moc_title_kinhnghiem"></div>
					</div>
					<div class="descript mt8">
						<div><?=$C->news[0]->description?></div>
						<div class="mt4"><a href="<?=LINK_EXPERIENCE.$C->news[0]->c_slug.'/'.$C->news[0]->slug?>" title="<?=SEO_TITLE($C->news[0]->title)?>" class="btn_view_more">Xem chi tiết</a></div>
						<?php
							if($C->id==52){
						?>
						<div class="color_145ca5 fwb mt6">Các kiến thức khác</div>
						<?php
							}else{
						?>
						<div class="color_145ca5 fwb mt6">Các chia sẽ khác</div>
						<?php
							}
						?>
						<?php
							for($i=1;$i<=3;$i++){
								if(!empty($C->news[$i])){
						?>
						<div>
							<img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" class="png" />&nbsp; 
							<a href="<?=LINK_EXPERIENCE.$C->news[$i]->c_slug.'/'.$C->news[$i]->slug?>" title="<?=SEO_TITLE($C->news[$i]->title)?>" class="color_333333" ><?=CutText($C->news[$i]->title,140)?></a>
						</div>
						<?php
								}
							}
						?>
					</div>
				</div>
			</div>
			<div class="border_dashed mt11"></div>	
			<?php
						}
					}
				}
			?>
			<div class="item">
				<div class="title">
					<div class="left text fwb"><a  href="<?= PATH_URL ?>kinh-nghiem/hoi-dap" title="<?=SEO_TITLE("Hỏi đáp");?>">HỎI ĐÁP</a></div>
					<div class="right f11 mt10"><a href="<?= PATH_URL ?>kinh-nghiem/hoi-dap" title="<?=SEO_TITLE("Hỏi đáp");?>">Xem tất cả <img src="<?=PATH_URL?>static/images/icon/icon_muiten.png" alt="" class="png" /></a></div>
					<div class="clearAll"></div>
				</div>
				<div class="content_item">
                    <?php 
        				if(!empty($FAQS_TOP1))
            				{
            					foreach($FAQS_TOP1 AS $top)
            					{
            					   $answer = $this->model->answer_list_top1($top->id);
				    ?>
					<div class="title_content_list">
						<div class="left img"><img src="<?=PATH_URL?>static/images/icon/icon_hoidap.png" alt="" class="" /></div>
						<div class="left text"><a href="<?=PATH_URL.'kinh-nghiem/hoi-dap/'.$top->slug?>" title="<?=SEO_TITLE($top->title)?>"><?= $top->title ?></a></div>
						<div class="clearAll"></div>
						<div class="bg_title_kinhnghiem bg_left_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_right_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_bottom_right_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_bottom_left_title_kinhnghiem"></div>
						<div class="bg_title_kinhnghiem bg_moc_title_kinhnghiem"></div>
					</div>
					<div class="descript mt8">
						<div> <?php if(!empty($answer)){echo Cuttext($answer[0]->content,250);}?></div>
                        <div class="mt4"><a href="<?=PATH_URL.'kinh-nghiem/hoi-dap/'.$top->slug?>" title="<?=SEO_TITLE($top->title)?>" class="btn_view_more">Xem chi tiết</a></div>
					</div>
                    <?php }}?>	
                        <div class="color_145ca5 fwb mt6">Các câu hỏi khác</div>
					   <?php 
            				if(!empty($FAQS))
            				{
            					foreach($FAQS AS $faqs)
            					{
        				?>
							<div class="mt5"><a class="color_333333" href="<?= PATH_URL .'kinh-nghiem/hoi-dap/'.$faqs->slug?>" title="<?=SEO_TITLE($faqs->title)?>"><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" class="png" />&nbsp;<?= $faqs->title ?></a></div>
                        <?php 
                        
                            }} 
                        
                        ?>   
				</div>
			</div>
            
			<div class="border_dashed mt11"></div>
			<!--
			<div class="item">
				<div class="title">
					<div class="left text fwb">ĐÁNH GIÁ</div>
					<div class="right f11 mt10"><a href="#">Xem tất cả <img src="<?=PATH_URL?>static/images/icon/icon_muiten.png" alt="" class="png" /></a></div>
					<div class="clearAll"></div>
				</div>
				<div class="content_item">
					<div><a href="#" class="color_145ca5 fwb">Buổi offline giao lưu Cộng tác viên đầu tiên của Autobay.vn</a></div>
					<div class="descript mt8">
						<div>
							<div class="img left"><a href="#"><img src="<?=PATH_URL?>static/images/img_danhgia.jpg" alt="" /></a></div>
							<div class="text left">
								<div>Ngày 13/10 vừa qua, buổi offline Giao lưu Công Tác Viên do Công ty TNHH Vịnh Ô tô tổ chức đã diễn ra và thành công tốt đẹp.</div>
								<div class="mt4"><a href="#" class="btn_view_more">Xem chi tiết</a></div>
							</div>
							<div class="clearAll"></div>
						</div>
						<div class="color_145ca5 fwb mt9">Các câu hỏi khác:</div>
						<div><a class="color_333333" href="#"><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" class="png" />&nbsp;Maria Đinh Phương Ánh và Nhà hàng Beirut</a></div>
						<div><a class="color_333333" href="#"><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" class="png" />&nbsp;Ana Mandara Hue Resort & Spa</a></div>
						<div><a class="color_333333" href="#"><img src="<?=PATH_URL?>static/images/icon/img_muiten_1.png" alt="" class="png" />&nbsp;Autobay dành tặng các bạn 10 vé tham gia đêm Gala Dinner</a></div>
					</div>
				</div>
			</div>
			-->
			<div class="border_dashed mt11"></div>
			<div class="item">
				<div class="title">
					<div class="left text fwb"><a href="<?=PATH_URL?>kinh-nghiem/thu-vien" title="<?=SEO_TITLE("Thư Viện")?>">THƯ VIỆN</a></div>
					<div class="right f11 mt10"><a href="<?=PATH_URL?>kinh-nghiem/thu-vien" title="<?=SEO_TITLE("Thư Viện")?>">Xem tất cả <img src="<?=PATH_URL?>static/images/icon/icon_muiten.png" alt="" class="png" /></a></div>
					<div class="clearAll"></div>
				</div>
				<div class="content_item content_thuvien">
                  <?php 
        				if(!empty($LIBRARY_TOP1))
            				{
            					foreach($LIBRARY_TOP1 AS $top)
            					{
            						$imgLi = '';
            						if(!empty($top)){
            							if( $top->type == '0' ){
            								$imgLi = PATH_URL . 'static/images/tim/timthumb.php?src=' . PATH_URL . 'static/uploads/library/' . $top->link . '&amp;w=100&amp;h=75;zc=0&amp;q=100';
            							}else{
            								$imgLi = 'http://img.youtube.com/vi/'.$top->link.'/1.jpg';
            							}
            						}
                                   
				    ?>
					<div class="descript">
						<div>
                            <div class="image left">
                                <a href="<?=PATH_URL?>kinh-nghiem/thu-vien/#<?=($top->type == '0' ? 'hinh-' : 'video-').$top->id?>" title="<?=SEO_TITLE("Thư Viện")?>" ><img width="100" height="75" src="<?= $imgLi ?>" alt="" /></a>
                            </div>
							<div class="text left">
								<div><?=CutText($top->title,40);?></div>
								<div class="mt4"><a href="<?=PATH_URL?>kinh-nghiem/thu-vien/#<?=($top->type == '1' ? 'hinh-' : 'video-').$top->id?>" class="btn_view_more">Xem chi tiết</a></div>
							</div>
							<div class="clearAll"></div>
						</div>
     	            </div>
                    <?php }} ?>
				</div>
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
		</div>
		<div class="clearAll"></div>
	</div>
</div>