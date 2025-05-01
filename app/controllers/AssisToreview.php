<?php

class AssisToreview extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['assis_id'])) {
            header('Location: ' . ROOT . '/login');
            $notification = new Notification();
            $_SESSION['notification'] = [
                'message' => 'You are not authorized to access this page.',
                'type' => 'error',
            ];
            exit;
        }

        // if ($_SESSION['type'] != 'Vet Assistant') {
        //     header('Location: ' . ROOT . '/login');
        //     $notification = new Notification();
        //     $_SESSION['notification'] = [
        //         'message' => 'You are not authorized to access this page.',
        //         'type' => 'error',
        //     ];
        //     exit;
        // }
        
        $this->view('assistant/assistoreview');
    }

}
