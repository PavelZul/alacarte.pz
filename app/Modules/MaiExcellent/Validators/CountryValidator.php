<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Validators;

use App\Modules\MaiExcellent\Interfaces\ValidatorInterface;

class CountryValidator implements ValidatorInterface
{
    static function prepareData(array $data): array
    {
        return array_map(function ($item) {
            return [
                'country_id' => $item['Id'],
                'code' => $item['Code'],
                'name' => $item['Name'],
            ];
        }, $data);
    }

    public function validateData(array $data): array
    {
        $validated = array_filter(self::prepareData($data), function ($item) {
            switch(true) {
                case gettype($item['country_id']) !== 'integer' || $item['country_id'] < 1:
                case gettype($item['code']) !== 'string' || strlen($item['code']) > 32:
                case gettype($item['name']) !== 'string' || strlen($item['name']) > 128:
                    return false;
                default:
                    return true;
            }
        });

        throw_if(empty($validated), Exception::class, 'MAI Excellent: validation error');

        return $validated;
    }
}
