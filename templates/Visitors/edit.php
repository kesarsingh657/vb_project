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

.form-label { 
    font-weight: 500; 
}
</style>

<body>

<!-- Include Sidebar Element -->
<?= $this->element('sidebar') ?>

<!-- ---------- MAIN AREA ---------- -->
<div class="main-content">

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="form-card">
                    <h4 class="form-title">Edit Visitor</h4>

                    <?= $this->Form->create($visitor, ['type' => 'file']) ?>

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
                        'class' => 'form-control mb-3'
                    ]) ?>

                    <?= $this->Form->control('address', [
                        'type' => 'textarea',
                        'label' => 'Address',
                        'rows' => 2,
                        'class' => 'form-control mb-3'
                    ]) ?>

                    <?= $this->Form->control('company_name', [
                        'label' => 'Company Name',
                        'class' => 'form-control mb-3'
                    ]) ?>

                    <!-- DROPDOWN -->
                    <label class="form-label">Reason of Visit</label>
                    <select name="visit_reason" class="form-select mb-3" required>
                        <option value="">Select Reason</option>
                        <?php foreach ($visitReasons as $key => $label): ?>
                            <option value="<?= h($key) ?>" <?= ($visitor->visit_reason == $key) ? 'selected' : '' ?>>
                                <?= h($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('host_name', [
                                'label' => 'Host Name',
                                'class' => 'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('host_department', [
                                'label' => 'Host Department',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->Form->control('host_phone', [
                        'label' => 'Host Phone',
                        'class' => 'form-control mb-3',
                        'maxlength' => 10
                    ]) ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('visit_date', [
                                'type' => 'date',
                                'label' => 'Visit Date',
                                'class' => 'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('visit_time', [
                                'type' => 'time',
                                'label' => 'Visit Time',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>

                    <!-- Show current photo if exists -->
                    <?php if (!empty($visitor->photo)): ?>
                        <div class="mb-3">
                            <label class="form-label">Current Photo</label><br>
                            <?= $this->Html->image('uploads/'.$visitor->photo, [
                                'style'=>'width:80px;height:80px;border-radius:8px;object-fit:cover;'
                            ]) ?>
                        </div>
                    <?php endif; ?>

                    <?= $this->Form->control('photo', [
                        'type' => 'file',
                        'label' => 'Update Visitor Photo',
                        'class' => 'form-control mb-4'
                    ]) ?>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill py-2">
                            Update Visitor
                        </button>
                        <?= $this->Html->link('Cancel', ['action'=>'dashboard'], ['class'=>'btn btn-secondary flex-fill py-2']) ?>
                    </div>

                    <?= $this->Form->end() ?>

                </div>

            </div>
        </div>
    </div>

</div>
</body>