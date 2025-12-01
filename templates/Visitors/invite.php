<?php $this->assign('title', 'Send Invite'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.body-bg {
    margin-left: 250px;
    padding: 20px;
}

.card-custom {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.card-custom h3 {
    font-weight: 600;
    border-left: 4px solid #dc3545;
    padding-left: 10px;
}
</style>

<div class="body-bg">

    <div class="container mt-4">
        <div class="card-custom">

            <h3 class="mb-4">Send Visitor Invite</h3>

            <?= $this->Form->create(null) ?>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('visitor_name', [
                        'label' => 'Visitor Name',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('mobile_number', [
                        'label' => 'Mobile Number',
                        'maxlength' => 10,
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

            </div>

            <?= $this->Form->control('email', [
                'label' => 'Email',
                'class' => 'form-control mb-3',
                'required' => true
            ]) ?>

            <!-- Select Reason -->
            <label class="form-label">Reason for Visit</label>
            <select name="reason" class="form-select mb-3" required>
                <option value="">Select Reason</option>
                <option value="Meeting">Meeting</option>
                <option value="Interview">Interview</option>
                <option value="Delivery">Delivery</option>
                <option value="Maintenance">Maintenance</option>
            </select>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('visit_date', [
                        'type' => 'date',
                        'label' => 'Visit Date',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <!-- AM/PM TIME INPUT -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Visit Time</label>
                    <input type="time" name="visit_time" class="form-control" required>
                </div>

            </div>

            <?= $this->Form->control('note_to_visitor', [
                'type' => 'textarea',
                'label' => 'Note to Visitor',
                'class' => 'form-control mb-3',
                'rows' => 3,
                'placeholder' => 'Example: Please bring ID card, reach 10 min early...'
            ]) ?>

            <button class="btn btn-danger w-100 py-2">Send Invite</button>

            <?= $this->Form->end() ?>

        </div>
    </div>

</div>
