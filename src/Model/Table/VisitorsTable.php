<?php
/**
 * Visitors Table Model
 * File: src/Model/Table/VisitorsTable.php
 * 
 * This file handles all database queries for visitors table
 * Functions to get, add, update, delete visitors
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Expression\QueryExpression;

class VisitorsTable extends Table
{
    /**
     * Initialize the table
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->setTable('visitors');
        $this->setPrimaryKey('id');
    }

    /**
     * Get all visitors
     * 
     * @return array - List of all visitors
     */
    public function getAllVisitors()
    {
        try {
            $visitors = $this->find()
                ->order(['visit_date' => 'DESC', 'visit_time' => 'DESC'])
                ->toArray();
            
            return $visitors;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get today's visitors
     * 
     * @return array - Visitors scheduled for today
     */
    public function getTodaysVisitors()
    {
        try {
            $today = date('Y-m-d');
            
            $visitors = $this->find()
                ->where(['visit_date' => $today])
                ->order(['visit_time' => 'ASC'])
                ->toArray();
            
            return $visitors;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get visitor by ID
     * 
     * @param int $id - Visitor ID
     * @return array - Visitor data
     */
    public function getVisitorById($id)
    {
        try {
            $visitor = $this->find()
                ->where(['id' => $id])
                ->first();
            
            return $visitor;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get visitor by mobile number
     * 
     * @param string $mobile - Mobile number
     * @return array - Visitor data
     */
    public function getVisitorByMobile($mobile)
    {
        try {
            $visitor = $this->find()
                ->where(['mobile_number' => $mobile])
                ->first();
            
            return $visitor;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Save new visitor
     * 
     * @param array $data - Visitor data to save
     * @return boolean - true if saved, false if not
     */
    public function saveNewVisitor($data)
    {
        try {
            $visitor = $this->newEntity($data);
            
            if ($this->save($visitor)) {
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update visitor check-in time
     * 
     * @param int $id - Visitor ID
     * @return boolean - true if updated, false if not
     */
    public function checkInVisitor($id)
    {
        try {
            $visitor = $this->getVisitorById($id);
            
            if (!$visitor) {
                return false;
            }
            
            // Update check-in time to current time
            $visitor->check_in_time = date('Y-m-d H:i:s');
            $visitor->status = 'approved';
            
            if ($this->save($visitor)) {
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update visitor check-out time
     * 
     * @param int $id - Visitor ID
     * @return boolean - true if updated, false if not
     */
    public function checkOutVisitor($id)
    {
        try {
            $visitor = $this->getVisitorById($id);
            
            if (!$visitor) {
                return false;
            }
            
            // Update check-out time to current time
            $visitor->check_out_time = date('Y-m-d H:i:s');
            $visitor->status = 'completed';
            
            if ($this->save($visitor)) {
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete visitor by ID
     * 
     * @param int $id - Visitor ID
     * @return boolean - true if deleted, false if not
     */
    public function deleteVisitor($id)
    {
        try {
            $visitor = $this->getVisitorById($id);
            
            if (!$visitor) {
                return false;
            }
            
            if ($this->delete($visitor)) {
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get visitors by status
     * 
     * @param string $status - Status (pending, approved, rejected, completed)
     * @return array - Visitors with that status
     */
    public function getVisitorsByStatus($status)
    {
        try {
            $visitors = $this->find()
                ->where(['status' => $status])
                ->order(['visit_date' => 'DESC'])
                ->toArray();
            
            return $visitors;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get visitors by date
     * 
     * @param string $date - Date in Y-m-d format
     * @return array - Visitors on that date
     */
    public function getVisitorsByDate($date)
    {
        try {
            $visitors = $this->find()
                ->where(['visit_date' => $date])
                ->order(['visit_time' => 'ASC'])
                ->toArray();
            
            return $visitors;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Search visitors by name or mobile
     * 
     * @param string $search - Search term
     * @return array - Matching visitors
     */
    public function searchVisitors($search)
    {
        try {
            $visitors = $this->find()
                ->where([
                    'OR' => [
                        ['visitor_name LIKE' => '%' . $search . '%'],
                        ['mobile_number LIKE' => '%' . $search . '%'],
                        ['company_name LIKE' => '%' . $search . '%']
                    ]
                ])
                ->order(['created_at' => 'DESC'])
                ->toArray();
            
            return $visitors;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get statistics
     * 
     * @return array - Count of visitors by status
     */
    public function getStatistics()
    {
        try {
            $today = date('Y-m-d');
            
            $stats = [
                'total_today' => $this->find()->where(['visit_date' => $today])->count(),
                'pending' => $this->find()->where(['status' => 'pending'])->count(),
                'approved' => $this->find()->where(['status' => 'approved'])->count(),
                'completed' => $this->find()->where(['status' => 'completed'])->count(),
            ];
            
            return $stats;
        } catch (\Exception $e) {
            return [];
        }
    }
}
?>