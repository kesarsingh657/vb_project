<!-- File: templates/Security/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Dashboard - Lava Visitor Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }
        
        .navbar {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar h1 {
            font-size: 24px;
            font-weight: 600;
        }
        
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 20px;
            border: 1px solid white;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .logout-btn:hover {
            background: white;
            color: #dc3545;
        }
        
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #dc3545;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
        }
        
        .action-bar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }
        
        .visitors-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .visitors-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .visitors-table th {
            background: #dc3545;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .visitors-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .visitors-table tr:hover {
            background: #f8f9fa;
        }
        
        .visitor-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-approved {
            background: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        
        .btn-checkout {
            background: #28a745;
        }
        
        .btn-assign {
            background: #007bff;
        }
        
        .btn-view {
            background: #6c757d;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        
        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🔒 Security Dashboard - LAVA Visitor Management</h1>
        <div class="user-info">
            <span>Welcome, <?= h($user->username) ?></span>
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'logout-btn']) ?>
        </div>
    </div>

    <div class="container">
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Today's Visitors</h3>
                <div class="number"><?= $todayCount ?></div>
            </div>
            <div class="stat-card">
                <h3>Checked In</h3>
                <div class="number"><?= $checkedIn ?></div>
            </div>
            <div class="stat-card">
                <h3>Pending Approval</h3>
                <div class="number"><?= $pending ?></div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <h2>Today's Visitors</h2>
            <?= $this->Html->link('➕ Register New Visitor', ['action' => 'newVisitor'], ['class' => 'btn-primary']) ?>
        </div>

        <!-- Visitors Table -->
        <div class="visitors-table">
            <?php if (empty($visits)): ?>
                <div class="empty-state">
                    <h3>📋 No Visitors Yet</h3>
                    <p>No visitors registered for today. Click "Register New Visitor" to add one.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Visitor Name</th>
                            <th>Mobile</th>
                            <th>Host</th>
                            <th>Department</th>
                            <th>Visit Time</th>
                            <th>Status</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Card No.</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visits as $visit): ?>
                            <tr>
                                <td>
                                    <?php if ($visit->visitor_master && $visit->visitor_master->photo): ?>
                                        <img src="/img/visitors/<?= h($visit->visitor_master->photo) ?>" class="visitor-photo" alt="Visitor">
                                    <?php else: ?>
                                        <div class="visitor-photo" style="background: #ddd; display: flex; align-items: center; justify-content: center;">👤</div>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= h($visit->visitor_master->name ?? 'N/A') ?></strong></td>
                                <td><?= h($visit->visitor_master->mobile_number ?? 'N/A') ?></td>
                                <td><?= h($visit->user->username ?? 'N/A') ?></td>
                                <td><?= h($visit->host_department ?? 'N/A') ?></td>
                                <td><?= date('h:i A', strtotime($visit->visit_time)) ?></td>
                                <td>
                                    <span class="status-badge status-<?= h($visit->approval_status) ?>">
                                        <?= ucfirst(h($visit->approval_status)) ?>
                                    </span>
                                </td>
                                <td><?= $visit->check_in_time ? date('h:i A', strtotime($visit->check_in_time)) : '-' ?></td>
                                <td><?= $visit->check_out_time ? date('h:i A', strtotime($visit->check_out_time)) : '-' ?></td>
                                <td><?= h($visit->visitor_card_number ?? '-') ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <?php if (!$visit->check_out_time): ?>
                                            <?= $this->Form->postLink('Check Out', ['action' => 'checkOut', $visit->id], ['class' => 'btn-sm btn-checkout', 'confirm' => 'Check out this visitor?']) ?>
                                        <?php endif; ?>
                                        
                                        <?php if (!$visit->visitor_card_number): ?>
                                            <button class="btn-sm btn-assign" onclick="assignCard(<?= $visit->id ?>)">Assign Card</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function assignCard(visitId) {
            const cardNumber = prompt('Enter visitor card number:');
            if (cardNumber) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/lava_projectfinal/security/assign-card/' + visitId;
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'card_number';
                input.value = cardNumber;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>