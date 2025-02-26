<?php

class Species_Breeds {
    use Model;

    protected $table = 'species_breeds'; 
    protected $allowedColumns = ['species', 'breed'];

    public function __construct() {
        $this->limit = 30;     // override default limit 10
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
        $speciesQuery = "SELECT DISTINCT species FROM `species_breeds`";
        return $this->query($speciesQuery);
    }

    public function getBreedsList ($species) {
        $breedsList = $this->where(['species' => $species]);
        return $breedsList;
    }
}