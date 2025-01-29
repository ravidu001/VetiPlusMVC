<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Dashboard</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/styles.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/navBar.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/myFooter.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/dashboard.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet">
    
    </head>

    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/petOwnerNav.php'; ?>

        <!-- actual content: -->
        <div class="dashContent">

            <section id="myProfile" class="dashArea">
                <h2>My Profile</h2>
                <div id="myProfile_content" class="dashAreaContent" style="justify-content: space-evenly;">
                    <?php
                        // $stmt = $con->prepare("SELECT * FROM petOwner WHERE petOwnerID = ?");
                        // $stmt->bind_param("s", $userID);
                        // $stmt->execute();                  
                        // $profileDetails = $stmt->get_result()->fetch_assoc();
                        
                        // $stmt->close();
                        // if (!empty($profileDetails['profilePicture'])):
                        
                    ?>
                    <!-- <img src="<?= ROOT.'/assets/images/profilePics/petOwner/'.$profileDetails['profilePicture']?>"
                        alt="Profile picture."> -->
                    <?php //else: ?>
                        <p>Add a profile picture.</p>
                    <?php //endif; ?>
                    <div class="textContent">
                        <h3>Welcome back!</h3>
                        <!-- <p><?= $profileDetails['fullName'] ?></p> -->
                    </div>
                </div>
            </section>
    
            <section id="myPets" class="dashArea">
                <h2>My Pets</h2>
                <div class="dashAreaContent">
                    <!-- <?php
                        // $stmt = $con->prepare("SELECT petID, name, profilePicture FROM pet WHERE petOwnerID = ?");
                        // $stmt->bind_param("s", $userID);
                        // $stmt->execute();
                        // $result = $stmt->get_result();
                        // $stmt->close();

                        // if($result->num_rows > 0) :
                        //     $data = $result->fetch_all(MYSQLI_ASSOC);
                        //     foreach ($data as $k => $pet) : ?>
                                <!-- <form action='./petProfile.php' method='post' class='petCard' onclick='this.submit()' title='Go to Pet Profile Page.'>
                                    <input type='text' name='petID' id='petID' value='<?= $pet['petID'] ?>' hidden>
                                    <img src='<?= ROOT."/assets/images/profilePics/pet/".$pet['profilePicture'] ?>' class='petImg' alt='Pet Image'>
                                    <h3><?= $pet['name'] ?></h3>
                                </form> -->
                            <?php //endforeach;
                        //else: ?>
                            <div class="petCard">
                                <h3>No Pets<br/>added yet!</h3>
                            </div>
                        <?php //endif;
                    ?>
                    <a class="petCard" href="./petRegister.php">
                        <i class="bx bxs-plus-circle bx-lg"></i>
                        <h3>Add Pet</h3>
                    </a>                   
                </div>
            </section>
    
            <section id="upcomingAppointments" class="dashArea">  
                <h2>Upcoming Appointments</h2>
                <div class="appointments-container scrollAppointments">
                    <?php for ($i=0; $i<2; $i++) :?>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Bingo</h3>
                                <span>Full Bath - Mr.Perera</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.12.2024 | 6:00PM</h4>
                            </div>
                            <div class="appintmentOptions">
                                <button><i class="bx bxs-edit bx-md"></i> Edit</button>
                                <button><i class="bx bxs-calendar-edit bx-md"></i> Reschedule</button>
                            </div>
                        </div>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/vetIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Bingo</h3>
                                <span>Monthly Check-up</span>
                                <span><b>Dr. Rajapakse</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.12.2024 | 6:00PM</h4>
                            </div>
                            <div class="appintmentOptions">
                                <button><i class="bx bxs-edit bx-md"></i> Edit</button>
                                <button><i class="bx bxs-calendar-edit bx-md"></i> Reschedule</button>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        </div>
        <script>
            
        </script>

        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

    </body>
</html>
