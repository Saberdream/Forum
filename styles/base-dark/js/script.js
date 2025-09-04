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
var text_action_confirmation = 'Are you sure you want to do this action on the selected items?';
var text_select_element = 'You have to select at least one item.';
var text_select_action = 'You have to select an action.';
var text_cancel = 'Cancel';
var text_modify = 'Modify';
var text_spoiler_show = 'Show';
var text_spoiler_hide = 'Hide';

$(function(){
	$('[data-toggle="tooltip"], .bt-forum, .bt-topic').tooltip({
		trigger: 'hover',
		container: 'body'
	});
	$('.editor-buttons button').tooltip({
		trigger: 'hover',
		container: 'body',
		title: function(){
			return $(this).attr('aria-label');
		}
	});
	$('#upload_allowed_types').tagit({
	  singleFieldDelimiter: ';',
	  availableTags: [ "gif", "jpg", "jpeg", "png", "bmp", "ico", "tif", "tiff" ]
	});
	$('.image-upload').colorbox({
		maxWidth: '95%',
		maxHeight: '95%',
		rel: true
	});
	
	$('.list-smileys').colorbox({
		href: site_root+'smileys',
		iframe: true,
		width: '60%',
		height: '95%',
		maxWidth: '95%',
		maxHeight: '95%',
		innerWidth: '50%',
		innerHeight: '95%'
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
		if($("select[name='action'] option:selected").val() == '') {
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
	$('.moder-form .checkbox-item, .moder-form #selectall').change(function(){
		$('.navbar-fixed-bottom').css('display', 'block');
	});
	$('.navbar-fixed-bottom .close').on('click', function(){
		$(this).parent().css('display', 'none');
	});
	$('.bt-forum').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$('#dialog-confirm').text(text_action_confirmation).dialog({
			buttons: {
				OK: function(){
					$(this).dialog('close');
					$.get(url, function(data){
						$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
						// setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
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
	$('.bt-topic').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$.get(url, function(data){
			$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
			setTimeout(function(){$('#dialog-confirm').dialog('close');}, 300);
		});
	});
	$('.bt-kick-user').colorbox({
		iframe: true,
		width: '100%',
		height: '100%',
		maxWidth: '550px',
		maxHeight: '300px'
	});
	$('.bt-forum-subscribe').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$.get(url, function(data){
			$('#dialog-confirm').html(data);
			$('#dialog-confirm').dialog({ buttons: [] }).dialog('open');
			setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
		});
	});
	$('.bt-alert-post').colorbox({
		iframe: true,
		width: '95%',
		height: '95%',
		maxWidth: '500px',
		maxHeight: '500px'
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
	$('.bt-edit-post').on('click', function(event){
		event.preventDefault();
		event.stopPropagation();
		var Elem = $(this).parent().parent().next();
		var Url = $(this).attr('href');
		var param = $.urlParam(Url);
		var Forum = param['forum'];
		var Topic = param['topic'];
		var Token = param['token'];
		var Id = param['id'];
		var Name = param['basename'];
		var Token2 = $('input[name=get_post_token]').val();
		$(Elem).editable(site_root + 'posting.php', {
			loadurl     : site_root + 'viewtopic.php',
			loaddata    : { 'id': Topic, 'get-post': Id, 'token': Token2 },
			loadtext    : '<img src="'+site_root+'styles/base/images/loading.gif" />',
			indicator	: '<img src="'+site_root+'styles/base/images/loading.gif" />',
			onblur      : 'ignore',
			cssclass    : 'post-edit',
			type		: 'textarea',
			cancel		: '<button class="btn btn-black">'+text_cancel+'</button>',
			submit		: '<button class="btn btn-warning">'+text_modify+'</button>',
			height		: 'auto',
			onblur		: false,
			submitdata	: { 'mode': 'edit', 'forum': Forum, 'topic': Topic, 'postid': Id, 'token': Token },
			callback : function(value, settings) {
				$('.post-image').each(function(){
					if(this.complete){
						imageLoaded.call(this);
					}
					else {
						$(this).one('load', imageLoaded);
					}
				});
				$('.spoiler-top a').text(text_spoiler_show);
			}
		});
		return false;
	});
	$('.post-image').each(function(){
		if(this.complete){
			imageLoaded.call(this);
		}
		else {
			$(this).one('load', imageLoaded);
		}
	});
	$('.bt-refresh').on('click', function(e){
		e.preventDefault();
		window.location.reload();
	});
	$('.user-profile').colorbox({
		iframe: true,
		width: '100%',
		maxWidth: '590px',
		height: '75%'
	});
	$('.user_avatar').colorbox({
		maxWidth: '99%',
		maxHeight: '99%'
	});
	$('.spoiler-top a').text(text_spoiler_show);
	$('#button-preview').on('click', function(){
		var Text = $('#message').val();
		var Token = $('input[name=token_preview]').val();
		$.post(site_root + 'preview.php', {
				message: Text,
				token: Token
			}, function(data){
			$('#message-preview .post_body').html(data);
			$('.post-image').each(function(){
				if(this.complete){
					imageLoaded.call(this);
				}
				else {
					$(this).one('load', imageLoaded);
				}
			});
			$('.spoiler-top a').text(text_spoiler_show);
		});
		if($('#message-preview').css('display') == 'none') {
			$('#message-preview').css('display', 'block');
		}
	});
});