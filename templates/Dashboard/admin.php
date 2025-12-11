<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f7;
        }

        .page-container {
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .admin-card {
            width: 900px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .date-box {
            background: #f1f1f1;
            padding: 8px 14px;
            border-radius: 10px;
            margin-right: 10px;
        }

        .search-input {
            width: 220px;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        
        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-new {
            background: #ff4f63;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-new:hover {
            background: #ff2d4b;
        }

        .btn-invite {
            background: #ffe4e8;
            color: #ff4f63;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ff4f63;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-invite:hover {
            background: #ff4f63;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 10px;
        }

        th {
            background: #f6f6f6;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .check-link {
            color: #ff4f63;
            font-weight: bold;
            cursor: pointer;
        }

        .action-btn {
            background: #ff4f63;
            color: white;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            border: none;
        }

        .visitor-img {
            width: 40px;
            height: 40px;
            background: #ccc;
            border-radius: 5px;
        }

    </style>
</head>

<body>

<div class="page-container">

    <div class="admin-card">

        <div class="top-section">

            
            <div>
                <span class="date-box">From: <input type="date"></span>
                <span class="date-box">To: <input type="date"></span>
            </div>

            
            <input type="text" class="search-input" placeholder="Search Visitor">

            
            <div class="btn-group">
                <a href="/visitors/add-single"><button class="btn-new">+ New Visitor</button></a>
                <a href="/invite"><button class="btn-invite">Invite Visitor</button></a>
            </div>

        </div>

        <h3 style="margin-bottom: 15px;">Today's Visitors</h3>

        <table>
            <tr>
                <th>Image</th>
                <th>Visitor Name</th>
                <th>Host Name</th>
                <th>Host Status</th>
                <th>Group</th>
                <th>Visit Date-Time</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Action</th>
            </tr>

            
            <tr>
                <td><div class="visitor-img"></div></td>
                <td>Amit Kumar<br><small>9990725677</small></td>
                <td>5100176 - Akhil Tiwari</td>
                <td>Approved</td>
                <td>No</td>
                <td>11-10-2023 11:00 AM</td>
                <td><b>11:00</b></td>
                <td><span class="check-link">Check-Out</span></td>
                <td><button class="action-btn">View</button></td>
            </tr>

        </table>

    </div>

</div>

</body>
</html>
