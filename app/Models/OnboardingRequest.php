<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingRequest extends Model
{
    protected $fillable = [
        'business_type',
        'business_size',
        'sales_volume',
        'organization_method',
        'message',
        'name',
        'email',
        'phone',
        'company_name',
        'request_type',
        'images',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'images' => 'array',
        'submitted_at' => 'datetime',
    ];
}
