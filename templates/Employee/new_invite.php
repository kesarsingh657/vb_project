<!DOCTYPE html>
<html>
<head>
    <title>Create Invite - Visitor Management</title>
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
                    <a href="/employee/index">My Visitors</a>
                </li>
                <li>
                    <a href="/employee/new-invite" class="active">New Invite</a>
                </li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Create Visitor Invite</h1>
                <a href="/employee/index" class="btn btn-secondary">Back</a>
            </div>
            
            <div class="form-container">
                <div class="tabs">
                    <button class="tab-button active" data-tab="single-invite">Single Invite</button>
                    <button class="tab-button" data-tab="group-invite">Group Invite</button>
                </div>
                
                <!-- Single Invite Tab -->
                <div id="single-invite" class="tab-content active">
                    <form method="post" action="/employee/create-invite" onsubmit="return validateDateTime()">
                        <input type="hidden" name="invite_type" value="single">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Visit Date</label>
                                <input type="date" name="visit_date" id="visit_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visit Time</label>
                                <input type="time" name="visit_time" id="visit_time" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Mobile Number</label>
                                <input type="text" name="visitor_mobile" class="form-control" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visitor Name</label>
                                <input type="text" name="visitor_name" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="visitor_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="visitor_company" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="visitor_address" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required">Visit Reason</label>
                            <select name="visit_reason" class="form-control" required onchange="document.getElementById('visit_reason_text').value = this.options[this.selectedIndex].text">
                                <option value="">Select Reason</option>
                                <?php foreach ($visitReasons as $id => $reason): ?>
                                    <option value="<?= $id ?>"><?= $reason ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="visit_reason_text" id="visit_reason_text">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Note to Visitor</label>
                            <textarea name="note_to_visitor" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Invite</button>
                    </form>
                </div>
                
                <!-- Group Invite Tab -->
                <div id="group-invite" class="tab-content">
                    <form method="post" action="/employee/create-invite">
                        <input type="hidden" name="invite_type" value="group">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Group Name</label>
                                <input type="text" name="group_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visit Reason</label>
                                <select name="visit_reason" class="form-control" required onchange="document.getElementById('group_visit_reason_text').value = this.options[this.selectedIndex].text">
                                    <option value="">Select Reason</option>
                                    <?php foreach ($visitReasons as $id => $reason): ?>
                                        <option value="<?= $id ?>"><?= $reason ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="visit_reason_text" id="group_visit_reason_text">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Visit Date</label>
                                <input type="date" name="visit_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visit Time</label>
                                <input type="time" name="visit_time" class="form-control" required>
                            </div>
                        </div>
                        
                        <h3 style="color: #dc143c; margin: 30px 0 20px 0;">Visitors</h3>
                        
                        <div id="visitor-rows-container">
                            <div class="visitor-row">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="visitors[0][name]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="visitors[0][mobile]" class="form-control" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="visitors[0][email]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="visitors[0][address]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" name="visitors[0][company]" class="form-control">
                                </div>
                                <div></div>
                            </div>
                        </div>
                        
                        <button type="button" class="add-row-btn" onclick="addVisitorRow()">Add More Visitors</button>
                        
                        <div style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">Create Group Invite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/main.js"></script>
</body>
</html>