<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
}
* { margin: 0; padding: 0; box-sizing: border-box; }

.main-content {
    margin-left: 250px;
    padding: 20px;
}

.form-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.form-title {
    font-weight: 600;
    border-left: 4px solid #0d6efd;
    padding-left: 10px;
    margin-bottom: 25px;
}

.form-label { font-weight: 500; }

.host-suggestions {
    position: absolute;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
    display: none;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.host-suggestion-item {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
}

.host-suggestion-item:hover {
    background: #f8f9fa;
}

.badge-info {
    background: #17a2b8;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    margin-left: 5px;
}
</style>

<body>

<?= $this->element('sidebar') ?>

<div class="main-content">
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-card">
                    <h4 class="form-title">Add New Visitor</h4>

                    <?= $this->Form->create($visitor, ['type' => 'file', 'id' => 'visitorForm']) ?>

                    <!-- Visit Type -->
                    <div class="mb-3">
                        <label class="form-label">Visit Type</label>
                        <select name="visit_type" class="form-select" id="visitType">
                            <option value="single">Single Visitor</option>
                            <option value="group">Group Visit</option>
                        </select>
                    </div>

                    <!-- Group Size (hidden by default) -->
                    <div class="mb-3" id="groupSizeDiv" style="display:none;">
                        <label class="form-label">Number of Visitors</label>
                        <input type="number" name="group_size" class="form-control" min="1" max="50" value="1">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('visitor_name', [
                                'label' => 'Visitor Name',
                                'class' => 'form-control',
                                'required' => true,
                                'id' => 'visitorName'
                            ]) ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('mobile_number', [
                                'label' => 'Mobile Number',
                                'maxlength' => 10,
                                'class' => 'form-control',
                                'required' => true,
                                'id' => 'mobileNumber'
                            ]) ?>
                            <small class="text-info" id="existingVisitorInfo" style="display:none;">
                                ✓ Existing visitor found - details auto-filled
                            </small>
                        </div>
                    </div>

                    <?= $this->Form->control('email', [
                        'label' => 'Email',
                        'class' => 'form-control mb-3',
                        'id' => 'visitorEmail'
                    ]) ?>

                    <?= $this->Form->control('address', [
                        'type' => 'textarea',
                        'label' => 'Address',
                        'rows' => 2,
                        'class' => 'form-control mb-3',
                        'id' => 'visitorAddress'
                    ]) ?>

                    <?= $this->Form->control('company_name', [
                        'label' => 'Company Name',
                        'class' => 'form-control mb-3',
                        'id' => 'companyName'
                    ]) ?>

                    <label class="form-label">Reason of Visit</label>
                    <select name="visit_reason" class="form-select mb-3" required>
                        <option value="">Select Reason</option>
                        <option value="meeting">Meeting</option>
                        <option value="interview">Interview</option>
                        <option value="delivery">Delivery</option>
                        <option value="personal">Personal Visit</option>
                        <option value="other">Other</option>
                    </select>

                    <div class="row">
                        <div class="col-md-12 mb-3" style="position:relative;">
                            <label class="form-label">Search Host <small class="text-muted">(Type to search)</small></label>
                            <input type="text" id="hostSearch" class="form-control" placeholder="Type host name or email..." autocomplete="off">
                            <div class="host-suggestions" id="hostSuggestions"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('host_name', [
                                'label' => 'Host Name',
                                'class' => 'form-control',
                                'id' => 'hostName',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('host_department', [
                                'label' => 'Host Department',
                                'class' => 'form-control',
                                'id' => 'hostDepartment'
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->Form->control('host_phone', [
                        'label' => 'Host Phone',
                        'class' => 'form-control mb-3',
                        'maxlength' => 10,
                        'id' => 'hostPhone'
                    ]) ?>

                    <input type="hidden" name="host_email" id="hostEmail">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('visit_date', [
                                'type' => 'date',
                                'label' => 'Visit Date',
                                'class' => 'form-control',
                                'value' => date('Y-m-d'),
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('visit_time', [
                                'type' => 'time',
                                'label' => 'Visit Time',
                                'class' => 'form-control',
                                'value' => date('H:i'),
                                'required' => true
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->Form->control('photo', [
                        'type' => 'file',
                        'label' => 'Visitor Photo',
                        'class' => 'form-control mb-4',
                        'accept' => 'image/*'
                    ]) ?>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Add Visitor & Send Approval Request
                    </button>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Show/hide group size
document.getElementById('visitType').addEventListener('change', function() {
    const groupDiv = document.getElementById('groupSizeDiv');
    groupDiv.style.display = this.value === 'group' ? 'block' : 'none';
});

// Auto-populate visitor details on mobile number change
document.getElementById('mobileNumber').addEventListener('blur', function() {
    const mobile = this.value;
    if (mobile.length === 10) {
        fetch('<?= $this->Url->build(['action' => 'checkExisting']) ?>?mobile=' + mobile)
            .then(response => response.json())
            .then(data => {
                if (data.exists && data.data) {
                    document.getElementById('visitorName').value = data.data.name || '';
                    document.getElementById('visitorEmail').value = data.data.email || '';
                    document.getElementById('visitorAddress').value = data.data.address || '';
                    document.getElementById('companyName').value = data.data.company || '';
                    document.getElementById('existingVisitorInfo').style.display = 'block';
                } else {
                    document.getElementById('existingVisitorInfo').style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});

// Host search functionality with auto-fill
let hostSearchTimeout;
document.getElementById('hostSearch').addEventListener('input', function() {
    const searchTerm = this.value;
    const suggestionsDiv = document.getElementById('hostSuggestions');
    
    clearTimeout(hostSearchTimeout);
    
    if (searchTerm.length < 2) {
        suggestionsDiv.style.display = 'none';
        return;
    }
    
    hostSearchTimeout = setTimeout(() => {
        fetch('<?= $this->Url->build(['action' => 'searchHost']) ?>?term=' + searchTerm)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    suggestionsDiv.innerHTML = '';
                    
                    data.forEach(host => {
                        const div = document.createElement('div');
                        div.className = 'host-suggestion-item';
                        div.innerHTML = `
                            <strong>${host.name}</strong>
                            <span class="badge-info">${host.employee_code}</span><br>
                            <small class="text-muted">${host.department || 'N/A'} • ${host.phone || 'N/A'}</small>
                        `;
                        
                        // Auto-fill on click - NOW ALL FIELDS ARE EDITABLE
                        div.addEventListener('click', function() {
                            document.getElementById('hostSearch').value = host.name;
                            document.getElementById('hostName').value = host.name;
                            document.getElementById('hostDepartment').value = host.department || '';
                            document.getElementById('hostPhone').value = host.phone || '';
                            document.getElementById('hostEmail').value = host.employee_code + '@company.com';
                            suggestionsDiv.style.display = 'none';
                        });
                        
                        suggestionsDiv.appendChild(div);
                    });
                    
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.innerHTML = '<div class="host-suggestion-item text-muted">No hosts found</div>';
                    suggestionsDiv.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                suggestionsDiv.style.display = 'none';
            });
    }, 300);
});

// Hide suggestions when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('#hostSearch') && !e.target.closest('#hostSuggestions')) {
        document.getElementById('hostSuggestions').style.display = 'none';
    }
});

// Form validation before submit
document.getElementById('visitorForm').addEventListener('submit', function(e) {
    const hostName = document.getElementById('hostName').value;
    
    if (!hostName) {
        e.preventDefault();
        alert('Please select a host from the search results or enter manually');
        document.getElementById('hostSearch').focus();
        return false;
    }
});
</script>

</body>