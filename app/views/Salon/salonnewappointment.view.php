<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonnewappointment.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
</head>
<body>
   <div class="pagecontent">
        <div class="sidebarandappointmentcontent">
                <div>
                    <?php
                        include __DIR__ . '/../navbar/salonnav.php';
                    ?>
                </div>
                <div class="appointmentcontent">
                <div class="calendarpart">
                    

                    <div class="calendar">
                        <?php
                            require __DIR__ .'/saloncalander.view.php';
                        ?>
                    </div>
                </div>
                <div class="appointmentdetailpart">
                    <div class="upcomingappointmentdetails">
                        <h3>Upcoming Appointments</h3>
                            <div class="userdetail">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Time Slot</th>
                                            <th>User</th>
                                            <th>Service</th>
                                            <th>Contact Number</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>6.00 a.m - 6.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Mark Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6.30 a.m - 7.00 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Mark Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7.00 a.m - 7.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Mark Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8.00 a.m - 8.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9.00 a.m - 9.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.00 a.m - 10.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11.00 a.m - 11.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Mark Completed</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12.00 a.m - 12.30 a.m</td>
                                            <td>
                                                <div class="user">
                                                    <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                    Abdual Rahim Vijepala
                                                </div>
                                            </td>
                                            <td>Pet Bathing</td>
                                            <td>0776533229</td>
                                            <td>
                                                <button class="ok">Completed</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
    </div>
   
    
</body>
    <script src="<?=ROOT?>/assets/js/navbar/salonnav.js"></script>
</html>