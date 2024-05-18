<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $translations->title
 * @property string $translations->description
 * @property string $slug
 * @property bool $active
 *
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 * @property Role[]|Collection $roles
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'active',
    ];

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
