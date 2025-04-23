<?php

class _404 extends Controller {
    public function index() {
        $this->view(404);
    }

    public function returnPage() {
        switch ($_SESSION['type']) {
            case 'Vet Doctor':
                header('Location: ../Doctor');
                break;
            case 'Pet Owner':
                header('Location: ../PO_home');
                break;
            case 'Salon':
                header('Location: ../Salon');
                break;
            case 'Vet Assistant':
                header('Location: ../Assistant');
                break;
            case 'System Admin':
                header('Location: ../Admin');
                break;
            case 'Owner':
                header('Location: ../Owner');
                break;

            default:
                $message[] = 'User type not recognized!';
        }
        
    }
}