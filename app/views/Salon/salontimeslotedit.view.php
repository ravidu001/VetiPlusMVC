<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Time Period Edit</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslotedit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="content">
        <a href="<?=ROOT?>/SalonTimeSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
        <h2 class="topic">Edit Details</h2>
        <form action="<?= ROOT?>/SalonTimeSlotEdit" method="POST">
            <div class="schedule-grid">
                        <div class="day-schedule">
                            <h4>Open Time</h4>
                            <select name="openTime">
                                <option value="0.00">00:00</option>
                                <option value="1.00">01:00</option>
                                <option value="2.00">02:00</option>
                                <option value="3.00">03:00</option>
                                <option value="4.00">04:00</option>
                                <option value="5.00">05:00</option>
                                <option value="6.00">06:00</option>
                                <option value="7.00">07:00</option>
                                <option value="8.00">08:00</option>
                                <option value="9.00">09:00</option>
                                <option value="10.00">10:00</option>
                                <option value="11.00">11:00</option>
                                <option value="12.00">12:00</option>
                                <option value="13.00">13:00</option>
                                <option value="14.00">14:00</option>
                                <option value="15.00">15:00</option>
                                <option value="16.00">16:00</option>
                                <option value="17.00">17:00</option>
                                <option value="18.00">18:00</option>
                                <option value="19.00">19:00</option>
                                <option value="20.00">20:00</option>
                                <option value="21.00">21:00</option>
                                <option value="22.00">22:00</option>
                                <option value="23.00">23:00</option>
                                <option value="24.00">24:00</option>
                            </select>
                        </div>
                        <div class="day-schedule">
                            <h4>Close Time</h4>
                            <select name="closeTime">
                                <option value="0.00">00:00</option>
                                <option value="1.00">01:00</option>
                                <option value="2.00">02:00</option>
                                <option value="3.00">03:00</option>
                                <option value="4.00">04:00</option>
                                <option value="5.00">05:00</option>
                                <option value="6.00">06:00</option>
                                <option value="7.00">07:00</option>
                                <option value="8.00">08:00</option>
                                <option value="9.00">09:00</option>
                                <option value="10.00">10:00</option>
                                <option value="11.00">11:00</option>
                                <option value="12.00">12:00</option>
                                <option value="13.00">13:00</option>
                                <option value="14.00">14:00</option>
                                <option value="15.00">15:00</option>
                                <option value="16.00">16:00</option>
                                <option value="17.00">17:00</option>
                                <option value="18.00">18:00</option>
                                <option value="19.00">19:00</option>
                                <option value="20.00">20:00</option>
                                <option value="21.00">21:00</option>
                                <option value="22.00">22:00</option>
                                <option value="23.00">23:00</option>
                                <option value="24.00">24:00</option>
                            </select>
                        </div>
                        <div class="day-schedule">
                            <h4>Time duration for the Slot(min)</h4>
                            <select name="slotDuration">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                                <option value="110">110</option>
                                <option value="120">120</option>
                            </select>
                        </div>
                    <button type="submit" name="save">Save</button>    
            </div>
                
        </form>
    </div>
</body>
</html>