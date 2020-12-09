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
                //Informa mensagem de erro
                return $dados['1'];
            }
        }
    }

    /**
     * Função: FeedHistorico
     * Objetivo: Alimentar a tabela de historico dados valores iniciais.
     *           Os parâmetros de entrada são exatamente os campos da tabela 'Histórico'
     *           As operações são cadastradas em tabela sendo:
     *           1 - Crédito
     *           2 - Debito
     *           3 - Transferencias.
     */
    public function FeedHistorico($array_in = null){

        //Declaração de variáveis


        //Verifica a entrada de dados.
        if(!($array_in)){
            return false;
        }

        if (($array_in)) {
            $this->historictable = TableRegistry::get('Historicos');
            $this->historictable = TableRegistry::getTableLocator()->get('Historicos');          
            $historico = $this->historictable->newEmptyEntity();

            //Configura os campos 
            $historico->pessoa_id = $array_in['Pessoa_id'];
            $historico->pessoa_destino_id = $array_in['Pessoa_destino'];
            $historico->operacao_id = $array_in['Operacao_id'];
            $historico->valor = $array_in['Valor'];
            $historico->valor_anterior = $array_in['Valor_anterior'];
            $historico->valor_final = $array_in['Valor_final'];

            //Executa o save.
            if ($this->historictable->save($historico)) {
                return true;
            }else{
                return false;
            }
        }         
    }
}