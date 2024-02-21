<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentHasClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function homeroom(): BelongsTo
    {
        return $this->belongsTo(HomeRoom::class, 'homeroom_id', 'id');
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
