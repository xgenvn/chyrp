<?php
/*
Plugin Name: Dewplayer
Plugin URI: http://www.royakhosravi.com/?p=3
Description:  Insert Dewplayer (Flash Mp3 Player) in posts & comments.
Author: Roya Khosravi
Version: 1.2
Author URI: http://www.royakhosravi.com/

Updates:
-none

To-Doo: 
-none
*/

$dewplayer_localversion="1.2";
$wp_dewp_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
 // Admin Panel   
function dewplayer_add_pages()
{
	add_options_page('Dewplayer options', 'Dewplayer', 8, __FILE__, 'dewplayer_options_page');            
}
// Options Page
function dewplayer_options_page()
{ 
	global $dewplayer_localversion;
	$status = dewplayer_getinfo();	
	$theVersion = $status[1];
	$theMessage = $status[3];	
	
			if( (version_compare(strval($theVersion), strval($dewplayer_localversion), '>') == 1) )
			{
				$msg = 'Latest version available '.' <strong>'.$theVersion.'</strong><br />'.$theMessage;	
				  _e('<div id="message" class="updated fade"><p>' . $msg . '</p></div>');			
			
			}
			
			

			if (isset($_POST['submitted'])) 
	{	


			$disp_posts = !isset($_POST['disp_posts'])? 'off': 'on';
			update_option('dewplayer_posts', $disp_posts);
			$disp_comments = !isset($_POST['disp_comments'])? 'off': 'on';
			update_option('dewplayer_comments', $disp_comments);
			$disp_link = !isset($_POST['disp_link'])? 'off': 'on';
			update_option('dewplayer_link', $disp_link);

			$dewvs= ($_POST['dewvs']=="")? 'classic': $_POST['dewvs'];
			update_option('dewplayer_dewvs', $dewvs);

			$dewbg= ($_POST['dewbg']=="")? 'FFFFFF': $_POST['dewbg'];
			update_option('dewplayer_dewbg', $dewbg);
			$dewtrans = !isset($_POST['dewtrans'])? '0': '1';	
			update_option('dewplayer_dewtrans', $dewtrans);
			$dewvolume = (int) ($_POST['dewvolume']=="")? '100': $_POST['dewvolume'];	
			update_option('dewplayer_dewvolume', $dewvolume);
			$dewstart = !isset($_POST['dewstart'])? '0': '1';
			update_option('dewplayer_dewstart', $dewstart);
			$dewreplay = !isset($_POST['dewreplay'])? '0': '1';
			update_option('dewplayer_dewreplay', $dewreplay);
			$dewrandomplay = !isset($_POST['dewrandomplay'])? '0': '1';
			update_option('dewplayer_dewrandomplay', $dewrandomplay);
			$dewshowtime = !isset($_POST['dewshowtime'])? '0': '1';
			update_option('dewplayer_dewshowtime', $dewshowtime);
			$dewnopointer = !isset($_POST['dewnopointer'])? '0': '1';
			update_option('dewplayer_dewnopointer', $dewnopointer);					
			
			$msg_status = 'Dewplayer options saved.';
							
		   _e('<div id="message" class="updated fade"><p>' . $msg_status . '</p></div>');
		
	} 
		// vas me chercher le truc dans la base!
		$disp_link = (get_option('dewplayer_link')=='on') ? 'checked':'';		
		$disp_posts = (get_option('dewplayer_posts')=='on') ? 'checked' :'' ;
		$disp_comments = (get_option('dewplayer_comments')=='on') ? 'checked':'';
		$dewvs = get_option('dewplayer_dewvs');
		$dewbg = get_option('dewplayer_dewbg');
		$dewtrans = (get_option('dewplayer_dewtrans')=='1') ? 'checked':'';
		$dewvolume = get_option('dewplayer_dewvolume');
		$dewstart = (get_option('dewplayer_dewstart')=='1') ? 'checked':'';
		$dewreplay = (get_option('dewplayer_dewreplay')=='1') ? 'checked':'';
		$dewrandomplay = (get_option('dewplayer_dewrandomplay')=='1') ? 'checked':'';
		$dewshowtime = (get_option('dewplayer_dewshowtime')=='1') ? 'checked':'';
		$dewnopointer = (get_option('dewplayer_dewnopointer')=='1') ? 'checked':'';

		if ($dewbg=="") $dewbg="FFFFFF";
		if ($dewvolume=="") $dewvolume="100";
		if ($dewvs=="") $dewvs="classic";
	global $wp_version;	
	global $wp_dewp_plugin_url;
	$actionurl=$_SERVER['REQUEST_URI'];
    // Configuration Page
    echo <<<END
<div class="wrap" style="max-width:950px !important;">
	<h2>Dewplayer $dewplayer_localversion</h2>
				
	<div id="poststuff" style="margin-top:10px;">
	
	<div id="sideblock" style="float:right;width:220px;margin-left:10px;"> 
		 <h3>Related</h3>

<div id="dbx-content" style="text-decoration:none;">
<ul>
<li><a style="text-decoration:none;" href="http://www.royakhosravi.com/?p=3">DewPlayer</a></li>
</ul><br />
</div>
 	</div>
	
	 <div id="mainblock" style="width:710px">
	 
		<div class="dbx-content">
		 	<form name="rkform" action="$action_url" method="post">
					<input type="hidden" name="submitted" value="1" /> 
						<h3>Usage</h3>                         
<p>Dewplayer Wordpress plugin allows you to insert DewPlayer (a free flash mp3 Player, under Creative Commons licence) in posts & comments and lets you listen to your favorite music online. Multiple files are separated by a pipe (<strong><font color="#FF0000">|</font></strong>).
Just copy Dewplayer code and paste it into your post or comment.</p>
<p>Usage : <strong><font color="#FF0000">[dewplayer:</font></strong>Path to your mp3 files on local or remote site<strong><font color="#FF0000">]</font></strong></p>

<p>Examples: <br>
<strong><font color="#FF0000">[dewplayer:</font></strong>http://www.mymusic.com/mysong.mp3<strong><font color="#FF0000">]</font></strong><br>
<strong><font color="#FF0000">[dewplayer:</font></strong>song1.mp3<strong><font color="#FF0000">|</font></strong>song2.mp3<strong><font color="#FF0000">|</font></strong>song3.mp3<strong><font color="#FF0000">]</font></strong></p>

<h3>Options</h3>
<p><strong>DewPlayer settings</strong></p>

<div><label for="dewvs">DewPlayer Version</label><br>
END;
$arr = array ("classic" => "Classic (200x20)","mini" => "Mini (160x20)","multi" => "Multi (240x20)");
foreach ($arr as $key => $value) {
	echo '&nbsp;&nbsp;&nbsp;<input type="radio" id="dewvs" name="dewvs" value="'.$key.'" ';
	if ($dewvs == $key) echo 'checked';
	echo ' />'.$value.'<br />';
}
    echo <<<END
</div>

<div><input id="check3" type="checkbox" name="disp_posts" $disp_posts />
<label for="check3">Display DewPlayer in posts</label></div>

<div><input id="check4" type="checkbox" name="disp_comments" $disp_comments />
<label for="check4">Display DewPlayer in comments</label></div>
<div><input id="check2" type="checkbox" name="disp_link" $disp_link />
<label for="check2">Display Mp3 link in RSS feed</label></div>

<br><br><strong>DewPlayer Appearence</strong><br><br>
<div><label for="dewbg">Background color  </label><input id="dewbg"  name="dewbg" value="$dewbg" size="7"/>&nbsp;&nbsp;
<label for="dewtrans">or transparent ? </label><input id="dewtrans" type="checkbox" name="dewtrans" $dewtrans />
</div>

<div><label for="dewvolume">Volume </label><input id="dewvolume"  name="dewvolume" value="$dewvolume" size="7"/>%</div>

<div><label for="dewstart">Auto start ? </label><input type="checkbox" id="dewstart" name="dewstart" $dewstart /></div>
<div><label for="dewreplay">Loop ? </label><input type="checkbox" id="dewreplay" name="dewreplay" $dewreplay /></div>
<div><label for="dewrandomplay">Random play ? </label><input type="checkbox" id="dewrandomplay" name="dewrandomplay" $dewrandomplay /></div>
<div><label for="dewshowtime">Time display (mm:ss) ? </label><input type="checkbox" id="dewshowtime" name="dewshowtime" $dewshowtime /></div>
<div><label for="dewnopointer">No cursor ? </label><input type="checkbox" id="dewnopointer" name="dewnopointer" $dewnopointer /></div>
<br>
<br>
<div class="submit"><input type="submit" name="Submit" value="Update options" /></div>
			</form>
		</div>
					
		<br/><br/><h3>&nbsp;</h3>	
	 </div>

	</div>
<h5>DewPlayer plugin by <a href="http://www.royakhosravi.com/">Roya Khosravi</a></h5>
</div>
END;
}
// Add Options Page
add_action('admin_menu', 'dewplayer_add_pages');

function dewplayer_tag($files) {
	$files = trim($files);
	$dewvs = get_option('dewplayer_dewvs');
	$dewbg = get_option('dewplayer_dewbg');
	$dewtrans = get_option('dewplayer_dewtrans');
	$dewvolume = get_option('dewplayer_dewvolume');
	$dewstart = get_option('dewplayer_dewstart');
	$dewreplay = get_option('dewplayer_dewreplay');
	$dewrandomplay = get_option('dewplayer_dewrandomplay');
	$dewshowtime = get_option('dewplayer_dewshowtime');
	$dewnopointer = get_option('dewplayer_dewnopointer');
	$player = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
	$player .= '/';
	if ($dewvs == 'mini') {
	$player .= 'dewplayer-mini.swf';
	$width="160";
	$height="20";
	} else if ($dewvs == 'multi') {
	$player .= 'dewplayer-multi.swf';
	$width="240";
	$height="20";
	} else {
	$player .= 'dewplayer.swf';
	$width="200";
	$height="20";
	}
	if(($dewtrans==1)&&($dewbg=='')) {
	$add_me_1='';
	$add_me_2='<param name="wmode" value="transparent" />';
	} else if(($dewtrans==0)&&($dewbg!='')) {
	if (substr_count($dewbg, '#') > 0) $dewbg = str_replace( '#', '', $dewbg);
	$add_me_1='&amp;bgcolor='.$dewbg;
	$add_me_2='<param name="bgcolor" value="'.$dewbg.'" />';
	} else {
	$add_me_1='&amp;bgcolor=FFFFFF';
	$add_me_2='<param name="bgcolor" value="FFFFFF" />';
	}
	$dewp_tag = '<!-- Dewplayer Begin-->';
	$dewp_tag .= '<object type="application/x-shockwave-flash" ';
	$dewp_tag .= 'data="'.$player.'?mp3='.$files;
	if($dewstart==1) $dewp_tag .= '&amp;autostart='.$dewstart;
	if($dewreplay==1) $dewp_tag .= '&amp;autoreplay='.$dewreplay;
	if($dewshowtime==1) $dewp_tag .= '&amp;showtime='.$dewshowtime;
	if($dewrandomplay==1) $dewp_tag .= '&amp;randomplay='.$dewrandomplay;
	if($dewnopointer==1) $dewp_tag .= '&amp;nopointer='.$dewnopointer;
	$dewp_tag .= $add_me_1; 
	$dewp_tag .= '" width="'.$width.'" height="'.$height.'">';
	$dewp_tag .= $add_me_2;
	$dewp_tag .= '<param name="movie" value="'.$player.'?mp3='.$files;
	if($dewstart==1) $dewp_tag .= '&amp;autostart='.$dewstart;
	if($dewreplay==1) $dewp_tag .= '&amp;autoreplay='.$dewreplay;
	if($dewshowtime==1) $dewp_tag .= '&amp;showtime='.$dewshowtime;
	if($dewrandomplay==1) $dewp_tag .= '&amp;randomplay='.$dewrandomplay;
	if($dewnopointer==1) $dewp_tag .= '&amp;nopointer='.$dewnopointer;
	$dewp_tag .= $add_me_1;
	$dewp_tag .= '" /></object>';
	$dewp_tag .= '<!-- Dewplayer End-->';	

if (is_feed())
{
    if (get_option('dewplayer_link')=='on') {
		if (substr_count($files, '|') > 0) {
			$mp3files = explode("|", $files);
			if ($mp3files !== false) {        
				foreach ($mp3files as $key => $value) {
					$dewp_tag.='<a href="'.$value.'">'.$value.'</a><br>';
				}
			}


		} else {
			$dewp_tag.='<a href="'.$files.'">'.$files.'</a>';
		}
	}
}

	return $dewp_tag;
}


function dewplayer_check($the_content) {
	if(strpos($the_content, "[dewplayer:")!==FALSE) {

		preg_match_all('/\[dewplayer:([)a-zA-Z0-9\/:\.\|\-_\s%#]+)/', $the_content, $matches, PREG_SET_ORDER); 
		foreach($matches as $match) { 
		$the_content = preg_replace("/\[dewplayer:([)a-zA-Z0-9\/:\.\|\-_\s%#]+)\]/", dewplayer_tag($match[1]), $the_content,1);
		}
		
	}



    return $the_content;

}

function dewplayer_install(){
  if(get_option('dewplayer_posts' == '') || !get_option('dewplayer_posts')){
    add_option('dewplayer_posts', 'on');
  }
  if(get_option('dewplayer_link' == '') || !get_option('dewplayer_link')){
    add_option('dewplayer_link', 'on');
  } 
  if(get_option('dewplayer_dewbg' == '') || !get_option('dewplayer_dewbg')){
    add_option('dewplayer_dewbg', 'FFFFFF');
  } 
  if(get_option('dewplayer_dewvs' == '') || !get_option('dewplayer_dewvs')){
    add_option('dewplayer_dewvs', 'classic');
  } 
  if(get_option('dewplayer_dewtrans' == '') || !get_option('dewplayer_dewtrans')){
    add_option('dewplayer_dewtrans', '0');
  } 
  if(get_option('dewplayer_dewvolume' == '') || !get_option('dewplayer_dewvolume')){
    add_option('dewplayer_dewvolume', '100');
  } 
  if(get_option('dewplayer_dewstart' == '') || !get_option('dewplayer_dewstart')){
    add_option('dewplayer_dewstart', '0');
  } 
  if(get_option('dewplayer_dewreplay' == '') || !get_option('dewplayer_dewreplay')){
    add_option('dewplayer_dewreplay', '0');
  } 
  if(get_option('dewplayer_dewrandomplay' == '') || !get_option('dewplayer_dewrandomplay')){
    add_option('dewplayer_dewrandomplay', '0');
  } 
  if(get_option('dewplayer_dewshowtime' == '') || !get_option('dewplayer_dewshowtime')){
    add_option('dewplayer_dewshowtime', '0');
  } 
  if(get_option('dewplayer_dewnopointer' == '') || !get_option('dewplayer_dewnopointer')){
    add_option('dewplayer_dewnopointer', '0');
  } 

//// on peut ajouter d'autres options par defaut
}

if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
    dewplayer_install();
}

