
    let deleteStaffId = null;

    function confirmDelete(staffId) {
        deleteStaffId = staffId;
        
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        deleteStaffId = null;
    }

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
    
        setTimeout(() => {
            notification.style.opacity = 1;
        }, 10);
    
        setTimeout(() => {
            notification.style.opacity = 0;
            setTimeout(() => {
                notification.style.display = 'none';
            }, 500);
        }, 3000);
    }
    

