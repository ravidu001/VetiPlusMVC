<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/appointmentlist.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <section class="home">
    <div class="appointment-list">
            <div class="container">
                <table>
                  <thead>
                    <tr>
                      <th>Appointment ID</th>
                      <th>Pet Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Doctor Name</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="accept">Accept</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="accept">Accept</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="accept">Accept</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="accept">Accept</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="cancel">Cancel</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="accept">Accept</button></td>
                    </tr>
                    <tr>
                      <td>220022</td>
                      <td>Jemy</td>
                      <td>2024/04/07</td>
                      <td>3.00pm</td>
                      <td>Ravindu Piris</td>
                      <td><button class="cancel">Cancel</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
    </section>
</body>
</html>