<!-- File: templates/Admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lava Visitor Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            display: flex;
        }
        
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        
        .sidebar-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            font-size: 12px;
            color: #bdc3c7;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }
        
        .menu-item:hover, .menu-item.active {
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #3498db;
        }
        
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 20px;
        }
        
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .top-bar h1 {
            font-size: 28px;
            color: #2c3e50;
        }
        
        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #3498db;
        }
        
        .stat-card.green { border-left-color: #2ecc71; }
        .stat-card.orange { border-left-color: #f39c12; }
        .stat-card.red { border-left-color: #e74c3c; }
        .stat-card.purple { border-left-color: #9b59b6; }
        
        .stat-card h3 {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .recent-visits {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .recent-visits h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .visits-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .visits-table th {
            background: #ecf0f1;
            padding: 12px;
            text-align: left;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .visits-table td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .visits-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-approved {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>👤 ADMIN PANEL</h2>
            <p>LAVA Visitor Management</p>
        </div>
        <div class="sidebar-menu">
            <a href="/lava_projectfinal/admin/dashboard" class="menu-item active">📊 Dashboard</a>
            <a href="/lava_projectfinal/admin/visitors" class="menu-item">👥 All Visitors</a>
            <a href="/lava_projectfinal/admin/users" class="menu-item">👤 Manage Users</a>
            <a href="/lava_projectfinal/admin/visit-reasons" class="menu-item">📝 Visit Reasons</a>
            <a href="/lava_projectfinal/admin/reports" class="menu-item">📈 Reports</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h1>Welcome, <?= h($user->username) ?>!</h1>
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'logout-btn']) ?>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Visitors</h3>
                <div class="number"><?= $totalVisitors ?></div>
            </div>
            <div class="stat-card green">
                <h3>Total Visits</h3>
                <div class="number"><?= $totalVisits ?></div>
            </div>
            <div class="stat-card orange">
                <h3>Today's Visits</h3>
                <div class="number"><?= $todayVisits ?></div>
            </div>
            <div class="stat-card red">
                <h3>Pending Approvals</h3>
                <div class="number"><?= $pendingApprovals ?></div>
            </div>
            <div class="stat-card purple">
                <h3>Security Guards</h3>
                <div class="number"><?= $securityCount ?></div>
            </div>
            <div class="stat-card">
                <h3>Employees</h3>
                <div class="number"><?= $employeeCount ?></div>
            </div>
        </div>

        <!-- Recent Visits -->
        <div class="recent-visits">
            <h2>Recent Visits (Last 100)</h2>
            <table class="visits-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor Name</th>
                        <th>Mobile</th>
                        <th>Host</th>
                        <th>Visit Date</th>
                        <th>Visit Time</th>
                        <th>Status</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($visits)): ?>
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 40px; color: #999;">
                                No visits recorded yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($visits as $visit): ?>
                            <tr>
                                <td><strong>#<?= $visit->id ?></strong></td>
                                <td><?= h($visit->visitor_master->name ?? 'N/A') ?></td>
                                <td><?= h($visit->visitor_master->mobile_number ?? 'N/A') ?></td>
                                <td><?= h($visit->user->username ?? 'N/A') ?></td>
                                <td><?= date('d M Y', strtotime($visit->visit_date)) ?></td>
                                <td><?= date('h:i A', strtotime($visit->visit_time)) ?></td>
                                <td>
                                    <span class="status-badge status-<?= h($visit->approval_status) ?>">
                                        <?= ucfirst(h($visit->approval_status)) ?>
                                    </span>
                                </td>
                                <td><?= $visit->check_in_time ? date('h:i A', strtotime($visit->check_in_time)) : '-' ?></td>
                                <td><?= $visit->check_out_time ? date('h:i A', strtotime($visit->check_out_time)) : '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>