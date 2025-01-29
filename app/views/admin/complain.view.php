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
          <h1>Complain Management</h1>
          <div class="search-filter">
            <input type="text" placeholder="Search complaints...">
          </div>
        </div>

        <table class="complain-table">
          <thead>
            <tr>
              <th>User Name</th>
              <th>Complaint Description</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John Doe</td>
              <td>Service quality not meeting expectations</td>
              <td>2023-06-15</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist"  class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <tr>
              <td>Sarah Smith</td>
              <td>Delayed response from customer support</td>
              <td>2023-06-14</td>
              <td>
                <a  href="<?= ROOT ?>/AdminComplain/complainlist" class="action-btn">View Details</a>
              </td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
<!-- 
        <div class="pagination">
          <button>Previous</button>
          <button class="active">1</button>
          <button>2</button>
          <button>3</button>
          <button>Next</button>
        </div> -->
      </div>
    </div>
  </section>
</body>

</html>