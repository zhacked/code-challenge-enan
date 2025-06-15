<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class CustomerImporter
{
    private $apiUrl;
    private $resultsPerPage;

    public function __construct($apiUrl = 'https://randomuser.me/api', $resultsPerPage = 100)
    {
        $this->apiUrl = $apiUrl;
        $this->resultsPerPage = $resultsPerPage;
    }

    public function importCustomers()
    {

        $response = Http::get($this->apiUrl, [
            'results' => $this->resultsPerPage,
            'nat' => 'AU',
        ]);

        $customersData = $response->json()['results'];

        foreach ($customersData as $customerData) {
            $this->upsertCustomer($customerData);
        }
    }

    private function upsertCustomer($customerData)
    {
        $email = $customerData['email'];

        Customer::updateOrCreate(['email' => $email], [
            'gender' => $customerData['gender'],
            'title' => $customerData['name']['title'],
            'first_name' => $customerData['name']['first'],
            'last_name' => $customerData['name']['last'],
            'street_number' => $customerData['location']['street']['number'],
            'street_name' => $customerData['location']['street']['name'],
            'city' => $customerData['location']['city'],
            'state' => $customerData['location']['state'],
            'country' => $customerData['location']['country'],
            'postcode' => $customerData['location']['postcode'],
            'latitude' => $customerData['location']['coordinates']['latitude'],
            'longitude' => $customerData['location']['coordinates']['longitude'],
            'phone' => $customerData['phone'],
            'cell' => $customerData['cell'],
            'nationality' => $customerData['nat'],
            'picture_large' => $customerData['picture']['large'],
            'picture_medium' => $customerData['picture']['medium'],
            'picture_thumbnail' => $customerData['picture']['thumbnail'],
        ]);
    }
}
