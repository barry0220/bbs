
/***********************
输入框效果判断
************************/

//移动加框效果
function overInput(obj){ $(obj).addClass('text-hover'); }
function outInput(obj){ $(obj).removeClass('text-hover'); }


//输入框检测
function checkInput(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.focus();
}

//是否显示错误提示
function showArm(objId,showDel){ //判断提示
	var obj = $(objId);
	if(showDel=='show'){
		if(obj.val()==''){
			obj.addClass('text-err').next().show();
		} else {
			obj.removeClass('text-err').next().hide();
		}
	} else if(showDel=='del'){
		obj.next().hide();
	}
}
//选中时检测是否有值
function checkFocus(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.addClass('text-focus');
	//判断是否有值，没有值则添加样式
	if(obj.val()==''){
		lev.addClass('label-focus');
	}
}
//失去焦点时判断
function checkBlur(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.removeClass('text-focus');
	lev.removeClass('label-focus');
	if(obj.val()==''){ lev.show(); }
	showArm(obj,'show');
}

function checkBlur2(levId,objId){
	var lev = $(levId), obj = $(objId);	//鎻愮ず淇℃伅灞? 杈撳叆妗?
	obj.removeClass('text-focus');
	lev.removeClass('label-focus');
	if(obj.val()==''){ lev.show(); }
	//showArm(obj,'show');
}

//键盘按下与弹起时的操作
function checkKeyDownUp(levId,objId,numOnly){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	if(obj.val()==''){
		lev.show();
	} else {
		lev.hide();
	}
	//只能输入数字
	if(numOnly){
		if(isNaN(obj.val())){
			showArm(obj,'show');
			lev.show();
			obj.val('').next().show();
		}
	}
}

function checkKeyDownUp2(levId,objId,numOnly){
	var lev = $(levId), obj = $(objId);	//鎻愮ず淇℃伅灞? 杈撳叆妗?
	//alert('1');
	if(obj.val()==''){
		lev.show();
	} else {
		lev.hide();
	}
	//鍙兘杈撳叆鏁板瓧
//	if(numOnly){
//		if(isNaN(obj.val())){
//			showArm(obj,'show');
//			lev.show();
//			obj.val('').next().show();
//		}
//	}
}


//显示提示内容
function showPromptBox(){
	$('.input-box-f').hover(
		function(){ $(this).find('.prompt-box').show() },
		function(){ $(this).find('.prompt-box').hide() }
	);
}

//初始化输入框检测项
function createCheckInput(){
	//添加输入框效果
	var $allLabelMsg = $('.input-box-f .label-msg');
	$allLabelMsg.hover(
		function(){ $(this).next('.input-text').addClass('text-hover'); },
		function(){ $(this).next('.input-text').removeClass('text-hover'); }
	);
	//添加输入判断
	/*for(i=0; i<$('.input-box-f .label-msg').length; i++) {
		var alm = $('.input-box-f .label-msg').eq(i);
		var lId = '#'+alm.attr('id');
		var iId = '#'+alm.next().attr('id');
		//label框添加相关事件
		alm.click(function(){ checkInput(lId,iId); });
		//输入框添加相关事件
		alm.next()
			.focus(function(){ checkFocus(lId,iId); })
			.keyup(function(){ checkKeyDownUp(lId,iId); })
			.keydown(function(){ checkKeyDownUp(lId,iId); })
			.blur(function(){ checkBlur(lId,iId); });
			alert(alm.next().attr('id'));
	};*/
	$('.input-box-f').find('.label-msg').each(function(){
		var lId = '#'+$(this).attr('id');
		var iId = '#'+$(this).next().attr('id');
		//label框添加相关事件
		$(this).click(function(){ checkInput(lId,iId); });
		//输入框添加相关事件
		$(this).next()
			.focus(function(){ checkFocus(lId,iId); })
			.keyup(function(){ checkKeyDownUp(lId,iId); })
			.keydown(function(){ checkKeyDownUp(lId,iId); })
			.blur(function(){ checkBlur(lId,iId); });
	});
}

//初始化输入框检测项
function createCheckInput2(){
	//添加输入框效果
	var $allLabelMsg = $('.input-box-f .label-msg');
	$allLabelMsg.hover(
		function(){ $(this).next('.input-text').addClass('text-hover'); },
		function(){ $(this).next('.input-text').removeClass('text-hover'); }
	);
	//添加输入判断
	/*for(i=0; i<$('.input-box-f .label-msg').length; i++) {
		var alm = $('.input-box-f .label-msg').eq(i);
		var lId = '#'+alm.attr('id');
		var iId = '#'+alm.next().attr('id');
		//label框添加相关事件
		alm.click(function(){ checkInput(lId,iId); });
		//输入框添加相关事件
		alm.next()
			.focus(function(){ checkFocus(lId,iId); })
			.keyup(function(){ checkKeyDownUp(lId,iId); })
			.keydown(function(){ checkKeyDownUp(lId,iId); })
			.blur(function(){ checkBlur(lId,iId); });
			alert(alm.next().attr('id'));
	};*/
	$('.input-box-f').find('.label-msg').each(function(){
		var lId = '#'+$(this).attr('id');
		var iId = '#'+$(this).next().attr('id');
		//label框添加相关事件
		$(this).click(function(){ checkInput(lId,iId); });
		//输入框添加相关事件
		$(this).next()
			.focus(function(){ checkFocus(lId,iId); })
			.keyup(function(){ checkKeyDownUp2(lId,iId); })
			.keydown(function(){ checkKeyDownUp2(lId,iId); })
			.blur(function(){ checkBlur(lId,iId); });
	});
}

//内容框有内容时则隐藏提示信息
function checkInputCont(){
	$('.input-box-f input').each(function(){
		if($(this).val() != ''){
			$(this).parent().find('.label-msg').hide();
		}
	});
}

//弹出发送状态框
function showSendPrompt(){
	$('.prompt-content').parent().show();
	$('.prompt-content').animate({marginBottom:'3px'},function(){
		setTimeout(function(){
			$('.prompt-content').animate({marginBottom:'-50px'},function(){ $('.prompt-content').parent().hide(); });
		},3000);
	});
}
