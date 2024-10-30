jQuery(document).ready(function() {

jQuery('.uploadbtn').click(function() {
	btnID    =  jQuery(this).attr('id');
	textID   = '#default_img_id'+btnID;
	uploadID = jQuery(textID);
	imgID    = '#default_img'+btnID;
 	imgfield = jQuery(imgID);
 	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 	return false;
});

jQuery('.roluploadbtn').click(function() {
	btnID    =  jQuery(this).attr('id');
	textID   = '#mouseover_img_id'+btnID;
	uploadID = jQuery(textID);
	imgID    = '#mouseover_img'+btnID;
 	imgfield = jQuery(imgID);
 	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 	return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 uploadID.val(imgurl);
 imgfield.attr('src',imgurl)
 tb_remove();
}

jQuery( "#tabs" ).tabs();
jQuery('.color').wpColorPicker();
});