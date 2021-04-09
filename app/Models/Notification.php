<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = false;

    /**
     * Get the user that owns a notification
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
