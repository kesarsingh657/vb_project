// Tab functionality
function initTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
}

// Modal functionality
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('show');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
    }
}

// Search visitor by mobile number
function searchVisitor(mobile, callback) {
    if (mobile.length >= 10) {
        fetch('/security/search-visitor?mobile=' + mobile)
            .then(response => response.json())
            .then(data => {
                if (callback) callback(data);
            })
            .catch(error => console.error('Error:', error));
    }
}

// Search host by name
function searchHost(name, callback) {
    if (name.length >= 3) {
        fetch('/security/search-host?name=' + name)
            .then(response => response.json())
            .then(data => {
                if (callback) callback(data);
            })
            .catch(error => console.error('Error:', error));
    }
}

// Auto-fill visitor details
function autoFillVisitor(visitor) {
    document.getElementById('visitor_name').value = visitor.visitor_name || '';
    document.getElementById('visitor_email').value = visitor.email || '';
    document.getElementById('visitor_address').value = visitor.address || '';
    document.getElementById('visitor_company').value = visitor.company_name || '';
}

// Auto-fill host details
function autoFillHost(employee) {
    document.getElementById('host_id').value = employee.id || '';
    document.getElementById('host_name').value = employee.employee_name || '';
    document.getElementById('host_department').value = employee.department || '';
    document.getElementById('host_phone').value = employee.phone_number || '';
}

// Add visitor row for group visit
let visitorRowCount = 1;

function addVisitorRow() {
    visitorRowCount++;
    const container = document.getElementById('visitor-rows-container');
    
    const lastRow = container.querySelector('.visitor-row:last-child');
    const lastAddress = lastRow ? lastRow.querySelector('input[name*="address"]').value : '';
    
    const newRow = document.createElement('div');
    newRow.className = 'visitor-row';
    newRow.innerHTML = `
        <div class="form-group">
            <input type="text" name="visitors[${visitorRowCount}][name]" class="form-control" placeholder="Visitor Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="visitors[${visitorRowCount}][mobile]" class="form-control visitor-mobile" placeholder="Mobile Number" maxlength="10" required>
        </div>
        <div class="form-group">
            <input type="email" name="visitors[${visitorRowCount}][email]" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" name="visitors[${visitorRowCount}][address]" class="form-control" placeholder="Address" value="${lastAddress}">
        </div>
        <div class="form-group">
            <input type="text" name="visitors[${visitorRowCount}][company]" class="form-control" placeholder="Company">
        </div>
        <button type="button" class="remove-row-btn" onclick="removeVisitorRow(this)">X</button>
    `;
    
    container.appendChild(newRow);
    
    // Add mobile search functionality
    const mobileInput = newRow.querySelector('.visitor-mobile');
    mobileInput.addEventListener('input', function() {
        if (this.value.length >= 10) {
            searchVisitor(this.value, function(visitors) {
                if (visitors.length > 0) {
                    const row = mobileInput.closest('.visitor-row');
                    row.querySelector('input[name*="name"]').value = visitors[0].visitor_name;
                    row.querySelector('input[name*="email"]').value = visitors[0].email || '';
                    row.querySelector('input[name*="address"]').value = visitors[0].address || '';
                    row.querySelector('input[name*="company"]').value = visitors[0].company_name || '';
                }
            });
        }
    });
}

function removeVisitorRow(button) {
    const row = button.closest('.visitor-row');
    row.remove();
}

// Assign visitor card
function assignCard(visitId) {
    const cardNumber = prompt('Enter Visitor Card Number:');
    
    if (cardNumber) {
        const formData = new FormData();
        formData.append('card_number', cardNumber);
        
        fetch('/security/assign-card/' + visitId, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Card assigned successfully');
                location.reload();
            } else {
                alert('Failed to assign card');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error assigning card');
        });
    }
}

// Photo upload preview
function previewPhoto(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Capture photo from webcam
let stream = null;

function startCamera() {
    const video = document.getElementById('camera-video');
    
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(mediaStream) {
            stream = mediaStream;
            video.srcObject = stream;
            video.play();
        })
        .catch(function(error) {
            console.error('Error accessing camera:', error);
            alert('Could not access camera');
        });
}

function capturePhoto() {
    const video = document.getElementById('camera-video');
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0);
    
    canvas.toBlob(function(blob) {
        const file = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        
        const photoInput = document.getElementById('visitor_photo');
        photoInput.files = dataTransfer.files;
        
        previewPhoto(photoInput, 'photo-preview');
        closeCamera();
        closeModal('camera-modal');
    });
}

function closeCamera() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
}

// Form validation
function validateVisitorForm() {
    const mobile = document.getElementById('visitor_mobile').value;
    const name = document.getElementById('visitor_name').value;
    const hostName = document.getElementById('host_name').value;
    
    if (mobile.length !== 10) {
        alert('Mobile number must be 10 digits');
        return false;
    }
    
    if (name.trim() === '') {
        alert('Visitor name is required');
        return false;
    }
    
    if (hostName.trim() === '') {
        alert('Host name is required');
        return false;
    }
    
    return true;
}

// Date and time validation
function validateDateTime() {
    const visitDate = document.getElementById('visit_date').value;
    const visitTime = document.getElementById('visit_time').value;
    
    const selectedDateTime = new Date(visitDate + ' ' + visitTime);
    const currentDateTime = new Date();
    
    if (selectedDateTime < currentDateTime) {
        alert('Visit date and time cannot be in the past');
        return false;
    }
    
    return true;
}

// Search functionality
function performSearch(searchTerm) {
    const rows = document.querySelectorAll('.data-table tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm.toLowerCase())) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initTabs();
    
    // Mobile search for single visit
    const visitorMobile = document.getElementById('visitor_mobile');
    if (visitorMobile) {
        visitorMobile.addEventListener('input', function() {
            if (this.value.length >= 10) {
                searchVisitor(this.value, function(visitors) {
                    if (visitors.length > 0) {
                        autoFillVisitor(visitors[0]);
                    }
                });
            }
        });
    }
    
    // Host search
    const hostName = document.getElementById('host_name');
    if (hostName) {
        hostName.addEventListener('input', function() {
            if (this.value.length >= 3) {
                searchHost(this.value, function(employees) {
                    if (employees.length > 0) {
                        const datalist = document.getElementById('host-suggestions');
                        if (datalist) {
                            datalist.innerHTML = '';
                            employees.forEach(emp => {
                                const option = document.createElement('option');
                                option.value = emp.employee_name;
                                option.setAttribute('data-id', emp.id);
                                option.setAttribute('data-dept', emp.department);
                                option.setAttribute('data-phone', emp.phone_number);
                                datalist.appendChild(option);
                            });
                        }
                    }
                });
            }
        });
        
        hostName.addEventListener('change', function() {
            const datalist = document.getElementById('host-suggestions');
            if (datalist) {
                const option = datalist.querySelector(`option[value="${this.value}"]`);
                if (option) {
                    document.getElementById('host_id').value = option.getAttribute('data-id');
                    document.getElementById('host_department').value = option.getAttribute('data-dept');
                    document.getElementById('host_phone').value = option.getAttribute('data-phone');
                }
            }
        });
    }
    
    // Set current date and time
    const visitDateInput = document.getElementById('visit_date');
    const visitTimeInput = document.getElementById('visit_time');
    
    if (visitDateInput) {
        const today = new Date().toISOString().split('T')[0];
        visitDateInput.value = today;
        visitDateInput.min = today;
    }
    
    if (visitTimeInput) {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        visitTimeInput.value = `${hours}:${minutes}`;
    }
    
    // Close modal on outside click
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.remove('show');
            closeCamera();
        }
    };
});