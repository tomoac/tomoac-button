<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacButtonBlockController extends BlockController {

	protected $btTable = 'btTomoacButton';
	protected $btInterfaceWidth = "600";
	protected $btInterfaceHeight = "260";
	
	public function getBlockTypeDescription() {
		return t('Tomoac Button');
	}
	
	public function getBlockTypeName() {
		return t('Social button by tomoac');
	}

	function view(){
		
//		error_log('view bid='.$this->bID,0);

		$page = Page::getCurrentPage();
		$url = BASE_URL . DIR_REL . $page->getCollectionPath();

		$db = Loader::db();

		if(intval($this->bID) == 0)
			return;

		$this->set('bID',intval($this->bID));

		$rows = $db->query("SELECT * FROM btTomoacButton WHERE bID=$this->bID LIMIT 1");
		$row = $rows->fetchrow();
		$contents = json_decode( $row{'contents'} );

		$options = $row{'options'};
		if(empty($options))
			$options = "twitter/googleplusone/hatena/mixi/facebook";
		$this->set('options',$options);


		foreach($contents as $content) {
//			error_log($content->{'kinda'}.'('.$content->{'onoff'}.')',0);

			if($content->{'onoff'} == 'off')
				continue;

			switch ($content->{'kinda'}) {

			case 'twitter':			// ==== twitter ==== //

				$data_url = 'data-url="'.$url.'"';
				$data_via = 'data-via="'.trim($content->{'user'}).'"';
				if(!strlen(trim($content->{'user'})))
					$data_via = '';
				$data_size = 'data-size="large"';
				if($content->{'buttonsize'} == 0)
					$data_size = '';
				$data_count = 'data-count="none"';
				if($content->{'count'} == 1)
					$data_count = '';
				$html = '
<!-- start twitter -->
<a href="https://twitter.com/share" class="twitter-share-button" '.$data_url.' '.$data_via.' '.$data_size.' '.$data_count.' data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- end twitter -->
';
				$this->set('twitter',$html);
				break;

			case 'googleplusone':	// ==== google plus one ==== //

				$data_url = 'href="'.$url.'"';
				if($content->{'buttonsize'} != '')
					$bsize = 'size="'.$content->{'buttonsize'}.'"';
				$html = "
<!-- start googleplusone -->
<g:plusone $bsize $data_url></g:plusone>
<script type=\"text/javascript\">
  window.___gcfg = {lang: 'ja'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- end googleplusone -->
";
				$this->set('googleplusone',$html);
				break;

			case 'hatena':			// ====== Hatena ===== //

				$html = '
<!-- start hatena -->
<a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="'.$content->{'buttontype'}.'" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<!-- end hatena -->
';
				$this->set('hatena',$html);
				break;

			case 'mixi':			// ====== Mixi ===== //

				if(strlen($content->{'key'}) != 0) {
					$html = '
<!-- start mixi -->
<a href="http://mixi.jp/share.pl" class="mixi-check-button" data-key="'.$content->{'key'}.'" data-url="'.$url.'" data-button="'.$content->{'buttontype'}.'">mixiチェック</a>
<script type="text/javascript" src="http://static.mixi.jp/js/share.js"></script>
<!-- end mixi -->
';
					$this->set('mixi',$html);
				}
				break;

			case 'facebook':		// ====== Facebook ===== //

				$send   = ' data-send="'.$content->{'send'}.'"';
				$layout = $content->{'layout'}?' data-layout="'.$content->{'layout'}.'"':'';
				$width  = $content->{'width'} ?' data-width="'.$content->{'width'}.'"':'';
				$show   = ' data-show-faces="'.$content->{'showfaces'}.'"';
				$action = $content->{'action'}?' data-action="'.$content->{'action'}.'"':'';
				$color  = $content->{'color'} ?' data-colorscheme="'.$content->{'color'}.'"':'';
				$font   = $content->{'font'}  ?' data-font="'.$content->{'font'}.'"':'';

				$html = '
<!-- start facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-like" data-href="'.$url.'" '.$send . $layout . $width . $show . $action . $color . $font .'></div>
<!-- end facebook -->
';
				$this->set('facebook',$html);
				break;
			}
		}
	}

	function save( $data ) {

//		error_log('save bid='.$this->bID,0);

		$bID = $this->bID;
		$contents = array();

		// ======== twitter ======= //
		$twitter['kinda'] = 'twitter';
		$twitter['onoff'] = $data['twitter_onoff'];
		$twitter['user'] = $data['twitter_user'];
		$twitter['count'] = $data['twitter_count'];
		$twitter['buttonsize'] = $data['twitter_buttonsize'];
		$contents[] = $twitter;

		// ==== google plusone ==== //
		$googleplusone['kinda'] = 'googleplusone';
		$googleplusone['onoff'] = $data['googleplusone_onoff'];
		$googleplusone['buttonsize'] = $data['googleplusone_buttonsize'];
		$contents[] = $googleplusone;

		// ======== hatena ======== //
		$hatena['kinda'] = 'hatena';
		$hatena['onoff'] = $data['hatena_onoff'];
		$hatena['buttontype'] = $data['hatena_buttontype'];
		$contents[] = $hatena;

		// ========= mixi ========= //
		$mixi['kinda'] = 'mixi';
		$mixi['onoff'] = $data['mixi_onoff'];
		$mixi['key'] = $data['mixi_key'];
		$mixi['buttontype'] = $data['mixi_buttontype'];
		$contents[] = $mixi;

		// ======= facebook ======= //
		$facebook['kinda'] = 'facebook';
		$facebook['onoff'] = $data['facebook_onoff'];
		$facebook['appid'] = $data['facebook_appid'];
		$facebook['send'] = $data['facebook_send']==1?'true':'false';
		$facebook['layout'] = $data['facebook_layout'];
		$facebook['width'] = $data['facebook_width'];
		$facebook['showfaces'] = $data['facebook_showfaces']==1?'true':'false';
		$facebook['verb'] = $data['facebook_verb'];
		$facebook['color'] = $data['facebook_color'];
		$facebook['font'] = $data['facebook_font'];
		$contents[] = $facebook;

		$this->update_database( $this->bID, json_encode( $contents ));
	}

	function update_database ( $bID, $contents ) {
		$db = Loader::db();
		if(intval($bID) > 0) {
			$q = "SELECT count(*) AS total FROM btTomoacButton WHERE bID=$bID";
			$total = $db->getOne($q);
		} else 
			$total = 0;

		if( intval($total) == 0 ) { 
			$vals = array( intval($bID), $contents);
			$db->query("INSERT INTO btTomoacButton (bID, contents ) values (?,?)", $vals);
		} else {
			$vals = array( $contents, intval($bID));
			$db->query("UPDATE btTomoacButton set contents=? WHERE bID=?", $vals);
		}
	}
}
