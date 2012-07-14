<?php
defined('C5_EXECUTE') or die("Access Denied.");

	$db = Loader::db();

	$bID = $_POST["bid"];
	$options = $_POST["p"];

	//error_log('bID='.$bID.'/opt='.$options,0);

	try {
		$sql = "UPDATE btTomoacButton SET options='$options' WHERE bID=$bID";
		$result = $db->query( $sql );
	} catch (Exception $e) {
		error_log('error:'.$e,0);
	}
?>
