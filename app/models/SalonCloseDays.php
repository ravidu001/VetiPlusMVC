<?php

class SalonCloseDays {
    use Model;
    use Database;
    protected $table = 'salon_open_days';

    public function addCloseDay($data) {
        return $this->insert($data);
    }
}
