<?php
	$menu_active = $this->uri->segment(1);
?>
	<div class="header_top">
				<div class="header_content">
					<div class="left"><img src="<?=PATH_URL?>/static/images/icon/logo_maxgame.png" alt="" /></div>
					<div class="left"><a href="mailto:trogiup@maxgame.vn" class="email pl26 color_444 fs11">Trogiup@maxgame.vn</a></div>
					<div class="left"><span class="phone pl15 ml23 color_444 fs11">083 7696 696 - 083 7696 696</span></div>
					<div class="right fs11 fwb color_blue">
						<a class="color_blue" href="">Đăng nhập</a><span>&nbsp;|&nbsp;</span><a class="color_blue" href="">Đăng ký</a>
						<a href="" class="naptien color_nau pl7">Nạp MAX Coin</a>
					</div>
					<div class="clearAll"></div>
				</div>
			</div>
			<div class="header_menu">
				<div class="wrap_menu">
					<ul>
						<li>
							<a href="javascript:void(0);">WEB GAME<img class="arrow_down" src="<?=PATH_URL?>/static/images/icon/menu_arrow.png" alt="" /></a>
					
						</li>
						<li>
							<a href="javascript:void(0);">MINI GAME<img class="arrow_down" src="<?=PATH_URL?>/static/images/icon/menu_arrow.png" alt="" /></a>
							
						</li>
						<li>
							<a class="no_bg" href="<?=PATH_URL?>forum">DIỄN ĐÀN<img class="arrow_down" src="<?=PATH_URL?>/static/images/icon/menu_arrow.png" alt="" /></a>
						</li>
						<li>
							<a class="active" href="javascript: void(0);">TIN TỨC<img class="arrow_down" src="<?=PATH_URL?>/static/images/icon/menu_arrow.png" alt="" /></a>
							<div class="submenu">
								<ul>
									<li><a href="<?=PATH_URL?>tin-tuc">Tất cả tin tức</a></li>
									<?php if(!empty($menu_top)){
												foreach($menu_top as $top_new){
									?>
									<li><a href="<?=PATH_URL?>tin-tuc/<?=$top_new->slug?>"><?=$top_new->name?></a></li>
									<?php } }?>
								</ul>
								<div class="clearAll"></div>
							</div>
						</li>
					</ul>
					<div class="clearAll"></div>
				</div>
			</div>