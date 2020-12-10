<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Operacoes Controller
 *
 * @property \App\Model\Table\OperacoesTable $Operacoes
 * @method \App\Model\Entity\Operaco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OperacoesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $operacoes = $this->paginate($this->Operacoes);

        $this->set(compact('operacoes'));
    }

    /**
     * View method
     *
     * @param string|null $id Operaco id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $operaco = $this->Operacoes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('operaco'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $operaco = $this->Operacoes->newEmptyEntity();
        if ($this->request->is('post')) {
            $operaco = $this->Operacoes->patchEntity($operaco, $this->request->getData());
            if ($this->Operacoes->save($operaco)) {
                $this->Flash->success(__('The operaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The operaco could not be saved. Please, try again.'));
        }
        $this->set(compact('operaco'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Operaco id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $operaco = $this->Operacoes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $operaco = $this->Operacoes->patchEntity($operaco, $this->request->getData());
            if ($this->Operacoes->save($operaco)) {
                $this->Flash->success(__('The operaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The operaco could not be saved. Please, try again.'));
        }
        $this->set(compact('operaco'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Operaco id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $operaco = $this->Operacoes->get($id);
        if ($this->Operacoes->delete($operaco)) {
            $this->Flash->success(__('The operaco has been deleted.'));
        } else {
            $this->Flash->error(__('The operaco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
