<!-- You can extract CSS/sidebar later. For now: simple. -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { font-family:'Segoe UI',sans-serif; background:#f4f4f4; }
* { margin:0; padding:0; box-sizing:border-box; }
.sidebar { width:250px; background:#dc3545; min-height:100vh; position:fixed; left:0; top:0; padding:20px; color:white;}
.logo { text-align:center; margin-bottom:30px; }
.menu-items { list-style:none; padding:0; }
.menu-items a { color:white; text-decoration:none; display:block; padding:10px 12px; border-radius:5px; margin-bottom:10px; font-size:14px;}
.menu-items a:hover { background:rgba(255,255,255,0.2); }
.main-content { margin-left:250px; padding:20px; }
.card-box { background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.08); }
.photo-big { width:120px; height:120px; border-radius:10px; background:#dc3545; color:#fff; display:flex; align-items:center; justify-content:center; font-size:40px; margin-bottom:15px; }
</style>

<body>
<div class="sidebar">
    <div class="logo">
        <h2>🔐 VB</h2>
        <small>Visitor Mgmt</small>
    </div>
    <ul class="menu-items">
        <li><a href="<?= $this->Url->build(['action'=>'dashboard']) ?>">📊 Dashboard</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'add']) ?>">👥 New Visitor</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'invite']) ?>">✉ Invite</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'reports']) ?>">📈 Reports</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'settings']) ?>">⚙ Settings</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Admin','action'=>'logout']) ?>">🚪 Logout</a></li>
    </ul>
</div>

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
                    <h5>Visitor Info</h5>
                    <p><strong>Mobile:</strong> <?= h($visitor->mobile_number) ?></p>
                    <p><strong>Email:</strong> <?= h($visitor->email) ?></p>
                    <p><strong>Company:</strong> <?= h($visitor->company_name) ?></p>
                    <p><strong>Address:</strong> <?= h($visitor->address) ?></p>

                    <hr>

                    <h5>Visit Details</h5>
                    <p><strong>Date:</strong> <?= h($visitor->visit_date) ?></p>
                    <p><strong>Time:</strong> <?= h($visitor->visit_time) ?></p>
                    <p><strong>Reason ID / Text:</strong> <?= h($visitor->visit_reason) ?></p>

                    <hr>

                    <h5>Host Details</h5>
                    <p><strong>Host Name:</strong> <?= h($visitor->host_name) ?></p>
                    <p><strong>Department:</strong> <?= h($visitor->host_department) ?></p>
                    <p><strong>Host Phone:</strong> <?= h($visitor->host_phone) ?></p>

                    <div class="mt-3">
                        <?= $this->Html->link('Back to Dashboard', ['action'=>'dashboard'], ['class'=>'btn btn-secondary']) ?>
                        <?= $this->Html->link('Edit Visitor', ['action'=>'edit', $visitor->id], ['class'=>'btn btn-primary ms-2']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
