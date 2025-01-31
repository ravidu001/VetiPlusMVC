<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback And Reviews</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonfeedback.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="pagecontent">
        <div class="feedbackcontent">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="feedbackdetail">
                <h3>Feedback and Reviews</h3>
                <p>You may have 1000 more customer today, and your business may make up to 20 more public comments.</p>
                <div class="tablecontent">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="userdetail">
                                            <img class="image" src="assets/images/salon/profile/boy.jpg" alt="userimage">
                                        <h4>Abdul Raheam Senanayaka</h4>
                                    </div>
                                </td>
                                <td class="discript">
                                  <div class="star">    
                                        <?php 
                                            $stars = 3 ;
                                            $totalstars = 5;

                                            for($i =  1 ; $i <= $totalstars; $i++ )
                                            {
                                                if($i <= $stars)
                                                {
                                                    ?>
                                                        <i class='bx bxs-star icon'></i>      
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <i class='bx bx-star icon' ></i>
                                                    <?php
                                                }
                                            }

                                        ?>
                                        <p>11/27/2021</p>
                                    </div>

                                    <p class="description">
                                    <!-- "I recently took my dog, Bella, to Pampered Paws Salon, 
                                    and I couldn't be happier with the service! From the 
                                    moment we walked in, the staff was welcoming and made 
                                    Bella feel at ease. The salon is spotless, with a fresh 
                                    and calming atmosphere that even nervous pets would 
                                    feel comfortable in.
                                    The groomer, Alex, took the time to ask about Bella's grooming 
                                    needs and preferences. They even offered suggestions for her 
                                    coat care based on her breed. The grooming was top-notch; 
                                    Bella's coat was shiny and soft, her nails were perfectly trimmed, 
                                    and she even got a cute little bow that made her look adorable!
                                    I appreciated how well the salon communicated—confirming our 
                                    appointment and sending a reminder on the day. The booking process 
                                    was smooth, and they were accommodating with times that fit my schedule. 
                                    I also loved that they used gentle, pet-friendly products. Bella looked 
                                    fantastic and seemed happy and relaxed afterward.
                                 -->
                                    </p>
                                </td>
                                <td>
                            <form method="post" action="">
                                    <!-- check the reply is send or not!-->
                                    <?php
                                    //if (isset($data['reply_success']) && $feedback['id'] === $_POST['feedback_id'])
                                        if(isset($data['success']))
                                        {
                                            ?>
                                                <p class="description">
                                                    <?= htmlspecialchars($data['success']); ?>
                                                </p>
                                            <?php
                                        }
                                        else{
                                            ?>
                                                <textarea name="reply">Thank you so much !
                                                </textarea>
                                                <button class="reply" name="send">
                                                    Send
                                                </button> 
                                            <?php
                                        }
                                        ?>    
                                </td>
                            </form>     
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?=ROOT?>/assets/js/navbar/salonnavbarbar.js"></script>
</html>