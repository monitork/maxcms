$(document).ready(function(){$().UItoTop({easingType:"easeOutQuart"});$("#caledar_from").datepicker({changeMonth:true,changeYear:true,dateFormat:"dd-mm-yy",yearRange:"1930:2050"});$("#caledar_to").datepicker({changeMonth:true,changeYear:true,dateFormat:"dd-mm-yy",yearRange:"1930:2050"});$(".custom_chk").jqTransCheckBox();$(".custom_rd").jqTransRadio();$(".custom_select").jqTransSelect();$(".fancyboxClick").fancybox();$("#saveContent").click(function(){$("#loader").fadeIn()});$(".gr_perm_error").width($(".right_content").width()-2);$(".gr_perm_success").width($(".right_content").width()-2);$("#frmManagement input").keypress(function(b){if(b.which==13){save();return false}});var a=$.url(document.location.href);if(a.segment(-1)!="update"&&a.segment(-2)!="update"){if(a.fsegment(1)=="back"||a.fsegment(1)=="save"){if(a.fsegment(1)=="save"){show_perm_success()}if(a.segment(-1)!="update_profile"&&a.segment(-1)!="setting"){if($("#start").val()==""){$("#start").val(0)}searchContent($("#start").val(),10)}}else{if(a.segment(-1)!="update_profile"&&a.segment(-1)!="setting"){if(module!="admincp"){searchContent(0,10)}}}}});function show_perm_denied(){$(".gr_perm_error").fadeIn(500);$("#loader").fadeOut(300);$(".table").css("marginTop",4);setTimeout("$('.gr_perm_error').fadeOut(300); $('.table').css('marginTop',0);",5000)}function show_perm_success(){$(".gr_perm_success").fadeIn(500);$("#loader").fadeOut(300);$(".table").css("marginTop",4);setTimeout("$('.gr_perm_success').fadeOut(300); $('.table').css('marginTop',0);",5000)}function searchContent(d,b){if(b==undefined){if($("#per_page").val()){b=$("#per_page").val()}else{b=10}}var a=$("#func_sort").val();var c=$("#type_sort").val();$("#start").val(d);var has_filter_category = $('.has_filter_category').size() > 0;$.post(root+"admincp/"+module+"/ajaxLoadContent",{func_order_by:a,order_by:c,start:d,per_page:b,dateFrom:$("#caledar_from").val(),dateTo:$("#caledar_to").val(),content:$("#search_content").val(), category:has_filter_category ? $("#category_filter").val(): 0},function(e){$("#ajax_loadContent").html(e);$(".custom_chk").jqTransCheckBox();$(".fancyboxClick").fancybox();$(".sort").removeClass("icon_sort_desc");$(".sort").removeClass("icon_sort_asc");$(".sort").addClass("icon_no_sort");if(c=="DESC"){$("#"+a).addClass("icon_sort_desc")}else{$("#"+a).addClass("icon_sort_asc")}})}function enterSearch(a){if(a.keyCode==13){searchContent(0)}}function sort(b){var a=$("#func_sort").val();var c=$("#type_sort").val();if(b==a){if(c=="DESC"){$("#type_sort").val("ASC")}else{$("#type_sort").val("DESC")}}else{$("#func_sort").val(b);$("#type_sort").val("DESC")}searchContent(0,$("#per_page").val())}function updateStatus(d,a,c){var b=root+"admincp/"+c+"/ajaxUpdateStatus";$.post(b,{id:d,status:a},function(e){$("#loadStatusID_"+d).html(e);if(c=="admincp_modules"){$.get(root+"admincp/menu",function(f){$("#loadMenu").html(f)})}})}function selectItem(b){var a=document.getElementById("item"+b);if(a.checked==false){$(".item_row"+b).addClass("row_active")}else{$(".item_row"+b).removeClass("row_active")}}function selectAllItems(a){if(document.getElementById("selectAllItems").checked==false){$(".jqTransformCheckboxWrapper a").addClass("jqTransformChecked");for(var b=0;b<a;b++){if(document.getElementById("item"+b)!=null){$(".item_row"+b).addClass("row_active");itemCheck=document.getElementById("item"+b);itemCheck.checked=true}}}else{$(".jqTransformCheckboxWrapper a").removeClass("jqTransformChecked");for(var b=0;b<a;b++){if(document.getElementById("item"+b)!=null){$(".item_row"+b).removeClass("row_active");itemCheck=document.getElementById("item"+b);itemCheck.checked=false}}}}function showStatusAll(){var a=$("#per_page").val();for(var b=0;b<a;b++){if(document.getElementById("item"+b)!=null){if(document.getElementById("item"+b).checked==true){updateStatus($("#item"+b).val(),0,module)}}}}function hideStatusAll(){var a=$("#per_page").val();for(var b=0;b<a;b++){if(document.getElementById("item"+b)!=null){if(document.getElementById("item"+b).checked==true){updateStatus($("#item"+b).val(),1,module)}}}}function deleteItem(c){var a=confirm("Are you sure delete item?");if(a){var b=root+"admincp/"+module+"/delete";$.post(b,{id:c},function(d){if(d=="permission-denied"){show_perm_denied()}else{searchContent($("#start").val(),$("#per_page").val())}})}}function deleteAll(){var b=confirm("Are you sure delete item selected?");if(b){var a=$("#per_page").val();for(var d=0;d<a;d++){if(document.getElementById("item"+d)!=null){if(document.getElementById("item"+d).checked==true){id=$("#item"+d).val();var c=root+"admincp/"+module+"/delete";$.post(c,{id:id},function(e){if(e=="permission-denied"){show_perm_denied()}else{searchContent($("#start").val(),$("#per_page").val())}})}}}}}function chk_perm(b,a){if(a!="no_access"){if(a=="read"){if($("#read"+b).attr("checked")=="checked"){$("#noaccess"+b).attr("checked",true);$("#write"+b).attr("checked",false);$("#delete"+b).attr("checked",false);$(".custom_noaccess"+b).addClass("jqTransformChecked");$(".custom_write"+b).removeClass("jqTransformChecked");$(".custom_delete"+b).removeClass("jqTransformChecked")}else{$("#noaccess"+b).attr("checked",false);$(".custom_noaccess"+b).removeClass("jqTransformChecked")}}else{$("#read"+b).attr("checked",true);$("#noaccess"+b).attr("checked",false);$(".custom_read"+b).addClass("jqTransformChecked");$(".custom_noaccess"+b).removeClass("jqTransformChecked")}}else{if($("#noaccess"+b).attr("checked")=="checked"){$("#read"+b).attr("checked",true);$(".custom_read"+b).addClass("jqTransformChecked")}else{$(".perm_access"+b).attr("checked",false);$(".custom_read"+b).removeClass("jqTransformChecked");$(".custom_write"+b).removeClass("jqTransformChecked");$(".custom_delete"+b).removeClass("jqTransformChecked")}}};
$(document).ready(function(){
	
	// onchange manufacturer 
	if($('#admincp_car_manufacturer').length > 0 ){
		$('#manufacturerAdmincp').live('change',function(){
			var selected = $(this).val();
			var url = root + 'admincp/cars/ajax_manu_model';
			$.post(url,{manu_id:selected},function(data){
				$('#admincp_car_manu_model').html(data);
			});
			$('#modelAdmincp').val(0);
			$('#modelAdmincp').change();
		});
	}
	
	//onchange model
	if($('#admincp_car_manu_model').length > 0 ){
		$('#modelAdmincp').live('change',function(){
			var selected = $(this).val();
			var url = root + 'admincp/cars/ajax_model_trim';
			$.post(url,{model_id:selected},function(data){
				$('#admincp_car_model_trim').html(data);
			});
			$('#trimAdmincp').val(0);
			$('#trimAdmincp').change();
		});
	}

	//onchange trim
	if($('#wrap_gen_date').length > 0 ){
		$('#trimAdmincp').live('change',function(){
			var selected = $(this).val();
			var url = root + 'admincp/cars/ajax_trim_gen';
			$.post(url,{trim_id : selected},function(data){
				$('#wrap_select_gen').html(data);
			});
			$('#select_gen').val(0);
			$('#select_gen').change();
		});
	}

	if($('#wrap_state_date').length > 0 ){
		$('#select_gen').live('change',function(){
			var selected = $(this).val();
			var trim_id = $('#trimAdmincp').val();
			var url = root + 'admincp/cars/ajax_gen_state';
			$.post(url,{gen_id : selected},function(data){
				$('#wrap_select_state').html(data);	
			});
			var url1 = root + 'admincp/cars/ajax_gen_date';
			$.post(url1,{trim_id : trim_id ,gen_id : selected},function(data){
				$('#wrap_gen_date').html(data);
			});
			$('#select_state').val(0);
			$('#select_state').change();
		});

		$('#select_state').live('change',function(){
			var selected = $(this).val();
			var trim_id = $('#trimAdmincp').val();
			var gen_id = $('#select_gen').val();
			var url = root + 'admincp/cars/ajax_equipment';
			$.post(url,{state_id : selected, trim_id : trim_id, gen_id : gen_id},function(data){
				$('#wrap_equipment').html(data);	
			});
			var url1 = root + 'admincp/cars/ajax_state_date';
			$.post(url1,{state_id : selected, trim_id : trim_id, gen_id : gen_id},function(data){
				$('#wrap_state_date').html(data);
			});

		});
	}

	if($('.select_primary_price').length > 0 ){
		$('.select_primary_price').change(function(){
			value = $('.select_primary_price option:selected').val();
		});
	}

	//onchange province
	if( $('#districtAdmincp').length > 0 ){
		$('#provinceAdmincp').live('change',function(){
			var selected = $(this).val();
			var url = root + 'admincp/cars/ajax_province_district';
			$.post(url,{provinceID:selected},function(data){
				$('#wrap_district').html(data);
			});
		});
	}

});

