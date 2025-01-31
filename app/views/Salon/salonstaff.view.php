<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonstaff.css">
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/cssFiles/salon/ToolContentMainTopic.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>

    <div class="pagecontent">
            
        <div class="StaffandSidebar">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="staff-content">
                <h2 class="header-name">Staff Details</h2>
                
                <div class="content-0">
                    <button class="add" id="service-add">
                    <a href="<?=ROOT?>/SalonStaff/add">Add</a>
                    </button>
                        <?php
                            // require "../../components/common/serchbar.php";
                        ?>
                </div>

                <table class="table">

                    <thead>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Phone Number</th>
                        <th>NIC Number</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                        <?php 
                            if(isset($data) & !empty($data))
                            {
                                foreach ($data as $x)
                                {
                                    // show($data);
                                 ?>
                                    <tr>
                                    <td><p><?= htmlspecialchars($x->fullName) ?></p></td>
                                    <td>
                                        <img src="<?= htmlspecialchars($x->profilePicture) ?>" class="staff-picture">
                                    </td>
                                    <td><p><?= htmlspecialchars($x->mobileNumber) ?></p></td>
                                    <td><p><?= htmlspecialchars($x->NIC) ?></p></td>
                                    <td><p><?= htmlspecialchars($x->address) ?></p></td>
                                    <td><p><?= htmlspecialchars($x->workingType) ?></p></td>
                                    <td>
                                        <button class='edit'>
                                            <a href='<?= ROOT ?>/SalonStaff/edit/<?= htmlspecialchars($x->staffID) ?>'>Edit</a>
                                        </button>
                                        <button class='edit'>
                                            <a href='<?= ROOT ?>/SalonStaff/delete/<?= htmlspecialchars($x->staffID) ?>'>Delete</a>
                                        </button>
                                    </td>
                                </tr>

                                <?php
                                }
                            }
                        ?>

                       
                        
                    </tbody>

                </table>


            </div>
        </div>
    </div>
    

</body>
<script src="<?=ROOT?>/assets/js/nav/salonnav.js"></script>

</html>