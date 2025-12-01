<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background:#f4f4f4;
}
* { margin:0; padding:0; box-sizing:border-box; }

/* Sidebar */
.sidebar {
    width:250px;
    background:#dc3545;
    min-height:100vh;
    position:fixed;
    left:0; top:0;
    padding:20px;
    color:white;
}
.logo { text-align:center; margin-bottom:25px; }
.logo h2 { font-size:22px; margin:0; }
.logo small { font-size:12px; opacity:0.8; }

.menu-items { list-style:none; padding:0; margin-top:20px; }
.menu-items a {
    color:white;
    text-decoration:none;
    padding:10px 12px;
    display:block;
    border-radius:5px;
    margin-bottom:10px;
    font-size:14px;
    transition:0.2s;
}
.menu-items a:hover,
.menu-items a.active {
    background:rgba(255,255,255,0.2);
}

/* Main content */
.main-content {
    margin-left:250px;
    padding:20px;
}

/* Small round icon photo */
.photo {
    width:35px;
    height:35px;
    border-radius:50%;
    background:#dc3545;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    font-weight:600;
}
</style>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">
        <h2>🔐 VB</h2>
        <small>Visitor Mgmt</small>
    </div>

    <ul class="menu-items">
        <li><a class="active" href="<?= $this->Url->build(['action'=>'dashboard']) ?>">📊 Dashboard</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'add']) ?>">👥 New Visitor</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'invite']) ?>">✉ Invite</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'reports']) ?>">📈 Reports</a></li>
        <li><a href="<?= $this->Url->build(['action'=>'settings']) ?>">⚙ Settings</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Admin','action'=>'logout']) ?>">🚪 Logout</a></li>
    </ul>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">

    <h3 class="mb-4">Today's Visitors</h3>

    <!-- Buttons -->
    <div class="mb-3">
        <?= $this->Html->link('➕ New Visitor', ['action'=>'add'], ['class'=>'btn btn-danger']) ?>
        <?= $this->Html->link('✉ Invite Visitor', ['action'=>'invite'], ['class'=>'btn btn-outline-danger ms-2']) ?>
    </div>

    <!-- Table -->
    <div class="table-container bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Visitor</th>
                    <th>Host</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($visitors)): ?>
                <?php foreach ($visitors as $v): ?>
                    <tr>

                        <!-- Photo -->
                        <td>
                            <?php if (!empty($v->photo)): ?>
                                <?= $this->Html->image(
                                    'uploads/' . $v->photo,
                                    ['style'=>'width:35px;height:35px;border-radius:50%;object-fit:cover;']
                                ) ?>
                            <?php else: ?>
                                <div class="photo">
                                    <?= strtoupper(substr($v->visitor_name, 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <!-- Visitor -->
                        <td>
                            <strong><?= h($v->visitor_name) ?></strong><br>
                            <small><?= h($v->mobile_number) ?></small>
                        </td>

                        <!-- Host -->
                        <td>
                            <strong><?= h($v->host_name) ?></strong><br>
                            <small><?= h($v->host_department) ?></small>
                        </td>

                        <td><?= h($v->visit_date) ?></td>
                        <td><?= h($v->visit_time) ?></td>
                        <td><?= h($v->visit_reason) ?></td>

                        <!-- Buttons -->
                        <td>
                            <?= $this->Html->link('View', ['action'=>'view', $v->id], ['class'=>'btn btn-sm btn-secondary']) ?>
                            <?= $this->Html->link('Edit', ['action'=>'edit', $v->id], ['class'=>'btn btn-sm btn-primary']) ?>
                            <?= $this->Form->postLink('Delete',
                                ['action'=>'delete', $v->id],
                                ['class'=>'btn btn-sm btn-danger','confirm'=>'Delete this visitor?']
                            ) ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center py-3">No visitors today.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