$(function() {
	$('input[data-type="image"]').live('change', function() {
		var value= $(this).val();
		var ext = value.substr( (value.lastIndexOf('.') +1) );
		var in_ext= $.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']);
		if(in_ext == -1) {
			alert('Định dạng file không hợp lệ (.jpg, .jpeg, .png, .gif) ');
			$(this).val('');
			return false;
		}	
	});
	
	$("#ngaycomat_autobayAdmincp").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2013:2050'
	});	
	
	$(".datepicker").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2013:2050'
	});	
	$("#ngayramatAdmincp").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2013:2050'
	});	
	
	$('input[data-type="video"]').live('change', function() {
		var value= $(this).val();
		var ext = value.substr( (value.lastIndexOf('.') +1) );
		var in_ext= $.inArray(ext.toLowerCase(), ['mp4', 'flv', 'avi', 'mkv']);
		if(in_ext == -1) {
			alert('Định dạng file không hợp lệ (.mp4, .flv, .avi, .mkv) ');
			$(this).val('');
			return false;
		}		
	});
});

function updateStatusHtml(id, status, module){
	var url=root+"admincp/"+module+"/ajaxUpdateStatusHtml";
	$.post(url,{id:id,status:status},function(data){
		$("#loadStatusID_"+id).html(data);
	});
}

function updateSold(id_car,sold,module){
	var url=root+"admincp/"+module+"/ajaxUpdateSold";
	$.post(url,{id:id_car,sold:sold},function(data){
		$("#loadSoldID_"+id_car).html(data);
	});
}

