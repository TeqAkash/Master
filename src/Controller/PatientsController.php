<?php
declare(strict_types=1);

namespace App\Controller;
use \Cake\Mailer\Mailer;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => ['Appoints'],
        ]);

        $this->set(compact('patient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patient = $this->Patients->newEmptyEntity();
        if ($this->request->is('post')) {
            $body =$this->request->getData();
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                $message = "Your Information Has Been Saved "."\n";  
                $message .= "Patient Name ".$patient->name."\n";          
                $message .= "Patient Age ".$patient->age."\n";          
                $message .= "Patient Email ".$patient->email."\n";          
                $message .= "Patient Phone ".$patient->phone."\n";          
                $mailer = new Mailer();
                $mailer->setTransport('mail');
                $mailer->setFrom(['ajatthework18@gmail.com' => 'Akash Jain'])
                ->setTo($body['email'])
                ->setSubject('Dignostic Hospital')
                ->deliver($message);

                return $this->redirect(['action' => 'logout']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $this->set(compact('patient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $this->set(compact('patient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patient = $this->Patients->get($id);
        if ($this->Patients->delete($patient)) {
            $this->Flash->success(__('The patient has been deleted.'));
        } else {
            $this->Flash->error(__('The patient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function firstpage(){
        $this->viewBuilder()->setLayout('index');
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {   
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','add','firstpage']);
    }

    public function login()
    {
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // debug($result); die;
    // regardless of POST or GET, redirect if user is logged in
    if ($result->isValid()) {
        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'appoints',
            'action' => 'add',
        ]);

        return $this->redirect($redirect);
        }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or Phone'));
        }
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
