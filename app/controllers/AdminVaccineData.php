<?php 

class AdminVaccineData extends Controller
{
    public function index()
    {    
        $vaccinedata = new VaccineDataModel();
        $adminavaccinedata = $vaccinedata->getalldata();
        $this->view('admin/adminvaccinedata',[
            'adminavaccinedata' => $adminavaccinedata,
        ]);
    }

    public function createvaccine(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
                $data = [
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'brand' => $_POST['brand'],
                    'petType' => $_POST['type'],
                ];
                $petdata = new VaccineDataModel();
                $petdata->addNew($data);
                redirect('AdminVaccineData');
            }
        
        }
    }
    public function deletevaccinedata(){
        if(isset($_GET['vaccineID'])){
            $vaccineID = $_GET['vaccineID'];
            $deletedata = new VaccineDataModel();
            $deletedata->delete($vaccineID, 'vaccineID');
            redirect('AdminVaccineData'); // refresh the view
        }
    }
}