<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Interfaces;

interface ValidatorInterface {
    static function prepareData(array $data): array;
    public function validateData(array $data): array;
}
