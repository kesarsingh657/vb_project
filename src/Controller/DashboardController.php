<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;   

class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        
        $this->Visits = TableRegistry::getTableLocator()->get('Visits');

    
        $this->viewBuilder()->setLayout('sidebar');
    }

    public function admin()
    {
        $today = date('Y-m-d');

        $visits = $this->Visits
            ->find()
            ->where(['visit_date' => $today])
            ->order(['id' => 'DESC'])
            ->all();

        $this->set(compact('visits'));
    }
}
