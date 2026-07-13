<?php

// FriendsOfSymfony1 fork (PHP 8.x) loaded via Composer; its autoload.php registers sfCoreAutoload.
require_once dirname(__FILE__).'/../vendor/autoload.php';

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array('sfDoctrinePlugin','sfJqueryReloadedPlugin','sfDoctrineGuardPlugin'));
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->setWebDir($this->getRootDir().'/public_html');
  }
}
