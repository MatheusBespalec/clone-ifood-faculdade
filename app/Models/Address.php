<?php

namespace App\Models;

use App\Enum\BrazilStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "street",
        "neighborhood",
        "number",
        "complement",
        "reference",
        "city",
        "state",
        "user_id"
    ];

    protected $casts = [
        "state" => BrazilStates::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
