<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Dashboard</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet">
    
    </head>

    <body>
            <script>
                console.log(<?= json_encode($this->petCount) ?>);
                console.log(<?= json_encode($this->po_details) ?>);
            </script>
            
        <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?>

        <!-- actual content: -->
        <div class="bodyArea">
            <h1 class="bodyHeader">Welcome!</h1>

            <div class="card horizCard">

                <?php if (!empty($this->po_details->profilePicture)): ?>
                    <img class="profilePic" src="<?= ROOT.'/assets/images/petOwner/profilePictures/po_user/'.$this->po_details->profilePicture?>"
                        alt="Profile picture.">
                <?php else: ?>
                    <img class="profilePic" src="<?= ROOT.'/assets/images/petOwner/profilePictures/po_user/noPicuser.png' ?>"
                        alt="No Profile picture added.">
                <?php endif; ?>
                <span>
                    <h3>Welcome back!</h3>
                    <p><?= $this->po_details->fullName ?></p>
                </span>

            </div>

            <section id="myPets" class="dashArea">
                <h2 class="dashHeader">My Pets</h2>

                <div class="tallCard-container pets-container"></div>
                <template class="petCard-template">
                    <a href="" title="Go to Pet Profile Page." class="card tallCard petCard">
                        <img src="" class='profilePicture' alt='Pet Image'>
                        <h3 class="name"></h3>
                    </a>
                </template>
                <template class="registerPet-template">
                    <a href="po_petRegister" title="Go to Pet Profile Page." class="card tallCard petCard">
                        <p><i class="bx bxs-plus-circle bx-lg"></i></p>
                        <p>Register pet</p>
                    </a>
                </template>

                <!-- <div class="dashContent">
                    <?php
                        if($this->pet_details) :
                            foreach ($this->pet_details as $pet) : ?>
                                <a href="po_petProfile?petID=<?= $pet->petID ?>" title="Go to Pet Profile Page." class="card tallCard">
                                    <img src='<?= ROOT."/assets/images/petOwner/profilePics/pet/".$pet->profilePicture ?>' class='petImg' alt='Pet Image'>
                                    <h3><?= $pet->name ?></h3>
                                </a>
                            <?php endforeach;
                        else: ?>
                            <div class="card horizCard">
                                <h3>No Pets<br/>added yet!</h3>
                            </div>
                        <?php endif;
                    ?>
                    <a class="card dashCard" href="./po_petRegister">
                        <i class="bx bxs-plus-circle bx-lg"></i>
                        <h3>Add Pet</h3>
                    </a>                   
                </div> -->

            </section>
        
        
                <section id="upcomingAppointments" class="dashArea">  
                    <h2 class="dashHeader">Upcoming Appointments</h2>
                    
                    <div class="appointments-container scrollAppointments">
                        <?php for ($i=0; $i<2; $i++) :?>
                            <div class="appointmentCard">
                                <img src="<?= ROOT.'/assets/images/petOwner/serviceIcons/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
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
                                <img src="<?= ROOT.'/assets/images/petOwner/serviceIcons/vetIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
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

            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

        </div>
        <script>
            const cardTemplate = document.querySelector('.petCard-template');
            const petsContainer = document.querySelector('.pets-container');

            fetch('PO_home/getPets')
            .then(result => result.json())
            .then(data => {
                // if no pets found, no need for mapping:
                if (data.petCount == 0) return;

                data.map(pet => {
                    const card = cardTemplate.content.cloneNode(true).children[0];
                
                    card.setAttribute('href', `po_petProfile?petID=${pet.petID}`)
                    card.querySelector('.profilePicture').src = 
                        `<?=ROOT.'/assets/images/petOwner/profilePictures/pet/' ?>${pet.profilePicture}`;
                    card.querySelector('.name').textContent = pet.name;

                    petsContainer.append(card)
                })
            })
            .finally(() => {
                const regCardTemplate = document.querySelector('.registerPet-template');
                const regCard = regCardTemplate.content.cloneNode(true).children[0];
                petsContainer.append(regCard);
            })

        </script>
    </body>
</html>
