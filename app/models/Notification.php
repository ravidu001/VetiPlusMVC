<?php

class Notification {
    public function show($message, $type = 'success', $refresh = 'true') {
        $_SESSION['notification'] = [
            'message' => $message,
            'type' => $type,
        ];

        if ($refresh == 'true') {
           
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function display() {
        if (isset($_SESSION['notification'])) {
            $notification = $_SESSION['notification'];
            unset($_SESSION['notification']);

            return $this->renderNotification($notification['message'], $notification['type']);
        }
        return '';
    }

    private function renderNotification($message, $type) {
        $typeClass = '';
        $emoji = '';
        switch ($type) {
            case 'success':
                $typeClass = 'notification-success';
                $emoji = '✅'; 
                break;
            case 'error':
                $typeClass = 'notification-error';
                $emoji = '❌'; 
                break;
            case 'warning':
                $typeClass = 'notification-warning';
                $emoji = '⚠️'; 
                break;
        }

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