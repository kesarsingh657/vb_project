<?php
/**
 * Dashboard View
 * File: templates/Visitors/dashboard.php
 * 
 * This file displays the main dashboard with all visitors
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - VB Visitor Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .logo h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 12px;
            opacity: 0.8;
        }

        .menu-items {
            list-style: none;
        }

        .menu-items li {
            margin-bottom: 15px;
        }

        .menu-items a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 14px;
        }

        .menu-items a:hover,
        .menu-items a.active {
            background-color: rgba(255, 255, 255, 0.2);
            padding-left: 20px;
        }

        .menu-items a span {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 400px;
        }

        .search-box input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #dc3545;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #dc3545;
        }

        .stat-card.pending {
            border-left-color: #ffc107;
        }

        .stat-card.approved {
            border-left-color: #28a745;
        }

        .stat-card.rejected {
            border-left-color: #dc3545;
        }

        .stat-card h3 {
            color: #666;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
        }

        .stat-card p {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }

        /* Filter Bar */
        .filter-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .filter-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-controls select,
        .filter-controls input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background-color: #c82333;
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f0f0 100%);
            border-bottom: 2px solid #ddd;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            color: #555;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        .visitor-photo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-cell {
            display: flex;
            gap: 8px;
        }

        .action-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            border: none;
            background: none;
            padding: 0;
        }

        .action-icon.view {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .action-icon.view:hover {
            background-color: #0066cc;
            color: white;
        }

        .action-icon.checkout {
            background-color: #fff3cd;
            color: #ff9800;
        }

        .action-icon.checkout:hover {
            background-color: #ff9800;
            color: white;
        }

        .action-icon.delete {
            background-color: #ffebee;
            color: #dc3545;
        }

        .action-icon.delete:hover {
            background-color: #dc3545;
            color: white;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 10px;
            }

            .main-content {
                margin-left: 70px;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            table {
                font-size: 11px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h2>🔐 VB</h2>
            <p>Visitor Mgmt</p>
        </div>
        <ul class="menu-items">
            <li><a href="<?= $this->Url->build(['action' => 'dashboard']) ?>" class="active"><span>📊</span> Dashboard</a></li>
            <li><a href="<?= $this->Url->build(['action' => 'add']) ?>"><span>👥</span> New Visitor</a></li>
            <li><a href="#"><span>📈</span> Reports</a></li>
            <li><a href="#"><span>⚙️</span> Settings</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'logout']) ?>"><span>🚪</span> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="search-box">
                <form method="GET" action="<?= $this->Url->build(['action' => 'dashboard']) ?>" style="display: flex; gap: 10px; flex: 1; max-width: 400px;">
                    <input type="text" name="search" placeholder="Search visitor..." value="<?= $this->request->getQuery('search') ?>">
                    <button type="submit" class="btn btn-primary" style="padding: 8px 15px;">Search</button>
                </form>
            </div>
            <div class="user-info">
                <span>👤 Admin</span>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <?php if ($this->Flash->render('success')): ?>
            <div class="alert alert-success">
                <?= $this->Flash->render('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->Flash->render('error')): ?>
            <div class="alert alert-danger">
                <?= $this->Flash->render('error') ?>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>Today's Visitors</h3>
                <div class="number"><?= $stats['total_today'] ?? 0 ?></div>
                <p>Planned visits</p>
            </div>
            <div class="stat-card pending">
                <h3>Pending Approval</h3>
                <div class="number"><?= $stats['pending'] ?? 0 ?></div>
                <p>Awaiting host response</p>
            </div>
            <div class="stat-card approved">
                <h3>Checked In</h3>
                <div class="number"><?= $stats['approved'] ?? 0 ?></div>
                <p>Currently on premises</p>
            </div>
            <div class="stat-card approved">
                <h3>Completed</h3>
                <div class="number"><?= $stats['completed'] ?? 0 ?></div>
                <p>Finished visits</p>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-controls">
                <form method="GET" action="<?= $this->Url->build(['action' => 'dashboard']) ?>" style="display: flex; gap: 15px; align-items: center;">
                    <input type="date" name="date" value="<?= $this->request->getQuery('date') ?>">
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="pending" <?= $this->request->getQuery('status') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="approved" <?= $this->request->getQuery('status') === 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="completed" <?= $this->request->getQuery('status') === 'completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="action-buttons">
                <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">+ New Visitor</a>
            </div>
        </div>

        <!-- Visitors Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Visitor Name</th>
                        <th>Mobile / Company</th>
                        <th>Host (Department)</th>
                        <th>Visit Reason</th>
                        <th>Visit Date/Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($visitors)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: #999;">
                                No visitors found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($visitors as $visitor): ?>
                            <tr>
                                <td>
                                    <div class="visitor-photo">
                                        <?= substr($visitor->visitor_name, 0, 2) ?>
                                    </div>
                                </td>
                                <td><strong><?= h($visitor->visitor_name) ?></strong></td>
                                <td>
                                    <?= h($visitor->mobile_number) ?><br>
                                    <small><?= h($visitor->company_name) ?></small>
                                </td>
                                <td>
                                    <?= h($visitor->host_name) ?><br>
                                    <small><?= h($visitor->host_department) ?></small>
                                </td>
                                <td><?= h($visitor->visit_reason) ?></td>
                                <td>
                                    <?= date('M d, Y', strtotime($visitor->visit_date)) ?><br>
                                    <?= date('h:i A', strtotime($visitor->visit_time)) ?>
                                </td>
                                <td>
                                    <span class="status-badge status-<?= $visitor->status ?>">
                                        <?= ucfirst($visitor->status) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-cell">
                                        <a href="<?= $this->Url->build(['action' => 'view', $visitor->id]) ?>" class="action-icon view" title="View Details">👁️</a>
                                        <button type="button" class="action-icon checkout" onclick="checkoutVisitor(<?= $visitor->id ?>)" title="Check Out">🚪</button>
                                        <button type="button" class="action-icon delete" onclick="deleteVisitor(<?= $visitor->id ?>)" title="Delete">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function checkoutVisitor(id) {
            if (confirm('Are you sure you want to check-out this visitor?')) {
                fetch('<?= $this->Url->build(['action' => 'checkOut']) ?>/' + id, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Visitor checked out successfully');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        function deleteVisitor(id) {
            if (confirm('Are you sure you want to delete this visitor record?')) {
                fetch('<?= $this->Url->build(['action' => 'delete']) ?>/' + id, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Visitor deleted successfully');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }
    </script>
</body>
</html>