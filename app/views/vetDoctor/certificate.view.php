<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Medical Certificate</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a0dad;
            --background-light: #f4f4f8;
            --text-dark: #333;
            --text-light: #6e6e6e;
            --white: #ffffff;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .certificate {
            width: 1100px;
            height: 800px;
            background-image: url('https://png.pngtree.com/png-clipart/20240103/original/pngtree-certificate-border-frame-with-pastel-color-paw-animal-footstep-pattern-vector-png-image_14006861.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .certificate-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* backdrop-filter: blur(1px); */
            display: flex;
            flex-direction: column;
            padding: 50px;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .certificate-header h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .certificate-body {
            display: flex;
            justify-content: space-between;
            flex-grow: 1;
        }

        .section {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 25px;
            width: 48%;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border: 2px solid var(--primary-color);
        }

        .section h2 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .section-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background-color: var(--background-light);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .section-item:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .section-item span {
            color: var(--text-light);
            font-weight: 500;
        }

        .section-item strong {
            color: var(--text-dark);
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
        }

        .signature {
            text-align: center;
        }

        .veterinary-details {
            text-align: right;
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .certificate {
                width: 100%;
                height: auto;
                min-height: 800px;
            }
            .certificate-body {
                flex-direction: column;
            }
            .section {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
<?php echo $notification->display(); ?>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
    <?php if ($_SESSION['petOwnerID'] == 'Pet Owner') : ?>
        <div style="margin: 20px; display: flex; justify-content: center;">
            <a href="<?= ROOT ?>/" class="btn btn-primary" style="margin: 20px; font-size: 2rem; align-items: center; display: flex; justify-content: center;">
                <i class="ri-arrow-left-circle-line"></i>
            </a>
        </div>
    <?php endif; ?>
    <div class="certificate">
        <div class="certificate-overlay">
            <!-- <div class="veterinary-details">
                <strong>PetCare Veterinary Clinic</strong><br>
                123 Pawsome Street<br>
                Cityville, State 12345<br>
                📞 (555) 123-4567
            </div> -->

            <div class="certificate-header">
                <h1>Pet Medical Certificate</h1>
                <p>Official Health Examination Report</p>
            </div>

            <div class="certificate-body">
                <div class="section">
                    <h2>Pet Information</h2>
                    <div class="section-item">
                        <span>Name:</span>
                        <strong><?= !empty($petData->name) ? htmlspecialchars($petData->name, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Species:</span>
                        <strong><?= !empty($petData->species) ? htmlspecialchars($petData->species, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Breed:</span>
                        <strong><?= !empty($petData->breed) ? htmlspecialchars($petData->breed, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Age:</span>
                        <strong><?= !empty($age) ? htmlspecialchars($age, ENT_QUOTES, 'UTF-8') : "No data available"; ?> Years</strong>
                    </div>
                    <div class="section-item">
                        <span>Gender:</span>
                        <strong><?= !empty($petData->gender) ? htmlspecialchars($petData->gender, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                </div>

                <div class="section">
                    <h2>Medical Assessment</h2>
                    <div class="section-item">
                        <span>Overall Health:</span>
                        <strong><?= !empty($certificateData[0]->healthRate) ? htmlspecialchars($certificateData[0]->healthRate, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Vaccination Status:</span>
                        <strong><?= !empty($certificateData[0]->vaccinationStatus) ? htmlspecialchars($certificateData[0]->vaccinationStatus, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Follow-up Appointments:</span>
                        <strong><?= !empty($certificateData[0]->followUpAppointment) ? htmlspecialchars($certificateData[0]->followUpAppointment, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Recommendations</span>
                        <strong><?= !empty($certificateData[0]->recommendation) ? htmlspecialchars($certificateData[0]->recommendation, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                    <div class="section-item">
                        <span>Certificate Expired:</span>
                        <strong><?= !empty($certificateData[0]->expiryDate) ? htmlspecialchars($certificateData[0]->expiryDate, ENT_QUOTES, 'UTF-8') : "No data available"; ?></strong>
                    </div>
                </div>
            </div>

            <div class="certificate-footer">
                <div>
                    <p><em>Certified by Licensed Veterinarian</em></p>
                </div>
                <div class="signature">
                    <p style="border-top: 2px solid var(--primary-color); display: inline-block; padding-top: 10px;">
                        Dr. <?= !empty($certificateData[0]->fullName) ? htmlspecialchars($certificateData[0]->fullName, ENT_QUOTES, 'UTF-8') : "No data available"; ?>
                    </p><br>
                    <small>Veterinary Surgeon License #<?= !empty($certificateData[0]->lnumber) ? htmlspecialchars($certificateData[0]->lnumber, ENT_QUOTES, 'UTF-8') : "No data available"; ?></small>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const today = new Date();
        //     const nextCheckup = new Date(today);
        //     nextCheckup.setMonth(today.getMonth() + 6);

        //     document.getElementById('examDate').textContent = today.toLocaleDateString();
        //     document.getElementById('nextCheckup').textContent = nextCheckup.toLocaleDateString();
        // });
    </script>
</body>
</html>