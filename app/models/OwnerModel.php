<?php

class OwnerModel {
    use Model;

    protected $table = 'owner';

    protected $allowedColumns = [
       'email',
       'password',
    ];
}