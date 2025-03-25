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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $test_id = $_POST['test_id'];

    if ($action == 'delete') {
        $stmt = $conn->prepare("DELETE FROM exams WHERE id = ?");
        $stmt->bind_param("i", $test_id);
        $stmt->execute();
    } elseif ($action == 'edit') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $stmt = $conn->prepare("UPDATE exams SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $test_id);
        $stmt->execute();
    }
}

$stmt = $conn->prepare("SELECT * FROM exams");
$stmt->execute();
$tests = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX Admin - Manage Tests</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/admin-header.php'; ?>

    <main id="main">
        <section id="admin-tests" class="admin-tests">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Manage Tests</h1>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($test = $tests->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($test['id']); ?></td>
                                        <td><?php echo htmlspecialchars($test['title']); ?></td>
                                        <td><?php echo htmlspecialchars($test['description']); ?></td>
                                        <td>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                                                <input type="hidden" name="action" value="edit">
                                                <input type="text" name="title" value="<?php echo htmlspecialchars($test['title']); ?>">
                                                <input type="text" name="description" value="<?php echo htmlspecialchars($test['description']); ?>">
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </form>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
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
