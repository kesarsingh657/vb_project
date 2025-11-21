<?php
/**
 * Visitors Controller
 * File: src/Controller/VisitorsController.php
 * 
 * This file handles:
 * - Dashboard (show all visitors)
 * - Add new visitor
 * - View visitor details
 * - Check-in visitor
 * - Check-out visitor
 * - Delete visitor
 * - Search/Filter visitors
 */

namespace App\Controller;

use Cake\Controller\Controller;

class VisitorsController extends Controller
{
    /**
     * Initialize the controller
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Check if admin is logged in
     * This runs before every action
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow login and logout without session
        if (in_array($this->request->getParam('action'), ['dashboard'])) {
            // Check if logged in
            if (!$this->request->getSession()->read('admin_id')) {
                $this->Flash->error('Please login first.');
                return $this->redirect(['controller' => 'Admin', 'action' => 'login']);
            }
        }
    }

    /**
     * Dashboard - Show all visitors
     * 
     * This function runs when user visits /visitors/dashboard
     * It displays the main dashboard with all visitors
     */
    public function dashboard()
    {
        // Get Visitors model
        $visitorsTable = $this->getTableLocator()->get('Visitors');

        // Check if search is requested
        $search = $this->request->getQuery('search');
        $status = $this->request->getQuery('status');
        $date = $this->request->getQuery('date');

        if ($search) {
            // Search by name, mobile, or company
            $visitors = $visitorsTable->searchVisitors($search);
        } elseif ($status) {
            // Filter by status
            $visitors = $visitorsTable->getVisitorsByStatus($status);
        } elseif ($date) {
            // Filter by date
            $visitors = $visitorsTable->getVisitorsByDate($date);
        } else {
            // Get all visitors (today's by default)
            $visitors = $visitorsTable->getTodaysVisitors();
        }

        // Get statistics
        $stats = $visitorsTable->getStatistics();

        // Pass data to view
        $this->set(compact('visitors', 'stats'));
    }

    /**
     * View visitor details
     * 
     * @param int $id - Visitor ID
     */
    public function view($id = null)
    {
        if (!$id) {
            $this->Flash->error('Visitor not found.');
            return $this->redirect(['action' => 'dashboard']);
        }

        // Get Visitors model
        $visitorsTable = $this->getTableLocator()->get('Visitors');

        // Get visitor details
        $visitor = $visitorsTable->getVisitorById($id);

        if (!$visitor) {
            $this->Flash->error('Visitor not found.');
            return $this->redirect(['action' => 'dashboard']);
        }

        // Pass data to view
        $this->set(compact('visitor'));
    }

    /**
     * Add new visitor
     * 
     * This function runs when user clicks "New Visitor" button
     * It shows form to add visitor and saves the data
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $visitorsTable = $this->getTableLocator()->get('Visitors');
            $visitorData = [
                'visitor_name' => $data['visitor_name'] ?? '',
                'mobile_number' => $data['mobile_number'] ?? '',
                'email' => $data['email'] ?? '',
                'address' => $data['address'] ?? '',
                'company_name' => $data['company_name'] ?? '',
                'visit_reason' => $data['visit_reason'] ?? '',
                'host_name' => $data['host_name'] ?? '',
                'host_department' => $data['host_department'] ?? '',
                'host_phone' => $data['host_phone'] ?? '',
                'visit_date' => $data['visit_date'] ?? '',
                'visit_time' => $data['visit_time'] ?? '',
                'status' => 'pending',
            ];
            if (!empty($data['photo']['name'])) {
                $photoData = file_get_contents($data['photo']['tmp_name']);
                $visitorData['photo'] = $photoData;
            }
            if ($visitorsTable->saveNewVisitor($visitorData)) {
                $this->Flash->success('Visitor added successfully!');
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error('Error adding visitor. Please try again.');
            }
        }

        $visitReasonsTable = $this->getTableLocator()->get('VisitReasons');
        $visitReasons = $visitReasonsTable->find()->toArray();

        $this->set(compact('visitReasons'));
    }

    /**
     * Check-in visitor
     * 
     * @param int $id - Visitor ID
     */
    public function checkIn($id = null)
    {
        if (!$id) {
            return $this->respondAsJson(['success' => false, 'message' => 'Invalid visitor ID']);
        }

        // Get Visitors model
        $visitorsTable = $this->getTableLocator()->get('Visitors');

        // Check-in visitor
        if ($visitorsTable->checkInVisitor($id)) {
            return $this->respondAsJson(['success' => true, 'message' => 'Visitor checked in successfully']);
        } else {
            return $this->respondAsJson(['success' => false, 'message' => 'Error checking in visitor']);
        }
    }

    /**
     * Check-out visitor
     * 
     * @param int $id - Visitor ID
     */
    public function checkOut($id = null)
    {
        if (!$id) {
            return $this->respondAsJson(['success' => false, 'message' => 'Invalid visitor ID']);
        }

        // Get Visitors model
        $visitorsTable = $this->getTableLocator()->get('Visitors');

        // Check-out visitor
        if ($visitorsTable->checkOutVisitor($id)) {
            return $this->respondAsJson(['success' => true, 'message' => 'Visitor checked out successfully']);
        } else {
            return $this->respondAsJson(['success' => false, 'message' => 'Error checking out visitor']);
        }
    }

    /**
     * Delete visitor
     * 
     * @param int $id - Visitor ID
     */
    public function delete($id = null)
    {
        if (!$id) {
            return $this->respondAsJson(['success' => false, 'message' => 'Invalid visitor ID']);
        }

        // Only allow POST requests
        if (!$this->request->is('post')) {
            return $this->respondAsJson(['success' => false, 'message' => 'Invalid request method']);
        }

        // Get Visitors model
        $visitorsTable = $this->getTableLocator()->get('Visitors');

        // Delete visitor
        if ($visitorsTable->deleteVisitor($id)) {
            return $this->respondAsJson(['success' => true, 'message' => 'Visitor deleted successfully']);
        } else {
            return $this->respondAsJson(['success' => false, 'message' => 'Error deleting visitor']);
        }
    }

    /**
     * Helper function to return JSON response
     * 
     * @param array $data - Data to return as JSON
     */
    protected function respondAsJson($data)
    {
        $this->response = $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($data));

        return $this->response;
    }
}
?>