<?php

class SalonOffer extends Controller 
{

    public function index() 
    {
        $offerdata = new SalonOffers;
        $servicedata = new SalonServices;

        $salonID = $_SESSION['SALON_USER'];

        if(!$salonID)
        {
            redirect('Login');
        }

        //first get this salon service ID 
        $serviceDetails = $servicedata->findAllServiceId($salonID);

        $offers = [];

        if($serviceDetails)
        {
            foreach($serviceDetails as $serviceDetail)
            {
                $serviceID = $serviceDetail->serviceID;
                $serviceOffers = $offerdata->findByService($serviceID);

                if ($serviceOffers) {
                    foreach ($serviceOffers as $offer) {
                        $offers[] = $offer;
                    }
                }
            }

        }
        else
        {
            echo "service Not fount yet";
            $data['service'] = "service Not added yet";
        }

        // Fetch all offers from salonspecialoffer table
        // $offers = $offerdata->findAllOfferId();

        $data = []; // Initialize $data array

        if (!empty($offers)) 
        {
            foreach ($offers as $key => $offer) 
            {
                $serviceID = $offer->serviceID;
                $service = $servicedata->whereservice($serviceID);

                if (!empty($service)) {
                    $data[$key] = [
                        'serviceName' => $service[0]->serviceName ?? 'Unknown',
                        'discount' => $offer->discount ?? 0,
                        'description' => $offer->description ?? 'No description added yet',
                        'closeDate' => $offer->closeDate ?? '',
                        'startDate' => $offer->startDate ?? '',
                        'createDate' => $offer->createDate ?? '',
                        'specialOfferID' => $offer->specialOfferID ?? null
                    ];
                } 
                else 
                {
                    // If service is not found, set placeholders
                    $data[$key] = [
                        'serviceName' => 'Unknown',
                        'discount' => $offer->discount ?? 0,
                        'description' => $offer->description ?? 'No description added yet',
                        'closeDate' => $offer->closeDate ?? '',
                        'startDate' => $offer->startDate ?? '',
                        'createDate' => $offer->createDate ?? '',
                        'specialOfferID' => $offer->specialOfferID ?? null
                    ];
                }
            }
        }

        $this->view('Salon/salonoffer', ['data' => $data]);
    }

    public function addoffer() 
    {
        $data = [];
        $salonID = $_SESSION['SALON_USER'];
        $servicedata = new SalonServices;
        $services = $servicedata->findAllServiceId($salonID);
        $data['services'] = $services;

        if (isset($_POST['submit'])) 
        {
            // Get the serviceID from the form
            $serviceID = $_POST['serviceID'] ?? '';

            // Find the selected service
            $selectedService = $servicedata->whereservice($serviceID);

            // Get the service charge (price) of the selected service
            $servicePrice = $selectedService->serviceCharge ?? 0;

            // Get the discount value from the form
            $discount = htmlspecialchars(trim($_POST['discount'] ?? ''));

            // Calculate the new price
            $newServicePrice = $servicePrice - ($discount * $servicePrice / 100);

            $data = [
                'serviceID' => $_POST['serviceID'] ?? '',
                'discount' => htmlspecialchars(trim($_POST['discount'] ?? '')),
                'startDate' => htmlspecialchars(trim($_POST['offerStartDate'] ?? '')),
                'closeDate' => htmlspecialchars(trim($_POST['offerClosetDate'] ?? '')),
                'description' => htmlspecialchars(trim($_POST['description'] ?? '')),
                'createDate' => date('Y-m-d H:i:s') // Capture the current date and time
            ];

            // Validate the input data
            $validateresult = $this->ValidateOfferData($data, $newServicePrice);

            if (empty($validateresult['errors'])) {
                $offertable = new SalonOffers;

                try {
                    // Call the insert method
                    $offertable->addoffer($validateresult);

                    // If no exception occurs, assume success
                    redirect('SalonOffer');
                } catch (Exception $e) {
                    $data['errors'] = 'Data insert unsuccessful: ' . $e->getMessage();
                }
            } else {
                $data['errors'] = $validateresult['errors'];
            }
        }

        $this->view('Salon/salonofferadd', $data);
    }

