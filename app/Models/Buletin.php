<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buletin extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'file_path',
        'bulan',
        'tahun',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'bulan' => 'integer',
            'tahun' => 'integer',
        ];
    }
}
