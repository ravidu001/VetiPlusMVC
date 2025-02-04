<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - User Feedback</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/feedback.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="main-container">
            <div class="header">
                <h1>User Feedback</h1>
                <div class="filter-options">
                    <button class="filter-btn active">Latest</button>
                    <button class="filter-btn">Highest Rated</button>
                    <button class="filter-btn">Most Helpful</button>
                </div>
            </div>
            <!-- Feedback Card 1 -->
    

<!-- Feedback Cards -->
<div class="feedback-container">
<?php foreach ($feedback as $feedback): ?>
        <div class="feedback-card">
            <img src="../../../public/assets/images/systemAdmin/user.png" class="user-avatar">
            <h3 class="user-name"><?= htmlspecialchars($feedback->name, ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="user-feedback"><?= htmlspecialchars($feedback->comment, ENT_QUOTES, 'UTF-8') ?></p>
            <div class="rating">
                <?php for ($i = 0; $i < $feedback->rating; $i++): ?>
                    <i class="bx bxs-star star filled"></i>
                <?php endfor; ?>
                <?php for ($i = 0; $i < 5 - $feedback->rating; $i++): ?>
                    <i class="bx bx-star star"></i>
                <?php endfor; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
            <!-- <div class="feedback-card">
                    <img src="../../../public/assets/images/common/logo.png " class="user-avatar">
                    <h3 class="user-name">Ramesh Peshala</h3>
                    <p class="user-feedback"><?= htmlspecialchars($feedback[0]->comment) ?></p>
                    <div class="rating">
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bx-star star'></i>
                    </div>
                </div> -->

            <!-- Feedback Card 2 -->
            <!-- <div class="feedback-card">
                    <img src="../../assets/images/user.png"  class="user-avatar">
                    <h3 class="user-name">Sarah Johnson</h3>
                    <p class="user-feedback">Quick and reliable service. My pets always receive top-notch care and attention.</p>
                    <div class="rating">
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                    </div>
                </div> -->

            <!-- Feedback Card 3 -->
            <!-- <div class="feedback-card">
                    <img src="../../assets/images/user.png"  class="user-avatar">
                    <h3 class="user-name">Michael Lee</h3>
                    <p class="user-feedback">Knowledgeable and caring staff. They always take the time to explain everything thoroughly.</p>
                    <div class="rating">
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bx-star star'></i>
                        <i class='bx bx-star star'></i>
                    </div>
                </div> -->

            <!-- Feedback Card 4 -->
            <!-- <div class="feedback-card">
                    <img src="../../assets/images/user.png"  class="user-avatar">
                    <h3 class="user-name">Emily Davis</h3>
                    <p class="user-feedback">The best experience I've had with a vet! Highly recommend to all pet owners.</p>
                    <div class="rating">
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                        <i class='bx bxs-star star filled'></i>
                    </div>
                </div> -->
        <!-- </div> -->
        </div>
    </section>
</body>

</html>