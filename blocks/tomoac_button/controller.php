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

	function view(){
		$page = Page::getCurrentPage();
		$url = BASE_URL . DIR_REL . $page->getCollectionPath();
		$this->set('url',$url);
	}
}
