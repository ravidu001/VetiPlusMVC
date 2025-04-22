<?php

class User
{
    use Model;

    protected $table = 'User';

    protected $allowedColumns = ['email', 'password', 'type', 'loginCount'];

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

    public function updatePassword($email, $password) {
        $this->update($email, ['password' => $password], 'email');
    }

    public function po_changePassword ($petOwnerID, $oldPass, $newPass) {
        $petOwner = $this->first(['email' => $petOwnerID]);
        if ( password_hash($oldPass, PASSWORD_DEFAULT) == $petOwner->password ) {
            $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

            $changeSuccess = $this->update($petOwnerID, ['password' => $newPassHash], 'email');
            return empty($changeSuccess) ? true : false;
        } else {
            return false;
        }

    }

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['name'] = "email is required";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function countUser()
    {
        $count = $this->getCount();
        return $count;  // Return the count value

    }
}
