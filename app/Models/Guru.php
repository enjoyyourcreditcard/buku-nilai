<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function mapels(): HasMany
    {
        return $this->hasMany(Mapel::class);
    }
}
