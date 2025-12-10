<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;   // <-- REQUIRED IMPORT

class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // FIX: Load model without loadModel()
        $this->Visits = TableRegistry::getTableLocator()->get('Visits');

        // Set layout
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