    public function deleteoffer($specialOfferID) 
    {
        $offertable = new SalonOffers;
        $result = $offertable->offerdelete($specialOfferID);

        if ($result !== false) {
            echo json_encode([
                'success' => true,
                'message' => 'Offer deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete the offer.'
            ]);
        }

        exit;
    }

    public function editoffer($specialOfferID) 
    {
        $specialOfferID = (int)$specialOfferID; 

        $data = [];
        $salonID = $_SESSION['SALON_USER'];

        $servicedata = new SalonServices;
        $services = $servicedata->findAllServiceId($salonID);
        $data['services'] = $services;

        $offerModel = new SalonOffers;

        $offerData = $offerModel->whereoffer($specialOfferID);
        $data['olddata'] = $offerData;

        if (isset($_POST['update'])) {
            // Get the serviceID from the form
            $serviceID = $_POST['serviceID'] ?? '';

            // Find the selected service
            $selectedService = $servicedata->whereservice($serviceID);

            // Get the service charge (price) of the selected service
            $servicePrice = $selectedService->serviceCharge ?? 0;

            // Get the discount value from the form
            $discount = htmlspecialchars(trim($_POST['discount'] ?? ''));

            // Calculate the new price
            $newServicePrice = $servicePrice - ($discount * $servicePrice / 100);

            $data = [
                'description' => htmlspecialchars(trim($_POST['description'] ?? '')),
                'discount' => htmlspecialchars(trim($_POST['discount'] ?? '')),
                'createDate' => htmlspecialchars(trim($_POST['createDate'] ?? '')),
                'startDate' => htmlspecialchars(trim($_POST['startDate'] ?? '')),
                'closeDate' => htmlspecialchars(trim($_POST['closeDate'] ?? '')),
                'serviceID' => htmlspecialchars(trim($_POST['serviceID'] ?? '')),
            ];

            // Validate the data
            $validateresult = $this->ValidateOfferData($data, $newServicePrice);

            if (empty($validateresult['errors'])) {
                $offertable = new SalonOffers;
                try {
                    // Call the update method
                    $result = $offertable->offerupdate($specialOfferID, $validateresult);
                    // If no exception occurs, assume success
                    redirect('SalonOffer');
                } catch (Exception $e) {
                    // Handle the exception if something goes wrong
                    $data['errors'] = 'Data update unsuccessful: ' . $e->getMessage();
                }
            } else {
                $data['errors'] = $validateresult['errors'];
            }

        }

        $this->view('Salon/salonofferedit', $data);
    }

    private function ValidateOfferData($arr, $newServicePrice) 
    {
        $arr['errors'] = []; 

        // 1. Check if serviceID is selected
        if (empty($arr['serviceID'])) {
            $arr['errors'][] = 'Please select a service.';
        }

        // 2. Check if discount is a valid number (positive value)
        if (empty($arr['discount'])) {
            $arr['errors'][] = 'Please provide a valid discount (positive number).';
        }

        // 2.1 Check if the new price is valid
        if ($newServicePrice < 0) {
            $arr['errors'][] = 'Please enter a suitable discount.';
        }

        // 3. Check if startDate and closeDate are valid dates and not before the createDate
        $createDate = !empty($arr['createDate']) ? strtotime($arr['createDate']) : 0;
        $startDate = !empty($arr['startDate']) ? strtotime($arr['startDate']) : 0;
        $closeDate = !empty($arr['closeDate']) ? strtotime($arr['closeDate']) : 0;

        // Check if startDate and closeDate are not null or empty
        if ($startDate && $startDate < $createDate) {
            $arr['errors'][] = 'Start date cannot be before the create date.';
        }

        if ($closeDate && $closeDate < $createDate) {
            $arr['errors'][] = 'Close date cannot be before the create date.';
        }

        // 4. Check if startDate is before closeDate
        if ($startDate && $closeDate && $startDate > $closeDate) {
            $arr['errors'][] = 'Start date cannot be after the close date.';
        }

        // 5. Check if startDate and closeDate have valid formats
        if ($startDate && !strtotime($arr['startDate'])) {
            $arr['errors'][] = 'Start date is not in a valid format.';
        }

        if ($closeDate && !strtotime($arr['closeDate'])) {
            $arr['errors'][] = 'Close date is not in a valid format.';
        }

        // If there are no errors, unset the errors key
        if (empty($arr['errors'])) {
            unset($arr['errors']); 
        }

        return $arr;
    }
}
