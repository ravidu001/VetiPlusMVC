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
            </div>
    


<div class="feedback-container">
    <?php if (!empty($feedback)): ?>
        <?php foreach ($feedback as $feedback_item): ?>
            <div class="feedback-card">
                <img src="<?= ROOT ?>/assets/images/systemAdmin/user.png" class="user-avatar" alt="profile picture">
                <h3 class="user-name"><?= htmlspecialchars($feedback_item->name, ENT_QUOTES, 'UTF-8') ?></h3>
                <p class="user-feedback"><?= htmlspecialchars($feedback_item->comment, ENT_QUOTES, 'UTF-8') ?></p>
                <p class="user-name" style="color:black; font-size=14px;"><?= htmlspecialchars($feedback_item->contactNumber, ENT_QUOTES, 'UTF-8') ?></p>
                
                <div class="rating">
                    <?php for ($i = 0; $i < $feedback_item->rating; $i++): ?>
                        <i class="bx bxs-star star filled"></i>
                    <?php endfor; ?>
                    <?php for ($i = 0; $i < 5 - $feedback_item->rating; $i++): ?>
                        <i class="bx bx-star star"></i>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No feedback available.</p>
    <?php endif; ?>
</div>

        </div>
    </section>
</body>

</html>