<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Salon Scheduler</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslot.css">
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/Enterdatebox.css"> -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonavailabletime.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
        <div class="pagecontent">
                <div>
                    <?php
                         include __DIR__ . '/../navbar/salonnav.php';
                    ?>
                </div>
                <div class="SelectDateAndSlot">
                    <h1>Pet Salon Schedule</h1>
                    <div class="DateAndScedule">
                        <div class="DateContent">
                            <div style="display: flex;">  
                                <div class="SelectDate">
                                <div class="selectdatebox">
                                    <div class="selectdateboxname">
                                            Enter Date 
                                        </div>
                                        <div class="enterdate">
                                            <input type="date" class="selectdate">
                                        </div>
                                    </div>
                                    <div class="legend">
                                        <div class="legendcontent">
                                            <div class="legend-item">
                                                <div class="color-box available"></div>
                                                <span>Available</span>
                                            </div>
                                            <div class="legend-item">
                                                <div class="color-box booked"></div>
                                                <span>Booked</span>
                                            </div>
                                            <div class="legend-item">
                                                <div class="color-box blocked"></div>
                                                <span>Blocked</span>
                                            </div>
                                        </div>    

                                            <div class="time-slots">
                                    <!-- Morning slots -->
                                    <div class="time-slot available">
                                        <div class="time-slot-time">9:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">9:30 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot booked">
                                        <div class="time-slot-time">10:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon booked"></span>
                                            Booked
                                        </div>
                                    </div>

                                    <div class="time-slot blocked">
                                        <div class="time-slot-time">10:30 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon blocked"></span>
                                            Blocked
                                        </div>
                                    </div>

                                    <div class="time-slot available locked">
                                        <div class="time-slot-time">11:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                        <div class="locked-message">Locked (within 2 hours)</div>
                                    </div>

                                    <!-- Add more time slots as needed -->
                                    <div class="time-slot available">
                                        <div class="time-slot-time">11:30 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">12:00 PM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">12:30 PM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">1:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">1:30 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">2:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">2:30 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot available">
                                        <div class="time-slot-time">3:00 AM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                            Available
                                        </div>
                                    </div>

                                    <div class="time-slot booked">
                                        <div class="time-slot-time">3:30 PM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon booked"></span>
                                            Booked
                                        </div>
                                    </div>

                                    <div class="time-slot blocked">
                                        <div class="time-slot-time">4:00 PM</div>
                                        <div class="time-slot-status">
                                            <span class="status-icon blocked"></span>
                                            Blocked
                                        </div>
                                    </div>
                            
                                </div>

                                        </div>
                                    </div>

                                <div>
                                <div class="container">
                                   
                                    <h2>Time Details</h2>
                                    <div class="times">
                                        <h4 class="opentime">
                                            Salon Open Time :-
                                        </h4>
                                        <p>
                                            10.00 AM
                                        </p>
                                        <h4 class="closetime">
                                            Salon Close Time :-
                                        </h4>
                                        <p>
                                            12.00 AM
                                        </p>
                                        <h4 class="closetime">
                                            Time duration :-
                                        </h4>
                                        <p>
                                            20 min
                                        </p>

                                        <h3>Closing Dates(For a Month)</h3>
                                        <div class="closedates">
                                            <h5 class="date">2025 Jan 25</h5>
                                        </div>
                                        <button class="edit-btn" style="margin-right:20px">
                                            <a href='<?= ROOT ?>/SalonOneTimeAllocation'>
                                                Edit
                                            </a>
                                        </button>
                                    </div>

                                    <div id="saveSection" style="display:none; margin-top: 15px;">
                                        <button class="save-btn" onclick="saveChanges()">Save Changes</button>
                                        <button class="cancel-btn" onclick="cancelEdit()">Cancel</button>
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <!-- <div class="TimeSlotShedule"> -->
                            <!-- <div class="container"> -->
                                    
                                
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>    
                </div>
        </div>
</body>
    <script src="<?=ROOT?>/assets/js/salon/salonavailabletime.js"></script>
</html>