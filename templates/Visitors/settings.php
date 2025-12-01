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

.card {
    border: none;
    border-radius: 8px;
}

.form-label {
    font-weight: 500;
}
</style>

<body>

<!-- Include Sidebar Element -->
<?= $this->element('sidebar') ?>

<!-- ---------- MAIN AREA ---------- -->
<div class="main-content">

    <h3 class="mb-4">System Settings</h3>

    <div class="card p-4 shadow-sm">

        <?= $this->Form->create(null) ?>

        <div class="mb-3">
            <?= $this->Form->control('company_name', [
                'label' => 'Company Name',
                'class' => 'form-control',
                'value' => 'VB Visitor Management'
            ]) ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Notifications</label>
            <select name="email_notify" class="form-select">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">SMS Notifications</label>
            <select name="sms_notify" class="form-select">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Default Timezone</label>
            <select name="timezone" class="form-select">
                <option>Asia/Kolkata</option>
                <option>Asia/Dubai</option>
                <option>America/New_York</option>
                <option>Europe/London</option>
            </select>
        </div>

        <div class="mb-3">
            <?= $this->Form->control('session_timeout', [
                'label' => 'Session Timeout (minutes)',
                'type' => 'number',
                'class' => 'form-control',
                'value' => '30'
            ]) ?>
        </div>

        <button type="submit" class="btn btn-danger w-100 py-2">Save Settings</button>

        <?= $this->Form->end() ?>

    </div>

</div>

</body>