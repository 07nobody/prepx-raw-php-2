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

$stmt = $conn->prepare("SELECT * FROM exams WHERE id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$exam = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM questions WHERE exam_id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$questions = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX - Start Test</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        let timer;
        let timeLeft = <?php echo $exam['duration']; ?> * 60;

        function startTimer() {
            timer = setInterval(function() {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById("test-form").submit();
                } else {
                    timeLeft--;
                    let minutes = Math.floor(timeLeft / 60);
                    let seconds = timeLeft % 60;
                    document.getElementById("timer").innerHTML = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
                }
            }, 1000);
        }

        window.onload = function() {
            startTimer();
        }
    </script>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main id="main">
        <section id="start-test" class="start-test">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1><?php echo htmlspecialchars($exam['title']); ?></h1>
                        <p>Time left: <span id="timer"></span></p>
                        <form id="test-form" method="POST" action="submit-test.php">
                            <?php while ($question = $questions->fetch_assoc()) { ?>
                                <div class="mb-3">
                                    <label><?php echo htmlspecialchars($question['question']); ?></label>
                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[<?php echo $question['id']; ?>]" value="<?php echo $i; ?>" required>
                                            <label class="form-check-label">
                                                <?php echo htmlspecialchars($question['option' . $i]); ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
