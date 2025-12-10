<!DOCTYPE html>
<html>
<head>
<style>

/* Page background */
.page-wrapper {
    background: #f3f4f7;
    min-height: 100vh;
    padding: 35px;
    display: flex;
    justify-content: center;
}

/* Main card */
.card {
    width: 1000px;
    background: #ffffff;
    padding: 30px;
    border-radius: 22px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.10);
}

/* Header + filters */
.top-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.filter-box {
    background: #ececec;
    padding: 8px 12px;
    border-radius: 10px;
    margin-right: 10px;
}

.date-input {
    border: none;
    background: none;
    font-size: 14px;
    outline: none;
}

.search-input {
    padding: 10px 15px;
    border-radius: 10px;
    border: 1px solid #ddd;
    width: 230px;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th {
    background: #f6f6f6;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

/* Visitor image */
.visitor-img {
    width: 45px;
    height: 45px;
    background: #ccc;
    border-radius: 6px;
}

/* Buttons */
.btn-red {
    background: #ff4f63;
    color: white;
    border: none;
    padding: 7px 12px;
    font-size: 12px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-gray {
    background: #dcdcdc;
    color: #333;
    border: none;
    padding: 7px 12px;
    font-size: 12px;
    border-radius: 8px;
    cursor: pointer;
}

.check-link {
    color: #ff4f63;
    font-weight: bold;
    cursor: pointer;
}

</style>
</head>

<body>

<div class="page-wrapper">
    <div class="card">

        <!-- Filters -->
        <div class="top-section">

            <div>
                <span class="filter-box">
                    From: <input type="date" class="date-input">
                </span>

                <span class="filter-box">
                    To: <input type="date" class="date-input">
                </span>
            </div>

            <input type="text" class="search-input" placeholder="Search Visitor">

            <a href="/visitors/add-single">
                <button class="btn-red">New Visitor</button>
            </a>

        </div>

        <h3 style="margin-bottom:15px;">Today's Visitors</h3>

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

            <!-- Sample Static Data (Replace with DB values later) -->
            <tr>
                <td><div class="visitor-img"></div></td>
                <td>
                    Amit Kumar <br>
                    <small>9990725677</small>
                </td>
                <td>
                    5100176 - Akhil Tiwari <br>
                    <small>IT Department</small>
                </td>
                <td>Approved</td>
                <td>No</td>
                <td>11-10-2023 11:00 AM</td>
                <td><b>11:00</b></td>
                <td><span class="check-link">Check-Out</span></td>
                <td>
                    <button class="btn-red">Assign</button>
                    <button class="btn-gray">View</button>
                </td>
            </tr>

        </table>

    </div>
</div>

</body>
</html>
