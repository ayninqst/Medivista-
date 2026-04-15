<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Article Q&A</title>

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
    background: #eef2f5;
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
}

.navbar a.active {
    color: #93c5fd;
    font-weight: 600;
}

/* CONTAINER */
.container {
    max-width: 800px;
    margin: 60px auto;
}

/* TITLE */
.title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.subtitle {
    color: #666;
    margin-bottom: 30px;
}

/* CARD */
.card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* INPUT */
textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    resize: none;
    margin-top: 10px;
}

button {
    margin-top: 10px;
    background: #2f3e4e;
    color: white;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #1f2a36;
}

/* Q&A */
.qa h4 {
    font-weight: 600;
    margin-bottom: 15px;
}

.qa-item {
    margin-bottom: 18px;
}

.qa-item p {
    margin: 3px 0;
}

/* USER */
.user strong {
    color: #000;
}

/* ADMIN */
.admin {
    color: #3b82f6;
}

/* OPTIONAL divider */
.qa-item:not(:last-child) {
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>
        <a href="index.php">Home</a>
        <a href="#">Articles</a>
        <a href="#">Outbreaks</a>
        <a href="qa.php" class="active">Q&A</a>
    </div>
    <div>
        <a href="#">Login/Register</a>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="title">Article Q&A</div>
    <div class="subtitle">Ask questions related to medical articles</div>

    <!-- ASK QUESTION -->
    <div class="card">
        <h4>Ask a Question</h4>
        <form action="submit.php" method="POST">

            <textarea name="question" rows="3" placeholder="Type your question..." required></textarea>

            <button type="submit">Submit</button>

        </form>
    </div>

    <!-- QUESTIONS & ANSWERS -->
    <div class="card qa">
        <h4>Questions & Answers</h4>

        <div class="qa-item">
            <p class="user"><strong>Q:</strong> What are dengue symptoms?</p>
            <p class="admin"><strong>A:</strong> Fever, headache, joint pain.</p>
        </div>

        <div class="qa-item">
            <p class="user"><strong>Q:</strong> Is COVID-19 still dangerous?</p>
            <p class="admin"><strong>A:</strong> Yes, especially for elderly.</p>
        </div>

    </div>

</div>

</body>
</html>