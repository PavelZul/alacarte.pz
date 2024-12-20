<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Integrations;

use App\Modules\MaiExcellent\Services\ApiService;

final readonly class ApiClient
{
    private const URI_ALL_HOTELS_LIST = 'Service1/GetHotellist';
    private const COUNTRY_LIST = 'Integratiion/GetCountrys';

    public function __construct(private ApiService $apiService) {}

    public function allHotelsList()
    {
        return $this->apiService->send('GET', self::URI_ALL_HOTELS_LIST)->json();
    }

    public function countriesList()
    {
        return $this->apiService->send('POST', self::COUNTRY_LIST)->json();
    }
}
