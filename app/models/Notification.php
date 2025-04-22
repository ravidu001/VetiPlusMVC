<?php

class Notification {
    public function show($message, $type = 'success', $refresh = 'true') {
        // Store the message and type in the session to access it later
        $_SESSION['notification'] = [
            'message' => $message,
            'type' => $type,
        ];

        if ($refresh == 'true') {
            // echo "<script>alert('Here');</script>";            
            // Redirect back to the previous controller
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            // exit();
        }
    }

    public function display() {
        // Check if there is a notification in the session
        if (isset($_SESSION['notification'])) {
            $notification = $_SESSION['notification'];
            // Clear the notification from the session
            unset($_SESSION['notification']);

            // Return the HTML for the notification
            return $this->renderNotification($notification['message'], $notification['type']);
        }
        return '';
    }

    private function renderNotification($message, $type) {
        // Determine the appropriate class and emoji for the notification
        $typeClass = '';
        $emoji = '';
        switch ($type) {
            case 'success':
                $typeClass = 'notification-success';
                $emoji = '✅'; // Success emoji
                break;
            case 'error':
                $typeClass = 'notification-error';
                $emoji = '❌'; // Error emoji
                break;
            case 'warning':
                $typeClass = 'notification-warning';
                $emoji = '⚠️'; // Warning emoji
                break;
        }

        // Return the HTML for the notification with animation
        return "
            <div class='notification $typeClass' id='notification'>
                <div class='notification-content'>
                    <span class='notification-icon'>$emoji</span>
                    <p>$message</p>
                </div>
                <button class='notification-close' onclick='closeNotification()'>&times;</button>
            </div>
            <script>
                function closeNotification() {
                    const notification = document.getElementById('notification');
                    notification.classList.add('notification-exit');
                    setTimeout(() => {
                        notification.remove();
                    }, 500); // Match the duration of the slideOut animation
                }

                // Automatically close the notification after 10 seconds
                setTimeout(() => {
                    closeNotification();
                }, 10000); // 10000 milliseconds = 10 seconds
            </script>
        ";
    }
}