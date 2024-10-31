<?php
 /*
=== OnClick WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */	
// ### SHORT CODE JQWUD ###	
function jquery_wud($atts){
	
	//The magic short code :-)
	extract( shortcode_atts(array('url' => '', 'button' => '', 'text' => '', 'icon' => '', 'target' => '', 'bgcolor' => '', 'color' => '', 'hover' => '', 'flat' => '', 'ani' => '', 'speed' => ''), $atts ));
	global $jqwfuncs;

	//Start collecting standard values
	$button_wud=0;
	$target_wud=0;
	$flat_wud=0;
	$JQuery_URL=NULL;
	$JQuery_TXT="Click here ... ";
	$bgcolor=NULL;
	$color=NULL;
	$hover=NULL;
	$wud_animo=NULL;
	$animate=NULL;
	$ani_wud=0;
	$speed_wud=0;
	$JQused=0;
	//End collecting standard values
	
  //Start check main shortcode
  if(isset($atts["url"]) && $atts["url"]!=''){
	
	//Correction input URL
	if(isset($atts["url"]) && $atts["url"]!=''){
		//Clean up messy things
		$atts["url"] = filter_var($atts["url"], FILTER_SANITIZE_STRING);
		//Parse URL
		$parsed_url=parse_url($atts["url"]);
		$path = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 	

		//Find out what the user input is
		if (strstr($path, '.')) {$atts["url"]="http://".$atts["url"];} //String with . is domain and should have http(s)			
		if(substr($atts["url"],0,1) !="/" && substr($atts["url"],0,4) !="http"){$atts["url"]="/".$atts["url"];} //if http or https is used
		if(substr($atts["url"],-1) !="/" && substr($atts["url"],0,4) !="http"){$atts["url"]=$atts["url"]."/";} //if WP slug is used
		if(substr($atts["url"],1,1) =="#" && substr($atts["url"],2,1) =="_" ){$atts["url"]="#_";} //if #_ is used.
		if(substr($atts["url"],1,1) =="#" && substr($atts["url"],2,1) !="_" ){$atts["url"]="#";} //if # is used. 
		if(substr($path,-1) ==")" || substr($path,-2) ==");" || substr($path,-2) =="(&" ){ //if a Javascript function() is used.
			if(substr($path,-2) =="(&"){ //If values found between ''
				$JQused=1;
				$output = getBetween($atts["url"],"(",")");	
				$atts["url"]=substr($path,0,-1).$output.");";			
			}
			else{ //Without values between ''
				$JQused=1;
				$atts["url"]=$path;
			}
		} 
		
	}
	//Correction input Target
	if(isset($atts["target"]) && $atts["target"]!='' ){
		if(is_numeric($atts["target"]) && $atts["target"] > 0 && $atts["target"] == round($atts["target"], 0)){
			$target_wud=$atts["target"];
			if($target_wud > 1){$target_wud=1;}
		}
	}	
	//Show the button (yes/no)
	if(isset($atts["button"]) && $atts["button"]!='' ){
		if(is_numeric($atts["button"]) && $atts["button"] > 0 && $atts["button"] == round($atts["button"], 0)){
			$button_wud=$atts["button"];
			if($button_wud > 10){$button_wud=9;}
		}
	}
	//Show the text
	if(isset($atts["text"]) && $atts["text"]!='' ){
		$JQuery_TXT = filter_var($atts["text"], FILTER_SANITIZE_STRING);
	}	

	//Set Animation number to animation string
	if(isset($atts["ani"]) && $atts["ani"]!='' ){
		if(is_numeric($atts["ani"]) && $atts["ani"] >= 0 && $atts["ani"] == round($atts["ani"], 0)){
			$ani_wud=animated_icon($atts["ani"]);
			if($atts["ani"] > 42){
				$ani_wud=animated_icon(0);
			}
		}
	}

	//Set Animation speed
	if(isset($atts["speed"]) && $atts["speed"]!='' ){
		if(is_numeric($atts["speed"]) && $atts["speed"] >= 0 && $atts["speed"] == round($atts["speed"], 0)){
			$speed_wud=animation_speed($atts["speed"]);
			if($atts["speed"] > 8){
				$speed_wud=animation_speed(0);
			}
		}
	}
	
	//Show the animated fonts
	if(isset($atts["icon"]) && $atts["icon"]!='' ){
		if($JQuery_TXT=='Click here ... '){$JQuery_TXT="";}
		$animated_wud = filter_var($atts["icon"], FILTER_SANITIZE_STRING);
		$animate=$jqwfuncs['onclick_wud_animate'];
		$anispeed=$jqwfuncs['onclick_wud_animate_speed'];
		//If the animation string is used
		if(!empty($ani_wud)){$animate=$ani_wud;}
		//If no icon is used the speed is not in use ... and will be 0
		if(!empty($speed_wud)){$anispeed=$speed_wud;}
		//The icon result.
		$wud_animo = '&nbsp;<span class="'.$animated_wud.' animated '.$animate.' '.$anispeed.'">&nbsp;</span>';
	}
	
	//Users input Background Color
	if(isset($atts["bgcolor"]) && $atts["bgcolor"]!=''){
		if(substr($atts["bgcolor"],0,1) =="#" ){$atts["bgcolor"]=substr($atts["bgcolor"],1,7);}
		if(ctype_xdigit($atts["bgcolor"]) && (strlen($atts["bgcolor"]) == 6 || strlen($atts["bgcolor"]) == 3)){
			$bgcolor = "#".filter_var(substr($atts["bgcolor"],0,6), FILTER_SANITIZE_STRING);
		}
	}

	//Users input Font Color
	if(isset($atts["color"]) && $atts["color"]!=''){
		if(substr($atts["color"],0,1) =="#" ){$atts["color"]=substr($atts["color"],1,7);}
		if(ctype_xdigit($atts["color"]) && (strlen($atts["color"]) == 6 || strlen($atts["color"]) == 3)){
			$color = "#".filter_var(substr($atts["color"],0,6), FILTER_SANITIZE_STRING);
		}
	}	

	//Users input On Hover Color
	if(isset($atts["hover"]) && $atts["hover"]!=''){
		if(substr($atts["hover"],0,1) =="#" ){$atts["hover"]=substr($atts["hover"],1,7);}
		if(ctype_xdigit($atts["hover"]) && (strlen($atts["hover"]) == 6 || strlen($atts["hover"]) == 3)){
			$hover = "#".filter_var(substr($atts["hover"],0,6), FILTER_SANITIZE_STRING);
		}
	}

	//Ignore round buttons
	if(isset($atts["flat"]) && $atts["flat"]!='' ){
		if(is_numeric($atts["flat"]) && $atts["flat"] > 0 && $atts["flat"] == round($atts["flat"], 0)){
			$flat_wud=$atts["flat"];
			if($flat_wud > 1){$flat_wud=1;}
		}
	}
	
	// BUTTON url	
	if(isset($atts["url"]) && $atts["url"]!=''  && $button_wud > 0){
		//Define saved parameters
		$lineheight=($jqwfuncs['onclick_wud_but_font_size']+0.5)."vw"; //change with CSS if mobile devices
		$buttonfont=($jqwfuncs['onclick_wud_but_font_size'])."vw"; //change with CSS if mobile devices
		$buttonpadding=($jqwfuncs['onclick_wud_padding'])."%"; //change with CSS if mobile devices
		if($flat_wud==0){ $buttoncorner=$jqwfuncs['onclick_wud_round_button']; }
				   else { $buttoncorner=0; }		
		$miniborder=$jqwfuncs['onclick_wud_border_size']/2;
		if(empty($bgcolor)){ $bgcolor=$jqwfuncs['onclick_wud_but_bcolor']; }
		if(empty($color)){ $color=$jqwfuncs['onclick_wud_but_fcolor']; }
		if(empty($hover)){ $hover=$jqwfuncs['onclick_wud_hover_bcolor']; }
		$bordersize=$jqwfuncs['onclick_wud_border_size'];
		$bordercolor=$jqwfuncs['onclick_wud_border_color'];
		
		//If a Javascript function is used
		if($JQused==1){ $jq=$atts["url"];  } //onclick event
		//Regualar URL
		else{
		if($target_wud==1){ $jq='window.open(\''.$atts["url"].'\',\'_blank\');'; } //onclick url new tab/window
					  else{ $jq='location.href=\''.$atts["url"].'\''; } //onclick url same tab
		}
		
			$JQuery_URL= '<button class="wud-buttons" 
				onclick="'.$jq.'" 
				onMouseOver="this.style.backgroundColor=\''.$hover.'\'"  
				onMouseOut="this.style.backgroundColor=\''.$bgcolor.'\'" 
				style=" padding: '.$buttonpadding.'; 
				font-family:'.$jqwfuncs['onclick_wud_font_button'].' !important;
				border-radius:'.$buttoncorner.'px; 
				font-size:'.$buttonfont.'; 
				line-height:'.$lineheight.';  
				background-color:'.$bgcolor.'; 
				color:'.$color.'; 
				box-shadow: '.$bordersize.'px '.$bordersize.'px '.$miniborder.'px '.$bordercolor.'; 
				margin:0.5%; 
				outline:none; 
				border:solid 1px #bababa;
				text-decoration: none;" >'.$wud_animo.$JQuery_TXT.'</button>'; 
	}

	// HREF url	
	if(isset($atts["url"]) && $atts["url"]!=''  && $button_wud == 0){
		//If a Javascript function is used
		if($JQused==1){ $JQuery_URL= '<a href="#_"  onclick="'.$atts["url"].'" style="outline:none;">'.$JQuery_TXT.'</a>'; } //onclick event
		//Regualar URL
		else{
		if($target_wud==1){	$JQuery_URL= '<a href="#_"  onclick="window.open(\''.$atts["url"].'\',\'_blank\');" style="outline:none;">'.$JQuery_TXT.'</a>'; } //url new tab/window 
					  else{ $JQuery_URL= '<a href="#_"  onclick="location.href=\''.$atts["url"].'\'" style="outline:none;">'.$JQuery_TXT.'</a>'; } //url same tab	
		}
	}
	
  //End check main shortcode	
  }
else{
	$JQuery_URL='<font color="red">ERROR_01 => '.__("The short code has an invalid value and must contain at least", "onclick-wud").': <b>[jqwud url="your link"]</b>!</font>';	
}	
return $JQuery_URL;
}	

//Get a string between 2 signs
function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}
?>