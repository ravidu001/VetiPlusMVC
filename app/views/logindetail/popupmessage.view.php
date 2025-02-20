<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... existing head content ... -->
    <style>
        .popup {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            transform: translateX(150%);
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }

        .popup.show {
            transform: translateX(0);
        }

        .popup.success {
            background-color: #4CAF50;
        }

        .popup.error {
            background-color: #f44336;
        }

        .popup-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .popup-icon {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- ... existing container content ... -->
        
        <!-- Add this right before closing body tag -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="popup-icon"></span>
                <span class="popup-message"></span>
            </div>
        </div>

        <script>
            function showPopup(message, type) {
                const popup = document.getElementById('popup');
                const popupMessage = popup.querySelector('.popup-message');
                const popupIcon = popup.querySelector('.popup-icon');
                
                popup.className = 'popup ' + type;
                popupMessage.textContent = message;
                popupIcon.innerHTML = type === 'success' ? '✓' : '✕';
                
                popup.classList.add('show');
                
                setTimeout(() => {
                    popup.classList.remove('show');
                }, 3000);
            }

            document.querySelector('.login-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch('<?= ROOT ?>/login/login', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showPopup(data.message || 'Login successful!', 'success');
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        showPopup(data.message || 'Login failed!', 'error');
                    }
                })
                .catch(error => {
                    showPopup('An error occurred. Please try again.', 'error');
                });
            });
        </script>
    </div>
</body>
</html>