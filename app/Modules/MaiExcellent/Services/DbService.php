<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Services;

use App\Modules\MaiExcellent\Factories\ValidatorFactory;
use App\Modules\MaiExcellent\Models\Country;
use App\Modules\MaiExcellent\Models\Hotel;
use App\Modules\MaiExcellent\Validators\CountryValidator;
use App\Modules\MaiExcellent\Validators\HotelValidator;
use Illuminate\Database\Eloquent\Model;

final readonly class DbService
{
    static public function store(Model $model, $data): Model
    {
        $validated = ValidatorFactory::getValidator($model)->validateData($data);
        $model::upsert($validated,
         match (get_class($model)) {
             Country::class => ['country_id', 'code'],
             Hotel::class => ['rec_id', 'hotel_code'],
             default => throw new \Exception("DbService not found for model: " . get_class($model))
        });
        return $model;
    }}
