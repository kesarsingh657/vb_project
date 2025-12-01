<!DOCTYPE html>
<html>
<head>
    <title>Visitor Details - Visitor Management</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php include 'header.ctp'; ?>
    
    <div class="dashboard-layout">
        <?php include 'sidebar.ctp'; ?>
        
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Visitor Details</h1>
                <a href="/security/index" class="btn btn-secondary">Back to Dashboard</a>
            </div>
            
            <div class="visitor-details">
                <div class="detail-row">
                    <div class="detail-label">Visitor Photo:</div>
                    <div class="detail-value">
                        <?php if ($visit->visitor_photo): ?>
                            <img src="/img/visitors/<?= $visit->visitor_photo ?>" alt="Photo" style="max-width: 200px; border: 2px solid #dc143c; border-radius: 8px;">
                            <br><br>
                            <a href="/img/visitors/<?= $visit->visitor_photo ?>" download class="btn btn-sm btn-secondary">Download Photo</a>
                        <?php else: ?>
                            No photo available
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visitor Name:</div>
                    <div class="detail-value"><?= $visit->visitor_name ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Mobile Number:</div>
                    <div class="detail-value"><?= $visit->visitor_mobile ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?= $visit->visitor_email ?: '-' ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Address:</div>
                    <div class="detail-value"><?= $visit->visitor_address ?: '-' ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Company:</div>
                    <div class="detail-value"><?= $visit->visitor_company ?: '-' ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visit Type:</div>
                    <div class="detail-value">
                        <?php if ($visit->visit_type == 'group'): ?>
                            Group Visit (<?= $visit->group_name ?>)
                        <?php else: ?>
                            Single Visit
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Host Name:</div>
                    <div class="detail-value"><?= $visit->host_name ?> (<?= $visit->host_department ?>)</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Host Phone:</div>
                    <div class="detail-value"><?= $visit->host_phone ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visit Date:</div>
                    <div class="detail-value"><?= date('d M Y', strtotime($visit->visit_date)) ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visit Time:</div>
                    <div class="detail-value"><?= date('h:i A', strtotime($visit->visit_time)) ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visit Reason:</div>
                    <div class="detail-value"><?= $visit->visit_reason_text ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Check-In Time:</div>
                    <div class="detail-value">
                        <?= $visit->check_in_time ? date('d M Y h:i A', strtotime($visit->check_in_time)) : '-' ?>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Check-Out Time:</div>
                    <div class="detail-value">
                        <?= $visit->check_out_time ? date('d M Y h:i A', strtotime($visit->check_out_time)) : '-' ?>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visitor Card:</div>
                    <div class="detail-value"><?= $visit->visitor_card_number ?: '-' ?></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Host Approval:</div>
                    <div class="detail-value">
                        <?php if ($visit->host_approval_status == 'pending'): ?>
                            <span class="status-badge status-pending">Pending</span>
                        <?php elseif ($visit->host_approval_status == 'approved'): ?>
                            <span class="status-badge status-approved">Approved</span>
                        <?php else: ?>
                            <span class="status-badge status-rejected">Rejected</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Visit Status:</div>
                    <div class="detail-value">
                        <?php if ($visit->visit_status == 'checked_in'): ?>
                            <span class="status-badge status-checked-in">Checked In</span>
                        <?php elseif ($visit->visit_status == 'checked_out'): ?>
                            <span class="status-badge status-checked-out">Checked Out</span>
                        <?php else: ?>
                            <span class="status-badge status-pending">Pending</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($previousVisits)): ?>
                <div class="visitor-history">
                    <h2 class="history-title">Previous Visits</h2>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Visit Date</th>
                                    <th>Host</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($previousVisits as $prevVisit): ?>
                                    <tr>
                                        <td><?= date('d M Y', strtotime($prevVisit->visit_date)) ?></td>
                                        <td><?= $prevVisit->host_name ?></td>
                                        <td><?= $prevVisit->visit_reason_text ?></td>
                                        <td>
                                            <?php if ($prevVisit->visit_status == 'checked_out'): ?>
                                                <span class="status-badge status-checked-out">Completed</span>
                                            <?php else: ?>
                                                <span class="status-badge status-checked-in">Checked In</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/security/view-visit/<?= $prevVisit->id ?>" class="btn btn-sm btn-secondary">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="/js/main.js"></script>
</body>
</html>