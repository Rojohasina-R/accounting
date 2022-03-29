<?php

namespace App\Models;

use App\Models\Line;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'type'];

    public function lines()
    {
        return $this->hasMany(Line::class);
    }
}
