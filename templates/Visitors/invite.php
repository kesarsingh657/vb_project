<div class="page-wrapper">
    <div class="form-card">
        <div class="title">Invite Visitor</div>

        <?= $this->Form->create() ?>

        <input class="input-box" type="text" name="visitor_name" placeholder="Visitor Name*" required>
        <input class="input-box" type="text" name="visitor_mobile" placeholder="Visitor Mobile*" required>
        <input class="input-box" type="email" name="visitor_email" placeholder="Email*" required>

        <input class="input-box" type="text" name="host_name" placeholder="Host Name*" required>
        <input class="input-box" type="text" name="host_department" placeholder="Department*" required>
        <input class="input-box" type="text" name="host_mobile" placeholder="Host Mobile*" required>

        <input class="input-box" type="date" name="visit_date" required>
        <input class="input-box" type="time" name="visit_time" required>

        <input class="input-box" type="text" name="visit_reason" placeholder="Reason*" required>

        <button class="main-btn" type="submit">Send Invitation</button>

        <?= $this->Form->end() ?>
    </div>
</div>
