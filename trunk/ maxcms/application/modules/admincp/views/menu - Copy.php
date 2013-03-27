<ul id="grouped_menu">
	<?php
	$i = 1;
	foreach($group_list as $group){
		$clickable = empty($group->link) ? 'clickable' : '';
	?>
	<li class="parent_menu" id="group_menu_<?=$i?>"><a <?php if($this->uri->segment(2)==$group->link){ ?>class="menu_active"<?php }else{?>class="<?=$clickable?>"<?php }?> href="<?=PATH_URL.'admincp/'.$group->link?>"><span class="menu_items"><?=$group->name?></span></a>
		<?php
		if(!empty($group->module_list)){
		?>
		<ul class="cate_left">
			<?php
				foreach($group->module_list as $module){
					$clickable = empty($module->link) ? 'clickable' : '';
				?>
				<li><a <?php if($this->uri->segment(2)==$module->link){ ?>class="menu_active"<?php }else{?>class="<?=$clickable?>"<?php }?> href="<?=PATH_URL.'admincp/'.$module->link?>"><img src="<?=PATH_URL.'static/images//admin/icons/button-shape.png'?>" align="left" style="padding-top:11px" /><span class="menu_items" style="text-indent: 5px"><?=$module->name?></span></a>
					<?php if(!empty($module->sub_module_list)){?>
						<ul class="parent_left">
							<?php foreach($module->sub_module_list as $module_sub_tree){
									$clickable = empty($module_sub_tree->link) ? 'clickable' : '';?>
								<li><a <?php if($this->uri->segment(2)==$module_sub_tree->link){ ?>class="menu_active"<?php }else{?>class="<?=$clickable?>"<?php }?> href="<?=PATH_URL.'admincp/'.$module_sub_tree->link?>"><p class="parent_items"><?=$module_sub_tree->name?></p></a>
							<?php }?>
						</ul>
					<?php }?>
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
	$(document).ready(function () {
		$('#grouped_menu > li > a.clickable').click(function(e){
			if ($(this).attr('class') != 'active'){
				$('#grouped_menu li ul').slideUp();// Collapse all menus' uls
				$(this).next().children().children('ul').show();
				$(this).next().show();// Expand the corresponding ul
				$('#grouped_menu li a').removeClass('active');
				$(this).addClass('active');
			} else {
				//$(this).next().slideToggle();// Collapse the corresponding ul
				$(this).next().show();
			}
			e.preventDefault();
		});
		 var li_jele;
		$('#grouped_menu li ul li').each(function(){
			if($(this).find('> a').attr('class') == 'menu_active'){
				li_jele = $(this).parent().parent();
				$(this).children('ul').show();
				// li_jele.find('> a').addClass('active');
				// li_jele.find('> ul').slideToggle();
			}
		});
		 /*$('#grouped_menu li ul li .parent_left li').each(function(){
			if($(this).find('> a').attr('class') == 'menu_active'){
				$(this).show();
				li_jele = $(this).parent().parent();
			}
		}); 
		// var li_jele = $('#grouped_menu li#group_menu_2');*/
		if(li_jele){
			li_jele.find('> a').addClass('active');
			//li_jele.find('> ul').slideToggle();// Expand the corresponding ul
		} 
	});
</script>