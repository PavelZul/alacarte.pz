<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class Hotel extends Model
{
    public $timestamps = false;
    protected $guarded = ['created_at', 'updated_at'];
    protected $casts = [
        'data' => 'array',
    ];

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }
}
