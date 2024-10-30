<?php
/* 
Plugin Name: MouseOver Plugin 
Plugin URI: http://mouseoverplugin.com/
Description: A plugin to change the image, text and links when you place the mouse on it.   
Author: http://mouseoverplugin.com 
Version: 1.0
*/
		
// add MouseOver Plugin menu in admin settings

define('MOUSE_OVER','mouseover-free');
define('MOUSE_OVER_PATH',plugins_url(MOUSE_OVER));

add_action( 'init', 'wpimageflip_init' );
global $wpdb;

function wpimageflip_init(){
	add_action( 'admin_menu', 'wpimageflip_admin_menu' );
}

function wpimageflip_admin_menu() {
	global $wpdb;
	add_menu_page('WP Image Flip Options', 'Mouse Over Free', 'manage_options', 'mouseover_plugin', 'wp_image_flip_admin', MOUSE_OVER_PATH.'/images/mimage.png');
}

function wpimageflip_admin_js() {
if(is_admin()){
	wp_enqueue_script("jquery");			
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('wp-color-picker');
	
	wp_register_script('imageup',MOUSE_OVER_PATH.'/js/imageup.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('imageup');
 }
} 

function wpimageflip_admin_css() {
	wp_register_style('style', MOUSE_OVER_PATH .'/css/style.css');
	wp_register_style('jquery-ui-css', MOUSE_OVER_PATH .'/css/jquery-ui-css.css');
	
	wp_enqueue_style('style');
	wp_enqueue_style('jquery-ui-css');
	wp_enqueue_style('thickbox');
	wp_enqueue_style('wp-color-picker');

} 

function flip_user_script(){
    wp_enqueue_script("jquery");
	wp_register_script('mouseover_user', MOUSE_OVER_PATH .'/js/mouseover_user.js'); 
	wp_enqueue_script('mouseover_user');
?>
<style type="text/css">
.image-flip-wrap {
	float:left;
	width:<?php echo get_option('pwidth'); ?>px;
	min-height:<?php echo get_option('pheight'); ?>px;
	background-color:<?php echo get_option('pbgcolor'); ?>;
	padding:5px;
}
.image-flip-text {
	float:left;
	width:<?php echo get_option('textwidth'); ?>px;
	background-color:<?php echo get_option('textbgcolor'); ?>;
	padding:5px;
	font-family: Arial, Helvetica, sans-serif;
	color:<?php echo get_option('textcolor'); ?>;
	font-size:14px;
	font-weight:bold;
	text-align:center;
}
.image-flip-text a{
	font-family: Arial, Helvetica, sans-serif;
	color:<?php echo get_option('textcolor'); ?>;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
}
.flip-image {
	float:left;
	width:<?php echo get_option('imagedivwidth'); ?>px;
}
.inner-flip-image-first {
    float:left;
	width:<?php echo get_option('imagewidth'); ?>px;
    margin-right:5px;
}
.inner-flip-image-second {
    float:right;
	width:<?php echo get_option('imagewidth'); ?>px;
    text-align:center;
}
.flip-image img {
	cursor:pointer;
	max-width:100%;
    border:none;
}
</style>
    <?php
}	

add_action('wp_print_scripts', 'wpimageflip_admin_js');
add_action('admin_print_styles', 'wpimageflip_admin_css');
add_action('wp_head', 'flip_user_script');

function set_image_options() {
	add_option('pwidth','500','');
	add_option('pheight','200','');
	add_option('pbgcolor','#fffff','');
	
	add_option('textwidth','490');
	add_option('textbgcolor','#cccccc','');
	add_option('textcolor','#000000','');
	
	add_option('imagedivwidth', '245');
	add_option('imagewidth', '183.75');
	
	add_option('enable1','','');
	add_option('default_img1','','');
	add_option('mouseover_img1','','');
	add_option('image_text1','','');
	add_option('image_url1','','');
	add_option('opennwindow1','','');
	
	add_option('enable2','','');
	add_option('default_img2','','');
	add_option('mouseover_img2','','');
	add_option('image_text2','','');
	add_option('image_url2','','');
	add_option('opennwindow2','','');
}

function unset_image_options() {
	delete_option('pwidth');
	delete_option('pheight');
	delete_option('pbgcolor');
	delete_option('textbgcolor');
	delete_option('textcolor');
	
	delete_option('textwidth');
	delete_option('imagedivwidth');
	delete_option('imagewidth');
	
	delete_option('enable1');
	delete_option('default_img1');
	delete_option('mouseover_img1');
	delete_option('image_text1');
	delete_option('image_url1');
	delete_option('opennwindow1');
	
	delete_option('enable2');
	delete_option('default_img2');
	delete_option('mouseover_img2');
	delete_option('image_text2');
	delete_option('image_url2');
	delete_option('opennwindow2');
}

register_activation_hook(__FILE__,'set_image_options');
register_uninstall_hook(__FILE__,'unset_image_options');

if($_POST['options_image'] == "process-image") {
   
	$textwidth	    =	$_REQUEST['pwidth'] - 10;
	$imagedivwidth	=	($_REQUEST['pwidth'])/2;
	$imagewidth		=	($_REQUEST['pwidth']-5)/2;
	
	update_option('pwidth' ,$_REQUEST['pwidth']);
	update_option('pheight' ,$_REQUEST['pheight']);
	update_option('pbgcolor' ,$_REQUEST['pbgcolor']);
	update_option('textbgcolor' ,$_REQUEST['textbgcolor']);
	update_option('textcolor' ,$_REQUEST['textcolor']);
	
	update_option('textwidth', $textwidth );
	update_option('imagedivwidth', $imagedivwidth);
	update_option('imagewidth', $imagewidth);
	
	update_option('enable1',$_REQUEST['enable1']);
	update_option('default_img1',$_REQUEST['default_img1']);
	update_option('mouseover_img1',$_REQUEST['mouseover_img1']);
	update_option('image_text1',$_REQUEST['image_text1']);
	update_option('image_url1',$_REQUEST['image_url1']);
	update_option('opennwindow1',$_REQUEST['opennwindow1']);
	
	update_option('enable2',$_REQUEST['enable2']);
	update_option('default_img2',$_REQUEST['default_img2']);
	update_option('mouseover_img2',$_REQUEST['mouseover_img2']);
	update_option('image_text2',$_REQUEST['image_text2']);
	update_option('image_url2',$_REQUEST['image_url2']);
	update_option('opennwindow2',$_REQUEST['opennwindow2']);
	
	$textwidth	    =	get_option('pwidth') - 10;
	$imagedivwidth	=	($textwidth)/2;
	$imagewidth		=	$imagedivwidth/1.5;
} 

function wp_image_flip_admin(){
?>
<div class="wrap">
  <?php 
		$runningVer = mouseover_free_get_version();
		$currentVer = mouseover_free_update_message();	
		if((float)$runningVer < (float)$currentVer){	
    ?>
  <div class="updated-fade-free">Version <?php echo $currentVer; ?> of Mouse Over Premium plugin is now available with much more features and options! <a href="http://www.mouseoverplugin.com">Click Here</a> to upgrade! </div>
  <?php } ?>
  <?php
	if(isset($_POST['submit'])){?>
  <div class="success-fade">Plugin has successfully saved, Please paste the short code <b>[MouseOver_01]</b> on the page or post, where you want the plugin.</div>
  <?php } ?>
  <div class="flip-heading-free">
    <p> <img src="<?php echo MOUSE_OVER_PATH; ?>/images/MouseOver_logo.png" /><br />
      <span style="color:#2c7ca7;font-size:15px;font-weight:bold;"> <a href="">Click here to See Our Latest WP Plugins</a> </span> </p>
  </div>
  <div class="updated-fade-free">
    <p> <span style="color:#2c7ca7;font-size:15px;font-weight:bold;">Welcome to Mouse Over plugin admin area</span><br>
      <br>
      To add new MouseOver plugin, please click the <b>"Icon Settings" tab</b> and upload images, add text and links.<br><b>"Plugin Settings" tab</b> provides with plugin size, background and text settings options.<br>
      Click the <b>"Save changes" button</b> for your plugin to get created and corresponding shortcode <b>[MouseOver_01]</b> will be available.<br>
      Copy and paste the shortcode on necessary page or post.<br><br>
	  <b><span style="color:#2c7ca7;font-size:15px;font-weight:bold;">MouseOver Plugin Premium allows you to:</span></b>
<br>+ Create unlimited short-codes to place anywhere on your website<br> 
+ Place the short-code <b>on sidebars and widgets</b><br> 
+ Upload your images or use <b>built-in graphics</b><br>
+ Write your own text<br>
+ Link images and text anywhere<br>
+ Choose backgrounds and sizes<br>
+ Simply place a short code anywhere in your posts, pages, widgets or sidebars<br>
<span style="color:#2c7ca7;font-size:15px;font-weight:bold;">For more features and to Download MouseOver Plugin premium, <a href="http://www.mouseoverplugin.com">click here!</a> </span>
    </p>
  </div>
  <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>&updated=true">
    <input type="hidden" name="options_image" value="process-image" />
    <div class="outer-tab">
      <div class="plugin-name">Mouse Over Plugin</div>
      <div id="tabs">
        <ul>
          <li><a href="#tabs-1">Icon1 Settings</a></li>
          <li><a href="#tabs-2">Icon2 Settings</a></li>
          <li><a href="#tabs-3">Plugin Settings</a></li>
        </ul>
        <div id="tabs-1">
          <p>
          <table>
            <tr>
              <td>Enable</td>
              <td><input type="radio" name="enable1" value="Yes" <?php if(get_option('enable1')=='Yes'){ echo "checked"; } ?> >
                Yes &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="enable1" value="no" <?php if(get_option('enable1')=='no'){ echo "checked"; } ?>>
                No</td>
            </tr>
            <tr>
              <td><label>Choose or Upload default Image</label>
              </td>
              <td><input id='default_img_id1' name='default_img1' size='40' type='text'  value='<?php echo get_option('default_img1'); ?>'  /></td>
              <td><input id='1' class="uploadbtn" name='default_img_upload_btn1' type='button' value='Upload'/></td>
            </tr>
            <tr>
              <td><label>Choose or Upload Mouse-over Image</label></td>
              <td><input id='mouseover_img_id1' name='mouseover_img1' size='40' type='text' value='<?php echo get_option('mouseover_img1'); ?>' /></td>
              <td><input id='1' class="roluploadbtn"  name='mouseover_img_upload_btn' type='button' value='Upload' /></td>
            </tr>
            <tr>
              <td valign="top"><label>Insert Text</label></td>
              <td><textarea id='image_text_id1' name='image_text1'><?php echo get_option('image_text1'); ?></textarea></td>
              <td><img id="default_img1" width="40" height="40" src="<?php echo get_option('default_img1'); ?>"/> <img id="mouseover_img1" width="40" height="40" src="<?php echo get_option('mouseover_img1'); ?>"/> </td>
            </tr>
            <tr>
              <td><label>Insert Link (URL)</label></td>
              <td><input id='image_url_id1'  name='image_url1' type='text' value='<?php echo get_option('image_url1'); ?>'/>
                &nbsp;
                <input type="checkbox" name="opennwindow1" value="yes" <?php if(get_option('opennwindow1')=='yes'){ echo "checked"; } ?> />
                Open in new window</td>
              <td></td>
            </tr>
          </table>
          </p>
        </div>
        <div id="tabs-2">
          <p>
          <table>
            <tr>
              <td>Enable</td>
              <td><input type="radio" name="enable2" value="Yes" <?php if(get_option('enable2')=='Yes'){ echo "checked"; } ?>>
                Yes &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="enable2" value="no" <?php if(get_option('enable2')=='no'){ echo "checked"; } ?>>
                No</td>
            </tr>
            <tr>
              <td><label>Upload default Image</label></td>
              <td><input id='default_img_id2' name='default_img2' size='40' type='text'  value='<?php echo get_option('default_img2'); ?>'  /></td>
              <td><input id='2' class="uploadbtn"  name='default_img_upload_btn2' type='button' value='Upload button'/></td>
            </tr>
            <tr>
              <td><label>Upload Mouse-over Image</label></td>
              <td><input id='mouseover_img_id2' name='mouseover_img2' size='40' type='text' value='<?php echo get_option('mouseover_img2'); ?>' /></td>
              <td><input id='2' class="roluploadbtn" name='mouseover_img_upload_btn2' type='button' value='Upload button' /></td>
            </tr>
            <tr>
              <td valign="top"><label>Insert Text</label></td>
              <td><textarea id='image_text_id2' name='image_text2'><?php echo get_option('image_text2'); ?></textarea></td>
              <td><img id="default_img2" width="40" height="40" src="<?php echo get_option('default_img2'); ?>"/> <img id="mouseover_img2" width="40" height="40" src="<?php echo get_option('mouseover_img2'); ?>"/> </td>
            </tr>
            <tr>
              <td><label>Insert Link (URL)</label></td>
              <td><input id='image_url_id2'  name='image_url2' type='text' value='<?php echo get_option('image_url2'); ?>'/>
                &nbsp;
                <input type="checkbox" name="opennwindow2" value="yes" <?php if(get_option('opennwindow2')=='yes'){ echo "checked"; } ?> />
                Open in new window</td>
              <td></td>
            </tr>
          </table>
          </p>
        </div>
        <div id="tabs-3">
          <p>
          <table>
            <tr>
              <td>Size</td>
              <td>Width
                <input type="text" name="pwidth" value='<?php echo get_option('pwidth'); ?>' size="10" /></td>
              <td>Height
                <input type="text" name="pheight" value='<?php echo get_option('pheight'); ?>' size="10" /></td>
            </tr>
            <tr>
              <td valign="top">Default Plugin Background Setting:</td>
              <td colspan="2"><input type="text" value="<?php echo get_option('pbgcolor');?>" name="pbgcolor" class="color" id="wpcv_label_color" /></td>
            </tr>
            <tr>
              <td valign="top">Default Textline Background Setting:</td>
              <td colspan="2"><input type="text" value="<?php echo get_option('textbgcolor');?>" name="textbgcolor" class="color" id="wpcv_label_color" /></td>
            </tr>
            <tr>
              <td valign="top">Default Textline color Setting:</td>
              <td colspan="2"><input type="text" value="<?php echo get_option('textcolor');?>" name="textcolor" class="color" id="wpcv_label_color" /></td>
            </tr>
          </table>
          </p>
        </div>
        <div class="submit">
          <input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?> " />
        </div>
      </div>
    </div>
  </form>
</div>
<?php
}
function image_flip_shortcode(){
ob_start();
?>
<div class="image-flip-wrap">
  <?php if(get_option('enable1')=='Yes'){ ?>
  <div class="flip-image">
    <div class="inner-flip-image-first">
      <?php if(get_option('image_url1') != ' '){ ?>
      <a href="<?php echo addhttpurl(get_option('image_url1')); ?>" <?php if(get_option('opennwindow1')=='yes'){ ?>target="_blank" <?php }else{?> target="_self" <?php }?> ><?php } ?><img src="<?php echo get_option('default_img1'); ?>" title="<?php echo get_option('image_text1'); ?>" onmouseover="this.src='<?php echo get_option('mouseover_img1'); ?>'" onmouseout="this.src='<?php echo get_option('default_img1'); ?>'">
      <?php if(get_option('image_url1') != ' '){ ?></a><?php } ?>
    </div></div>
  <?php } if(get_option('enable2')=='Yes'){ ?>
  <div class="flip-image" >
    <div class="inner-flip-image-second">
      <?php if(get_option('image_url2') != ''){ ?>
      <a href="<?php echo addhttpurl(get_option('image_url2')); ?>" <?php if(get_option('opennwindow2')=='yes'){ ?>target="_blank" <?php }else{?> target="_self" <?php }?> ><?php } ?><img src="<?php echo get_option('default_img2'); ?>" title="<?php echo get_option('image_text2'); ?>" onmouseover="this.src='<?php echo get_option('mouseover_img2'); ?>'" onmouseout="this.src='<?php echo get_option('default_img2'); ?>'"><?php if(get_option('image_url2') != ''){ ?></a>
      <?php } ?>
    </div></div>
  <?php } 
   if(get_option('enable1') == 'Yes'){
     $leastno = '1';
   }else{
     $leastno = '2';
   }
  ?>
  <div class="image-flip-text">
    <?php if(get_option('image_url'.$leastno) != ''){ ?>
    <a href="<?php echo addhttpurl(get_option('image_url'.$leastno)); ?>" <?php if(get_option('opennwindow'.$leastno)=='yes'){ ?>target="_blank" <?php }else{?> target="_self" <?php }?> ><?php } ?><?php echo get_option('image_text'.$leastno); ?><?php if(get_option('image_url'.$leastno) != ''){ ?></a>
    <?php } ?>
  </div>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'MouseOver_01', 'image_flip_shortcode' );

function addhttpurl($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function mouseover_free_update_message(){
    // readme contents
	$file           = 'http://plugins.trac.wordpress.org/browser/mouseover-free/trunk/readme.txt?format=txt';
    $data           = file($file);
	$stabletag      = $data[6];
	$currentversion = str_replace('Stable tag: ','',$stabletag);	
	return($currentversion);
}

function mouseover_free_get_version() {
	$plugin_data    = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}
?>