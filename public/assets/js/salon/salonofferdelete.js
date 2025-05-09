
    let deleteOfferId = null;

    // Show the modal and set the ID to delete
    function confirmDelete(offerId) {
        deleteOfferId = offerId;
        document.getElementById('deleteModal').style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        deleteOfferId = null;
    }

    // Handle confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteOfferId !== null) {
            const formData = deleteOfferId;
            
            fetch(`${BASE_URL}/SalonOffer/deleteoffer`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotification(data.message, 'error');
                }
                closeModal();
            })
            .catch(error => {
                showNotification(error, 'error');
                closeModal();
            });
        }
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
    
        // Trigger fade-in
        setTimeout(() => {
            notification.style.opacity = 1;
        }, 10);
    
        // Auto hide after 3 seconds
        setTimeout(() => {
            notification.style.opacity = 0;
            setTimeout(() => {
                notification.style.display = 'none';
            }, 500);
        }, 3000);
    }
    