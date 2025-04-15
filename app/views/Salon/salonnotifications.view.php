<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #7e57c2;
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --accent-color: #ff4081;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: var(--text-color);
        }

        .pagecontent {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 28px;
        }

        .dashboard-icon {
            position: relative;
            margin-right: 10px;
        }

        .dashboard-icon .icon {
            font-size: 24px;
            color: var(--primary-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .notifications {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .notification-tabs {
            display: flex;
            border-bottom: 1px solid #eee;
        }

        .tab {
            padding: 15px 20px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            text-align: center;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }

        .upcoming {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .upcoming:hover {
            background-color: #f9f9ff;
        }

        .upcoming .Date {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .upcomingdetails {
            padding: 15px;
            background-color: var(--secondary-color);
            border-radius: var(--border-radius);
            margin-bottom: 10px;
        }

        .upcomingdetails p {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .upcomingdetails p:last-child {
            margin-bottom: 0;
        }

        .upcomingdetails i {
            margin-right: 10px;
            color: var(--primary-color);
            width: 20px;
        }

        .expireDate {
            font-size: 12px;
            color: #888;
            text-align: right;
        }

        .no-notifications {
            padding: 40px 20px;
            text-align: center;
            color: #999;
        }

        .filled-notification .upcomingdetails {
            background-color: #f0f7ff;
            border-left: 4px solid var(--primary-color);
        }

        @media (max-width: 600px) {
            .pagecontent {
                padding: 10px;
                margin: 20px auto;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="pagecontent">
        <div class="header">
            <h1>Notifications</h1>
            <div class="dashboard-icon" id="icon">
                <a href="<?=ROOT?>/Salon">
                    <i class="fa-solid fa-circle-xmark pageclose"></i>
                </a>
            </div>
        </div>

        <div class="notifications">
           <?php
                // if(!empty($data['upcoming']))
                // {
                //     $results = $data['upcoming'];

                //     foreach($results as $notify)
                //     {
                //         ?>
                             <!-- Notification 1 -->
                <!-- //             <div class="upcoming filled-notification">
                //                 <p class="Date"><i class="fas fa-calendar-alt"></i> <?= date('F j, Y, g:i A', strtotime($notify['BookingDateTime'])) ?></p>
                //                 <div class="upcomingdetails">
                //                     <p class="Name"><i class="fas fa-user"></i> Name: <?= $notify['ownername'] ?></p>
                //                     <p class="Service"><i class="fas fa-cut"></i> Service:  <?= $notify['service'] ?></p>
                //                     <p class="Slot"><i class="fas fa-clock"></i> Slot Period: <?= $notify['slot'] ?></p>
                //                     <p class="SlotDate"><i class="fas fa-calendar-check"></i> Slot Date: <?= $notify['period'] ?></p>
                //                 </div>
                //                 <p class="expireDate">Appointment in <?= $notify['minutesLeft'] ?> minute<?= $notify['minutesLeft'] != 1 ? 's' : '' ?></p>
                //             </div> -->
                        <?php
                //     }
                // }
                // else
                {
                    // ?>
                         <!-- Empty state notification -->
                    <!-- //     <div class="upcoming">
                    //         <p class="Date"><i class="fas fa-calendar-alt"></i> <?= date('Y-m-d') ?></p>
                    //         <div class="upcomingdetails">
                    //             <p class="Name"><i class="fas fa-user"></i> Name: - </p>
                    //             <p class="Service"><i class="fas fa-concierge-bell"></i> Service: - </p>
                    //             <p class="Slot"><i class="fas fa-clock"></i> Slot Period: - </p>
                    //             <p class="SlotDate"><i class="fas fa-calendar-check"></i> Slot Date: - </p>
                    //         </div>
                    //         <p class="expireDate">Available slot</p>
                    //     </div> -->
                     <?php
                }
           ?>
           

           
        </div>
    </div>
</body>
<script>
    const BASE_URL = "<?= ROOT ?>";
</script>
    <script src="<?=ROOT?>/assets/js/salon/notifications.js"></script>
</html>