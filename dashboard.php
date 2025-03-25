<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM exams");
$stmt->execute();
$exams = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX - Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main id="main">
        <section id="dashboard" class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
                        <p>Here are the available exams:</p>
                        <ul>
                            <?php while ($exam = $exams->fetch_assoc()) { ?>
                                <li>
                                    <a href="start-test.php?exam_id=<?php echo $exam['id']; ?>">
                                        <?php echo htmlspecialchars($exam['title']); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
