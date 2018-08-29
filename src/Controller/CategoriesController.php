<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentCategories']
        ];
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $slug Category slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
//        $category = $this->Categories->get($slug, [
//            'contain' => ['ParentCategories', 'ChildCategories', 'Questions']
//        ]);
        $category = $this->Categories->find('slug', ['slug' => $slug])
            ->contain(['ParentCategories', 'ChildCategories', 'Questions'])->first();

        $this->set('category', $category);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Aura\Intl\Exception
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $slug Category slug.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @throws \Aura\Intl\Exception
     */
    public function edit($slug = null)
    {
        $category = $this->Categories->find('slug', ['slug' => $slug])
            ->contain(['ParentCategories'])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $slug Category slug.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Aura\Intl\Exception
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->find('slug', ['slug' => $slug])->first();
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
