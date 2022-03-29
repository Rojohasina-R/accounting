<?php

namespace App\Models;

use App\Models\Line;
use App\Models\Journal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'name', 'journal_id'];

    public function lines()
    {
        return $this->hasMany(Line::class);
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }
}
