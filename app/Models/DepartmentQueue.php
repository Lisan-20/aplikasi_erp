<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'crm_client_id',
        'service_requested',
        'priority',
        'status',
        'raw_message',
    ];

    public function crmClient()
    {
        return $this->belongsTo(CrmClient::class);
    }
}
