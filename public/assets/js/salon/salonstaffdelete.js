
    let deleteStaffId = null;

    // Show the modal and set the ID to delete
    function confirmDelete(staffId) {
        deleteStaffId = staffId;
        document.getElementById('deleteModal').style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        deleteStaffId = null;
    }

    // Handle confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteStaffId !== null) {
            const formData = deleteStaffId;
            
            fetch(`${BASE_URL}/SalonStaff/deleteStaff`, {
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

