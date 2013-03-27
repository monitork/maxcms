//FORM
$(function() {
	$('input[data-type="int"]').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	
	$('#lgEmail,#lgPassword').live('keypress', function(e) {
		 if(e.which == 13){
			login();
		}		
	});
	
	$('#btnLogin').live('click', function() {
		login();
	});
	
	$('#btnForgot').click(function(){
        var url= root+'user/forgotpass';
        var email= $('#emailForgot').val();
        if(email){
            $.post(
				url,
				$('#frForgot').serialize(),
				function(data){
					if(data.st=='SUCCESS'){
						showFrSuccess('#eFrForgot', 'Bạn hãy vào email để xác nhận quên mật khẩu');
						frReset('#frForgot');						
					}else{
						$.each(data.error,function(index,item){
							$('#eFrForgot').html(item.txt);
							return false;
						});								
					}
				},'json'
			);
        }else{
			$('#eFrForgot').html('Bạn chưa nhập email');	
			$('#emailForgot').focus();
		}
	});
	
	$('#btnLogout').live('click', function() {
		$.post(
			root+'user/logout',
			{},
			function(data){
				if(data.st=='SUCCESS'){
					$('#bloc-user').html(data.html);
				}			
			},'json'
		);		
	});
	
	$('#btnRegister').click(function() {
		var url= root+'user/register';
		$.post(
			url,
			$('#frRegister').serialize(),
			function(data){
				if(data.st=='SUCCESS'){
					showFrSuccess('#eFrRegister', 'Đăng ký thành công bạn hãy vào email để kích hoạt tài khoản');
					frReset('#frRegister');
				}else{
					$.each(data.error,function(index,item){
						$('input[name="'+item.field+'"]').focus();
						$('#eFrRegister').html(item.txt);
						return false;
					});					
				}
			},"json"
		);		
	});
	
	$('#reCaptcha').click(function() {
		var img= root+"captcha/getcaptcha/?t="+Math.random();
		$("#reCaptcha").attr({src:img});
	});	
	
	$('#btnCarSaleDV').live('click', function() {
		$.post(
			root+'car_sale_dv/post',
			$('.frCarSaleDV').serialize(),
			function(data){
				if(data.st=='SUCCESS'){
					frReset('.frCarSaleDV');
					$('.ifrCarSaleDV').html('');
					alert('Cám ơn bạn đã liên hệ với Autobay');
					showFrSuccess('.ifrCarSaleDV', '');
				}else{
					$.each(data.error,function(index,item){
						$('.ifrCarSaleDV').html(item.txt);
						if ($('input[name="'+item.field+'"]').length > 0 ) {
							$('input[name="'+item.field+'"]').focus();
						}else{
							$('textarea[name="'+item.field+'"]').focus();
						}
						return false;
					});							
				}
			},'json'
		);
	});	
});
//END FORM

function login(){
	var url= root+'user/login';
	if($('#lgEmail').val()!='')
	{
		$.post(
			url,
			$('#frLogin').serialize(),
			function(data){
				if(data.st=='SUCCESS'){
					$('#bloc-user').html(data.html);
				}else{
					$.each(data.error, function(i, item) {
						$('input[name="'+item.field+'"]').focus();
						$('#lgError').html(item.txt);
						return false;
					});					
				}				
			},'json'
		);
	}else{
		$('input[id="lgEmail"]').focus();
		$('#lgError').html('Bạn chưa nhập email');
	}
}

function frReset(element) {
    $(element).each(function(){
        this.reset();
    });
}

function showFrSuccess(element,txt){
    $(element).removeClass('frError').addClass('frSuccess').html(txt);
    var callback= function() {
        $(element).fadeOut().html('').removeClass('frSuccess').addClass('frError').fadeIn();
		$('html, body').animate({scrollTop: '0px'}, 200,function(){});
    }
    setTimeout(callback,1000);
}

function frSearch(){
	if($('#_ipSearch').val()!='Nhập từ khoá tìm kiếm'){
		$('#_frSearch').submit();
	}else{
		$('#_ipSearch').focus();
	}
}

function checkInp(val,error){
	if(val==''){
		
	}else{
		var frError= $('.frError');
		frError.html('');
		if(error=='cmnd'){
			if(isNaN(val)){
				frError.html('CMND không hợp lệ');
				return false;
			}else if($('#cmnd').val().length<9 || $('#cmnd').val().length>10){
				frError.html('CMND không hợp lệ');
				return false;
			}
			return true;
		}
		
		if(error=='email'){
			var filter = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if (!val.match(filter)){
				frError.html('Email không hợp lệ');
				return false;
			}
			return true;
		}
				
		if(error=='phone'){
			if(isNaN(val)){
				frError.html('Số điện thoại không hợp lệ');
				return false;
			}else{
				if(val.substr(0,2)==='01'){
					if(val.length<11 || val.length>11){
						frError.html('Số điện thoại không hợp lệ');
						return false;
					}
				}else{
					if(val.length<10 || val.length>10){
						frError.html('Số điện thoại không hợp lệ');
						return false;
					}
				}
			}
			return true;
		}
	}
}

function checkSel(val,error){
	var frError= $('.frError');
	if(val!=-1){
		frError.html('');
	}
}