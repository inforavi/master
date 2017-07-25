<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Consumers Controller
 *
 * @property \App\Model\Table\ConsumersTable $Consumers
 */
class ConsumersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $consumers = $this->paginate($this->Consumers);

        $this->set(compact('consumers'));
        $this->set('_serialize', ['consumers']);
    }

    /**
     * View method
     *
     * @param string|null $id Consumer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $consumer = $this->Consumers->get($id, [
            'contain' => ['Patients']
        ]);

        $this->set('consumer', $consumer);
        $this->set('_serialize', ['consumer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $consumer = $this->Consumers->newEntity();
        if ($this->request->is('post')) {
            $consumer = $this->Consumers->patchEntity($consumer, $this->request->data);
            if ($this->Consumers->save($consumer)) {
                $this->Flash->success(__('The consumer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The consumer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('consumer'));
        $this->set('_serialize', ['consumer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Consumer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $consumer = $this->Consumers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $consumer = $this->Consumers->patchEntity($consumer, $this->request->data);
            if ($this->Consumers->save($consumer)) {
                $this->Flash->success(__('The consumer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The consumer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('consumer'));
        $this->set('_serialize', ['consumer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $consumer = $this->Consumers->get($id);
        if ($this->Consumers->delete($consumer)) {
            $this->Flash->success(__('The consumer has been deleted.'));
        } else {
            $this->Flash->error(__('The consumer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
