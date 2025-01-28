<?php

class DoctorSessionModel {
    use Model;

    protected $table = 'session';

    protected $allowedColumns = ['sessionID', 'selectedDate', 'startTime', 'endTime', 'publishedTime', 'clinicLocation', 'district', 'assistantID', 'doctorID', 'note'];



}

