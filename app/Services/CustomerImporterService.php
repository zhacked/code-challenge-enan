<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use App\Providers\RandomUserApiService;

class CustomerImporterService
{
    public function __construct(private RandomUserApiService $api) {}

    public function import(): int
    {
        $customers = $this->api->fetch();

        $importedCount = 0;

        foreach ($customers as $data) {
            if (!isset($data['email'])) continue;

            Customer::updateOrCreate(
                ['email' => $data['email']],
                [
                    'first_name' => $data['name']['first'],
                    'last_name' => $data['name']['last'],
                    'username' => $data['login']['username'],
                    'password' => md5($data['login']['password']),
                    'gender' => $data['gender'],
                    'country' => $data['location']['country'],
                    'city' => $data['location']['city'],
                    'phone' => $data['phone'],
                ]
            );

            $importedCount++;
        }

        return $importedCount;
    }
}
