<input type="hidden" value="<?=$start?>" id="start" />
<input type="hidden" value="<?=$category;?>" class="has_filter_category" id="category_filter"/>
<div class="content_table">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<th class="th_no_cursor" width="40">No.</th>
			<th class="th_no_cursor" width="31"><input type="checkbox" class="custom_chk" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)" /></th>
			<th class="th_left" onclick="sort('image')"><div id="image" class="sort icon_no_sort">Hình ảnh</div></th>
			<th class="th_left" onclick="sort('title')"><div id="title" class="sort icon_no_sort">Tiêu đề</div></th>
			<th class="th_left" onclick="sort('categoryName')"><div id="categoryName" class="sort icon_no_sort">Thể loại</div></th>
			<th width="70" onclick="sort('status')"><div id="status" class="sort icon_no_sort">Status</div></th>
			<th width="100" onclick="sort('changed')"><div id="changed" class="sort icon_no_sort">Changed</div></th>
			<th class="th_last" width="100" onclick="sort('created')"><div id="created" class="sort icon_sort_asc">Created</div></th>
			<th class="th_last" width="100" onclick="sort('datepost')"><div id="datepost" class="sort icon_sort_asc">Datepost</div></th>
		</tr>
		<?php
			if($result){
				$i=0;
				foreach($result as $k=>$v){
					$dir = DIR_NEWS_IMAGES;
					// if($v->parent_id == 52){
						// $dir = DIR_KINHNGHIEM;
					// }
		?>
		<tr class="item_row<?=$i?> <?php ($k%2==0) ? print 'row1' : print 'row2' ?>">
			<td class="td_center"><?=$k+1+$start?></td>
			<td class="td_no_padd"><input type="checkbox" class="custom_chk" id="item<?=$i?>" onclick="selectItem(<?=$i?>)" value="<?=$v->id?>" /></td>
			<td class="td_center"><a href="<?=PATH_URL.'admincp/'.$module.'/update/'.$v->id?>"><img class="img_block" alt="" src="<?= img( $dir . $v->image, 150,120)?>" /></a></td>
			<td class="th_left"><a href="<?=PATH_URL.'admincp/'.$module.'/update/'.$v->id?>"><?=$v->title?></a></td>
			<td class="th_left"><?=$v->categoryName?></td>
			<td class="td_center" id="loadStatusID_<?=$v->id?>"><a href="javascript:void(0)" onclick="updateStatus(<?=$v->id?>,<?=$v->status?>,'<?=$module?>')"><img alt="Checked item" src="<?=PATH_URL.'static/images/admin/icons/'?><?php ($v->status==0) ? print 'uncheck_16x16.png' : print 'check_16x16.png' ?>" /></a></td>
			<td class="th_left"><?=date('d-m-Y',strtotime($v->changed))?></td>
			<td class="th_left td_center"><?=date('d-m-Y',strtotime($v->created))?></td>
			<td class="th_last td_center"><?=date('d-m-Y',strtotime($v->datepost))?></td>
		</tr>
		<?php $i++;}}else{ ?>
		<tr class="row1">
			<td class="th_last td_center" colspan="50" style="font-size: 20px; padding: 50px 0">No data</td>
		</tr>
		<?php } ?>
	</table>
</div>

<?php if($result){ ?>
<div class="footer_table">
	<div class="item_per_page">Items per page:</div>
	<div class="select_per_page">
		<select id="per_page" onchange="searchContent(<?=$start?>,this.value)">
			<option <?php ($per_page==10) ? print 'selected="selected"' : print '' ?> value="10">10</option>
			<option <?php ($per_page==25) ? print 'selected="selected"' : print '' ?> value="25">25</option>
			<option <?php ($per_page==50) ? print 'selected="selected"' : print '' ?> value="50">50</option>
			<option <?php ($per_page==100) ? print 'selected="selected"' : print '' ?> value="100">100</option>
		</select>
	</div>
	
	<div class="pagination"><?=$this->adminpagination->create_links();?></div>
</div>
<div class="clearAll"></div>
<?php } ?>