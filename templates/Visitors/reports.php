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
    width: 90%;
    max-width: 1000px;
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
}

/* Filters Section */
.filter-row {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.input-box {
    flex: 1;
    padding: 13px 15px;
    border: 1px solid #ddd;
    border-radius: 12px;
    font-size: 15px;
    background: #f8f8f8;
}

.main-btn {
    padding: 14px 25px;
    background: #ff4f63;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
    white-space: nowrap;
}

.main-btn:hover {
    background: #e93c55;
}

/* Table Styling */
table {
    width: 100%;
    margin-top: 25px;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

th {
    background: #ffe2e6;
    padding: 12px;
    text-align: left;
    font-size: 14px;
    color: #333;
}

td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

tr:hover {
    background: #fff7f8;
}

/* View Button */
.view-link {
    padding: 6px 12px;
    background: #ff4f63;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
}

.view-link:hover {
    background: #e93c55;
}

</style>
</head>

<body>

<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Reports</div>

        <!-- Filter Form -->
        <form method="get">
            <div class="filter-row">
                <input class="input-box" type="date" name="from" value="<?= $this->request->getQuery('from') ?>">
                <input class="input-box" type="date" name="to" value="<?= $this->request->getQuery('to') ?>">

                <button class="main-btn">Filter</button>
            </div>
        </form>

        <!-- Report Table -->
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
                    <td><?= h($v->visitor_name) ?></td>
                    <td><?= h($v->host_name) ?></td>
                    <td><?= h($v->visit_date . ' ' . $v->visit_time) ?></td>
                    <td><?= ucfirst(h($v->host_status)) ?></td>
                    <td><a class="view-link" href="/visitors/view/<?= $v->id ?>">View</a></td>
                </tr>
            <?php endforeach; ?>

            <?php if (count($visits) == 0): ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding:20px; color:#777;">
                        No records found
                    </td>
                </tr>
            <?php endif; ?>
        </table>

    </div>
</div>

</body>
</html>
