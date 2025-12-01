v<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

.card-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.photo-big {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    background: #dc3545;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin-bottom: 15px;
}
</style>

<body>

<!-- Include Sidebar Element -->
<?= $this->element('sidebar') ?>

<!-- ---------- MAIN AREA ---------- -->
<div class="main-content">

    <div class="container mt-4">
        <div class="card-box">
            <div class="row">
                <div class="col-md-3 text-center">
                    <?php if (!empty($visitor->photo)): ?>
                        <?= $this->Html->image('uploads/'.$visitor->photo, [
                            'style'=>'width:120px;height:120px;border-radius:10px;object-fit:cover;'
                        ]) ?>
                    <?php else: ?>
                        <div class="photo-big">
                            <?= strtoupper($visitor->visitor_name[0] ?? 'V') ?>
                        </div>
                    <?php endif; ?>
                    <p class="mt-2"><strong><?= h($visitor->visitor_name) ?></strong></p>
                </div>

                <div class="col-md-9">
                    <h5 class="mb-3">Visitor Info</h5>
                    <p><strong>Mobile:</strong> <?= h($visitor->mobile_number) ?></p>
                    <p><strong>Email:</strong> <?= h($visitor->email) ?></p>
                    <p><strong>Company:</strong> <?= h($visitor->company_name) ?></p>
                    <p><strong>Address:</strong> <?= h($visitor->address) ?></p>

                    <hr>

                    <h5 class="mb-3">Visit Details</h5>
                    <p><strong>Date:</strong> <?= h($visitor->visit_date) ?></p>
                    <p><strong>Time:</strong> <?= h($visitor->visit_time) ?></p>
                    <p><strong>Reason:</strong> <?= h($visitor->visit_reason) ?></p>

                    <hr>

                    <h5 class="mb-3">Host Details</h5>
                    <p><strong>Host Name:</strong> <?= h($visitor->host_name) ?></p>
                    <p><strong>Department:</strong> <?= h($visitor->host_department) ?></p>
                    <p><strong>Host Phone:</strong> <?= h($visitor->host_phone) ?></p>

                    <div class="mt-4">
                        <?= $this->Html->link('Back to Dashboard', ['action'=>'dashboard'], ['class'=>'btn btn-secondary']) ?>
                        <?= $this->Html->link('Edit Visitor', ['action'=>'edit', $visitor->id], ['class'=>'btn btn-primary ms-2']) ?>
                        <?= $this->Form->postLink('Delete', 
                            ['action'=>'delete', $visitor->id], 
                            ['class'=>'btn btn-danger ms-2', 'confirm'=>'Are you sure you want to delete this visitor?']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>