<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Saldos Controller
 *
 * @property \App\Model\Table\SaldosTable $Saldos
 * @method \App\Model\Entity\Saldo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaldosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $saldos = $this->paginate($this->Saldos);

        $this->set(compact('saldos'));
    }

    /**
     * View method
     *
     * @param string|null $id Saldo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $saldo = $this->Saldos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('saldo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saldo = $this->Saldos->newEmptyEntity();
        if ($this->request->is('post')) {
            $saldo = $this->Saldos->patchEntity($saldo, $this->request->getData());
            if ($this->Saldos->save($saldo)) {
                $this->Flash->success(__('The saldo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The saldo could not be saved. Please, try again.'));
        }
        $this->set(compact('saldo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Saldo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saldo = $this->Saldos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saldo = $this->Saldos->patchEntity($saldo, $this->request->getData());
            if ($this->Saldos->save($saldo)) {
                $this->Flash->success(__('The saldo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The saldo could not be saved. Please, try again.'));
        }
        $this->set(compact('saldo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Saldo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saldo = $this->Saldos->get($id);
        if ($this->Saldos->delete($saldo)) {
            $this->Flash->success(__('The saldo has been deleted.'));
        } else {
            $this->Flash->error(__('The saldo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Função: DoDebit
     * Objetivo: Realiza a operação de débito
     *           O primeiro parâmetro faz referencia a pessoa 
     *           O segundo parâmetro faz referencia ao valor a ser debitado.
     *           Ao final do processo atualiza o saldo total da conta.
     *           Valida se o saldo ficar negativo.
     */
    public function doDebit($id = null, $valor = null){

        //Declaração de variáveis.
        $data = null;
        $dados = null;
        $saldo_inicial = null;
        $saldo_final = null;
        $valor_debito = null;
        $check_num = null;
        $array_id_null = array('Erro' => 'Nao foi informado um ID valido');
        $array_valor_error = array('Erro' => 'Por favor, informe um valor numerico valido');
        $array_saldo_negativo = array('Erro' => 'Saldo nao pode ser inferior a 0.');
        $array_atualiza_saldo_error = array('Erro' => 'Nao foi possivel atualizar o saldo');
        $array_atualiza_saldo_sucess = array('Sucesso' => 'Saldo atualizado com sucesso');
        $array_return_param_error = array('Erro' => 'Parametros insuficientes');
        $array_aux = array();
        $array_historico = array();
        $save_historico = null;
        $saldo_new = $this->Saldos->newEmptyEntity();
        $saldotable = $this->getTableLocator()->get('Saldos');      
           
        //Validação dos inputs        
        if (!($id) or !($valor)) {
            //Informa mensagem de erro
            return $this->response->withType("application/json")->withStringBody(json_encode($array_return_param_error));                
        }        

        //Valida se o valor informado no saldo é float
        $check_num = is_numeric($valor);
        if(!($check_num)){
                //Informa mensagem de erro
                return $this->response->withType("application/json")->withStringBody(json_encode($array_valor_error));                
        }

        if(($id) and ($valor)){
            //Recupera o valor do saldo da pessoa.
            //$data = $this->GetDados->GetSaldos($id);
            $data = $this->Saldos->get($id, [
                'contain' => [],
            ]);

            //Se não retorna valor, pessoa não existe.
            if (($data)) {
                $saldo_inicial = $data->total_value;
                $valor_debito = $valor;

                //Realiza o débito
                $saldo_final = $saldo_inicial - $valor_debito;

                //Verifica se o valor é menor que zero.
                if ($saldo_final < 0) {
                    //Informa mensagem de erro
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_saldo_negativo));                
                }
                $data->total_value = $saldo_final;
                $saldo_new = $data;

                if ($this->Saldos->save($saldo_new)) {

                        //Configura o array para salvar informações no histórico
                        $array_historico = array(   'Pessoa_id' => $data->id, 
                        'Pessoa_destino' => $data->id, 
                        'Operacao_id' => 2, 
                        'Valor' => $valor,
                        'Valor_anterior' => $saldo_inicial,
                        'Valor_final'    => $saldo_final);

                        $save_historico = $this->GetDados->FeedHistorico($array_historico); 

                    //Informa mensagem de sucesso
                    $array_aux = array('Valor_atual' => $saldo_final);
                    $array_atualiza_saldo_sucess = $this->ConfigMessage->ConfigMessage($array_atualiza_saldo_sucess, $array_aux);                    
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_atualiza_saldo_sucess));                

                }else{
                    //Informa mensagem de erro
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_atualiza_saldo_error));                
                }           
            }else{
                //Informa mensagem de erro
                return $this->response->withType("application/json")->withStringBody(json_encode($array_id_null));                
            }
        }
    }

    /**
     * Função: doCredit
     * Objetivo: Realizar um depósito na conta da pessoa informada.
     */
    public function doCredit($id = null, $valor = null){

        //Declaração de variáveis.
        $data = null;
        $dados = null;
        $saldo_inicial = null;
        $saldo_final = null;
        $valor_credito = null;
        $check_num = null;
        $array_id_null = array('Erro' => 'Nao foi informado um ID valido');
        $array_valor_error = array('Erro' => 'Por favor, informe um valor numerico valido');
        $array_saldo_negativo = array('Erro' => 'Saldo nao pode ser inferior a 0.');
        $array_atualiza_saldo_error = array('Erro' => 'Nao foi possivel atualizar o saldo');
        $array_atualiza_saldo_sucess = array('Sucesso' => 'Saldo atualizado com sucesso');
        $array_return_param_error = array('Erro' => 'Parametros insuficientes');
        $array_aux = array();
        $array_historico = array();
        $save_historico = null;
        $saldo_new = $this->Saldos->newEmptyEntity();
        $saldotable = $this->getTableLocator()->get('Saldos');
      
        //Validação dos inputs        
        if (!($id) or !($valor)) {
            //Informa mensagem de erro
            return $this->response->withType("application/json")->withStringBody(json_encode($array_return_param_error));                
        }  
        
        //Valida se o valor informado no saldo é float
        $check_num = is_numeric($valor);
        if(!($check_num)){
                //Informa mensagem de erro
                return $this->response->withType("application/json")->withStringBody(json_encode($array_valor_error));                
        }
        
        if(($id) and ($valor)){
            //Recupera o valor do saldo da pessoa.
            //$data = $this->GetDados->GetSaldos($id);
            $data = $this->Saldos->get($id, [
                'contain' => [],
            ]);

            //Se não retorna valor, pessoa não existe.
            if (($data)) {
                $saldo_inicial = $data->total_value;
                $valor_credito = $valor;

                //Realiza o débito
                $saldo_final = $saldo_inicial + $valor_credito;

                //Verifica se o valor é menor que zero.
                if ($saldo_final < 0) {
                    //Informa mensagem de erro
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_saldo_negativo));                
                }
                $data->total_value = $saldo_final;
                $saldo_new = $data;

                if ($this->Saldos->save($saldo_new)) {

                        //Configura o array para salvar informações no histórico
                        $array_historico = array(   'Pessoa_id' => $data->id, 
                        'Pessoa_destino' => $data->id, 
                        'Operacao_id' => 1, 
                        'Valor' => $valor,
                        'Valor_anterior' => $saldo_inicial,
                        'Valor_final'    => $saldo_final);

                        $save_historico = $this->GetDados->FeedHistorico($array_historico);                    

                    //Informa mensagem de sucesso
                    $array_aux = array('Valor_atual' => $saldo_final);
                    $array_atualiza_saldo_sucess = $this->ConfigMessage->ConfigMessage($array_atualiza_saldo_sucess, $array_aux);                    
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_atualiza_saldo_sucess));                

                }else{
                    //Informa mensagem de erro
                    return $this->response->withType("application/json")->withStringBody(json_encode($array_atualiza_saldo_error));                
                }           
            }else{
                //Informa mensagem de erro
                return $this->response->withType("application/json")->withStringBody(json_encode($array_id_null));                
            }
        }        

    }
}