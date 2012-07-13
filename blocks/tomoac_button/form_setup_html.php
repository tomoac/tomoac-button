<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
	$form = Loader::helper('form');
	if($b != '' && intval($b->getBlockID()) > 0) {
		$db = Loader::db();
		$q = $db->query("select * FROM btButtonTomoac WHERE bID = ".$b->getBlockID()." LIMIT 1");
		$row = $q->fetchRow();

		$buttontw = $row['buttontw'];
		$counter = $row['counter'];
		$user = $row['user'];
		$user2 = $row['user2'];
		$buttonbig = $row['buttonbig'];
		$hashtag = $row['hashtag'];
		$lang = $row['lang'];

		$buttongp = $row['buttongp'];
		$buttonsize = $row['buttonsize'];
		$annotation = $row['annotation'];

		$buttonfb = $row['buttonfb'];
		$fbuser = $row['fbuser'];
		$appid = $row['appid'];

		$buttonha = $row['buttonha'];
		$buttontype = $row['buttontype'];
		$haurl = $row['haurl'];
		$hattl = $row['hattl'];

		$buttonmx = $row['buttonmx'];
		$mxbtntype = $row['mxbtntype'];
		$mxkey = $row['mxkey'];
	}
?>
<ul class="ccm-dialog-tabs" id="ccm-button-tabs">
	<li class="ccm-nav-active"><a href="javascript:void(0)" id="ccm-button-twitter"><?php   echo t('Twitter')?></a></li>
	<li><a href="javascript:void(0)" id="ccm-button-googleplusone"><?php   echo t('Google+1')?></a></li>
	<li><a href="javascript:void(0)" id="ccm-button-hatena"><?php   echo t('Hatena')?></a></li>
	<li><a href="javascript:void(0)" id="ccm-button-mixi"><?php   echo t('Mixi')?></a></li>
	<li><a href="javascript:void(0)" id="ccm-button-facebook"><?php   echo t('Facebook')?></a></li>
</ul>

<div style="text-align: left" >

<!-- ================ Twitter ================ -->
<div id="ccm-button-twitter-tab">
<?php
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('buttontw','on',($buttontw == 'on') or (!$buttontw)) . '表示';
	echo $form->radio('buttontw','off',($buttontw == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ユーザ名'.'</td><td>'.'&nbsp;'.$form->text('user', $user)."</td></tr>";
	echo '<tr><td>'.'数の表示'.'</td><td>'.$form->checkbox('counter', '1', $counter)."</td></tr>";
	echo '<tr><td>'.'ボタンサイズ（大）'.'</td><td>'.$form->checkbox('buttonbig', '1', $buttonbig)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Google+1 ================ -->
<div id="ccm-button-googleplusone-tab" style="display:none">
<?php
	echo '<br /><table>';

	echo '<tr><td>';
	echo $form->radio('buttongp','on',($buttongp == 'on') or (!$buttongp)) . '表示';
	echo $form->radio('buttongp','of',($buttongp == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ボタンサイズ'.'</td><td>'.$form->select('buttonsize', array(
							'small'=>'小（15px）',
							'medium'=>'中（20px）',
							''=>'標準（24px）',
							'tall'=>'大（60px）+1 情報'), $buttonsize).'</td></tr>';
	echo '</table>';
?>
</div>

<!-- ================ Hatena ================ -->
<div id="ccm-button-hatena-tab" style="display:none">
<?php
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('buttonha','on',($buttonha == 'on') or (!$buttonha)) . '表示';
	echo $form->radio('buttonha','of',($buttonha == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'ボタンタイプ'.'</td><td>'.$form->select('buttontype', array(
							'standard'=>'スタンダード',
							'vertical'=>'バーティカルボタン',
							'simple'=>'シンプルボタン'), $buttontype)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Mixi ================ -->
<div id="ccm-button-mixi-tab" style="display:none">
<?php
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('buttonmx','on',($buttonmx == 'on') or (!$buttonmx)) . '表示';
	echo $form->radio('buttonmx','of',($buttonmx == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'mixiチェックキー'.'</td><td>'.'&nbsp;'.$form->text('mxkey', $mxkey)."</td></tr>";
	echo '<tr><td>'.'mixiボタンタイプ'.'</td><td>'.$form->select('mxbtntype', array(
							'button-1'=>'button-1',
							'button-2'=>'button-2',
							'button-3'=>'button-3',
							'button-4'=>'button-4',
							'button-5'=>'button-5',
							'button-6'=>'button-6'), $mxbtntype)."</td></tr>";
	echo '</table>';
?>
</div>

<!-- ================ Facebook ================ -->
<div id="ccm-button-facebook-tab" style="display:none">
<?php
	echo '<br /><table>';
	echo '<tr><td>';
	echo $form->radio('buttonfb','on',($buttonfb == 'on') or (!$buttonfb)) . '表示';
	echo $form->radio('buttonfb','of',($buttonfb == 'off')) . '非表示';
	echo '</td></tr>';
	echo '<tr><td>'.'AppID'.'</td><td>'.'&nbsp;'.$form->text('fbuser', $fbuser) . "</td></tr>";
	echo '</table>';
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
