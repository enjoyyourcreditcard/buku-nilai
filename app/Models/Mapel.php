<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'nama',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }
}
