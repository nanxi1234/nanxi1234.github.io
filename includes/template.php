<?php
function player_jq() {
	if(get_option('jq')=='open'){
		echo '<script src="//lib.baomitu.com/jquery/3.4.1/jquery.min.js"></script>'."\n";
	}
}
function player_js(){
	$xl = get_option('xl').'.';
	if(get_option('xl') == '@'){
		$xl = '';
	}
	if(get_option('mb')=='open'){
		echo '<script id="myhk" src="https://' . $xl . 'myhkw.cn/player/js/player.js" key="' . get_option('id') . '" m="1"></script>'."\n";
	}else{
		echo '<script id="myhk" src="https://' . $xl . 'myhkw.cn/player/js/player.js" key="' . get_option('id') . '"></script>'."\n";
	}
}
?>