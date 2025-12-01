<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ---------- GENERAL CSS ---------- */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
}
* { margin: 0; padding: 0; box-sizing: border-box; }

/* ---------- SIDEBAR ---------- */
.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    padding: 20px;
    color: white;
}
.logo {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
}
.logo h2 { font-size: 22px; }
.logo p { font-size: 12px; opacity: 0.8; }
.menu-items { list-style: none; }
.menu-items a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-radius: 5px;
    transition: all 0.3s;
    font-size: 14px;
}
.menu-items a:hover,
.menu-items a.active {
    background-color: rgba(255, 255, 255, 0.2);
    padding-left: 20px;
}
.menu-items a span {
    margin-right: 10px;
    font-size: 18px;
}

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
.form-label { font-weight: 500; }
</style>

<body>

<!-- ---------- SIDEBAR ---------- -->
<div class="sidebar">
    <div class="logo">
        <h2>🔐 VB</h2>
        <p>Visitor Mgmt</p>
    </div>

    <ul class="menu-items">
        <li><a href="<?= $this->Url->build(['action' => 'dashboard']) ?>"><span>📊</span> Dashboard</a></li>
        <li><a class="active" href="<?= $this->Url->build(['action' => 'add']) ?>"><span>👥</span> New Visitor</a></li>
        <li><a href="<?= $this->Url->build(['action' => 'reports']) ?>"><span>📈</span> Reports</a></li>
        <li><a href="<?= $this->Url->build(['action' => 'settings']) ?>"><span>⚙️</span> Settings</a></li>
        <li><a href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'logout']) ?>"><span>🚪</span> Logout</a></li>
    </ul>
</div>

<!-- ---------- MAIN AREA ---------- -->
<div class="main-content">

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="form-card">
                    <h4 class="form-title">Add New Visitor</h4>

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

                    <!-- ✔ FIXED DROPDOWN -->
                    <label class="form-label">Reason of Visit</label>
                    <select name="visit_reason" class="form-select mb-3" required>
                        <option value="">Select Reason</option>
                        <?php foreach ($visitReasons as $key => $label): ?>
                            <option value="<?= h($key) ?>"><?= h($label) ?></option>
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
                                'label' => 'Visit Time (12-hour format)',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->Form->control('photo', [
                        'type' => 'file',
                        'label' => 'Visitor Photo',
                        'class' => 'form-control mb-4'
                    ]) ?>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Add Visitor
                    </button>

                    <?= $this->Form->end() ?>

                </div>

            </div>
        </div>
    </div>

</div>
</body>
