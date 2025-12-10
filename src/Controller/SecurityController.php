<?php
declare(strict_types=1);

namespace App\Controller;

class SecurityController extends AppController
{
    public function dashboard()
    {
        $this->viewBuilder()->setLayout('default');
        $sessionUser = $this->request->getSession()->read('AuthUser');
        if (!$sessionUser || $sessionUser->role !== 'security') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}
