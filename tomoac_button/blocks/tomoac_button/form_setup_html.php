<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

	$form = Loader::helper('form');
	$db = Loader::db();

//	if(($bID > 0)||($b != '' && intval($b->getBlockID()) > 0)) {
	if($bID > 0) {
		$rows = $db->query("SELECT * FROM btTomoacButton WHERE bID=$bID LIMIT 1");
		$row = $rows->fetchrow();
		$contents = json_decode( $row{'contents'} );
		$options = $row{'options'};
		$option = explode('/', $options);
		if(count($option) <= 1)
			$option = array('twitter','googleplusone','hatena','mixi','facebook') ;
	}
	else {
		$options = array('twitter/googleplusone/hatena/mixi/facebook','');
		$bIDs = $db->getOne("SELECT count(*) AS total from btTomoacButton WHERE bID=0");
		if($bIDs == 0)
			$sql = "INSERT btTomoacButton (options, contents) VALUES (?,?)";
		else
			$sql = "UPDATE btTomoacButton SET options=?, contents=? WHERE bID=0";
		$rows = $db->query($sql, $options);
		$option = explode('/', $options[0]);
	}
?>
<ul class="ccm-dialog-tabs" id="ccm-button-tabs">
<?php
	$i = 0;
	foreach($option as $op) {
		echo ($i == 0) ? '<li class="ccm-nav-active">' : '<li>';
		if($op == 'twitter') 		echo '<a href="javascript:void(0)" id="ccm-button-twitter">'.t('Twitter').'</a>';
		if($op == 'googleplusone')	echo '<a href="javascript:void(0)" id="ccm-button-googleplusone">'.t('Google+1').'</a>';
		if($op == 'hatena')			echo '<a href="javascript:void(0)" id="ccm-button-hatena">'.t('Hatena').'</a>';
		if($op == 'mixi')			echo '<a href="javascript:void(0)" id="ccm-button-mixi">'.t('Mixi').'</a>';
		if($op == 'facebook')		echo '<a href="javascript:void(0)" id="ccm-button-facebook">'.t('Facebook').'</a>';
		echo '</li>';
		$i++;
	}
?>
	<li><a href="javascript:void(0)" id="ccm-button-option"><?php   echo t('Option')?></a></li>
</ul>

<div style="text-align: left" >

