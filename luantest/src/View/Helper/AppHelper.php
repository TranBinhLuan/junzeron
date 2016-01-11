<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * App helper
 */
class AppHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    function url($url = null, $full = false) {
    	if(!isset($url['language']) && isset($this->params['language'])) {
    		$url['language'] = $this->params['language'];
    	}
    
    	return parent::url($url, $full);
    }
}
