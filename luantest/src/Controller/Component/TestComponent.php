<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Test component
 */
class TestComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function getTimeNowWithGMT() {
    	return gmdate ( "Y-m-d H:i:s", time () + TIME_GMT * 3600 );
    }
    
}
