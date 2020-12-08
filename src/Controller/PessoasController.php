<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Client;

/**
 * Pessoas Controller
 *
 * @property \App\Model\Table\PessoasTable $Pessoas
 * @method \App\Model\Entity\Pessoa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PessoasController extends AppController
{


    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $pessoas = $this->paginate($this->Pessoas);

        $this->set(compact('pessoas'));
    }

    /**
     * View method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pessoa = $this->Pessoas->get($id, [
            'contain' => ['Historicos'],
        ]);

        $this->set(compact('pessoa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pessoa = $this->Pessoas->newEmptyEntity();
        if ($this->request->is('post')) {
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->getData());
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('The pessoa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pessoa could not be saved. Please, try again.'));
        }
        $this->set(compact('pessoa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pessoa = $this->Pessoas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->getData());
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('The pessoa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pessoa could not be saved. Please, try again.'));
        }
        $this->set(compact('pessoa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pessoa = $this->Pessoas->get($id);
        if ($this->Pessoas->delete($pessoa)) {
            $this->Flash->success(__('The pessoa has been deleted.'));
        } else {
            $this->Flash->error(__('The pessoa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Função: GetSaldoPessoa
     * Objetivo: Retornar Saldo atual de uma determinada pessoa.
     * Data: 07/12/2020
     */
    public function getSaldoPessoa($id = null){

        //Declaração de variáveis
        $array_id_null = array('Erro' => 'Nao foi informado um ID valido');
        $data = null;
        $dados = null;
        $resposta = null;
        $nome = null;

        //Início
        $this -> autoRender = false;  
        //Verifica se algum Id foi informado.
        if (!($id)) {
            //Informa mensagem de erro
            return $this->response->withType("application/json")->withStringBody(json_encode($array_id_null));
        }

        if(($id)){            
            $data = $this->GetDados->GetSaldos($id);

            if (!($data)) {
            //Informa mensagem de erro
            return $this->response->withType("application/json")->withStringBody(json_encode($array_id_null));                
            }

            if(($data)){
            //Recupera o nome da pessoa.
            $nome = $this->GetDados->GetNomePessoa($data['0']['id_pessoa']); 
            $resposta = array('Nome' => $nome, 'Saldo' => $data['0']['total_value']);            
            return $this->response->withType("application/json")->withStringBody(json_encode($resposta));
            }
        }
    }
}
