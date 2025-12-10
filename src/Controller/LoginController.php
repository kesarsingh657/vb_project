namespace App\Controller;

class LoginController extends AppController
{
    public function index()
    {
        if ($this->request->is('post')) {

            $role = $this->request->getData('role');
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');

            if ($username === 'admin' && $password === 'admin123') {
                $this->request->getSession()->write('role', $role);

                return $this->redirect(['controller' => 'Dashboard', 'action' => $role]);
            } else {
                $this->Flash->error("Invalid Login Credentials");
            }
        }
    }
}
