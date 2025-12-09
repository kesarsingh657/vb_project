namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;

class TestController extends Controller
{
    public function checkDbConnection()
    {
        try {
            $connection = ConnectionManager::get('default');
            $results = $connection->execute('SELECT 1')->fetchAll('assoc');

            if ($results) {
                $this->set('message', 'Database connection successful!');
            } else {
                $this->set('message', 'Database connection failed!');
            }
        } catch (\Exception $e) {
            $this->set('message', 'Error: ' . $e->getMessage());
        }
    }
}
