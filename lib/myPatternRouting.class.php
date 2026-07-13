<?php

class myPatternRouting extends sfPatternRouting 
{
  public function parse($url) 
  {

    
    $url = rtrim($url, '/'); # trim trailing slashes before actual routing
        
    return parent::parse($url);
    
 
    }  


}
