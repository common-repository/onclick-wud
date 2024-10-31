<?php
 /*
=== OnClick WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	function onclick_wud_options_notice() {
	global $jqwfuncs;
		echo '<div class="onclick-wud-admin-table">';
		echo '<h2 class="onclick-wud-admin-h2">'.__("OnClick WUD Options", "onclick-wud").' - '.__("OnClick events in Posts and Pages", "onclick-wud").'! (Version: '.$jqwfuncs['onclick_wud_version'].')</h2>';
		echo '<img src="' . plugins_url( '../images/logo-onclick-wud.png', __FILE__ ) . '">';
		echo '<a id="onclick-rate-it" href="https://wordpress.org/support/plugin/onclick-wud" target="_blank" title="100% FREE PRO SUPPORT" ><img src="' . plugins_url( '../images/wud-support.png', __FILE__ ) . '"></a>';
		echo '<p><a href="https://wud-plugins.com" class="button-primary" id="onclick-pub-wud" target="_blank" title="100% FREE WUD PLUGINS" ><strong><font color="white">CLICK HERE TO DISCOVER<br> MORE WUD FREE PLUGINS</font></strong></a></p>';
		
		//SAVE THE VALUES TO WP_OPTIONS
	if ( isset($_POST['wud_opt_hidden']) && $_POST['wud_opt_hidden'] == 'Y' ) {
			
		if ( isset($_POST['onclick_wud_but_bcolor']) && !$_POST['onclick_wud_but_bcolor']=='') {$onclick_wud_but_bcolor = filter_var($_POST['onclick_wud_but_bcolor'], FILTER_SANITIZE_STRING);} else{$onclick_wud_but_bcolor ="#F73535";}
		update_option('onclick_wud_but_bcolor', $onclick_wud_but_bcolor);

		if ( isset($_POST['onclick_wud_hover_bcolor']) && !$_POST['onclick_wud_hover_bcolor']=='') {$onclick_wud_hover_bcolor = filter_var($_POST['onclick_wud_hover_bcolor'], FILTER_SANITIZE_STRING);} else{$onclick_wud_hover_bcolor ="#F73535";}
		update_option('onclick_wud_hover_bcolor', $onclick_wud_hover_bcolor);
		
		if ( isset($_POST['onclick_wud_but_fcolor']) && !$_POST['onclick_wud_but_fcolor']=='') {$onclick_wud_but_fcolor = filter_var($_POST['onclick_wud_but_fcolor'], FILTER_SANITIZE_STRING);} else{$onclick_wud_but_fcolor ="#FFFFFF";}
		update_option('onclick_wud_but_fcolor', $onclick_wud_but_fcolor);	
		
		$onclick_wud_but_font_size = filter_var($_POST['onclick_wud_but_font_size'], FILTER_SANITIZE_STRING);
		if($onclick_wud_but_font_size==''){$onclick_wud_but_font_size='14';}
		update_option('onclick_wud_but_font_size', ($onclick_wud_but_font_size/10));

		$onclick_wud_font_button = filter_var($_POST['onclick_wud_font_button'], FILTER_SANITIZE_STRING);
		update_option('onclick_wud_font_button', $onclick_wud_font_button);

		$onclick_wud_round_button = filter_var($_POST['onclick_wud_round_button'], FILTER_SANITIZE_STRING);
		update_option('onclick_wud_round_button', $onclick_wud_round_button);

		$onclick_wud_border_size = filter_var($_POST['onclick_wud_border_size'], FILTER_SANITIZE_STRING);
		update_option('onclick_wud_border_size', $onclick_wud_border_size);	

		if ( isset($_POST['onclick_wud_border_color']) && !$_POST['onclick_wud_border_color']=='') {$onclick_wud_border_color = filter_var($_POST['onclick_wud_border_color'], FILTER_SANITIZE_STRING);} else{$onclick_wud_border_color ="#F73535";}
		update_option('onclick_wud_border_color', $onclick_wud_border_color);

		$onclick_wud_padding = filter_var($_POST['onclick_wud_padding'], FILTER_SANITIZE_STRING);
		if($onclick_wud_padding==''){$onclick_wud_padding='14';}
		update_option('onclick_wud_padding', ($onclick_wud_padding/10));


		$onclick_wud_animate = filter_var($_POST['onclick_wud_animate'], FILTER_SANITIZE_STRING);
		update_option('onclick_wud_animate', $onclick_wud_animate);

		$onclick_wud_animate_speed = filter_var($_POST['onclick_wud_animate_speed'], FILTER_SANITIZE_STRING);
		update_option('onclick_wud_animate_speed', $onclick_wud_animate_speed);

		
		if( empty($error) ){
		echo '<div class="updated"><p><strong>'.__("Settings saved", "onclick-wud").'</strong></p></div>';
		}else{
		echo "<div class='error'><p><strong>";
			foreach ( $error as $key=>$val ) {
				_e($val, 'wud'); 
				echo "<br/>";
			}
		echo "</strong></p></div>";
		    }
	} 
	else {
		
		//If read the first time when opening this page, declare variables
		$onclick_wud_but_bcolor = $jqwfuncs['onclick_wud_but_bcolor'];
		$onclick_wud_but_fcolor = $jqwfuncs['onclick_wud_but_fcolor'];
		$onclick_wud_but_font_size = ($jqwfuncs['onclick_wud_but_font_size']*10);
		$onclick_wud_font_button = $jqwfuncs['onclick_wud_font_button'];
		$onclick_wud_round_button = $jqwfuncs['onclick_wud_round_button'];
		$onclick_wud_border_size = $jqwfuncs['onclick_wud_border_size'];
		$onclick_wud_border_color = $jqwfuncs['onclick_wud_border_color'];
		$onclick_wud_hover_bcolor = $jqwfuncs['onclick_wud_hover_bcolor'];
		$onclick_wud_padding = ($jqwfuncs['onclick_wud_padding']*10);
		$onclick_wud_animate = $jqwfuncs['onclick_wud_animate'];
		$onclick_wud_animate_speed = $jqwfuncs['onclick_wud_animate_speed'];
	}

//ADMIN 
// echo'<div id="onclick-wud-tip"><b class="onclick-trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("tips, help, support and others2", "onclick-wud").'</div></div>';

		//Form start
	    echo "<form name='onclick_wud_form' method='post' action=".admin_url('admin.php')."?page=onclick-wud>";
		echo "<div class='onclick-wud-wrap'>";
		
		echo "<input type='hidden' name='wud_opt_hidden' value='Y'>";

		echo '<b class="onclick-wud-admin-title">'.__("Buttons", "onclick-wud").'</b>';
		echo '<i class="cs-wp-color" >'.__("Background", "onclick-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="onclick_wud_but_bcolor" value="'. $onclick_wud_but_bcolor. '" data-rgba="false"><br><br>';
		echo '<i class="cs-wp-color" >'.__("On Hover", "onclick-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="onclick_wud_hover_bcolor" value="'. $onclick_wud_hover_bcolor. '" data-rgba="false"><br><br>';
		echo '<i class="cs-wp-color" >'.__("Text", "onclick-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="onclick_wud_but_fcolor" value="'. $onclick_wud_but_fcolor. '" data-rgba="false"><br><br>';

		echo '<dl><dt><label for="jqwud_box3">'.__("Font size", "onclick-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="jqwud_box3" type="text" style="font-weight:bolder;" value="'.$onclick_wud_but_font_size.'" readonly/></dd>
		<dt><label for="jqwud_sizer3"></label></dt>
		<dd><input class="onclick-wud-right" id="jqwud_sizer3" type="range" min="6" max="30" step="1" value="'.$onclick_wud_but_font_size.'" name="onclick_wud_but_font_size" onchange="jqwud_box3.value = jqwud_sizer3.value" oninput="jqwud_box3.value = jqwud_sizer3.value" /></dd></dl><br>';
	
		echo '<select name="onclick_wud_font_button" class="onclick-wud-right" >';
		echo     '<option value="inherit"'; if ( $onclick_wud_font_button == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
		echo     '<option value="initial"'; if ( $onclick_wud_font_button == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
		echo     '<option value="Arial"'; if ( $onclick_wud_font_button == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
		echo     '<option value="Times New Roman"'; if ( $onclick_wud_font_button == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
		echo     '<option value="Georgia"'; if ( $onclick_wud_font_button == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
		echo     '<option value="Serif"'; if ( $onclick_wud_font_button == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
		echo     '<option value="Helvetica"'; if ( $onclick_wud_font_button == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
		echo     '<option value="Lucida Sans Unicode"'; if ( $onclick_wud_font_button == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
		echo     '<option value="Tahoma"'; if ( $onclick_wud_font_button == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
		echo     '<option value="Verdana"'; if ( $onclick_wud_font_button == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
		echo     '<option value="Courier New"'; if ( $onclick_wud_font_button == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
		echo     '<option value="Lucida Console"'; if ( $onclick_wud_font_button == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
		echo '</select>';		
		echo '<i class="onclick-wud-admin-title">'.__("Font Family", "onclick-wud").'</i>';	
		echo '<br><br>';
		
		echo '<select name="onclick_wud_animate" class="onclick-wud-right" >';
		echo     '<option value="NULL"'; if ( $onclick_wud_animate == "NULL" ){echo 'selected="selected"';} echo '>'.__("0 No animation", "onclick-wud").'</option>';
		echo     '<option value="bounce"'; if ( $onclick_wud_animate == "bounce" ){echo 'selected="selected"';} echo '>1 Bounce</option>';
		echo     '<option value="flash"'; if ( $onclick_wud_animate == "flash" ){echo 'selected="selected"';} echo '>2 Flash</option>';
		echo     '<option value="pulse"'; if ( $onclick_wud_animate == "pulse" ){echo 'selected="selected"';} echo '>3 Pulse</option>';
		echo     '<option value="rubberBand"'; if ( $onclick_wud_animate == "rubberBand" ){echo 'selected="selected"';} echo '>4 Rubber Band</option>';
		echo     '<option value="shake"'; if ( $onclick_wud_animate == "shake" ){echo 'selected="selected"';} echo '>5 Shake</option>';
		echo     '<option value="swing"'; if ( $onclick_wud_animate == "swing" ){echo 'selected="selected"';} echo '>6 Swing</option>';
		echo     '<option value="tada"'; if ( $onclick_wud_animate == "tada" ){echo 'selected="selected"';} echo '>7 Tada</option>';
		echo     '<option value="wobble"'; if ( $onclick_wud_animate == "wobble" ){echo 'selected="selected"';} echo '>8 Wobble</option>';
		echo     '<option value="bounceIn"'; if ( $onclick_wud_animate == "bounceIn" ){echo 'selected="selected"';} echo '>9 Bounce In</option>';
		echo     '<option value="bounceInDown"'; if ( $onclick_wud_animate == "bounceInDown" ){echo 'selected="selected"';} echo '>10 Bounce In Down</option>';
		echo     '<option value="bounceInLeft"'; if ( $onclick_wud_animate == "bounceInLeft" ){echo 'selected="selected"';} echo '>11 Bounce In Left</option>';
		echo     '<option value="bounceInRight"'; if ( $onclick_wud_animate == "bounceInRight" ){echo 'selected="selected"';} echo '>12 Bounce In Right</option>';
		echo     '<option value="bounceInUp"'; if ( $onclick_wud_animate == "bounceInUp" ){echo 'selected="selected"';} echo '>13 Bounce In Up</option>';
		echo     '<option value="fadeIn"'; if ( $onclick_wud_animate == "fadeIn" ){echo 'selected="selected"';} echo '>14 Fade In</option>';
		echo     '<option value="fadeInDown"'; if ( $onclick_wud_animate == "fadeInDown" ){echo 'selected="selected"';} echo '>15 Fade In Down</option>';
		echo     '<option value="fadeInDownBig"'; if ( $onclick_wud_animate == "fadeInDownBig" ){echo 'selected="selected"';} echo '>16 Fade In Down Big</option>';		
		echo     '<option value="fadeInLeft"'; if ( $onclick_wud_animate == "fadeInLeft" ){echo 'selected="selected"';} echo '>17 Fade In Left</option>';
		echo     '<option value="fadeInLeftBig"'; if ( $onclick_wud_animate == "fadeInLeftBig" ){echo 'selected="selected"';} echo '>18 Fade In Left Big</option>';
		echo     '<option value="fadeInRight"'; if ( $onclick_wud_animate == "fadeInRight" ){echo 'selected="selected"';} echo '>19 Fade In Right</option>';
		echo     '<option value="fadeInRightBig"'; if ( $onclick_wud_animate == "fadeInRightBig" ){echo 'selected="selected"';} echo '>20 Fade In Right Big</option>';
		echo     '<option value="fadeInUp"'; if ( $onclick_wud_animate == "fadeInUp" ){echo 'selected="selected"';} echo '>21 Fade In Up</option>';
		echo     '<option value="fadeInUpBig"'; if ( $onclick_wud_animate == "fadeInUpBig" ){echo 'selected="selected"';} echo '>22 Fade In Up Big</option>';
		echo     '<option value="animated.flip"'; if ( $onclick_wud_animate == "animated.flip" ){echo 'selected="selected"';} echo '>23 Animated Flip</option>';
		echo     '<option value="flipInX"'; if ( $onclick_wud_animate == "flipInX" ){echo 'selected="selected"';} echo '>24 Flip In X</option>';
		echo     '<option value="flipInY"'; if ( $onclick_wud_animate == "flipInY" ){echo 'selected="selected"';} echo '>25 Flip In Y</option>';
		echo     '<option value="lightSpeedIn"'; if ( $onclick_wud_animate == "lightSpeedIn" ){echo 'selected="selected"';} echo '>26 Light Speed In</option>';
		echo     '<option value="rotateIn"'; if ( $onclick_wud_animate == "rotateIn" ){echo 'selected="selected"';} echo '>27 Rotate In</option>';
		echo     '<option value="rotateInDownLeft"'; if ( $onclick_wud_animate == "rotateInDownLeft" ){echo 'selected="selected"';} echo '>28 Rotate In Down Left</option>';
		echo     '<option value="rotateInDownRight"'; if ( $onclick_wud_animate == "rotateInDownRight" ){echo 'selected="selected"';} echo '>29 Rotate In Down Right</option>';
		echo     '<option value="rotateInUpLeft"'; if ( $onclick_wud_animate == "rotateInUpLeft" ){echo 'selected="selected"';} echo '>30 Rotate In Up Left</option>';
		echo     '<option value="rotateInUpRight"'; if ( $onclick_wud_animate == "rotateInUpRight" ){echo 'selected="selected"';} echo '>31 Rotate In Up Right</option>';
		echo     '<option value="hinge"'; if ( $onclick_wud_animate == "hinge" ){echo 'selected="selected"';} echo '>32 Hinge</option>';
		echo     '<option value="rollIn"'; if ( $onclick_wud_animate == "rollIn" ){echo 'selected="selected"';} echo '>33 Roll In</option>';
		echo     '<option value="zoomIn"'; if ( $onclick_wud_animate == "zoomIn" ){echo 'selected="selected"';} echo '>34 Zoom In</option>';
		echo     '<option value="zoomInDown"'; if ( $onclick_wud_animate == "zoomInDown" ){echo 'selected="selected"';} echo '>35 Zoom In Down</option>';
		echo     '<option value="zoomInLeft"'; if ( $onclick_wud_animate == "zoomInLeft" ){echo 'selected="selected"';} echo '>36 Zoom In Left</option>';
		echo     '<option value="zoomInRight"'; if ( $onclick_wud_animate == "zoomInRight" ){echo 'selected="selected"';} echo '>37 Zoom In Right</option>';
		echo     '<option value="zoomInUp"'; if ( $onclick_wud_animate == "zoomInUp" ){echo 'selected="selected"';} echo '>38 Zoom In Up</option>';
		echo     '<option value="slideInDown"'; if ( $onclick_wud_animate == "slideInDown" ){echo 'selected="selected"';} echo '>39 Slide In Down</option>';
		echo     '<option value="slideInLeft"'; if ( $onclick_wud_animate == "slideInLeft" ){echo 'selected="selected"';} echo '>40 Slide In Left</option>';
		echo     '<option value="slideInRight"'; if ( $onclick_wud_animate == "slideInRight" ){echo 'selected="selected"';} echo '>41 Slide In Right</option>';
		echo     '<option value="slideInUp"'; if ( $onclick_wud_animate == "slideInUp" ){echo 'selected="selected"';} echo '>42 Slide In Up</option>';	
		echo '</select>';		
		echo '<i class="onclick-wud-admin-title">'.__("Icon Animations", "onclick-wud").'</i>';	
		echo '<br><br>';

		echo '<select name="onclick_wud_animate_speed" class="onclick-wud-right" >';
		echo     '<option value="animDelay00"'; if ( $onclick_wud_animate_speed == "animDelay00" ){echo 'selected="selected"';} echo '>'.__("0 (None)", "onclick-wud").'</option>';
		echo     '<option value="animDelay01"'; if ( $onclick_wud_animate_speed == "animDelay01" ){echo 'selected="selected"';} echo '>1 (0.1 '.__("second", "onclick-wud").')</option>';
		echo     '<option value="animDelay02"'; if ( $onclick_wud_animate_speed == "animDelay02" ){echo 'selected="selected"';} echo '>2 (0.2 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay03"'; if ( $onclick_wud_animate_speed == "animDelay03" ){echo 'selected="selected"';} echo '>3 (0.3 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay04"'; if ( $onclick_wud_animate_speed == "animDelay04" ){echo 'selected="selected"';} echo '>4 (0.4 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay05"'; if ( $onclick_wud_animate_speed == "animDelay05" ){echo 'selected="selected"';} echo '>5 (0.5 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay06"'; if ( $onclick_wud_animate_speed == "animDelay06" ){echo 'selected="selected"';} echo '>6 (0.6 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay07"'; if ( $onclick_wud_animate_speed == "animDelay07" ){echo 'selected="selected"';} echo '>7 (0.7 '.__("seconds", "onclick-wud").')</option>';
		echo     '<option value="animDelay08"'; if ( $onclick_wud_animate_speed == "animDelay08" ){echo 'selected="selected"';} echo '>8 (0.8 '.__("seconds", "onclick-wud").')</option>';	
		echo '</select>';		
		echo '<i class="onclick-wud-admin-title">'.__("Animation Speed", "onclick-wud").'</i>';	
		echo '<br><br>';
		
		echo '<dl><dt><label for="jqwud_box1">'.__("Round corners", "onclick-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="jqwud_box1" type="text" style="font-weight:bolder;" value="'.$onclick_wud_round_button.'" readonly/></dd>
		<dt><label for="jqwud_sizer1"></label></dt>
		<dd><input class="onclick-wud-right" id="jqwud_sizer1" type="range" min="0" max="20" step="1" value="'.$onclick_wud_round_button.'" name="onclick_wud_round_button" onchange="jqwud_box1.value = jqwud_sizer1.value" oninput="jqwud_box1.value = jqwud_sizer1.value" /></dd></dl><br>';
							
		echo '<dl><dt><label for="jqwud_box2">'.__("Shadow size", "onclick-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="jqwud_box2" type="text" style="font-weight:bolder;" value="'.$onclick_wud_border_size.'" readonly/></dd>
		<dt><label for="jqwud_sizer2"></label></dt>
		<dd><input class="onclick-wud-right" id="jqwud_sizer2" type="range" min="0" max="10" step="1" value="'.$onclick_wud_border_size.'" name="onclick_wud_border_size" onchange="jqwud_box2.value = jqwud_sizer2.value" oninput="jqwud_box2.value = jqwud_sizer2.value" /></dd></dl><br>';

		echo '<i class="cs-wp-color" >'.__("Shadow color", "onclick-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="onclick_wud_border_color" value="'. $onclick_wud_border_color. '" data-rgba="false"><br><br>';
		

		echo '<dl><dt><label for="jqwud_box4">'.__("Button Size", "onclick-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="jqwud_box4" type="text" style="font-weight:bolder;" value="'.$onclick_wud_padding.'" readonly/></dd>
		<dt><label for="jqwud_sizer4"></label></dt>
		<dd><input class="onclick-wud-right" id="jqwud_sizer4" type="range" min="5" max="50" step="1" value="'.$onclick_wud_padding.'" name="onclick_wud_padding" onchange="jqwud_box4.value = jqwud_sizer4.value" oninput="jqwud_box4.value = jqwud_sizer4.value" /></dd></dl><br>';
		echo '</div>';
		
		echo "<div class='onclick-wud-wrap-2'>";
		echo '<h2>'.__("Usage", "onclick-wud").': </h2><strong>[jqwud url="my url"]</strong><br>'.__("Where \"my url\" is the destination.", "onclick-wud").'';
		echo '<h2>'.__("Options", "onclick-wud").'</h2>';
		echo '<strong>[button="1"]"</strong>  '.__("Activate button lay-out.", "onclick-wud").'';
	    echo '<br><strong>[text="xxx"]"</strong>  '.__("\"xxx\" Will be the link/button text.", "onclick-wud").'';
		echo '<br><strong>[target="1"]</strong>  '.__("Open URL in a new window/tab.", "onclick-wud").'';		
		echo '<br><strong>[bgcolor="#FF2D00"]</strong>  '.__("Button Background color.", "onclick-wud").'';
		echo '<br><strong>[color="#FEFEFE"]</strong>  '.__("Button Font color.", "onclick-wud").'';
		echo '<br><strong>[hover="#473E3C"] </strong>  '.__("Button Hover color.", "onclick-wud").'';
		echo '<br><strong>[ani="xx"] </strong>  '.__("Overwrites the icon animations setting.", "onclick-wud").'';
		echo '<br><strong>[speed="xx"] </strong>  '.__("Overwrites the animations speed setting.", "onclick-wud").'';
		echo '<br><strong>[icon="name_icon] </strong>  '.__("Insert animated icon.", "onclick-wud").'';
		echo '<button style="padding:1%;float:right;margin-right:30px;"onclick="window.open(\''.plugins_url('../txt/icon-wud.txt', __FILE__ ).'\',\'_blank\');"><b>'.__("List animated icons", "onclick-wud").'</b></button>';
		echo '<br><br><br>'.__("You can combine all options in one short code.", "onclick-wud").'';
		echo '<h2>'.__("Samples", "onclick-wud").'</h2>';
		echo '<strong>[jqwud url="my url" button="1"]</strong><br>  '.__("URL with button lay-out.", "onclick-wud").'';
		echo '<br><br><strong>[jqwud url="my url" text="Click here"]</strong><br>  '.__("URL with text: Click here.", "onclick-wud").'';
		echo '<br><br><strong>[jqwud url="my url" button="1" text="Click here"]</strong><br>  '.__("Button with text: Click here.", "onclick-wud").'';
		echo '<br><br><strong>[jqwud url="my url" target="1"]</strong><br>  '.__("URL with target new window/tab.", "onclick-wud").'';
		echo '<h2>'.__("Custom JavaScripts", "onclick-wud").'</h2>';
		echo ''.__("Edit", "onclick-wud").': <strong><a href="./plugin-editor.php?file=onclick-wud/js/custom/custom-java-01.js" target="_new">JavaScript 01</a> - <a href="./plugin-editor.php?file=onclick-wud/js/custom/custom-java-02.js" target="_new">JavaScript 02</a> - <a href="./plugin-editor.php?file=onclick-wud/js/custom/custom-java-03.js" target="_new">JavaScript 03</a></strong><br><br>';
		echo ''.__("Short Code Usage", "onclick-wud").': <strong>[jqwud url="yourfunction();"]</strong><br>';
		echo ''.__("Where <b>yourfunction()</b> is the function you have created, in one of the above mentioned JavaScripts", "onclick-wud").'<br>';
		echo ''.__("<br><b>Sample:</b>", "onclick-wud").'<br>';
		echo '<i>&nbsp&nbspfunction yourfunction() { <br>&nbsp&nbsp&nbsp&nbspalert(\'Hello World\');<br> &nbsp&nbsp}<br><br></i>';
		echo '<a href="#_"  onclick="yourfunction();">'.__("Test the above code.", "onclick-wud").'</a><br>';
		
		echo '</div><div class="clear"></div>';
		echo '<div><br>';	
		echo '<input type="submit" name="Submit" class="button-primary" id="onclick-wud-adm-subm" value="'.__("Save Changes", "onclick-wud").'" /><br><br>';
		echo '<p style="float:right;"><a href="https://wud-plugins.com" class="button-primary" id="onclick-pub-wud" target="_blank" title="100% FREE WUD PLUGINS" ><strong><font color="white">CLICK HERE TO DISCOVER<br> MORE WUD FREE PLUGINS</font></strong></a></p><br><br>';
		//Form send
		echo "</form>";
		echo '<a href="http://wud-plugins.com" class="button-primary" id="onclick-adm-wud" target="_blank">'.__("Visit our website", "onclick-wud").'</a>  <a href="https://wordpress.org/support/plugin/onclick-wud" class="button-primary" id="onclick-adm-wud" target="_blank">'.__("Get FREE Support", "onclick-wud").'</a>';
		echo '</div></div>';		
}
?>