<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Medivista</title>

<!-- ICON -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
}

body {
    background: #f3f5f7;
}

/* NAVBAR */
.navbar {
    background: #2f3e4e;
    display: flex;
    justify-content: space-between;
    padding: 15px 40px;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    font-size: 15px;
}

.navbar a.active {
    color: #93c5fd;;
    font-weight: 600;
    padding-bottom: 3px;
}

.navbar a:hover {
    color: #93c5fd;;
}

/* HERO */
.hero {
    text-align: center;
    padding: 80px 20px;
}

.hero h1 {
    font-size: 32px;
    font-weight: 600;
    color: #2f3e4e;
}

.hero h1 i {
    margin-right: 10px;
}

.hero p {
    margin-top: 15px;
    color: #666;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* CARDS */
.cards {
    margin-top: 60px;
    display: flex;
    justify-content: center;
    gap: 40px;
}

.card {
    background: white;
    width: 320px;
    padding: 35px;
    border-radius: 16px;
    text-align: left;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card-icon {
    font-size: 34px;
    margin-bottom: 15px;
    color: #2f3e4e;
}

.card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.card p {
    font-size: 15px;
    color: #666;
    margin-bottom: 10px;
}

.card a {
    color: #3b82f6;
    text-decoration: none;
    font-size: 14px;
}

.card a:hover {
    text-decoration: underline;
}

/* BUTTON */
.btn-dashboard {
    margin-top: 50px;
    background: #2f3e4e;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
}

.btn-dashboard i {
    margin-right: 8px;
}

.btn-dashboard:hover {
    background: #1f2a36;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div>
        <a href="#" class="active">Home</a>
        <a href="#">Articles</a>
        <a href="#">Outbreaks</a>
        <a href="qa.php">Q&A</a>
    </div>
    <div>
        <a href="#">Login/Register</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <h1>
        <i class="fa-solid fa-heart-pulse"></i>
        Medivista Health Information Portal
    </h1>

    <p>
        A comprehensive platform for monitoring, managing, and disseminating information
        about infectious diseases and outbreak prevention
    </p>

    <div class="cards">

        <div class="card">
            <i class="fa-solid fa-file-medical card-icon"></i>
            <h3>Infectious Disease Articles</h3>
            <p>Articles about infectious diseases</p>
            <a href="#">Explore →</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-triangle-exclamation card-icon"></i>
            <h3>Outbreak Alerts</h3>
            <p>Warnings about disease outbreaks and epidemics</p>
            <a href="#">Explore →</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-comments card-icon"></i>
            <h3>Article Q&A</h3>
            <p>Ask questions and get answers</p>
            <a href="qa.php">Explore →</a>
        </div>

    </div>

    <button class="btn-dashboard">
        <i class="fa-solid fa-bolt"></i> Go to Dashboard
    </button>
</section>

</body>
</html>