<!-- ================ Twitter ================ -->
<div id="ccm-button-twitter-tab">
<?php
	if($bID > 0) {
		foreach($contents as $content) {
			if($content->{'kinda'} != 'twitter') continue;

			$twitter_onoff = $content->{'onoff'};
			$twitter_user = $content->{'user'};
			$twitter_count = $content->{'count'};
			$twitter_buttonsize = $content->{'buttonsize'};
			break;
		}
	}
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('twitter_onoff','on',($twitter_onoff == 'on') or (!$twitter_onoff)) . '表示';
	echo $form->radio('twitter_onoff','off',($twitter_onoff == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ユーザ名'.'</td><td>'.'&nbsp;'.$form->text('twitter_user', $twitter_user)."</td></tr>";
	echo '<tr><td>'.'数の表示'.'</td><td>'.$form->checkbox('twitter_count', '1', $twitter_count)."</td></tr>";
	echo '<tr><td>'.'ボタンサイズ（大）'.'</td><td>'.$form->checkbox('twitter_buttonsize', '1', $twitter_buttonsize)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Google+1 ================ -->
<div id="ccm-button-googleplusone-tab" style="display:none">
<?php
	if($bID > 0) {
		foreach($contents as $content) {
			if($content->{'kinda'} != 'googleplusone') continue;

			$googleplusone_onoff = $content->{'onoff'};
			$googleplusone_buttonsize = $content->{'buttonsize'};
			break;
		}
	}
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('googleplusone_onoff','on',($googleplusone_onoff == 'on') or (!$googleplusone_onoff)) . '表示';
	echo $form->radio('googleplusone_onoff','of',($googleplusone_onoff == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ボタンサイズ'.'</td><td>'.$form->select('googleplusone_buttonsize', array(
							'small'=>'小（15px）',
							'medium'=>'中（20px）',
							''=>'標準（24px）',
							'tall'=>'大（60px）+1 情報'), $googleplusone_buttonsize).'</td></tr>';
	echo '</table>';
?>
</div>

<!-- ================ Hatena ================ -->
<div id="ccm-button-hatena-tab" style="display:none">
<?php
	if($bID > 0) {
		foreach($contents as $content) {
			if($content->{'kinda'} != 'hatena') continue;

			$hatena_onoff = $content->{'onoff'};
			$hatena_buttontype = $content->{'buttontype'};
			break;
		}
	}
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('hatena_onoff','on',($hatena_onoff == 'on') or (!$hatena_onoff)) . '表示';
	echo $form->radio('hatena_onoff','of',($hatena_onoff == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ボタンタイプ'.'</td><td>'.$form->select('hatena_buttontype', array(
							'standard'=>'スタンダード',
							'vertical'=>'バーティカルボタン',
							'simple'=>'シンプルボタン'), $hatena_buttontype)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Mixi ================ -->
<div id="ccm-button-mixi-tab" style="display:none">
<?php
	if($bID > 0) {
		foreach($contents as $content) {
			if($content->{'kinda'} != 'mixi') continue;

			$mixi_onoff = $content->{'onoff'};
			$mixi_key = $content->{'key'};
			$mixi_buttontype = $content->{'buttontype'};
			break;
		}
	}
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('mixi_onoff','on',($mixi_onoff == 'on') or (!$mixi_onoff)) . '表示';
	echo $form->radio('mixi_onoff','of',($mixi_onoff == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'mixiチェックキー(必須)'.'</td><td>'.'&nbsp;'.$form->text('mixi_key', $mixi_key)."</td></tr>";
	echo '<tr><td>'.'mixiボタンタイプ'.'</td><td>'.$form->select('mixi_buttontype', array(
							'button-1'=>'button-1',
							'button-2'=>'button-2',
							'button-3'=>'button-3',
							'button-4'=>'button-4',
							'button-5'=>'button-5',
							'button-6'=>'button-6'), $mixi_buttontype)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Facebook ================ -->
<div id="ccm-button-facebook-tab" style="display:none">
<?php
	if($bID > 0) {
		foreach($contents as $content) {
			if($content->{'kinda'} != 'facebook') continue;

			$facebook_onoff = $content->{'onoff'};
			$facebook_appid = $content->{'appid'};
			$facebook_send = $content->{'send'};
			$facebook_layout = $content->{'layout'}!=''?$content->{'layout'}:'button_count';
			$facebook_width = $content->{'width'}!=''?$content->{'width'}:450;
			$facebook_showfaces = $content->{'showfaces'};
			$facebook_verb = $content->{'verb'}!=''?$content->{'verb'}:'like';
			$facebook_color = $content->{'color'}!=''?$content->{'color'}:'light';
			$facebook_font = $content->{'font'};
			break;
		}
	}
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('facebook_onoff','on',($facebook_onoff == 'on') or (!$facebook_onoff)) . '表示';
	echo $form->radio('facebook_onoff','of',($facebook_onoff == 'off')) . '非表示';
	echo '</td></tr>';
//	echo '<tr><td>'.'AppID'.'</td><td>'.'&nbsp;'.$form->text('facebook_appid', $facebook_appid) . "</td></tr>";
	echo '<tr><td>'.'送るボタン'.'</td><td>'.$form->checkbox('facebook_send', '1', $facebook_send)."</td></tr>";
	echo '<tr><td>'.'レイアウトスタイル'.'</td><td>'.$form->select('facebook_layout', array(
							'standard'=>'standard',
							'button_count'=>'button_count',
							'box_count'=>'box_count'), $facebook_layout)."</td></tr>";
	echo '<tr><td>'.'幅'.'</td><td>'.'&nbsp;'.$form->text('facebook_width', $facebook_width) . "</td></tr>";
//	echo '<tr><td>'.'Show Faces'.'</td><td>'.$form->checkbox('facebook_showfaces', '1', $facebook_showfaces)."</td></tr>";
	echo '<tr><td>'.'添え字（Verb to display）'.'</td><td>'.$form->select('facebook_verb', array(
							'like'=>'like',
							'recommend'=>'recommend'), $facebook_verb)."</td></tr>";
	echo '<tr><td>'.'色（Color Scheme）'.'</td><td>'.$form->select('facebook_color', array(
							'light'=>'light',
							'dark'=>'dark'), $facebook_color)."</td></tr>";
	echo '<tr><td>'.'フォント'.'</td><td>'.$form->select('facebook_font', array(
							''=>'--',
							'arial'=>'arial',
							'lucida grande'=>'lucida grande',
							'segoe ui'=>'segoe ui',
							'tahoma'=>'tahoma',
							'trebuchet ms'=>'trebuchet ms',
							'verdana'=>'verdana'), $facebook_font)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Options ================ -->
<div id="ccm-button-option-tab" style="display:none">
<?php

	$th = Loader::helper('concrete/urls');
	$ajax_url = "'" . BASE_URL . $th->getToolsURL('order.php', 'tomoac_button') ."'";

	echo '
<style type="text/css">
a.moveUpLink   { display:block; background:url('.DIR_REL.'/concrete/images/icons/arrow_up.png)   no-repeat center; height:10px; width:16px; }
a.moveDownLink { display:block; background:url('.DIR_REL.'/concrete/images/icons/arrow_down.png) no-repeat center; height:10px; width:16px; }
</style>
';
	echo "\n";
	echo '
<script type="text/javascript">
';
	echo "
function moveUp( n, bid ){
	if($('#'+(n-1)).text() != '') {
		var a = $('#'+n).text()
		var b = $('#'+(n-1)).text()
		$('#'+n).text(b)
		$('#'+(n-1)).text(a)
	}
	var t = '';
	for(i=0; $('#'+i).text() != ''; i++)
		t = t + $('#'+i).text() + '/';
	saveOrder(t, bid);
}
function moveDown( n, bid ){
	if($('#'+(n+1)).text() != '') {
		var a = $('#'+n).text()
		var b = $('#'+(n+1)).text()
		$('#'+n).text(b)
		$('#'+(n+1)).text(a)
	}
	var t = '';
	for(i=0; $('#'+i).text() != ''; i++)
		t = t + $('#'+i).text() + '/';
	saveOrder(t, bid);
}
function saveOrder(t, bid){ 
	var postStr='p='+t+'&bid='+bid;
	$.ajax({ 
		type: 'POST',
		data: postStr,
		url: ".$ajax_url.",
		success: function(msg){	
//			alert(msg);
		}
	});
}
";
	echo '
-->
</script>
';
	echo '<br />'.t('Change Order').'<table width=30%">'."\n";
	if($bID == '') $bID = 0;
	$i = 0;
	foreach($option as $op) {
		if(empty($op)) continue;
		echo '<tr><td>&nbsp;'.($i+1).'.&nbsp;</td><td id="'.$i.'">';
		echo $op;
		echo '</td><td>';
		echo '<a onclick="moveUp('.$i.','.$bID.');  return false" class="moveUpLink"></a>';
		echo '<a onclick="moveDown('.$i.','.$bID.');return false" class="moveDownLink"></a>';
		echo '</td></tr>'."\n";
		$i++;
	}
	echo '</table>'."\n";
?>
</div>

<!-- ================ Tab Setup ================ -->
<script type="text/javascript">
	var ccm_fpActiveTab = "ccm-button-twitter";	
	$("#ccm-button-tabs a").click(function() {
		$("li.ccm-nav-active").removeClass('ccm-nav-active');
		$("#" + ccm_fpActiveTab + "-tab").hide();
		ccm_fpActiveTab = $(this).attr('id');
		$(this).parent().addClass("ccm-nav-active");
		$("#" + ccm_fpActiveTab + "-tab").show();
	});
</script>

</div>
