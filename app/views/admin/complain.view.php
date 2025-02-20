<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
  <title>Complain Management</title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/complain.css">
</head>

<body>
  <?php require_once '../app/views/navbar/adminnav.php'; ?>

  <section class="home">
    <div class="main-container">
      <div class="complain-container">
        <div class="complain-header">
          <h1>Complaint Management</h1>
          <div class="search-filter">
            <input type="text" id="searchInput" placeholder="Search complaints...">
          </div>
        </div>

        <div class="complaints-grid">
          <?php foreach ($complain as $complaint): ?>
            <div class="complaint-card">
              <div class="complaint-info">
                <div class="info-group">
                  <h3>User Email</h3>
                  <p><?= htmlspecialchars($complaint->email) ?></p>
                </div>
                <div class="info-group">
                  <h3>Complaint Description</h3>
                  <p><?= htmlspecialchars($complaint->issue) ?></p>
                </div>
                <div class="info-group">
                  <h3>Date</h3>
                  <p><?= htmlspecialchars($complaint->dateTime) ?></p>
                </div>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

</body>

</html>