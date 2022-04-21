<?php

namespace App\Models;

use Database\Factories\FormDataFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable = [
        'form_data_id',
        'result',
    ];

    public function formData(): BelongsTo
    {
        return $this->belongsTo(FormData::class, 'form_data_id');
    }
}
