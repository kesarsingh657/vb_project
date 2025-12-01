<?php $this->assign('title', 'Settings'); ?>

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
        <label>Email Notifications</label>
        <select name="email_notify" class="form-select">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Default Timezone</label>
        <select name="timezone" class="form-select">
            <option>Asia/Kolkata</option>
            <option>Asia/Dubai</option>
            <option>America/New_York</option>
            <option>Europe/London</option>
        </select>
    </div>

    <button class="btn btn-danger w-100">Save Settings</button>

    <?= $this->Form->end() ?>
</div>
