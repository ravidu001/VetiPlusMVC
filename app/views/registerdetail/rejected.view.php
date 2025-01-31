<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Request Declined</title>
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
                <li>Incomplete application details</li>
                <li>Verification documents not meeting requirements</li>
                <li>Inconsistent or unclear information provided</li>
                <li>Additional review needed</li>
            </ul>
        </div>

        <form method="POST" action="<?=ROOT?>/SalonRegister">
            <button class="action-btn" name="reapply" type="submit">
                Reapply
            </button>
        </form>
        

        <p class="support-text">
            Need help? Contact our support team at support@company.com
        </p>
    </div>

</body>
</html>