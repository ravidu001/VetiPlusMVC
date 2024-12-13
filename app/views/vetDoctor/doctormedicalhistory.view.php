<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Medical History</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/medicalhistory.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="medical-history-container">
        <div class="profile-header">
            <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet Avatar" class="pet-avatar">
            <div class="profile-details">
                <h1>Roky</h1>
                <p>German Shepherd | Male | 2 Years 6 Months | 20 kg</p>
                <p>Patient ID: #10011</p>
            </div>
        </div>

        <div class="medical-section medical-section-collapsed">
                <h2>Vaccination History</h2>
                <div class="medical-section-scrollable">
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Rabies Vaccination</h3>
                            <p>Annual protective vaccination</p>
                        </div>
                        <div class="medical-entry-date">1 Month Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>DHPP Vaccination</h3>
                            <p>Comprehensive dog vaccination</p>
                        </div>
                        <div class="medical-entry-date">3 Months Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Bordetella Vaccination</h3>
                            <p>Kennel cough prevention</p>
                        </div>
                        <div class="medical-entry-date">6 Months Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Leptospirosis Vaccination</h3>
                            <p>Bacterial infection prevention</p>
                        </div>
                        <div class="medical-entry-date">9 Months Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Lyme Disease Vaccination</h3>
                            <p>Tick-borne disease prevention</p>
                        </div>
                        <div class="medical-entry-date">1 Year Ago</div>
                    </div>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (5)</div>
            </div>

            <div class="medical-section medical-section-collapsed">
                <h2>Medical Conditions</h2>
                <div class="medical-section-scrollable">
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Skin Allergy</h3>
                            <p>Mild dermatological treatment</p>
                        </div>
                        <div class="medical-entry-date">1 Year Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Ear Infection</h3>
                            <p>Treated with specialized antibiotics</p>
                        </div>
                        <div class="medical-entry-date">8 Months Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Eye Inflammation</h3>
                            <p>Mild conjunctivitis treatment</p>
                        </div>
                        <div class="medical-entry-date">2 Years Ago</div>
                    </div>
                    <div class="medical-entry">
                        <div class="medical-entry-details">
                            <h3>Digestive Issues</h3>
                            <p>Temporary gastrointestinal discomfort</p>
                        </div>
                        <div class="medical-entry-date">3 Years Ago</div>
                    </div>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (4)</div>
            </div>

            <div class="medical-section medical-section-collapsed">
        <h2>Surgical History</h2>
        <div class="medical-section-scrollable">
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Neutering</h3>
                    <p>Routine surgical procedure</p>
                </div>
                <div class="medical-entry-date">1.5 Years Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Dental Cleaning</h3>
                    <p>Comprehensive oral hygiene</p>
                </div>
                <div class="medical-entry-date">2 Years Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Tumor Removal</h3>
                    <p>Benign growth extraction</p>
                </div>
                <div class="medical-entry-date">3 Years Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Knee Ligament Repair</h3>
                    <p>ACL reconstruction</p>
                </div>
                <div class="medical-entry-date">4 Years Ago</div>
            </div>
        </div>
        <div class="view-all-btn" onclick="toggleSection(this)">View All (4)</div>
    </div>

    <div class="medical-section medical-section-collapsed">
        <h2>Prescription History</h2>
        <div class="medical-section-scrollable">
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Antihistamines</h3>
                    <p>Allergy management</p>
                </div>
                <div class="medical-entry-date">2 Months Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Ear Infection Drops</h3>
                    <p>Antibiotic ear treatment</p>
                </div>
                <div class="medical-entry-date">8 Months Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Pain Management</h3>
                    <p>Anti-inflammatory medication</p>
                </div>
                <div class="medical-entry-date">1 Year Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Arthritis Supplement</h3>
                    <p>Joint health support</p>
                </div>
                <div class="medical-entry-date">2 Years Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Antibiotics</h3>
                    <p>Systemic infection treatment</p>
                </div>
                <div class="medical-entry-date">3 Years Ago</div>
            </div>
        </div>
        <div class="view-all-btn" onclick="toggleSection(this)">View All (5)</div>
    </div>

    <div class="medical-section medical-section-collapsed">
        <h2>Allergies & Sensitivities</h2>
        <div class="medical-section-scrollable">
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Food Sensitivity</h3>
                    <p>Specific protein intolerance</p>
                </div>
                <div class="medical-entry-date">1 Year Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Pollen Allergy</h3>
                    <p>Seasonal environmental reaction</p>
                </div>
                <div class="medical-entry-date">2 Years Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Dust Mite Sensitivity</h3>
                    <p>Respiratory irritation</p>
                </div>
                <div class="medical-entry-date">3 Years Ago</div>
            </div>
        </div>
        <div class="view-all-btn" onclick="toggleSection(this)">View All (3)</div>
    </div>

    <div class="medical-section medical-section-collapsed">
        <h2>Weight Tracking</h2>
        <div class="medical-section-scrollable">
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Current Weight</h3>
                    <p>Healthy weight range</p>
                </div>
                <div class="medical-entry-date">20 kg</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Weight 6 Months Ago</h3>
                    <p>Slight weight gain</p>
                </div>
                <div class="medical-entry-date">19.5 kg</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Weight 1 Year Ago</h3>
                    <p>Initial weight check</p>
                </div>
                <div class="medical-entry-date">18 kg</div>
            </div>
        </div>
        <div class="view-all-btn" onclick="toggleSection(this)">View All (3)</div>
    </div>

    <div class="medical-section medical-section-collapsed">
        <h2>Additional Notes</h2>
        <div class="medical-section-scrollable">
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Special Dietary Needs</h3>
                    <p>Specific food requirements</p>
                </div>
                <div class="medical-entry-date">1 Year Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Medication Reminders</h3>
                    <p>Regular medication schedule</p>
                </div>
                <div class="medical-entry-date">6 Months Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Upcoming Appointments</h3>
                    <p>Scheduled veterinary visits</p>
                </div>
                <div class="medical-entry-date">3 Months Ago</div>
            </div>
            <div class="medical-entry">
                <div class="medical-entry-details">
                    <h3>Health Certificates</h3>
                    <p>Official health documentation</p>
                </div>
                <div class="medical-entry-date">2 Years Ago</div>
            </div>
        </div>
        <div class="view-all-btn" onclick="toggleSection(this)">View All (4)</div>
    </div>
        </div>
    </div>
