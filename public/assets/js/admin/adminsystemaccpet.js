// function openModal(type) {
//     const modal = document.getElementById('actionModal');
//     const title = document.getElementById('modalTitle');
//     const description = document.getElementById('modalDescription');

//     if (type === 'accept') {
//         title.textContent = 'Accept Salon Request';
//         description.textContent = 'Do you want to approve this salon registration?';
//     } else {
//         title.textContent = 'Decline Salon Request';
//         description.textContent = 'Are you sure you want to decline this salon registration?';
//     }

//     modal.style.display = 'flex';
// }

// function closeModal() {
//     document.getElementById('actionModal').style.display = 'none';
// }

// let selectedDoctorID = null;
// let selectedActionType = null;

// function openModal(type, doctorID) {
//     selectedDoctorID = doctorID;
//     selectedActionType = type;

//     const modal = document.getElementById('actionModal');
//     const title = document.getElementById('modalTitle');
//     const description = document.getElementById('modalDescription');

//     if (type === 'accept') {
//         title.textContent = 'Accept Doctor Request';
//         description.textContent = 'Do you want to approve this doctor registration?';
//     } else {
//         title.textContent = 'Decline Doctor Request';
//         description.textContent = 'Are you sure you want to decline this doctor registration?';
//     }

//     modal.style.display = 'flex';
// }

// function closeModal() {
//     document.getElementById('actionModal').style.display = 'none';
// }

let selectedDoctorID = null;
let selectedActionType = null;

function openModal(type, doctorID) {
    selectedDoctorID = doctorID;
    selectedActionType = type;

    const modal = document.getElementById('actionModal');
    const title = document.getElementById('modalTitle');
    const description = document.getElementById('modalDescription');
    const reasonWrapper = document.getElementById('rejectReasonWrapper');

    if (type === 'accept') {
        title.textContent = 'Accept Doctor Request';
        description.textContent = 'Do you want to approve this doctor registration?';
        reasonWrapper.style.display = 'none';
    } else {
        title.textContent = 'Decline Doctor Request';
        description.textContent = 'Are you sure you want to decline this doctor registration?';
        reasonWrapper.style.display = 'block';
    }

    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('actionModal').style.display = 'none';
}




