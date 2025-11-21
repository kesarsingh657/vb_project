<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    
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
     
     {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .logo h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 12px;
            opacity: 0.8;
        }

        .menu-items {
            list-style: none;
        }

        .menu-items li {
            margin-bottom: 15px;
        }

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

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 400px;
        }

        .search-box input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #dc3545;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #dc3545;
        }

        .stat-card.pending {
            border-left-color: #ffc107;
        }

        .stat-card.approved {
            border-left-color: #28a745;
        }

        .stat-card.rejected {
            border-left-color: #dc3545;
        }

        .stat-card h3 {
            color: #666;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
        }

        .stat-card p {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }

        /* Filter Bar */
        .filter-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .filter-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-controls select,
        .filter-controls input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background-color: #c82333;
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f0f0 100%);
            border-bottom: 2px solid #ddd;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            color: #555;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        .visitor-photo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-cell {
            display: flex;
            gap: 8px;
        }

        .action-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            border: none;
            background: none;
            padding: 0;
        }

        .action-icon.view {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .action-icon.view:hover {
            background-color: #0066cc;
            color: white;
        }

        .action-icon.checkout {
            background-color: #fff3cd;
            color: #ff9800;
        }

        .action-icon.checkout:hover {
            background-color: #ff9800;
            color: white;
        }

        .action-icon.delete {
            background-color: #ffebee;
            color: #dc3545;
        }

        .action-icon.delete:hover {
            background-color: #dc3545;
            color: white;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 10px;
            }

            .main-content {
                margin-left: 70px;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            table {
                font-size: 11px;
            }

            th, td {
                padding: 10px;
            }
        }
</style>
<body>
  <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h2>🔐 VB</h2>
            <p>Visitor Mgmt</p>
        </div>
        <ul class="menu-items">
            <li><a href="<?= $this->Url->build(['action' => 'dashboard']) ?>" class="active"><span>📊</span> Dashboard</a></li>
            <li><a href="<?= $this->Url->build(['action' => 'add']) ?>"><span>👥</span> New Visitor</a></li>
            <li><a href="#"><span>📈</span> Reports</a></li>
            <li><a href="#"><span>⚙️</span> Settings</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'logout']) ?>"><span>🚪</span> Logout</a></li>
        </ul>
    </div>


<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="form-card">
                <h4 class="form-title">Add New Visitor</h4>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Visitor Name</label>
                            <input type="text" name="visitor_name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile_number" maxlength="10" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason of Visit</label>
                        <select name="visit_reason" class="form-select">
                            <option value="">Select Reason</option>
                            <?php foreach ($visitReasons as $reason): ?>
                                <option value="<?= $reason->id ?>"><?= $reason->reason_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Host Name</label>
                            <input type="text" name="host_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Host Department</label>
                            <input type="text" name="host_department" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Host Phone</label>
                        <input type="text" name="host_phone" maxlength="10" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Visit Date</label>
                            <input type="date" name="visit_date" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Visit Time</label>
                            <input type="time" name="visit_time" class="form-control">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Visitor Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Add Visitor
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>
