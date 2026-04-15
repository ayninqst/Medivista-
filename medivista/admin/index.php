<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Medivista Health Information Portal Admin </title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
}

body {
    background: #e8f5f1;
}

/* NAVBAR */
.navbar {
    background: #2f6f64;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
}

.navbar .left a {
    color: white;
    text-decoration: none;
    margin-right: 25px;
    font-size: 15px;
}

.navbar .left a:hover {
    text-decoration: underline;
}

.navbar .right i {
    color: white;
    font-size: 22px;
}

/* HERO */
.hero {
    text-align: center;
    padding: 70px 20px;
}

.hero h1 {
    font-size: 36px;
    color: #2f6f64;
}

.hero p {
    margin-top: 10px;
    color: #5f7f78;
}

/* CARDS */
.cards {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 50px;
}

.card {
    background: #ffffff;
    width: 280px;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card i {
    font-size: 30px;
    margin-bottom: 15px;
    color: #222;
}

.card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.card p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

/* BUTTON */
.card button {
    background: #2f6f64;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 8px;
    cursor: pointer;
}

.card button:hover {
    background: #24574f;
}

.dashboard-btn-wrapper {
    text-align: center;
    margin-top: 50px;
}

.btn-dashboard {
    background: #2f6f64;
    color: white;
    border: none;
    padding: 12px 28px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
}

.btn-dashboard i {
    margin-right: 8px;
}

.btn-dashboard:hover {
    background: #24574f;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="left">
        <a href="#">Home</a>
        <a href="#">Articles</a>
        <a href="#">Outbreaks</a>
        <a href="admin/qa.php">Q&A</a>
        <a href="#">Logout</a>
    </div>
    <div class="right">
        <i class="fa-solid fa-user-circle"></i>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Medivista Health Information Portal Admin</h1>
</div>

<!-- CARDS -->
<div class="cards">

    <div class="card">
        <i class="fa-solid fa-file-medical icon-article"></i>
        <h3>Manage Articles</h3>
        <p>Add, edit, and delete disease articles</p>
        <button>Open</button>
    </div>

    <div class="card">
        <i class="fa-solid fa-triangle-exclamation icon-alert"></i>
        <h3>Manage Outbreaks</h3>
        <p>Update outbreak alerts and warnings</p>
        <button>Open</button>
    </div>

    <div class="card">
        <i class="fa-solid fa-comments icon-qa"></i>
        <h3>Manage Q&A</h3>
        <p>Respond to user questions</p>
        <button><a href="admin/qa.php" style="color: white; text-decoration: none;">Open</a></button>
    </div>

    <div class="card">
        <i class="fa-solid fa-users icon-user"></i>
        <h3>User Management</h3>
        <p>View and manage registered users</p>
        <button>Open</button>
    </div>

</div>

<div class="dashboard-btn-wrapper">
    <button class="btn-dashboard">
        <i class="fa-solid fa-bolt"></i> Go to Dashboard
    </button>
</div>

</body>
</html>