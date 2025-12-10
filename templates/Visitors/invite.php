<!DOCTYPE html>
<html>
<head>
<style>

.page-wrapper {
    background: #f4f6f9;
    padding: 40px;
    display: flex;
    justify-content: center;
}

.form-card {
    width: 650px;
    background: #ffffff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.10);
}

.title {
    font-size: 22px;
    font-weight: bold;
    color: #ff4f63;
    margin-bottom: 25px;
    text-align: center;
}

.input-box {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid #ddd;
    border-radius: 12px;
    margin-bottom: 15px;
    font-size: 15px;
    outline: none;
    background: #f8f8f8;
}

.main-btn {
    width: 100%;
    padding: 14px;
    background: #ff4f63;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 17px;
    cursor: pointer;
    margin-top: 10px;
}

.main-btn:hover {
    background: #e93c55;
}

</style>
</head>

<body>

<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Invite Visitor</div>

        <?= $this->Form->create(null) ?>

        <!-- Visitor Fields -->
        <input class="input-box" type="text" name="visitor_name" placeholder="Visitor Name*" required>
        <input class="input-box" type="text" name="visitor_mobile" placeholder="Visitor Mobile*" required>
        <input class="input-box" type="email" name="visitor_email" placeholder="Visitor Email*" required>

        <!-- Host Fields -->
        <input class="input-box" type="text" name="host_name" placeholder="Host Name*" required>
        <input class="input-box" type="text" name="host_department" placeholder="Host Department*" required>
        <input class="input-box" type="text" name="host_mobile" placeholder="Host Mobile*" required>

        <!-- Date & Time -->
        <input class="input-box" type="date" name="visit_date" required>
        <input class="input-box" type="time" name="visit_time" required>

        <!-- Visit Reason Dropdown -->
        <select name="visit_reason" class="input-box" required>
            <option value="">Select Visit Reason*</option>
            <?php foreach ($reasons as $id => $reason): ?>
                <option value="<?= $reason ?>"><?= $reason ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Submit Button -->
        <button class="main-btn" type="submit">Send Invitation</button>

        <?= $this->Form->end() ?>
    </div>
</div>

</body>
</html>
