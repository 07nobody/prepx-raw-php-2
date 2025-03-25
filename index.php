<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepX - Home</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main id="main">
        <section id="hero" class="d-flex align-items-center">
            <div class="container">
                <h1>Welcome to PrepX</h1>
                <h2>Your ultimate platform for exam preparation</h2>
                <a href="register.php" class="btn-get-started">Get Started</a>
            </div>
        </section>

        <section id="about" class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>About PrepX</h3>
                        <p class="fst-italic">
                            PrepX is a comprehensive online platform designed to help you prepare for your exams with ease.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> User-friendly interface</li>
                            <li><i class="bi bi-check-circle"></i> Wide range of exams</li>
                            <li><i class="bi bi-check-circle"></i> Detailed performance analysis</li>
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
