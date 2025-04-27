<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Request Declined</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/register/rejected.css">

</head>
<body>
    <div class="decline-container">
        <div class="decline-icon">🚫</div>
        <h2 class="decline-title">Registration Declined</h2>
        <p class="decline-subtitle">
            We apologize, but your registration request could not be processed at this time.
        </p>

        <div class="details-card">
            <div class="details-title">Potential Reasons</div>
            <ul class="details-list">
                <!-- <li>Incomplete application details</li>
                <li>Verification documents not meeting requirements</li>
                <li>Inconsistent or unclear information provided</li>
                <li>Additional review needed</li> -->
                <?php
                if (isset($doctorDetails->rejectReason)) {
                    $reasons = explode(',', $doctorDetails->rejectReason);
                    foreach ($reasons as $reason) {
                        echo "<li>" . htmlspecialchars(trim($reason)) . "</li>";
                    }
                } elseif($salonDetails->rejectReason){
                    $reasons = explode(',', $salonDetails->rejectReason);
                    foreach ($reasons as $reason) {
                        echo "<li>" . htmlspecialchars(trim($reason)) . "</li>";
                    }
                } else {
                    echo "<li>No specific reason provided.</li>";
                }
                ?>
            </ul>
        </div>
        <?php if (isset($doctorDetails->approvedStatus) && $doctorDetails->approvedStatus == 'rejected'): ?>
            <button class="action-btn" name="reapply" type="submit">
                <a href="<?= ROOT ?>/doctorregistration/errorUpdate?doctorID=<?= urlencode($doctorDetails->doctorID) ?>" class="action-btn">Reapply</a>
            </button>
        <?php elseif (isset($salonDetails->approvedStatus) && $salonDetails->approvedStatus == 'rejected'): ?>
            <button class="action-btn" name="reapply" type="submit">
                <a href="<?=ROOT?>/SalonRegister/errorUpdate?salonID=<?= urlencode($salonDetails->salonID) ?>" class="action-btn">Reapply</a>
            </button>
        <?php endif; ?>

        <p class="support-text">
            Need help? Contact our support team at support@vetiplus.com
        </p>
    </div>

</body>
</html>