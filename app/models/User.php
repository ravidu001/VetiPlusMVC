<?php

class User
{
    use Model;

    protected $table = 'User';

    protected $allowedColumns = ['email', 'password', 'type', 'loginCount', 'activeStatus'];

    public function create($data)
    {
        $this->insert($data);
    }

    public function checkUser($email)
    {
        // echo $email;
        $this->order_column = 'email';
        // $result = $this->where(['email' => $email]);
        return $this->where(['email' => $email]); // what this return is an array of user
        // if($result) {
        //     return true;
        // } else {
        //     return false;
        // } 
    }

    public function checkLoginUser($email)
    {
        return $this->first(['email' => $email]); // how to access return value: $registered['email']
    }

    public function updateCount($id, $loginCount)
    {
        $this->update($id, ['loginCount' => $loginCount], 'email');
    }

    public function updatePassword($email, $password)
    {
        $this->update($email, ['password' => $password], 'email');
    }

    public function po_changePassword($petOwnerID, $oldPass, $newPass)
    {
        $petOwner = $this->first(['email' => $petOwnerID]);
        if (password_hash($oldPass, PASSWORD_DEFAULT) == $petOwner->password) {
            $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

            $changeSuccess = $this->update($petOwnerID, ['password' => $newPassHash], 'email');
            return empty($changeSuccess) ? true : false;
        } else {
            return false;
        }
    }

    public function deactivateUser($email, $status)
    {
        $this->update($email, ['activeStatus' => $status], 'email');
    }

    public function validate($data)
    {
        $this->errors = [];

        //check the email is empty
        if (empty($data['email'])) 
        {
            $this->errors['name'] = "email is required";
        }
        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Invalid email format.";
        }

        //check the password is empty
        if(empty($data['password']) || empty($data['repassword']))
        {
            $this->errors['passwordempty'] = "Both password must be filled";
        }
        else
        {
            // Check if the password match
            if($data['password']  !== $data['repassword'])
            {
                $this->errors['passwordmatch'] = "Password do not match";
            }
            else
            {
                // Check password strength
                $password = $data['password'];

                if (strlen($password) < 8) 
                {
                    $this->errors['passwordlength'] = "Password must be at least 8 characters long";
                }
    
                if (!preg_match('/[A-Z]/', $password)) 
                {
                    $this->errors['passwordupper'] = "Password must have at least one uppercase letter";
                }
    
                if (!preg_match('/[a-z]/', $password)) 
                {
                    $this->errors['passwordlower'] = "Password must have at least one lowercase letter";
                }
    
                if (!preg_match('/[0-9]/', $password)) 
                {
                    $this->errors['passwordnumber'] = "Password must have at least one number";
                }
    
                if (!preg_match('/[\W]/', $password)) 
                {
                    $this->errors['passwordspecial'] = "Password must have at least one special character";
                }
    
                // Check if password is too common
                $commonPasswords = ['password', '12345678', 'abc12345'];
                if (in_array(strtolower($password), $commonPasswords)) 
                {
                    $this->errors['passwordcommon'] = "Password is too common, please choose a stronger one";
                }
            }
        }


        if (empty($this->errors)) 
        {
            return true;
        } else 
        {
            return false;
        }
    }

    public function countUser()
    {
        $count = $this->getCount();
        return $count;  // Return the count value

    }
    public function admincountUser()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE type = 'System Admin'";
        $result = $this->query($query);
        return $result[0]->total;
    }
    public function deactiveusercount()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE type = 'System Admin' AND activeStatus = 'deactive'";
        $result = $this->query($query);
        return $result[0]->total;
    }

    public function updateActiveStatus($id, $status)
    {
        return $this->update($id, ['activeStatus' => $status], 'email');
    }

    public function changestatus($email)
    {
        return $this->update($email, ['activeStatus' => 'deactive'], 'email');
    }
    public function updateUser($email, $data)
    {
        return $this->update($email, $data, 'email');
    }
    public function getUserByEmail($email)
    {  
        $this->order_column = 'email';
        return $this->where(['email' => $email]);
    }
}
