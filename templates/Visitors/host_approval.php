<!DOCTYPE html>
<html>
<head>
    <title>Visitor Approval</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .info-row {
            margin: 15px 0;
            padding: 10px;
            background: #f9f9f9;
            border-left: 4px solid #007bff;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .value {
            color: #333;
            margin-top: 5px;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 5px;
        }
        .btn-approve {
            background: #28a745;
            color: white;
        }
        .btn-reject {
            background: #dc3545;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-weight: bold;
        }
        .status-approved {
            background: #d4edda;
            color: #155724;
        }
        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔔 Visitor Approval Request</h2>
        
        <?php if ($approvalRequest->status === 'approved'): ?>
            <div class="status status-approved">
                ✓ This visit has been APPROVED
            </div>
        <?php elseif ($approvalRequest->status === 'rejected'): ?>
            <div class="status status-rejected">
                ✗ This visit has been REJECTED
            </div>
        <?php else: ?>
            <div class="status status-pending">
                ⏳ Waiting for your response
            </div>
        <?php endif; ?>
        
        <div class="info-row">
            <div class="label">Visitor Name</div>
            <div class="value"><?= h($visitor->visitor_name) ?></div>
        </div>
        
        <div class="info-row">
            <div class="label">Mobile Number</div>
            <div class="value"><?= h($visitor->mobile_number) ?></div>
        </div>
        
        <div class="info-row">
            <div class="label">Company</div>
            <div class="value"><?= h($visitor->company_name) ?></div>
        </div>
        
        <div class="info-row">
            <div class="label">Purpose of Visit</div>
            <div class="value"><?= h($visitor->visit_reason) ?></div>
        </div>
        
        <div class="info-row">
            <div class="label">Visit Date & Time</div>
            <div class="value"><?= h($visitor->visit_date) ?> at <?= h($visitor->visit_time) ?></div>
        </div>
        
        <?php if ($approvalRequest->status === 'pending'): ?>
            <form method="post" style="text-align: center; margin-top: 30px;">
                <button type="submit" name="action" value="approve" class="btn btn-approve">
                    ✓ Approve Visit
                </button>
                <button type="submit" name="action" value="reject" class="btn btn-reject">
                    ✗ Reject Visit
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>