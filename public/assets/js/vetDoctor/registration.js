const nextStepButtons = document.querySelectorAll('.next-step');
const previousStepButtons = document.querySelectorAll('.previous-step');
const formSections = document.querySelectorAll('.form-section');
const steps = document.querySelectorAll('.step');
let currentStep = 0;

nextStepButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (currentStep < formSections.length - 1) {
            formSections[currentStep].classList.remove('active');
            steps[currentStep].classList.remove('active');
            currentStep++;
            formSections[currentStep].classList.add('active');
            steps[currentStep].classList.add('active');
        }
    });
});

previousStepButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (currentStep > 0) {
            formSections[currentStep].classList.remove('active');
            steps[currentStep].classList.remove('active');
            currentStep--;
            formSections[currentStep].classList.add('active');
            steps[currentStep].classList.add('active');
        }
    });
});

// document.getElementById('vetRegistrationForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     alert('Registration Successful!');
//     // window.location.href = '<?= ROOT ?>/doctor';
// });