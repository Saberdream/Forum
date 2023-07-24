$.urlParam = function(url){
	var result = {};
	result['basename'] = url.substr(url.lastIndexOf('/')+1).split('?')[0];
	var searchIndex = url.indexOf('?');
	if (searchIndex == -1 ) return result;
	var sPageURL = url.substring(searchIndex+1);
	var sURLVariables = sPageURL.split('&');
	for(var i = 0; i < sURLVariables.length; i++) {       
		var sParameterName = sURLVariables[i].split('=');      
		result[sParameterName[0]] = sParameterName[1];
	}
	return result;
}

function spoilerToggle(o, reset) {
	var c, t;
	reset = reset || false;
	
	if (o && (c = o.parentNode.className.match(/\bspoiler-top\b/))) {
		f = o.parentNode.nextSibling;
		
		f.className = f.className.match(/\bspoiler-hidden\b/) ? 'spoiler-box spoiler-visible' : 'spoiler-box spoiler-hidden';
		
		if (f.previousSibling && (t = f.previousSibling.childNodes[0])) {
			t.innerHTML = (t.innerHTML==text_spoiler_hide) ? text_spoiler_show : text_spoiler_hide;
		}
	}
	return(false);
}

if(!site_root) {
	var site_root = window.location.protocol + '//' + window.location.hostname + '/';
}

var text_enlarge_image = 'Click on the image to enlarge';
var text_delete_confirmation = 'Are you sure you want to delete this item?';
var text_action_confirmation = 'Are you sure you want to do this action on the selected items?';
var text_select_element = 'You have to select at least one item.';
var text_select_action = 'You have to select an action.';
var text_cancel = 'Cancel';
var text_modify = 'Modify';
var text_spoiler_show = 'Show';
var text_spoiler_hide = 'Hide';

$(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
	$('.edit-cat').on('click', function(event){
		event.preventDefault();
		var Elem = $(this).parent().parent().children('.name');
		var Url = $(this).attr('href');
		var param = $.urlParam(Url);
		var Token = param['token'];
		var Id = param['id'];
		var Name = param['basename'];
		$(Elem).editable(Url, {
			placeholder : '',
			loadurl : site_root +'adm/'+ Name,
			loaddata : { action: 'get-name', id: Id, token: Token },
			loadtext : '<img src="'+ site_root +'adm/style/images/loading.gif">',
			indicator : '<img src="'+ site_root +'adm/style/images/loading.gif">',
			onblur : 'ignore',
			cssclass : 'form-edit'
		});
		return false;
	});
	$('.edit-code').on('click', function(event){
		event.preventDefault();
		var Elem = $(this).parent().parent().children('.code');
		var Url = $(this).attr('href');
		$(Elem).editable(Url, {
			placeholder: '',
			indicator : '<img src="'+ site_root +'adm/style/images/loading.gif">',
			onblur: 'ignore',
			cssclass: 'form-edit'
		});
		return false;
	});
	$('#upload_allowed_types, #avatar_allowed_types').tagit({
	  singleFieldDelimiter: ';',
	  availableTags: [ "gif", "jpg", "jpeg", "png", "bmp", "ico", "tif", "tiff" ]
	});
	$('#moderators').tagit({
	  singleFieldDelimiter: ';'
	});
	$('.image-upload').colorbox({
		maxWidth: '95%',
		maxHeight: '95%',
		rel: true,
		title: false
	});
	$('#selectall').click(function(event) {
		if(this.checked) {
			$('.checkbox-item').each(function() {
				this.checked = true;
			});
		}else{
			$('.checkbox-item').each(function() {
				this.checked = false;
			});
		}
	});
	$('.checkbox-item').change(function(){
		if($('.checkbox-item:checked').length == $('.checkbox-item').length) {
			$('#selectall').prop('checked', true);
		}
		else {
			$('#selectall').prop('checked', false);
		}
	});
    $('#dialog-confirm').dialog({
		autoOpen: false,
		modal: true,
		headerVisible: false,
		resizable: false,
		draggable: false,
		show: 'fade',
		hide: 'puff'
    });
	$('.action-submit').click(function(e){
		e.preventDefault();
		var Form = $(this).closest('form');
		if($('.checkbox-item:checked').length == 0) {
			$('#dialog-confirm').text(text_select_element).dialog({ buttons: { 'OK': function(){$(this).dialog('close');} } }).dialog('open');
			return false;
		}
		if($("select[name='action'] option:selected").val() == '' || $("select[name='action'] option:selected").val() == 'Action') {
			$('#dialog-confirm').text(text_select_action).dialog({ buttons: { 'OK': function(){$(this).dialog('close');} } }).dialog('open');
			return false;
		}
		$('#dialog-confirm').text(text_action_confirmation).dialog({
			buttons: {
				OK: function(){
					$(this).dialog('close');
					var formValues = Form.serialize();
					var url = Form.attr('action');
					$.post(url, formValues, function(data){
						$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
						setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
					});
				},
				Cancel: {
					text: text_cancel,
					click: function(){
						$(this).dialog('close');
					}
				}
			}
		}).dialog('open');
	});
	$('.delete, .alert-action, .synchronize').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$('#dialog-confirm').text(text_action_confirmation).dialog({
			buttons: {
				OK: function(){
					$(this).dialog('close');
					$.get(url, function(data){
						$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
						setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
					});
				},
				Cancel: {
					text: text_cancel,
					click: function(){
						$(this).dialog('close');
					}
				}
			}
		}).dialog('open');
	});
	function imageLoaded() {
		var Img = $(this);
		var oldWidth = Img.width();
		var parentWidth = Img.parent().width();
		var ImgUrl = Img.attr('src');
		if(oldWidth > parentWidth) {
			Img.css({'width': parentWidth, cursor: 'pointer'})
			.tooltip({title: text_enlarge_image})
			.colorbox({
				href: ImgUrl,
				maxWidth: '99%',
				maxHeight: '99%'
			});
		}	
	}
	$('.post-image').each(function(){
		if(this.complete){
			imageLoaded.call(this);
		}
		else {
			$(this).one('load', imageLoaded);
		}
	});
	$('#smiley-display').html('<img src="' +site_root+ 'gallery/smilies/' +$('#smileyurl').val()+ '" />');
	$('#smileyurl').on('change', function() {
		$('#smiley-display').html('<img src="' +site_root+ 'gallery/smilies/' +$(this).val()+ '" />');
	});
	$('.spoiler-top a').text(text_spoiler_show);
});