<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salon Time Slots</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslotedit.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
  <body>
  <?= $notification->display(); ?>
    <?php
        if (!empty($data['error']) && is_string($data['error'])) {
          echo "<script>alert('". addslashes($data['error']) ."');</script>";
        }
    ?>

    <div class="container">
        <h1>Salon Time Slot Configuration</h1>
        <a href="<?=ROOT?>/SalonSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
        <form action="<?=ROOT?>/SalonSlotCreate" method="post">
          <div class="slots">
            <label>Time Duration per Slot (minutes):
              <select name="duration" required>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="60">60</option>
              </select>
            </label>
            <label>Appointments per Slot:
              <input type="number" name="appointments" min="1" required />
            </label>
          </div>

          <div class="options">
            <p>Create time slots for:</p>
            <label><input type="radio" name="period" value="week" required /> Per Week</label>
            <label><input type="radio" name="period" value="month" /> Per Month</label>
          </div>

          <div class="startDate">
            <p>Slot Start Date:</p>
            <labe>
              <?php 
                $today = date('Y-m-d'); 
              ?>
              <input type="date" name="startDate" value="<?= $today ?>" min="<?= $today ?>">
            </label>
          </div>

          <table>
            <thead>
              <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>Close Time</th>
                <th>Closed</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                  $timeSlots = [];
                  for ($hour = 0; $hour < 24; $hour++) {
                    $timeSlots[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
                    $timeSlots[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':30';
                  }

                  foreach ($days as $day) {
                    echo '<tr>';
                    echo "<td>" . ucfirst($day) . "<input type='hidden' value='$day' name='$day'></td>";
                    echo "<td><select name='start_$day' class='time-select'>";
                    foreach ($timeSlots as $time) {
                      echo "<option value='$time'>$time</option>";
                    }
                    echo "</select></td>";
                    echo "<td><select name='close_$day' class='time-select'>";
                    foreach ($timeSlots as $time) {
                      echo "<option value='$time'>$time</option>";
                    }
                    echo "</select></td>";
                    echo "<td><input type='checkbox' name='closed_$day' class='closed-checkbox'></td>";
                    echo '</tr>';
                  }
              ?>
            </tbody>
          </table>

          
          <div class="submit-btn">
            <button type="submit" name="postdata">Generate Time Slots</button>
          </div>
      </form>
    </div>

  </body>
</html>
