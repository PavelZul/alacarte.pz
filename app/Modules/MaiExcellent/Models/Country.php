<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @mixin Builder
 */
class Country extends Model
{
    public $timestamps = false;
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
