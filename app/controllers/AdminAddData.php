<?php

class AdminAddData extends Controller
{
    public function index()
    {   
        $adddata = new Species_Breeds();
        $adminadddata = $adddata->getalldata();
        $this->view('admin/AdminAddData',[
            'adminadddata' => $adminadddata,
        ]);
    }

    public function createdata(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
                $data = [
                    'species' => $_POST['species'],
                    'breed' => $_POST['breed'],
                ];
                $petdata = new Species_Breeds();
                $petdata->addNew($data);
                redirect('AdminAddData');
            }
        
        }
    }

    public function deletedata(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $deletedata = new Species_Breeds();
            $deletedata->delete($id, 'id');
            redirect('AdminAddData'); // refresh the view
        }
    }
    
}