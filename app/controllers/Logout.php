<?php

class Logout extends Controller
{
    public function index()
    {
        if(isset($_SESSION['type']))
        {
            $userType = $_SESSION['type'];

            switch($userType)
            {
                case 'Vet Doctor':
                    unset( $_SESSION['user_id']);
                 
                case 'Pet Owner':
                    unset($_SESSION['petOwnerID']);
                 
                case 'Salon':
                    unset($_SESSION['SALON_USER']);
                 
                case 'Vet Assistant':
                    unset($_SESSION['assis_id']);
                   
                case 'System Admin':
                    unset($_SESSION['adminID']);
            }
            
        }
        
        header("Location: " . ROOT . "/Login");
        exit();
    }
   
}