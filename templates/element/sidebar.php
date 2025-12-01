<style>
.sidebar {
    width:250px;
    background:linear-gradient(135deg, #dc3545, #c82333);
    min-height:100vh;
    position:fixed;
    left:0; top:0;
    padding:20px;
    color:white;
}
.sidebar .logo { text-align:center; margin-bottom:30px; }
.sidebar .logo h2 { margin:0; font-size:22px; }
.sidebar ul { list-style:none; padding:0; margin:0; }
.sidebar ul li a {
    color:white;
    text-decoration:none;
    padding:10px 12px;
    display:block;
    border-radius:5px;
    margin-bottom:10px;
}
.sidebar ul li a:hover,
.sidebar ul li a.active {
    background:rgba(255,255,255,0.2);
}
</style>

<div class="sidebar">
    <div class="logo">
        <h2>🔐 VB</h2>
        <small>Visitor Mgmt</small>
    </div>

    <ul>
        <li><a href="<?= $this->Url->build(['controller'=>'Visitors','action'=>'dashboard']) ?>">📊 Dashboard</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Visitors','action'=>'add']) ?>">👥 New Visitor</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Visitors','action'=>'invite']) ?>">✉ Invite</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Visitors','action'=>'reports']) ?>">📈 Reports</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Visitors','action'=>'settings']) ?>">⚙ Settings</a></li>
        <li><a href="<?= $this->Url->build(['controller'=>'Admin','action'=>'logout']) ?>">🚪 Logout</a></li>
    </ul>
</div>