</div>
<script>
// Optional: More robust implementation
document.addEventListener('DOMContentLoaded', () => {
    const medicalSections = document.querySelectorAll('.medical-section');

    medicalSections.forEach(section => {
        const viewAllBtn = section.querySelector('.view-all-btn');
        const entries = section.querySelectorAll('.medical-entry');
        const totalEntries = entries.length;

        // Initial setup
        viewAllBtn.textContent = `View All (${totalEntries})`;

        // Accessibility improvements
        viewAllBtn.setAttribute('role', 'button');
        viewAllBtn.setAttribute('tabindex', '0');

        // Keyboard accessibility
        viewAllBtn.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                viewAllBtn.click();
            }
        });

        viewAllBtn.addEventListener('click', () => {
            const isCollapsed = section.classList.toggle('medical-section-collapsed');

            // Animate entries
            entries.forEach((entry, index) => {
                if (index >= 3) {
                    entry.style.transition = 'opacity 0.3s ease';
                    entry.style.opacity = isCollapsed ? '0' : '1';
                }
            });

            // Update button text
            viewAllBtn.textContent = isCollapsed 
                ? `View All (${totalEntries})` 
                : 'Show Less';

            // Accessibility attributes
            section.setAttribute('aria-expanded', !isCollapsed);
            viewAllBtn.setAttribute('aria-label', 
                isCollapsed ? `Expand to see all ${totalEntries} entries` 
                : 'Collapse entries'
            );
        });
    });
});
</script>
</body>
</html>