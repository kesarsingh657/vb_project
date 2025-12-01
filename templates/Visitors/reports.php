<?php $this->assign('title', 'Reports'); ?>

<h3 class="mb-4">Visitor Reports</h3>

<!-- Filters -->
<div class="card p-3 shadow-sm mb-3">
    <form method="get">

        <div class="row">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" name="from_date" class="form-control" value="<?= $this->request->getQuery('from_date') ?>">
            </div>

            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" name="to_date" class="form-control" value="<?= $this->request->getQuery('to_date') ?>">
            </div>

            <div class="col-md-3">
                <label>Host Name</label>
                <input type="text" name="host" class="form-control" placeholder="Search host..." value="<?= $this->request->getQuery('host') ?>">
            </div>

            <div class="col-md-3">
                <label>Visitor</label>
                <input type="text" name="visitor" class="form-control" placeholder="Name / Mobile..." value="<?= $this->request->getQuery('visitor') ?>">
            </div>
        </div>

        <button class="btn btn-danger w-100 mt-3">Apply Filters</button>
    </form>
</div>

<!-- Table -->
<div class="table-responsive bg-white p-3 rounded shadow-sm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Visitor</th>
                <th>Mobile</th>
                <th>Host</th>
                <th>Dept</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($visitors)): ?>
            <?php foreach ($visitors as $v): ?>

                <tr>
                    <td><strong><?= h($v->visitor_name) ?></strong></td>
                    <td><?= h($v->mobile_number) ?></td>
                    <td><?= h($v->host_name) ?></td>
                    <td><?= h($v->host_department) ?></td>
                    <td><?= h($v->visit_date) ?></td>
                    <td><?= h($v->visit_time) ?></td>

                    <!-- Status -->
                    <td>
                        <?php
                            if ($v->host_status == "approved") {
                                echo "<span class='badge bg-success'>Approved</span>";
                            } elseif ($v->host_status == "rejected") {
                                echo "<span class='badge bg-danger'>Rejected</span>";
                            } else {
                                echo "<span class='badge bg-warning text-dark'>Pending</span>";
                            }
                        ?>
                    </td>

                    <td><?= $v->check_in ?: '-' ?></td>
                    <td><?= $v->check_out ?: '-' ?></td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>

            <tr>
                <td colspan="9" class="text-center">No records found.</td>
            </tr>

        <?php endif; ?>
        </tbody>
    </table>
</div>
