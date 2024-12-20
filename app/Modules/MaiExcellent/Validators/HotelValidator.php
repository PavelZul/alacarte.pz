<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Validators;

use App\Modules\MaiExcellent\Interfaces\ValidatorInterface;

class HotelValidator implements ValidatorInterface
{
    static function prepareData(array $data): array
    {
        return array_map(function ($item) {
            return [
                'rec_id' => $item['RecId'],
                'hotel_code' => $item['HotelCode'],
                'hotel_name' => $item['HotelName'],
                'country_id' => $item['CountryId'],
                'data' => json_encode(array_filter($item, fn($key) => !in_array($key, ['$id', 'RecId', 'HotelCode', 'HotelName', 'CountryId'])) ?: '{}')
            ];
        }, $data);
    }

    public function validateData(array $data): array
    {
        return array_filter(self::prepareData($data), function ($item) {
            switch(true) {
                case gettype($item['rec_id']) !== 'integer' || $item['rec_id'] < 1:
                case gettype($item['hotel_code']) !== 'string' || strlen($item['hotel_code']) > 32:
                case gettype($item['hotel_name']) !== 'string' || strlen($item['hotel_name']) > 256:
                case gettype($item['country_id']) !== 'integer' || $item['country_id'] < 1:
                    return false;
                default:
                    return true;
            }
        });
    }
}
