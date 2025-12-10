<?php
namespace App\Controller;
use App\Controller\AppController;

class InvitesController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('sidebar');
        // show create invite page (employee)
    }
}