if (get_option('dewplayer_posts')=='on')  {
	add_filter('the_content', 'dewplayer_check', 100);
	add_filter('the_excerpt','dewplayer_check', 100);
	

}
if (get_option('dewplayer_comments')=='on') {
	add_filter('comment_text','dewplayer_check', 100);

}

add_action( 'plugins_loaded', 'dewplayer_install' );

add_action( 'after_plugin_row', 'dewplayer_check_plugin_version' );

function dewplayer_getinfo()
{
		$checkfile = "http://www.royakhosravi.com/pub/Dewplayer_wordpress_plugin_version.txt";
		
		$status=array();
		return $status;
		$vcheck = wp_remote_fopen($checkfile);
				
		if($vcheck)
		{
			$version = $dewplayer_localversion;
									
			$status = explode('@', $vcheck);
			return $status;				
		}					
}

function dewplayer_check_plugin_version($plugin)
{
	global $plugindir,$dewplayer_localversion;
	
 	if( strpos($plugin,'dewplayer.php')!==false )
 	{
			

			$status=dewplayer_getinfo();
			
			$theVersion = $status[1];
			$theMessage = $status[3];	
	
			if( (version_compare(strval($theVersion), strval($dewplayer_localversion), '>') == 1) )
			{
				$msg = 'Latest version available '.' <strong>'.$theVersion.'</strong><br />'.$theMessage;				
				echo '<td colspan="5" class="plugin-update" style="line-height:1.2em;">'.$msg.'</td>';
			} else {
				return;
			}
		
	}
}
?>
