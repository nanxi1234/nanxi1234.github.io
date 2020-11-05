<?php
/**
 * @package 明月浩空音乐播放器
 * @author 明月浩空
 * @version 20200712
 */
/*
Plugin Name: 明月浩空音乐播放器
Plugin URI: https://myhkw.cn
Version: 20200712
Author: 明月浩空
Author URI: https://lmih.cn
Text Domain: MyhkPlayer
Description: 明月浩空-Html5浮窗音乐播放器是基于QQ音乐、酷狗音乐、网易云音乐等歌曲ID全自动解析的Html5音乐播放器
*/

define('MyhkPlayer_URL', plugins_url('', __FILE__));
define('MyhkPlayer_PATH', dirname(__FILE__));
define('MyhkPlayer_ADMIN_URL', admin_url());

require MyhkPlayer_PATH . '/includes/admincn.php';
require MyhkPlayer_PATH . '/includes/template.php';

if($_COOKIE['MyhkPlayer_show']<round(time())-60){
add_action( 'wp_head', 'player_jq' );
add_action( 'wp_footer', 'player_js', 10);
}
?>
