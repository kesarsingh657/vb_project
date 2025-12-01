<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background:#f4f4f4;
}
* { margin:0; padding:0; box-sizing:border-box; }

.main-content {
    margin-left:250px;
    padding:20px;
}

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

.status-badge {
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
}

.badge-approved { background: #d4edda; color: #155724; }
.badge-pending { background: #fff3cd; color: #856404; }
.badge-rejected { background: #f8d7da; color: #721c24; }
.badge-checked-in { background: #cfe2ff; color: #084298; }
</style>

<body>

<?= $this->element('sidebar') ?>

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
                    <th>Type</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Check In/Out</th>
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

                        <!-- Type -->
                        <td>
                            <?php if ($v->visit_type == 'group'): ?>
                                <span class="badge bg-info">Group (<?= $v->group_size ?>)</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Single</span>
                            <?php endif; ?>
                            
                            <?php if ($v->is_pre_registered): ?>
                                <br><small class="text-success">✓ Pre-registered</small>
                            <?php endif; ?>
                        </td>

                        <td><?= h($v->visit_time) ?></td>

                        <!-- Status -->
                        <td>
                            <?php
                                if ($v->host_status == "approved") {
                                    echo "<span class='status-badge badge-approved'>✓ Approved</span>";
                                } elseif ($v->host_status == "rejected") {
                                    echo "<span class='status-badge badge-rejected'>✗ Rejected</span>";
                                } else {
                                    echo "<span class='status-badge badge-pending'>⏳ Pending</span>";
                                }
                            ?>
                        </td>

                        <!-- Check In/Out -->
                        <td>
                            <?php if ($v->check_in_time && $v->check_out_time): ?>
                                <small class="text-success">✓ Completed</small><br>
                                <small><?= date('h:i A', strtotime($v->check_out_time)) ?></small>
                            <?php elseif ($v->check_in_time): ?>
                                <span class="status-badge badge-checked-in">Checked In</span><br>
                                <small><?= date('h:i A', strtotime($v->check_in_time)) ?></small><br>
                                <?= $this->Html->link('Check Out', ['action'=>'checkOut', $v->id], [
                                    'class'=>'btn btn-sm btn-warning mt-1'
                                ]) ?>
                            <?php else: ?>
                                <?= $this->Html->link('Check In', ['action'=>'checkIn', $v->id], [
                                    'class'=>'btn btn-sm btn-success'
                                ]) ?>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
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
                <tr><td colspan="8" class="text-center py-3">No visitors today.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>