<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception\Exception;

    //Variaveis publicas
    $data  = null;
    $dados = null;
    $table = null;
/**
 * GetDados component
 */
class GetDadosComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function initialize(array $config):void {
        parent::initialize($config);        
        $this->table = TableRegistry::get('Saldos');
        $this->table = TableRegistry::getTableLocator()->get('Saldos');      
        
    }    

    /**
     * Função: GetSaldos
     * Objetivo: Recuperar o saldo de uma pessoa dado o ID
     */
    public function GetSaldos($id = null){
        //Verifica se foi informado um ID
        if(($id)){            
            $data = $this->table->find('all', ['conditions' => ['Saldos.id' => "$id"]]);
            $dados = $data->toArray();
            if($dados){
                return $dados;
            }else{
                return false;
            }
        }

        if(!($id)){
            return false;
        }
    }

    /**
     * Função: GetNomePessoa
     * Objetivo: Recuperar o nome de uma pessoa pelo ID
     */
    public function GetNomePessoa($id = null){
    
        
    //Verifica se foi informado um ID
        if(!($id)){
        return false;
        }
    
        if (($id)) {
            $this->table = TableRegistry::get('Pessoas');
            $this->table = TableRegistry::getTableLocator()->get('Pessoas');
            $data = $this->table->find('list', ['conditions' => ['Pessoas.id' => "$id"]]);
            $dados = $data->toArray();
            if (!($dados)) {
                return false;
            }else{
                return $dados;
            }
        }
    }

}