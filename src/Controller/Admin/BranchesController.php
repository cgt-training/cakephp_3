<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Branches Controller
 *
 * @property \App\Model\Table\BranchesTable $Branches
 */
class BranchesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    //The default page of branches load by this function.
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $branches = $this->paginate($this->Branches);

        $this->set(compact('branches'));
        $this->set('_serialize', ['branches']);
    }

    /**
     * View method
     *
     * @param string|null $id Branch id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    //User can view the data of perticular branch.
    public function view($id = null)
    {
        $branch = $this->Branches->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('branch', $branch);
        $this->set('_serialize', ['branch']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    //User can add the branch by this function
    public function add()
    {
        $branch = $this->Branches->newEntity();
        if ($this->request->is('post')) {
            $branch = $this->Branches->patchEntity($branch, $this->request->getData());
            if ($this->Branches->save($branch)) {
                $this->Flash->success(__('The branch has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The branch could not be saved. Please, try again.'));
        }
        $branches = $this->Branches->Branches->find('list', ['limit' => 200]);
        $companies = $this->Branches->Companies->find('list', ['limit' => 200]);
        $this->set(compact('branch', 'branches', 'companies'));
        $this->set('_serialize', ['branch']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Branch id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    //User can edit the branch data by edit function
    public function edit($id = null)
    {
        $branch = $this->Branches->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $branch = $this->Branches->patchEntity($branch, $this->request->getData());
            if ($this->Branches->save($branch)) {
                $this->Flash->success(__('The branch has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The branch could not be saved. Please, try again.'));
        }
        $branches = $this->Branches->Branches->find('list', ['limit' => 200]);
        $companies = $this->Branches->Companies->find('list', ['limit' => 200]);
        $this->set(compact('branch', 'branches', 'companies'));
        $this->set('_serialize', ['branch']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Branch id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    //User can delete the perticular branch by delete function
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $branch = $this->Branches->get($id);
        if ($this->Branches->delete($branch)) {
            $this->Flash->success(__('The branch has been deleted.'));
        } else {
            $this->Flash->error(__('The branch could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
