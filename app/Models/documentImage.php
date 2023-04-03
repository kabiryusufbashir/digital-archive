<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'doc_path',
    ];
}
