<?php if(!class_exists('raintpl')){exit;}?><script type="text/javascript">
$(document).on('click', '.bbcode-colors a', function(e) {
	e.preventDefault();
	return false;
});

$(document).on("mousedown", "[data-bbcode]", function() {
	var editor = $('#message');
    var start = editor[0].selectionStart;
    var end = editor[0].selectionEnd;
    var str = $(editor).val();
	var textStart = $(editor).val().substring(0, start);
    var textSelected = $(editor).val().substring(start, end);
	var textEnd = $(editor).val().substring(end, $(editor).val().length);
	var bbcode = $(this).attr("data-bbcode");

	if(bbcode.startsWith('color-')) {
		var color = bbcode.split('-')[1];
		var newText = "[color=" + color + "]" + textSelected + "[/color]";
		var newStart = start + color.length + 8;
		var newEnd = start + newText.length - 8;
		$('.dropdown-menu.bbcode-colors').dropdown();
	}
	else if(bbcode == 'list' && textSelected.length > 0) {
		var newText = "[list][*]" + textSelected.replace(/\r?\n/g, "\n[*]") + "[/list]";
		var newStart = start + 9;
		var newEnd = start + newText.length - 7;
	}
	else {
		var newText = "[" + bbcode + "]" + textSelected + "[/" + bbcode + "]";
		var newStart = start + bbcode.length + 2;
		var newEnd = start + newText.length - (bbcode.length + 3);
	}

	$(editor).val(textStart + newText + textEnd);
	$(editor)[0].selectionStart = newStart;
	$(editor)[0].selectionEnd = newEnd;
	// $(editor)[0].setSelectionRange(start, newText.length);
	$(editor).focus();
	return false;
});
</script>
<div class="btn-toolbar editor-buttons" role="toolbar">
  <div class="btn-group" role="group">
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["bold"];?>" data-bbcode="b"><i class="fa fa-bold"></i></button>
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["italic"];?>" data-bbcode="i"><i class="fa fa-italic"></i></button>
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["underline"];?>" data-bbcode="u"><i class="fa fa-underline"></i></button>
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["strikethrough"];?>" data-bbcode="s"><i class="fa fa-strikethrough"></i></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["left_align"];?>" data-bbcode="left"><i class="fa fa-align-left"></i></button>
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["center_align"];?>" data-bbcode="center"><i class="fa fa-align-center"></i></button>
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["right_align"];?>" data-bbcode="right"><i class="fa fa-align-right"></i></button>
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["justify"];?>" data-bbcode="justify"><i class="fa fa-align-justify"></i></button>
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["list"];?>" data-bbcode="list"><i class="fa fa-list"></i></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["quote"];?>" data-bbcode="quote"><i class="fa fa-quote-left"></i></button>
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["picture"];?>" data-bbcode="img"><i class="fa fa-picture-o"></i></button>
	<button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["link"];?>" data-bbcode="url"><i class="fa fa-link"></i></button>
    <button type="button" class="btn btn-dark" aria-label="Youtube" data-bbcode="youtube"><i class="fa fa-youtube-play"></i></button>
	<button type="button" class="btn btn-dark list-smileys" aria-label="<?php echo $lang_bbcode["smileys"];?>"><i class="fa fa-smile-o"></i></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-dark" aria-label="<?php echo $lang_bbcode["code"];?>" data-bbcode="code"><i class="fa fa-code"></i></button>
	<div class="btn-group" role="group">
	  <button id="menu-bbcode-colors" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="<?php echo $lang_bbcode["colors"];?>"><i class="fa fa-paint-brush"></i> <span class="caret"></span></button>
	  <ul class="dropdown-menu bbcode-colors" aria-labelledby="menu-bbcode-colors">
	    <li><a href="" data-bbcode="color-red"><?php echo $lang_bbcode["red"];?></a></li>
		<li><a href="" data-bbcode="color-green"><?php echo $lang_bbcode["green"];?></a></li>
	    <li><a href="" data-bbcode="color-yellow"><?php echo $lang_bbcode["yellow"];?></a></li>
		<li><a href="" data-bbcode="color-blue"><?php echo $lang_bbcode["blue"];?></a></li>
		<li><a href="" data-bbcode="color-gray"><?php echo $lang_bbcode["gray"];?></a></li>
		<li><a href="" data-bbcode="color-brown"><?php echo $lang_bbcode["brown"];?></a></li>
		<li><a href="" data-bbcode="color-purple"><?php echo $lang_bbcode["purple"];?></a></li>
		<li><a href="" data-bbcode="color-orange"><?php echo $lang_bbcode["orange"];?></a></li>
		<li><a href="" data-bbcode="color-pink"><?php echo $lang_bbcode["pink"];?></a></li>
	  </ul>
	</div>
    <button type="button" class="btn btn-dark" aria-label="Spoiler" data-bbcode="spoiler"><i class="fa fa-eye-slash"></i></button>
  </div>
</div>