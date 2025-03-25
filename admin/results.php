<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT results.id, users.name AS user_name, exams.title AS exam_title, results.score FROM results JOIN users ON results.user_id = users.id JOIN exams ON results.exam_id = exams.id");
$stmt->execute();
$results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX Admin - View Results</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/admin-header.php'; ?>

    <main id="main">
        <section id="admin-results" class="admin-results">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>View Results</h1>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Exam</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($result = $results->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($result['id']); ?></td>
                                        <td><?php echo htmlspecialchars($result['user_name']); ?></td>
                                        <td><?php echo htmlspecialchars($result['exam_title']); ?></td>
                                        <td><?php echo htmlspecialchars($result['score']); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/admin-footer.php'; ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
