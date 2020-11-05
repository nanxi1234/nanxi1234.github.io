<?php
add_action('admin_menu', 'MyhkPlayer_menu_page');
function MyhkPlayer_menu_page(){
    add_menu_page('明月浩空音乐', '明月浩空音乐', 'administrator', 'MyhkPlayer_options', 'MyhkPlayer_options', plugins_url('MyhkPlayer/images/icon.png'), 99);
}
//设置页面
function MyhkPlayer_options(){?>  
<link href="<?php echo plugin_dir_url(__FILE__ ); ?>css/style.css" type="text/css" rel="stylesheet" />
<h2>明月浩空音乐播放器 <a href="https://myhkw.cn" title="访问播放器专用后台编辑歌单" target="_blank"><span class="m-left" style="font-weight:bold;color:#f00">【歌单管理入口】</span></a></h2>
<?php update_MyhkPlayer_options() ?>
<form method="post"> 
	<table class="tb-set" width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0'>	
<tr>
	<td align="right"><b>线路切换：</b><br />(当播放器CDN访问异常时请切换，一般主站即可)</td>
	<td><span class="sel"><select name="xl"><option value="@" <?php if(get_option('xl')=="@") echo "selected"; ?>>主站</option><option value="player" <?php if(get_option('xl')=="player") echo "selected"; ?>>一线</option><option value="music" <?php if(get_option('xl')=="music") echo "selected"; ?>>二线</option></select></span></td>
</tr>

<tr>
	<td align="right"><b>加载jquery：</b><br />(没有jquery库时请打开，JS冲突请关闭)</td>
	<td><span class="sel"><select name="jq"><option value="open" <?php if(get_option('jq')=="open") echo "selected"; ?>>开启</option><option value="close" <?php if(get_option('jq')!="open") echo "selected"; ?>>关闭</option></select></span></td>
</tr>

<tr>
	<td align="right"><b>移动端加载：</b><br />(开启后将在手机，iPad等移动设备加载播放器)</td>
	<td><span class="sel"><select name="mb"><option value="open" <?php if(get_option('mb')!="close") echo "selected"; ?>>开启</option><option value="close" <?php if(get_option('mb')=="close") echo "selected"; ?>>关闭</option></select></span></td>
</tr>

<tr>
    <td align="right" width="30%"><b>播放器ID：</b><br />(填写<b>播放器控制面板</b>自己的播放器ID，免注册公用ID：demo)</td>
    <td colspan="3"><input type="text" class="txt txt-sho"  style="width:300px;color:#f00;font-weight:bold;" name="id" value="<?php if(get_option('id')==''){echo 'demo';}else{echo get_option('id');} ?>" /></td>
</tr>

<tr>
	<td align="right"><b>后台地址：</b><br />(免费注册创建播放器后台管理地址)</td>
	<td><b><a href="https://myhkw.cn" target="_blank">https://myhkw.cn</b></a></td>
</tr>

<tr>
    <td align="right" width="30%"></td>
	<td colspan="4"><input onclick="load();" type="submit" class="button" name="submit" id="submit" value="保存设置" /></td>
</tr>
	</table>
</form>
<script>function load() {document.getElementById("submit").value="保存中，请稍候...";setTimeout(function() {document.getElementById("submit").disabled="false";}, 1)}</script>
<?php }
function update_MyhkPlayer_options(){
	if($_POST['submit']){
		$updated = true;
		update_option('xl',$_POST['xl']);
		update_option('jq',$_POST['jq']);
		update_option('mb',$_POST['mb']);
		update_option('id',$_POST['id']);
		if($updated){
			echo "设置成功！";
		}else{
			echo '保存失败！请检查网络或设置！';
		}
	}
}
?>