<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<!--
<div>
<table border="0"><tr><td>
-->
<?php
	$option = explode('/', $options);
	foreach($option as $op) {

//		echo '<div style="float:left;">';
		switch ($op) {

		case 'twitter':
			echo $twitter;	/* Twitter */
			break;

		case 'googleplusone':
			echo $googleplusone; /* Google+1 */
			break;

		case 'hatena':
			echo $hatena;	/* Hatena */
			break;

		case 'mixi':
			echo $mixi;		/* Mixi */
			break;

		case 'facebook':
			echo $facebook;	/* Facebook */
			break;
		}
//		echo '</div>';
	}
?>
<!--
</td></tr></table>
</div>
-->
