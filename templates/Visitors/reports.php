<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Reports</div>

        <form method="get">
            <input class="input-box" type="date" name="from">
            <input class="input-box" type="date" name="to">
            <button class="main-btn">Filter</button>
        </form>

        <table>
            <tr>
                <th>Visitor</th>
                <th>Host</th>
                <th>Date</th>
                <th>Status</th>
                <th>View</th>
            </tr>

            <?php foreach ($visits as $v): ?>
                <tr>
                    <td><?= $v->visitor_name ?></td>
                    <td><?= $v->host_name ?></td>
                    <td><?= $v->visit_date ?> <?= $v->visit_time ?></td>
                    <td><?= ucfirst($v->host_status) ?></td>
                    <td><a class="view-link" href="/visitors/view/<?= $v->id ?>">View</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
