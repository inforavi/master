<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * FormsElements Controller
 *
 * @property \App\Model\Table\FormsElementsTable $FormsElements
 */
class FormsElementsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Forms', 'Elements']
        ];
        $formsElements = $this->paginate($this->FormsElements);

        $this->set(compact('formsElements'));
        $this->set('_serialize', ['formsElements']);
    }

    /**
     * View method
     *
     * @param string|null $id Forms Element id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $formsElement = $this->FormsElements->get($id, [
            'contain' => ['Forms', 'Elements']
        ]);

        $this->set('formsElement', $formsElement);
        $this->set('_serialize', ['formsElement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $formsElement = $this->FormsElements->newEntity();
        if ($this->request->is('post')) {
            $formsElement = $this->FormsElements->patchEntity($formsElement, $this->request->data);
            if ($this->FormsElements->save($formsElement)) {
                $this->Flash->success(__('The forms element has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The forms element could not be saved. Please, try again.'));
            }
        }
        $forms = $this->FormsElements->Forms->find('list', ['limit' => 200]);
        $elements = $this->FormsElements->Elements->find('list', ['limit' => 200]);
        $this->set(compact('formsElement', 'forms', 'elements'));
        $this->set('_serialize', ['formsElement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Forms Element id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $formsElement = $this->FormsElements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formsElement = $this->FormsElements->patchEntity($formsElement, $this->request->data);
            if ($this->FormsElements->save($formsElement)) {
                $this->Flash->success(__('The forms element has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The forms element could not be saved. Please, try again.'));
            }
        }
        $forms = $this->FormsElements->Forms->find('list', ['limit' => 200]);
        $elements = $this->FormsElements->Elements->find('list', ['limit' => 200]);
        $this->set(compact('formsElement', 'forms', 'elements'));
        $this->set('_serialize', ['formsElement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Forms Element id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $formsElement = $this->FormsElements->get($id);
        if ($this->FormsElements->delete($formsElement)) {
            $this->Flash->success(__('The forms element has been deleted.'));
        } else {
            $this->Flash->error(__('The forms element could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function renderForm($id = null) {
        $formsElements = \Cake\ORM\TableRegistry::get('FormsElements');
        $queryResult = $formsElements->find('all')
                ->where(['Forms.slug' => 'allergy'])
                ->contain(['Forms', 'Elements']);

        foreach ($queryResult as $key => $result) {
            $finalResult[$key]['from_element_id'] = $result->id;
            $finalResult[$key]['label'] = $result->caption;
            $finalResult[$key]['field_name'] = $result->field_name;
            $finalResult[$key]['required'] = $result->is_required;
            $finalResult[$key]['field_type'] = $result->element->name;
            $finalResult[$key]['form_name'] = $result->form->name;
            $finalResult[$key]['form_slug'] = $result->form->slug;
        }

        $this->set('finalResult', $finalResult);
        $this->set('_serialize', ['finalResult']);
    }

    public function saveDynamicForm() {
        $final = array();
        $i = 0;
        foreach ($this->request->data as $key => $value) {
            if ($key != 'patient_id') {
                $result = explode('__', $key);
                $final[$i]['field_value'] = $value;
                $final[$i]['field_name'] = $result[0];
                $final[$i]['form_element_id'] = $result[1];
                $final[$i]['patient_id'] = $this->request->data['patient_id'];
                $i++;
            }
            
        }
        //pr($final); die; 
        $formValues = \Cake\ORM\TableRegistry::get('FormValues');
        $formValues->saveData($final);
    }
    
    public function medicalHistory() {
        $formsvalues = \Cake\ORM\TableRegistry::get('FormValues');
        $queryResult = $formsvalues->find('all')
                ->select(['form_element_id'])
                ->where(['patient_id' => 120, 'form_id' => 1])
                ->group(['form_element_id']);
        
        pr(json_encode($queryResult)); die;
        
        $this->set('finalResult', $finalResult);
        $this->set('_serialize', ['finalResult']);
    }

}
