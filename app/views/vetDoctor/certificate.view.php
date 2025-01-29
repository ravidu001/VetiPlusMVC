<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Medical Certificate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                        <strong>Buddy</strong>
                    </div>
                    <div class="section-item">
                        <span>Species:</span>
                        <strong>Dog</strong>
                    </div>
                    <div class="section-item">
                        <span>Breed:</span>
                        <strong>Golden Retriever</strong>
                    </div>
                    <div class="section-item">
                        <span>Age:</span>
                        <strong>3 Years</strong>
                    </div>
                    <div class="section-item">
                        <span>Gender:</span>
                        <strong>Male</strong>
                    </div>
                </div>

                <div class="section">
                    <h2>Medical Assessment</h2>
                    <div class="section-item">
                        <span>Overall Health:</span>
                        <strong>Excellent</strong>
                    </div>
                    <div class="section-item">
                        <span>Weight:</span>
                        <strong>25 kg</strong>
                    </div>
                    <div class="section-item">
                        <span>Vaccination Status:</span>
                        <strong>Up to Date</strong>
                    </div>
                    <div class="section-item">
                        <span>Last Examination:</span>
                        <strong id="examDate"></strong>
                    </div>
                    <div class="section-item">
                        <span>Next Check-up:</span>
                        <strong id="nextCheckup"></strong>
                    </div>
                </div>
            </div>

            <div class="certificate-footer">
                <div>
                    <p><em>Certified by Licensed Veterinarian</em></p>
                </div>
                <div class="signature">
                    <p style="border-top: 2px solid var(--primary-color); display: inline-block; padding-top: 10px;">
                        Dr. Emily Johnson
                    </p><br>
                    <small>Veterinary Surgeon License #12345</small>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const nextCheckup = new Date(today);
            nextCheckup.setMonth(today.getMonth() + 6);

            document.getElementById('examDate').textContent = today.toLocaleDateString();
            document.getElementById('nextCheckup').textContent = nextCheckup.toLocaleDateString();
        });
    </script>
</body>
</html>