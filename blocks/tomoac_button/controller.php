<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacButtonBlockController extends BlockController {
	protected $btTable = 'btButtonTomoac';
	protected $btInterfaceWidth = "600";
	protected $btInterfaceHeight = "220";
	
	public function getBlockTypeDescription() {
		return t('Tomoac Button');
	}
	
	public function getBlockTypeName() {
		return t('Social button by tomoac');
	}	 

	function save( $data ) {
		$db = Loader::db();
		if(intval($this->bID) > 0) {
			$q = "select count(*) as total FROM btButtonTomoac WHERE bID = ".$this->bID;
			$total = $db->getOne($q);
		} else 
			$total = 0; 

		if( intval($total) == 0 ) { 
			$vals = array( intval($this->bID), $data['buttontw'], $data['buttongp'], $data['buttonfb'], $data['buttonha'], $data['buttonmx']
					,$data['counter'],$data['user'],$data['user2'],$data['hashtag'],$data['buttonbig'],$data['lang']
					,$data['buttonsize'],$data['annotation']
					,$data['fbuser'], $data['appid']
					,$data['buttonsize'],$data['haurl'],$data['hattl']
					,$data['mxbtntype'],$data['mxkey']
			);
			$db->query("INSERT INTO btButtonTomoac
					(bID, buttontw, buttongp, buttonfb, buttonha, buttonmx
					, counter, user, user2, hashtag, buttonbig, lang
					, buttonsize, annotation
					, fbuser, appid
					, buttontype, haurl, hattl
					, mxbtntype, mxkey
					) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $vals);
		} else {
			$vals = array( $data['buttontw'], $data['buttongp'], $data['buttonfb'], $data['buttonha'], $data['buttonmx']
					,$data['counter'],$data['user'],$data['user2'],$data['hashtag'],$data['buttonbig'],$data['lang']
					,$data['buttonsize'],$data['annotation']
					,$data['fbuser'],$data['appid']
					,$data['buttontype'],$data['haurl'],$data['hattl']
					,$data['mxbtntype'],$data['mxkey']
					,intval($this->bID));
			$db->query("UPDATE btButtonTomoac set 
					buttontw=?, buttongp=?, buttonfb=?, buttonha=?, buttonmx=?
					, counter=?, user=?, user2=?, hashtag=?, buttonbig=?, lang=?
					, buttonsize=?, annotation=?
					, fbuser=?, appid=?
					, buttontype=?, haurl=?, hattl=?
					, mxbtntype=?, mxkey=?
					WHERE bID = ?", $vals);
		}
	}
}
