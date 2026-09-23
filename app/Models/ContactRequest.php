<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'business_type',
        'business_size',
        'sales_volume',
        'organization_method',
        'message',
        'images',
        'type',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
