<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ---------- GENERAL CSS ---------- */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
}
* { margin: 0; padding: 0; box-sizing: border-box; }

/* ---------- MAIN CONTENT ---------- */
.main-content {
    margin-left: 250px;
    padding: 20px;
}

/* ---------- FORM CARD ---------- */
.form-card {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    max-width: 1000px;
    margin: 0 auto;
}

.form-title {
    font-weight: 600;
    font-size: 20px;
    border-left: 4px solid #dc3545;
    padding-left: 12px;
    margin-bottom: 30px;
    color: #333;
}

.form-label { 
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    border: 1px solid #ddd;
    padding: 10px 12px;
    border-radius: 4px;
}

.form-control:focus,
.form-select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
}

.btn-send {
    background: #dc3545;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 4px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-send:hover {
    background: #c82333;
}
</style>

<body>

<!-- Include Sidebar Element -->
<?= $this->element('sidebar') ?>

<!-- ---------- MAIN AREA ---------- -->
<div class="main-content">

    <div class="container mt-4 mb-5">
        <div class="form-card">
            <h4 class="form-title">Send Visitor Invite</h4>

            <?= $this->Form->create(null, ['url' => ['action' => 'invite']]) ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Visitor Name</label>
                    <input type="text" name="visitor_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="tel" name="mobile_number" class="form-control" maxlength="10" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Reason for Visit</label>
                <select name="visit_reason" class="form-select" required>
                    <option value="">Select Reason</option>
                    <option value="meeting">Meeting</option>
                    <option value="interview">Interview</option>
                    <option value="delivery">Delivery</option>
                    <option value="personal">Personal Visit</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Visit Date</label>
                    <input type="text" name="visit_date" class="form-control" placeholder="dd-mm-yyyy" onfocus="(this.type='date')">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Visit Time</label>
                    <input type="text" name="visit_time" class="form-control" placeholder="----" onfocus="(this.type='time')">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Note to Visitor</label>
                <textarea name="note_to_visitor" rows="4" class="form-control" placeholder="Example: Please bring ID card, reach 10 min early..."></textarea>
            </div>

            <button type="submit" class="btn btn-send w-100">
                Send Invite
            </button>

            <?= $this->Form->end() ?>

        </div>
    </div>

</div>

</body>