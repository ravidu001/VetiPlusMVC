<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salondashboard.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet"> -->

</header>
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>

<div class="pagecontent">
    <div class="dashbardheader">
        <!-- <h3>Dashboard</h3> -->
        <div class="profile">
            <!-- <img class="profile" src="../../assets/images/salon/girl.jpg" alt="profile.php"> -->
            <p>Owner :</p>
            <p class="name">Pabodya Nethsarani</p>
        </div>
        <div class="icon">
            <i class="fa-regular fa-bell icon"></i>
        </div>
        
    </div>

    <div style="display: flex; margin-left:1%">

        <div class="calander">
                    <?php
                        require __DIR__ .'/salonoverviewchart.view.php';  
                    ?> 
        </div>

        <div class="dashcontent">
            
            

            <div class="part1">
                <div class="overview">
                </div>
                <div class="calendar">
                
                    <?php
                        require __DIR__ .'/saloncalander.view.php'; 
                    ?> 
                </div>
            </div>

            <div class="part2">
                <div class="part2header">
                    <p>
                        Upcoming Appointments
                    </p>
                </div>

              
                <div class="upcominappointments">
                    <p class="realtime">8.30 a.m </p>
                        <div class="appointmentbox">
                            <div class="image">
                                <!-- <img class="image" src="../../assets/images/salon/boy.jpg" alt="boy">
                                <img class="petimage" src="../../assets/images/White Playful Pet Shop Logo.png"> -->
                            </div>
                            <div class="userdetails">
                                <p class=" username">Abdul Rahim</p><br>
                                <i class="fa-solid fa-paw icon" ><p class="servicename">Pet Bathing</p></i><br>
                                <p class="number">077-5369984</p><br>
                                <p class="time"><b>9.30a.m - 10.30p.m</b></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
    
    
</div>
