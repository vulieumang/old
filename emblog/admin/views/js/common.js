function CheckAll(form) {
	for (var i=0;i<form.elements.length;i++) {
		var e = form.elements[i];
		if (e.name != 'chkall')
		e.checked = form.chkall.checked;
	}
}
function getChecked(node) {
	var re = false;
	$('input.'+node).each(function(i){
		if (this.checked) {
			re = true;
		}
	});
	return re;
}
function timestamp(){
	return new Date().getTime();
}
function em_confirm (id, property) {
	switch (property){
		case 'tw':
		var urlreturn="twitter.php?action=del&id="+id;
		var msg = "Bạn có muốn xóa twitter này không? Thao tác không thể phục hồi!";break;
		case 'comment':
		var urlreturn="comment.php?action=del&id="+id;
		var msg = "Bạn có muốn xóa nhận xét này không? Thao tác không thể phục hồi!";break;
		case 'link':
		var urlreturn="link.php?action=dellink&linkid="+id;
		var msg = "Bạn có muốn xóa liên kết này không? Thao tác không thể phục hồi!";break;
		case 'backup':
		var urlreturn="data.php?action=renewdata&sqlfile="+id;
		var msg = "Bạn có muốn khôi phục từ tập tin sao lưu không?";break;
		case 'attachment':
		var urlreturn="attachment.php?action=del_attach&aid="+id;
		var msg = "Bạn có muốn xóa tập tin đính kèm này không? Thao tác không thể phục hồi!";break;
		case 'avatar':
		var urlreturn="blogger.php?action=delicon";
		var msg = "Bạn có muốn xóa hình ảnh này không? Thao tác không thể phục hồi!";break;
		case 'sort':
		var urlreturn="sort.php?action=del&sid="+id;
		var msg = "Bạn có muốn xóa phân loại này không? Thao tác không thể phục hồi!";break;
		case 'page':
		var urlreturn="page.php?action=del&gid="+id;
		var msg = "Bạn có muốn xóa trang này không? Thao tác không thể phục hồi!";break;
		case 'user':
		var urlreturn="user.php?action=del&uid="+id;
		var msg = "Bạn có muốn xóa thành viên này không? Thao tác không thể phục hồi!";break;
		case 'reset_widget':
		var urlreturn="widgets.php?action=reset";
		var msg = "Bạn có muốn khôi phục lại thiết lập ban đầu của widget không?C ác thiết lập của bạn sẽ bị mất.";break;
		case 'reset_plugin':
		var urlreturn="plugin.php?action=reset";
		var msg = "Bạn có muốn vô hiệu hóa tất cả các plugin?";break;
	}
	if(confirm(msg)){window.location = urlreturn;}else {return;}
}
function focusEle(id){try{document.getElementById(id).focus();}catch(e){}}
function hideActived(){
	$(".actived").hide();
	//$(".error").hide();
}
function displayToggle(id, keep){
	$("#"+id).toggle();
	if (keep == 1){$.cookie('em_'+id,$("#"+id).css('display'),{expires:365});}
	if (keep == 2){$.cookie('em_'+id,$("#"+id).css('display'));}
}
function isalias(a){
	var reg1=/^[\u4e00-\u9fa5\w-]*$/;
	var reg2=/^[\d]+$/;
	var reg3=/^post(-\d+)?$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(reg3.test(a)){
		return 3;
	}else if(a=='t' || a=='m' || a=='admin'){
		return 4;
	} else {
		return 0;
	}
}
function checkform(){
	var a = $.trim($("#alias").val());
	var t = $.trim($("#title").val());
	if (t==""){
		alert("Vui lòng nhập tiêu đề!");
		$("#title").focus();
		return false;
	}else if(0 == isalias(a)){
		return true;
	}else {
		alert("Liên kết lỗi!");
		$("#alias").focus();
		return false
	};
}
function checkalias(){
	var a = $.trim($("#alias").val());
	if (1 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">Liên kết chỉ được sử dụng chữ cái, chữ số, gạch ngang "-" và gạch dưới "_"!</span>');
	}else if (2 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">Liên kết không thể toàn số!</span>');
	}else if (3 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">Liên kết lỗi, không thể dùng \'post\' hoặc \'post-số\'</span>');
	}else if (4 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">Xung đột với hệ thống liên kết!</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
	}
}
function addattach(imgurl,imgsrc,aid){
	if (KE.g['content'].wyswygMode == false){
		alert('Xin vui lòng chuyển sang chế độ trù phú');
	}else {
		KE.insertHtml('content','<a target=\"_blank\" href=\"'+imgurl+'\" id=\"ematt:'+aid+'\"><img src=\"'+imgsrc+'\" alt=\"Nhấn vào đây để xem bản gốc\" border=\"0\"></a>');
	}
}
function insertTag (tag, boxId){
	var targetinput = $("#"+boxId).val();
	if(targetinput == ''){
		targetinput += tag;
	}else{
		var n = ',' + tag;
		targetinput += n;
	}
	$("#"+boxId).val(targetinput);
}
//ACT:0 Tu dong luu, 1 Nhan tai len dinh ken, 2 Nhan luu ban nhap, 3 Nhan luu trang, 4 Nhan dinh kem cho trang
function autosave(act){
	var nodeid = "as_logid";
	if (act == 3 || act == 4){
		var url = "page.php?action=autosave";
		var title = $.trim($("#title").val());
		var alias = $.trim($("#alias").val());
		var logid = $("#as_logid").val();
		var content = KE.html('content');
		var pageurl = $.trim($("#url").val());
		var allow_remark = $.trim($("table input[name=allow_remark][checked]").val());
		var is_blank = $.trim($("table input[name=is_blank][checked]").val());
		var ishide = $.trim($("#ishide").val());
		var ishide = ishide == "" ? "y" : ishide;
		var querystr = "content="+encodeURIComponent(content)
					+"&title="+encodeURIComponent(title)
					+"&alias="+encodeURIComponent(alias)
					+"&allow_remark="+allow_remark
					+"&is_blank="+is_blank
					+"&url="+pageurl
					+"&ishide="+ishide
					+"&as_logid="+logid;
	}else{
		var url = "save_log.php?action=autosave";
		var title = $.trim($("#title").val());
		var alias = $.trim($("#alias").val());
		var sort = $.trim($("#sort").val());
		var postdate = $.trim($("#postdate").val());
		var date = $.trim($("#date").val());
		var logid = $("#as_logid").val();
		var author = $("#author").val();
		var content = KE.html('content');
		var excerpt = KE.html('excerpt');
		var tag = $.trim($("#tag").val());
		var top = $.trim($("#post_options input[name=top][checked]").val());
		var allow_remark = $.trim($("#post_options input[name=allow_remark][checked]").val());
		var allow_tb = $.trim($("#post_options input[name=allow_tb][checked]").val());
		var password = $.trim($("#password").val());
		var ishide = $.trim($("#ishide").val());
		var ishide = ishide == "" ? "y" : ishide;
		var querystr = "content="+encodeURIComponent(content)
					+"&excerpt="+encodeURIComponent(excerpt)
					+"&title="+encodeURIComponent(title)
					+"&alias="+encodeURIComponent(alias)
					+"&author="+author
					+"&sort="+sort
					+"&postdate="+postdate
					+"&date="+date
					+"&tag="+encodeURIComponent(tag)
					+"&top="+top
					+"&allow_remark="+allow_remark
					+"&allow_tb="+allow_tb
					+"&password="+password
					+"&ishide="+ishide
					+"&as_logid="+logid;
	}
	// Kiem tra lien ket
	if(alias != '') {
		if (0 != isalias(alias)){
			$("#msg").html("<span class=\"msg_autosave_error\">Liên kết lỗi, tự động lưu thất bại</span>");
			if(act == 0){setTimeout("autosave(0)",60000);}
			return;
		}
	}
	if(act == 0){
		if(ishide == 'n'){return;}
		if (content == ""){
			setTimeout("autosave(0)",60000);
			return;
		}
	}
	if(act == 1 || act == 4){
		var gid = $("#"+nodeid).val();
		if (gid != -1){return;}
	}
	$("#msg").html("<span class=\"msg_autosave_do\">Tự động lưu...</span>");
	var btname = $("#savedf").val();
	$("#savedf").val("Tự động lưu");
	$("#savedf").attr("disabled", "disabled");
	$.post(url, querystr, function(data){
		data = $.trim(data);
		var isrespone=/^autosave\_gid\:\d+\_df\:\d*\_$/;
		if(isrespone.test(data)){
			var getvar = data.match(/\_gid\:([\d]+)\_df\:([\d]*)\_/);
			var logid = getvar[1];
			if (act != 3){
				var dfnum = getvar[2];
				if(dfnum > 0){$("#dfnum").html("("+dfnum+")")};
			}
    		$("#"+nodeid).val(logid);
    		var digital = new Date();
    		var hours = digital.getHours();
    		var mins = digital.getMinutes();
    		var secs = digital.getSeconds();
    		$("#msg_2").html("<span class=\"ajax_remind_1\">Đã lưu lúc "+hours+":"+mins+":"+secs+" </span>");
    		$("#savedf").attr("disabled", "");
    		$("#savedf").val(btname);
    		$("#msg").html("");
		}else{
		    $("#savedf").attr("disabled", "");
		    $("#savedf").val(btname);
		    $("#msg").html("<span class=\"msg_autosave_error\">Mạng hoặc hệ thống gặp trục trặc, sao lưu có thể thất bại...</span>");
	    }
	});
	if(act == 0){
		setTimeout("autosave(0)",60000);
	}
}