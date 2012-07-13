<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

	if(strlen($buttonsize) == 0)
		$size = '';
	else
		$size = 'size="'.$buttonsize.'"';
?>
<div>

<table border="0"><tr><td>

<!-- ================  Twitter ================  -->
<div style="float:left;">
<?php
	$data_url = 'data-url="'.$url.'"';
	if(strlen(trim($user)) != 0)
		$data_via = 'data-via="'.trim($user).'"';
	else
		$data_via = '';
?>
<a href="https://twitter.com/share" class="twitter-share-button" <?php echo $data_url.' '.$data_via; ?> data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<!-- ================  Google+1 ================  -->
<div style="float:left;">
<?php
	$data_url = 'href="'.$url.'"';
	if($buttonsize != '')
		$bsize = 'size="'.$buttonsize.'"'
?>
<g:plusone <?php echo $bsize.' '.$data_url; ?>></g:plusone>
<script type="text/javascript">
  window.___gcfg = {lang: 'ja'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

<!-- ================  Hatena ================  -->
<div style="float:left;">
<?php
	$data_url = $url;
	if($hattl != '')
		$hattl = 'data-hatena-bookmark-title="'.$hattl.'"'
?>
<a href="http://b.hatena.ne.jp/entry/<?php echo $data_url; ?>" class="hatena-bookmark-button" <?php echo $hattl; ?> data-hatena-bookmark-layout="<?php echo $buttontype; ?>" title="このエントリーをはてなブックマークに追加">
<img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" />
</a>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>

</a>
</div>

<!-- ================  Mixi ================ -->
<div style="float:left;">
<?php
	$data_url = $url;
	if(strlen($mxkey) != 0) {
?>
<a href="http://mixi.jp/share.pl" class="mixi-check-button" data-key="<?php echo $mxkey; ?>" data-url="<?php echo $data_url; ?>" data-button="<?php echo $mxbtntype; ?>">mixiチェック</a>
<script type="text/javascript" src="http://static.mixi.jp/js/share.js"></script>
<?php
	}
?>
</div>

<!-- ================  Facebook ================ -->
<div style="float:left;">
<?php
	$data_href = $url;
	if($hattl != '')
		$hattl = 'data-hatena-bookmark-title="'.$hattl.'"'
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="<?php echo $data_href; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
</div>

</td></tr></table>
</div>
