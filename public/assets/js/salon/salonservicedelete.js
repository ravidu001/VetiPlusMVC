
    let deleteServiceId = null;

    // Show the modal and set the ID to delete
    function confirmDelete(serviceId) {
        deleteServiceId = serviceId;

        document.getElementById('deleteModal').style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        deleteServiceId = null;
    }

    // Handle confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteServiceId !== null) {
            const formData = deleteServiceId;
            
            fetch(`${BASE_URL}/SalonService/deleteService`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Refresh the page after deletion
                } else {
                    alert('Error: ' + data.message);
                }
                closeModal();
            })
            .catch(error => {
                alert('An error occurred: ' + error);
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
