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

$stmt = $conn->prepare("SELECT COUNT(*) AS user_count FROM users");
$stmt->execute();
$user_count = $stmt->get_result()->fetch_assoc()['user_count'];

$stmt = $conn->prepare("SELECT COUNT(*) AS test_count FROM exams");
$stmt->execute();
$test_count = $stmt->get_result()->fetch_assoc()['test_count'];

$stmt = $conn->prepare("SELECT COUNT(*) AS result_count FROM results");
$stmt->execute();
$result_count = $stmt->get_result()->fetch_assoc()['result_count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX Admin - Dashboard</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/admin-header.php'; ?>

    <main id="main">
        <section id="admin-dashboard" class="admin-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Welcome, <?php echo htmlspecialchars($admin['name']); ?></h1>
                        <p>Here is the summary of the platform:</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <p class="card-text"><?php echo $user_count; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tests</h5>
                                        <p class="card-text"><?php echo $test_count; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Results</h5>
                                        <p class="card-text"><?php echo $result_count; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/admin-footer.php'; ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
