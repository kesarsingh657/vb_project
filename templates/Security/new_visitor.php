<!DOCTYPE html>
<html>
<head>
    <title>New Visitor - Visitor Management</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php include 'header.ctp'; ?>
    
    <div class="dashboard-layout">
        <?php include 'sidebar.ctp'; ?>
        
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Register New Visitor</h1>
                <a href="/security/index" class="btn btn-secondary">Back to Dashboard</a>
            </div>
            
            <div class="form-container">
                <div class="tabs">
                    <button class="tab-button active" data-tab="single-visit">Single Visit</button>
                    <button class="tab-button" data-tab="group-visit">Group Visit</button>
                </div>
                
                <!-- Single Visit Tab -->
                <div id="single-visit" class="tab-content active">
                    <form method="post" action="/security/create-visit" enctype="multipart/form-data" onsubmit="return validateVisitorForm()">
                        <input type="hidden" name="visit_type" value="single">
                        <input type="hidden" name="host_id" id="host_id">
                        
                        <h3 style="color: #dc143c; margin-bottom: 20px;">Visitor Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Visit Date</label>
                                <input type="date" name="visit_date" id="visit_date" class="form-control" required readonly value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visit Time</label>
                                <input type="time" name="visit_time" id="visit_time" class="form-control" required readonly value="<?= date('H:i') ?>">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Mobile Number</label>
                                <input type="text" name="visitor_mobile" id="visitor_mobile" class="form-control" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Visitor Name</label>
                                <input type="text" name="visitor_name" id="visitor_name" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="visitor_email" id="visitor_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="visitor_company" id="visitor_company" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="visitor_address" id="visitor_address" class="form-control">
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
                            <label class="form-label required">Visitor Photo</label>
                            <input type="file" name="visitor_photo" id="visitor_photo" class="form-control" accept="image/*" required onchange="previewPhoto(this, 'photo-preview')">
                            <button type="button" class="btn btn-secondary" style="margin-top: 10px;" onclick="openModal('camera-modal'); startCamera();">Take Photo</button>
                            <img id="photo-preview" style="display: none; margin-top: 10px; max-width: 200px; border: 2px solid #dc143c; border-radius: 8px;">
                        </div>
                        
                        <h3 style="color: #dc143c; margin: 30px 0 20px 0;">Host Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Host Name</label>
                                <input type="text" name="host_name" id="host_name" class="form-control" list="host-suggestions" required>
                                <datalist id="host-suggestions"></datalist>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Department</label>
                                <input type="text" name="host_department" id="host_department" class="form-control" required readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required">Phone Number</label>
                            <input type="text" name="host_phone" id="host_phone" class="form-control" required readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Note to Host</label>
                            <textarea name="note_to_host" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div style="display: flex; gap: 10px; margin-top: 30px;">
                            <button type="submit" name="action_type" value="save" class="btn btn-primary">Create Visit</button>
                            <button type="submit" name="action_type" value="save_new" class="btn btn-success">Save and Create New</button>
                        </div>
                    </form>
                </div>
                
                <!-- Group Visit Tab -->
                <div id="group-visit" class="tab-content">
                    <form method="post" action="/security/create-visit" enctype="multipart/form-data">
                        <input type="hidden" name="visit_type" value="group">
                        <input type="hidden" name="host_id" id="group_host_id">
                        
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
                        
                        <h3 style="color: #dc143c; margin: 30px 0 20px 0;">Visitors</h3>
                        
                        <div id="visitor-rows-container">
                            <div class="visitor-row">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="visitors[0][name]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="visitors[0][mobile]" class="form-control visitor-mobile" maxlength="10" required>
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
                        
                        <h3 style="color: #dc143c; margin: 30px 0 20px 0;">Host Information</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required">Host Name</label>
                                <input type="text" name="host_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Department</label>
                                <input type="text" name="host_department" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required">Phone Number</label>
                            <input type="text" name="host_phone" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Check-in now?</label>
                            <select name="check_in_now" class="form-control">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        
                        <div style="display: flex; gap: 10px; margin-top: 30px;">
                            <button type="submit" name="action_type" value="save" class="btn btn-primary">Create Visit</button>
                            <button type="submit" name="action_type" value="save_new" class="btn btn-success">Save and Create New</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Camera Modal -->
    <div id="camera-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Capture Photo</h2>
                <button class="modal-close" onclick="closeModal('camera-modal'); closeCamera();">X</button>
            </div>
            <div class="camera-container">
                <video id="camera-video" class="camera-video" autoplay></video>
                <br>
                <button type="button" class="btn btn-primary" onclick="capturePhoto()">Capture</button>
            </div>
        </div>
    </div>
    
    <script src="/js/main.js"></script>
</body>
</html>