<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class TomoacButtonPackage extends Package {

     protected $pkgHandle = 'tomoac_button';
     protected $appVersionRequired = '5.4.0';
     protected $pkgVersion = '0.5.0';

     public function getPackageDescription() {
          return t('Tomoac Button');
     }

     public function getPackageName() {
          return t('Social button by tomoac');
     }

     public function install() {
          $pkg = parent::install();

          // install block 
          BlockType::installBlockTypeFromPackage('tomoac_button', $pkg); 
     }
}
?>