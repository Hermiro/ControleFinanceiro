<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * ConfigDateComponent component
 */
class ConfigDateComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function convertDateTime ($data_in = null){


    	if (($data_in)) {    		
            
            $data_format = $data_in->i18nFormat('dd/MM/Y, H:m');
    		return $data_format;
    		
    	}

    	if (!($data_in)) {
			//Caso a data não tenha sido informado.   
    		return false;  
        }
    }

}
