<?php

namespace App\Models;

use App\Enuns\BrazilStates;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "zip_code",
        "name",
        "street",
        "neighborhood",
        "number",
        "complement",
        "city",
        "state",
        "active",
        "user_id"
    ];

    protected $casts = [
        "state" => BrazilStates::class,
        "boolean" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive(Builder $query)
    {
        $this->where("active", true);
    }
}
