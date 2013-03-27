<div class="main">
			<div class="left w630 pr10 pl10">
				<div class="color_cyan left fs14 fwb pb12 pt30"><?=$NEWS->name?></div>
				<div class="wrap_details left">
					<div class="fwb fs14 color_333"><?=$NEWS->description?></div>
					<div class="fs11 color_90 pt5 pb12"><?=datepostvn($NEWS->datepost)?></div>
					<div class="border"></div>
					<div class="news_details_content">
						<?=$NEWS->content?>
					</div>
					<div class="share pt22 left">
						<a href="" class="share_btn dib">Chia sẻ</a>
					</div>
					<div class="right color_333 pt28">
						Đánh giá <div class="basic" data-average="12" data-id="1"></div><span class="color_blue fwb">3.5</span>
					</div>
					<div class="clearAll"></div>
					<div class="border mt15"></div>
					<div class="binhluan">
						<div class="fs14 color_cyan fwb">Bình luận (2)</div>
						<div class="textbox">
							<img class="avatar" src="<?=PATH_URL?>/static/images/icon/avatar.png" height="44" width="44" alt="" />
							<input type="text" class="binhluan_text" disabled="disabled" />
							<div class="notice">
								<a href="" class="color_cyan">Đăng nhập</a> hoặc
								<a href="" class="color_cyan">Đăng ký</a> để bình luận
							</div>
						</div>
						<div class="user_comment">
							<div class="left pl9 pr4">
								<a href=""><img class="avatar" src="<?=PATH_URL?>/static/images/icon/avatar.png" height="44" width="44" alt="" /></a>
							</div>
							<div class="left color_333 pt10">
								<a href="" class="color_cyan">Học sinh gương mẫu:</a> Có 2 thứ này bá chủ thiên hạ 
								<br /><span class="fs11 color_90">asdadas</span>
							</div>
							<div class="clearAll"></div>
						</div>
						<div class="user_comment">
							<div class="left pl9 pr4">
								<a href=""><img class="avatar" src="<?=PATH_URL?>/static/images/icon/avatar.png" height="44" width="44" alt="" /></a>
							</div>
							<div class="left color_333 pt10">
								<a href="" class="color_cyan">Học sinh gương mẫu:</a> Có 2 thứ này bá chủ thiên hạ 
								<br /><span class="fs11 color_90">asdadas</span>
							</div>
							<div class="clearAll"></div>
						</div>
					</div>
				</div>
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