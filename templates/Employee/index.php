<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard - Visitor Management</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php 
    $user = $this->request->getSession()->read('User');
    ?>
    <div class="header">
        <div class="header-title">LAVA Visitor Management System</div>
        <div class="header-user">
            <div class="user-info">
                <div class="user-name"><?= $user['name'] ?></div>
                <div class="user-role"><?= ucfirst($user['role']) ?></div>
            </div>
            <a href="/users/logout" class="btn-logout">Logout</a>
        </div>
    </div>
    
    <div class="dashboard-layout">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="/employee/index" class="active">My Visitors</a>
                </li>
                <li>
                    <a href="/employee/new-invite">New Invite</a>
                </li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">My Visitors</h1>
                <a href="/employee/new-invite" class="btn btn-primary">Create New Invite</a>
            </div>
            
            <?php if ($this->Flash->render()): ?>
                <div class="alert alert-success">
                    <?= $this->Flash->render() ?>
                </div>
            <?php endif; ?>
            
            <div class="search-filter-bar">
                <div class="search-box">
                    <form method="get" action="/employee/index">
                        <input type="text" name="search" class="search-input" placeholder="Search visitors" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    </form>
                </div>
                <div class="filter-group">
                    <form method="get" action="/employee/index">
                        <input type="date" name="date" class="form-control" value="<?= $dateFilter ?>" onchange="this.form.submit()">
                    </form>
                </div>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Visitor Details</th>
                            <th>Visit Date & Time</th>
                            <th>Group Status</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($visits)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px;">No visitors found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($visits as $visit): ?>
                                <tr>
                                    <td>
                                        <a href="/employee/view-visit/<?= $visit->id ?>" style="color: #dc143c; text-decoration: none; font-weight: bold;">
                                            <?= $visit->visitor_name ?>
                                        </a><br>
                                        <small><?= $visit->visitor_mobile ?></small>
                                    </td>
                                    <td>
                                        <?= date('d M Y', strtotime($visit->visit_date)) ?><br>
                                        <small><?= date('h:i A', strtotime($visit->visit_time)) ?></small>
                                    </td>
                                    <td>
                                        <?php if ($visit->visit_type == 'group'): ?>
                                            <span class="status-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                                <?= $visit->group_name ?>
                                            </span>
                                        <?php else: ?>
                                            Single
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($visit->check_in_time): ?>
                                            <?= date('h:i A', strtotime($visit->check_in_time)) ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($visit->check_out_time): ?>
                                            <?= date('h:i A', strtotime($visit->check_out_time)) ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($visit->host_approval_status == 'pending'): ?>
                                            <span class="status-badge status-pending">Pending Approval</span>
                                        <?php elseif ($visit->host_approval_status == 'approved'): ?>
                                            <span class="status-badge status-approved">Approved</span>
                                        <?php else: ?>
                                            <span class="status-badge status-rejected">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <?php if ($visit->host_approval_status == 'pending'): ?>
                                                <a href="/employee/approve-visit/<?= $visit->id ?>" class="btn btn-sm btn-success">Approve</a>
                                                <a href="/employee/reject-visit/<?= $visit->id ?>" class="btn btn-sm btn-danger">Reject</a>
                                            <?php endif; ?>
                                            <?php if ($visit->is_pre_registered == 'yes' && $visit->visit_status == 'pending'): ?>
                                                <a href="/employee/cancel-invite/<?= $visit->id ?>" class="btn btn-sm btn-danger">Cancel</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="/js/main.js"></script>
</body>
</html>