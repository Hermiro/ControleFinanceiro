<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * ConfigMessage component
 */
class ConfigMessageComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Função: ConfigMEssage
     * Objetivo: Formata os textos de saída 
     */
    public function ConfigMessage($array_1 = array(), $array_2 = array()){

        //Verifica entrada
        if(!($array_1) or !($array_2)){
            return false;
        }

        if(($array_1) and ($array_2)){
            $array_1 = array_merge($array_1, $array_2);
            return $array_1;            
        }
    }
}
