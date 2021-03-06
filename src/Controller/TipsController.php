<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tips Controller
 *
 * @property \App\Model\Table\TipsTable $Tips
 *
 * @method \App\Model\Entity\Tip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions']
        ];
        $tips = $this->paginate($this->Tips);

        $this->set(compact('tips'));
    }

    /**
     * View method
     *
     * @param string|null $id Tip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tip = $this->Tips->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('tip', $tip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tip = $this->Tips->newEntity();
        if ($this->request->is('post')) {
            $tip = $this->Tips->patchEntity($tip, $this->request->getData());
            if ($this->Tips->save($tip)) {
                $this->Flash->success(__('The tip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tip could not be saved. Please, try again.'));
        }
        $questions = $this->Tips->Questions->find('list', ['limit' => 200]);
        $this->set(compact('tip', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tip = $this->Tips->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tip = $this->Tips->patchEntity($tip, $this->request->getData());
            if ($this->Tips->save($tip)) {
                $this->Flash->success(__('The tip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tip could not be saved. Please, try again.'));
        }
        $questions = $this->Tips->Questions->find('list', ['limit' => 200]);
        $this->set(compact('tip', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tip = $this->Tips->get($id);
        if ($this->Tips->delete($tip)) {
            $this->Flash->success(__('The tip has been deleted.'));
        } else {
            $this->Flash->error(__('The tip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
