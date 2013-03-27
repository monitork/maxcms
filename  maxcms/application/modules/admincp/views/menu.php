<ul id="grouped_menu">
	<?php
	$i = 1;
	$query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
	$current_link = $this->uri->uri_string(). $query;
	$admincp_prefix = 'admincp';
	$admincp_prefix_pos = strpos($current_link, $admincp_prefix);
	if($admincp_prefix_pos !== false){
		$current_link = substr($current_link,strlen($admincp_prefix)+1);
	}
	if($this->uri->segment(3)){
		$current_link=str_replace('/'.$this->uri->segment(3),'',$current_link);
	}
	
	foreach($group_list as $menu_1_item){
		$clickable = empty($menu_1_item->link) ? 'clickable' : '';
	?>
	<li class="menu_level_1" id="group_menu_<?=$i?>"><a class="<?=$menu_1_item->link==$current_link?'menu_active':$clickable?>" href="<?=PATH_URL.'admincp/'.$menu_1_item->link?>"><span class="menu_items"><?=$menu_1_item->name?></span></a>
		<?php
		if(!empty($menu_1_item->module_list)){
		?>
		<ul>
			<?php
			foreach($menu_1_item->module_list as $menu_2_item){
				$clickable = empty($menu_2_item->link) ? 'clickable' : '';
			?>
			<li class="menu_level_2"><a class="<?=$menu_2_item->link==$current_link?'menu_active':$clickable?>" href="<?=PATH_URL.'admincp/'.$menu_2_item->link?>"><img src="<?=PATH_URL.'static/images//admin/icons/button-shape.png'?>" align="left" style="padding-top:11px" /><span class="menu_items" style="text-indent: 5px"><?=$menu_2_item->name?></span></a>
				<?php 
				if(!empty($menu_2_item->sub_module_list)){
				?>
					<ul>
						<?php 
						foreach($menu_2_item->sub_module_list as $menu_3_item){
							$clickable = empty($menu_3_item->link) ? 'clickable' : '';
						?>
							<li class="menu_level_3"><a class="<?=$menu_3_item->link==$current_link?'menu_active':$clickable?>" href="<?=PATH_URL.'admincp/'.$menu_3_item->link?>"><p class="parent_items"><?=$menu_3_item->name?></p></a>
						<?php
						}
						?>
					</ul>
				<?php 
				}
				?>
			</li>
			<?php
			}
			?>
		</ul>
		<?php
		}
		?>
	</li>	
	<?php
		$i++;
	}
	?>
</ul>
<script type="text/javascript">
	function open_active_menu_level(menu_level){
		var menu_level_class = 'menu_level_'+menu_level;
		$('#grouped_menu li.'+menu_level_class+' > ul').slideUp();// Collapse all menus same level with menu_level
		$('#grouped_menu li.'+menu_level_class+' > a').each(function(){
			var current_class = $(this).attr('class');
			if (current_class.indexOf('menu_active') != -1){
				$(this).next().slideDown();
			}
		});
	}
	//hien active tai menu khi click 
	function attach_click_event_to_open_menu_level(menu_level){
		var menu_level_class = 'menu_level_'+menu_level;
		$('#grouped_menu li.'+menu_level_class+' > a.clickable').click(function(e){
			var current_class = $(this).attr('class');
			if (current_class.indexOf('menu_active') == -1){
				$('#grouped_menu li.'+menu_level_class+' > a').removeClass('menu_active');
				$(this).addClass('menu_active');
			} else {
				$(this).removeClass('menu_active');
			}
			open_active_menu_level(menu_level);
			return false;
		});
	}
	// mo menu cha khi menu con da duoc active
	function open_menu_level(parent_menu_level){
		var parent_menu_level_class = 'menu_level_'+parent_menu_level;
		var menu_level = parent_menu_level + 1;
		var menu_level_class = 'menu_level_'+menu_level;
		$('#grouped_menu li.'+menu_level_class+' > a').each(function(e){
			var current_class = $(this).attr('class');
			if (current_class.indexOf('menu_active') != -1){
				$(this).closest('li.'+parent_menu_level_class).find('> a').addClass('menu_active');
			}
		});
		open_active_menu_level(parent_menu_level);
	}
	$(document).ready(function () {
		attach_click_event_to_open_menu_level(1);
		attach_click_event_to_open_menu_level(2);
		
		// Open lower levels first!
		open_menu_level(2);
		open_menu_level(1);
		
	});
</script>