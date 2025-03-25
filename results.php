<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['exam_id'])) {
    header("Location: dashboard.php");
    exit();
}

$exam_id = $_GET['exam_id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM results WHERE exam_id = ? AND user_id = ?");
$stmt->bind_param("ii", $exam_id, $user_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$total_questions = $stmt->get_result()->fetch_assoc()['total_questions'];

$score = $result['score'];
$percentage = ($score / $total_questions) * 100;

$stmt = $conn->prepare("SELECT COUNT(*) + 1 AS rank FROM results WHERE exam_id = ? AND score > ?");
$stmt->bind_param("ii", $exam_id, $score);
$stmt->execute();
$rank = $stmt->get_result()->fetch_assoc()['rank'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX - Results</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main id="main">
        <section id="results" class="results">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Exam Results</h1>
                        <p>Score: <?php echo $score; ?> / <?php echo $total_questions; ?></p>
                        <p>Percentage: <?php echo number_format($percentage, 2); ?>%</p>
                        <p>Rank: <?php echo $rank; ?></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
