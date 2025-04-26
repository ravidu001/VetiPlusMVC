<?php

class Species_Breeds {
    use Model;

    protected $table = 'species_breeds'; 
    protected $allowedColumns = ['species', 'breed'];

    public function __construct() {
        $this->order_column = 'breed';
        $this->limit = 30;     // override default limit 10, since maybe more than 10 breeds.
    }

    /**
     * Receives new 'species' and 'breed' as associativ earray to be inserted.
     * Used by the system Admin
     * @param array $data new 'species' and 'breed'
     * @return bool
     */
    public function addNew ($data) {
        $addSuccess = $this->insert($data);
        return empty($addSuccess) ? true : false;
    }

    public function getSpeciesList () {
        $speciesQuery = "SELECT DISTINCT species FROM $this->table";
        return $this->query($speciesQuery);
    }

    public function getBreedsList ($species) {
        $breedsList = $this->where(['species' => $species]);
        return $breedsList;
    }
    public function getalldata() {
        $this->limit=1000;
        $this->order_column = 'id';
        $this->order_type = 'ASC';
        return $this->findAll();
    }
    
}