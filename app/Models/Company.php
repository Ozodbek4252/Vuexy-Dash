<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property string|null $logo_secondary
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read string|null $logo_path
 * @property-read string|null $logo_secondary_path
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'logo_secondary',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getLogoPathAttribute()
    {
        return $this->logo ? asset($this->logo) : asset('images/no-image.png');
    }


    public function getLogoSecondaryPathAttribute()
    {
        return $this->logo_secondary ? asset($this->logo_secondary) : asset('images/no-image.png');
    }
}
