function openModal(type) {
    const modal = document.getElementById('actionModal');
    const title = document.getElementById('modalTitle');
    const description = document.getElementById('modalDescription');

    if (type === 'accept') {
        title.textContent = 'Accept Salon Request';
        description.textContent = 'Do you want to approve this salon registration?';
    } else {
        title.textContent = 'Decline Salon Request';
        description.textContent = 'Are you sure you want to decline this salon registration?';
    }

    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('actionModal').style.display = 'none';
}