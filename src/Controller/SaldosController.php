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
}
