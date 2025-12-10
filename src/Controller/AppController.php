<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        // DO NOT load RequestHandler in CakePHP 5
        // DO NOT load Flash if not necessary

        // You can load Flash only if needed:
        $this->loadComponent('Flash');
    }
}
