<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    /**
     * Initialization hook method.
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

//        $this->Breadcrumbs->add(
//            __('Questions'),
//            ['controller' => 'questions', 'action' => 'index']
//        );
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Categories.ParentCategories', 'Answers', 'Tips']
        ];
        $questions = $this->paginate($this->Questions);

        $this->set([
            'questions' => $questions,
            '_serialize' => ['questions']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $slug Question slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $question = $this->Questions->find('slug', ['slug' => $slug])
            ->contain(['Categories', 'Categories.ParentCategories', 'Answers', 'Tips'])->first();

        $this->set([
            'question' => $question,
            '_serialize' => ['question']
        ]);

//        $this->Breadcrumbs->add(
//            h($question->title),
//            ['controller' => 'questions', 'action' => 'view', $question->slug]
//        );
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Aura\Intl\Exception
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $categories = $this->Questions->Categories->find('list', ['limit' => 200]);
        $this->set(compact('question', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $slug Question slug.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @throws \Aura\Intl\Exception
     */
    public function edit($slug = null)
    {
        $question = $this->Questions->find('slug', ['slug' => $slug])
            ->contain(['Categories', 'Categories.ParentCategories', 'Answers', 'Answers.Answers', 'Tips'])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->getData(), [
				'associated' => [
					'Categories',
					'Tips',
                    'Answers',
					'Answers.Answers'
				]
			]);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $categories = $this->Questions->Categories->find('list', ['limit' => 200]);
        $this->set(compact('question', 'categories'));

//        $this->Breadcrumbs->add(
//            h($question->title),
//            ['controller' => 'questions', 'action' => 'view', $question->slug]
//        );
    }

    /**
     * Delete method
     *
     * @param string|null $slug Question slug.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Aura\Intl\Exception
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->find('slug', ['slug' => $slug])->first();
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
