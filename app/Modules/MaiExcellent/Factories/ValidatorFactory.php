<?php

namespace App\Modules\MaiExcellent\Factories;

use App\Modules\MaiExcellent\Interfaces\ValidatorInterface;
use App\Modules\MaiExcellent\Models\Country;
use App\Modules\MaiExcellent\Models\Hotel;
use App\Modules\MaiExcellent\Validators\CountryValidator;
use App\Modules\MaiExcellent\Validators\HotelValidator;

class ValidatorFactory
{
    public static function getValidator($model): ValidatorInterface
    {
        return match (get_class($model)) {
            Country::class => new CountryValidator(),
            Hotel::class => new HotelValidator(),
            default => throw new \Exception("Validator not found for model: " . get_class($model))
        };
    }
}
