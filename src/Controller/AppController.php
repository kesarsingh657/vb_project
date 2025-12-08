<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        // Load Authentication Component (VERY IMPORTANT)
        $this->loadComponent('Authentication.Authentication');

        // Flash messages
        $this->loadComponent('Flash');
    }
}
