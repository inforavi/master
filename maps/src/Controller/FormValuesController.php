<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FormValues Controller
 *
 * @property \App\Model\Table\FormValuesTable $FormValues
 */
class FormValuesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        $this->paginate = [
            'contain' => ['Patients', 'Forms', 'FormsElements']
        ];
        
        $formValues = $this->paginate($this->FormValues);

        $this->set(compact('formValues'));
        $this->set('_serialize', ['formValues']);
    }

    /**
     * View method
     *
     * @param string|null $id Form Value id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formValue = $this->FormValues->get($id, [
            'contain' => ['Patients', 'Forms', 'FormElements']
        ]);

        $this->set('formValue', $formValue);
        $this->set('_serialize', ['formValue']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formValue = $this->FormValues->newEntity();
        if ($this->request->is('post')) {
            $formValue = $this->FormValues->patchEntity($formValue, $this->request->data);
            if ($this->FormValues->save($formValue)) {
                $this->Flash->success(__('The form value has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The form value could not be saved. Please, try again.'));
            }
        }
        $patients = $this->FormValues->Patients->find('list', ['limit' => 200]);
        $forms = $this->FormValues->Forms->find('list', ['limit' => 200]);
        $formElements = $this->FormValues->FormElements->find('list', ['limit' => 200]);
        $this->set(compact('formValue', 'patients', 'forms', 'formElements'));
        $this->set('_serialize', ['formValue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Form Value id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formValue = $this->FormValues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formValue = $this->FormValues->patchEntity($formValue, $this->request->data);
            if ($this->FormValues->save($formValue)) {
                $this->Flash->success(__('The form value has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The form value could not be saved. Please, try again.'));
            }
        }
        $patients = $this->FormValues->Patients->find('list', ['limit' => 200]);
        $forms = $this->FormValues->Forms->find('list', ['limit' => 200]);
        $formElements = $this->FormValues->FormElements->find('list', ['limit' => 200]);
        $this->set(compact('formValue', 'patients', 'forms', 'formElements'));
        $this->set('_serialize', ['formValue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Form Value id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formValue = $this->FormValues->get($id);
        if ($this->FormValues->delete($formValue)) {
            $this->Flash->success(__('The form value has been deleted.'));
        } else {
            $this->Flash->error(__('The form value could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
