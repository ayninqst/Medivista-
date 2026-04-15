<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Q&A Management</title>

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

/* CONTAINER */
.container {
    max-width: 900px;
    margin: 60px auto;
}

/* TITLE */
.title {
    font-size: 30px;
    font-weight: 600;
    margin-bottom: 25px;
}

/* SECTION TITLE */
.section-title {
    font-size: 18px;
    font-weight: 600;
    margin: 20px 0 10px;
}

/* CARD */
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* QUESTION TEXT */
.question {
    font-size: 15px;
    margin-bottom: 8px;
}

/* STATUS */
.status {
    font-size: 12px;
    margin-top: 5px;
}

.pending {
    color: red;
}

.answered {
    color: green;
}

/* BUTTON GROUP */
.actions {
    margin-top: 10px;
}

.btn {
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    margin-right: 5px;
}

/* BUTTON COLORS */
.view {
    background: #3b82f6;
    color: white;
}

.delete {
    background: #ef4444;
    color: white;
}

.view:hover {
    background: #2563eb;
}

.delete:hover {
    background: #dc2626;
}
</style>

</head>
<body>

<div class="container">

    <!-- TITLE -->
    <div class="title">Q&A Management</div>

    <!-- PENDING -->
    <div class="section-title">Pending Questions</div>

    <div class="card">
        <div class="question">What are dengue symptoms?</div>
        <div class="actions">
            <button class="btn view">View</button>
            <button class="btn delete">Delete</button>
        </div>
        <div class="status pending">Pending</div>
    </div>

    <div class="card">
        <div class="question">How to prevent flu?</div>
        <div class="actions">
            <button class="btn view">View</button>
            <button class="btn delete">Delete</button>
        </div>
        <div class="status pending">Pending</div>
    </div>

    <!-- ANSWERED -->
    <div class="section-title">Answered Questions</div>

    <div class="card">
        <div class="question">Is COVID-19 still dangerous?</div>
        <div class="actions">
            <button class="btn view">View</button>
        </div>
        <div class="status answered">Answered</div>
    </div>

</div>

</body>
</html>