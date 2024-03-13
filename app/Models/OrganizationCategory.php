<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationCategory extends Model
{
    use HasFactory;
    protected $table = 'organization_category';

    protected $fillable = [
        'name'
    ];
}
