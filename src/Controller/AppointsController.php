<?php
declare(strict_types=1);

namespace App\Controller;
use \Cake\Mailer\Mailer;

/**
 * Appoints Controller
 *
 * @property \App\Model\Table\AppointsTable $Appoints
 * @method \App\Model\Entity\Appoint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Patients', 'Doctors'],
        ];
        $appoints = $this->paginate($this->Appoints);

        $this->set(compact('appoints'));
    }

    /**
     * View method
     *
     * @param string|null $id Appoint id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appoint = $this->Appoints->get($id, [
            'contain' => ['Patients', 'Doctors'],
        ]);

        $this->set(compact('appoint'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
        $appoint = $this->Appoints->newEmptyEntity();
        if ($this->request->is('post')) {
            $bv =$this->request->getAttribute('identity');
            // debug($bv); die();
            $email= $bv->email;
            // debug($email); die();
            $appoint = $this->Appoints->patchEntity($appoint, $this->request->getData());
             
            $appoint->patient_id = $this->request->getAttribute('identity')->getIdentifier();
            if ($this->Appoints->save($appoint)) {
                $this->Flash->success(__('The appoint has been saved.'));

                $message = "Your Appointment Has Been Fixed"."\n";
                $message .= "Name " .$bv->name."\n";
                $message .= "Appointment Date ".$appoint->appoint_date."\n";

                $mailer = new Mailer();
                $mailer->setTransport('mail');
                $mailer->setFrom(['ajatthework18@gmail.com' => 'Akash Jain'])
                    ->setTo($email)
                    ->setSubject('Diagnostic Hospital')
                    ->deliver($message);

                return $this->redirect(['Controller'=>'Patients','action' => 'logout']);
            }
            $this->Flash->error(__('The appoint could not be saved. Please, try again.'));
        }
        
        $departments = $this->Appoints->Departments->find('list', ['limit' => 200])->all();
        $doctors = $this->Appoints->Doctors->find('list', ['limit' => 200])->all();
        $this->set(compact('appoint', 'doctors','departments'));
    }

   

    /**
     * Edit method
     *
     * @param string|null $id Appoint id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appoint = $this->Appoints->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appoint = $this->Appoints->patchEntity($appoint, $this->request->getData());
            if ($this->Appoints->save($appoint)) {
                $this->Flash->success(__('The appoint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appoint could not be saved. Please, try again.'));
        }
        $patients = $this->Appoints->Patients->find('list', ['limit' => 200])->all();
        $doctors = $this->Appoints->Doctors->find('list', ['limit' => 200])->all();
        $this->set(compact('appoint', 'patients', 'doctors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appoint id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appoint = $this->Appoints->get($id);
        if ($this->Appoints->delete($appoint)) {
            $this->Flash->success(__('The appoint has been deleted.'));
        } else {
            $this->Flash->error(__('The appoint could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function logout()
    {
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Patients', 'action' => 'firstpage']);
        }
    }
   
}
