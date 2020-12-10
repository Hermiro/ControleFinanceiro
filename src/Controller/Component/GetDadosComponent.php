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
    $nome = null;
    $nome_destino =null;
    $operacao = null;
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

    //Outros Componentes 
    public $components = ['ConfigDate', 'ConfigMessage'];    
    
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
                return $dados = array_values($dados);
            }
        }
    }

    /**
     * Função: GetOperacaoName
     * Objetivo: Recupera o nome da operação dado o ID
     */
    public function GetOperacaoName($id = null){

        //Valida input
        if (!($id)) {
            return false;
        }

        if(($id)){
            $this->operacaoTable = TableRegistry::get('Operacoes');
            $this->operacaoTable = TableRegistry::getTableLocator()->get('Operacoes');  
            
            $data = $this->operacaoTable->find('list', ['conditions' => ['Operacoes.id' => "$id"]]);
            $dados = $data->toArray();

            if (!($dados)) {
                return false;
            }

            if(($dados)){
                return $dados = array_values($dados);
            }
        }
    }

    /**
     * Função: NumberFormatForBRL
     * Objetivo: Configurar o número informado para real (BRL)
     */
    public function NumberFormatForBRL ($value = null){

        if (empty($value)) {
            return false;
        }

        if (!empty($value)) {
            $value = "R$ ".number_format($value,2,",",".");
            return $value;
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
            $historico->valor_anterior_pessoa_destino = $array_in['Valor_anterior_pessoa_destino'];
            $historico->valor_final_pessoa_destino = $array_in['Valor_final_pessoa_destino'];

            //Executa o save.
            if ($this->historictable->save($historico)) {
                return true;
            }else{
                return false;
            }
        }         
    }

    /**
     * Função: GetHistoric
     * Objetivo: Retornar o historico dados um ID
     */
    public function GetHistoric($id = null){

        //Declaração da variáveis
        $array_out = array();
        $array_out_aux = array();

        //Valida input
        if(!($id)){
            return false;
        }     
        
        if(($id)){
            $this->historictable = TableRegistry::get('Historicos');
            $this->historictable = TableRegistry::getTableLocator()->get('Historicos');   

            $data = $this->historictable->find('all', ['conditions' => ['Historicos.pessoa_id' => "$id"]]);            
            $dados = $data->toArray();  

            //Recupera informações sobre transferências
            $data_aux = $this->historictable->find('all', ['conditions' => ['Historicos.pessoa_destino_id' => "$id"]]);
            $dados_aux = $data_aux->toArray();

            //Se o valor de $dados não for encontrado retorna FALSE
            if(!($dados) and !($dados_aux)){
                return false;
            }         

            //Se o valor da dados estiver vazio porém houver dados de transferencia, iguala.
            if(!($dados) and ($dados_aux)){
                $dados = $dados_aux;
            }
            
            //Se houver valores nos dois arrays, combina.
            if(($dados) and ($dados_aux)){
                $last_key = array_key_last($dados);
                $last_key = $last_key + 1;
                //debug($last_key);
                foreach($dados_aux as $key => $value):
                    $dados[$last_key] = $value;
                    $last_key = $last_key + 1;
                endforeach;
            }           


            //Configura o array de saída
            if (($dados)) {
                foreach($dados as $key => $value):

                    $nome = $this->GetNomePessoa($value->pessoa_id);
                    $nome_destino = $this->GetNomePessoa($value->pessoa_destino_id);
                    $operacao = $this->GetOperacaoName($value->operacao_id);
                    
                    if($value->operacao_id == 3){

                        //Quando o IF informado for diferente do ID do campo pessoa ID
                        if($value->pessoa_id <> $id){
                            $array_out_aux = array(     'Pessoa' => $nome['0'],
                            'Operacao' => $operacao['0'],
                            'Destinatario' => $nome_destino['0'],
                            'Valor_operacao' => $this->NumberFormatForBRL($value->valor), 
                            'Valor_anterior' => $this->NumberFormatForBRL($value->valor_anterior_pessoa_destino),
                            'Valor_final' => $this->NumberFormatForBRL($value->valor_final_pessoa_destino));
                        }

                        //Quando forem iguais, significa que a receptor está olhando seu histórico.
                        if($value->pessoa_id == $id){
                            $array_out_aux = array(     'Pessoa' => $nome['0'],
                            'Operacao' => $operacao['0'],
                            'Destinatario' => $nome_destino['0'],
                            'Valor_operacao' => $this->NumberFormatForBRL($value->valor), 
                            'Valor_anterior' => $this->NumberFormatForBRL($value->valor_anterior),
                            'Valor_final' => $this->NumberFormatForBRL($value->valor_final));
                        }                 


                    } else{
                        $array_out_aux = array(     'Pessoa' => $nome['0'],
                                                    'Operacao' => $operacao['0'],
                                                    'Valor_operacao' => $this->NumberFormatForBRL($value->valor), 
                                                    'Valor_anterior' => $this->NumberFormatForBRL($value->valor_anterior),
                                                    'Valor_final' => $this->NumberFormatForBRL($value->valor_final));                        
                    }   
                    if(!($array_out)){
                        $array_out[$key] = $array_out_aux;                        
                    }else{                        
                        $key = $key++;
                        $array_out[$key] = $array_out_aux;
                    }
                    $array_out_aux = array();                                                           
                endforeach;
                return $array_out;
            }

            if(!($data)){
                return false;
            }
        }
    }
}