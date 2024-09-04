<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotentialCustomer extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'email',
        'name',
        'country',
        'phone',
        'broker_id',
        'status',
        'agent_id',
    ];

    // Define the relationship with the Broker model
    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    // Define the relationship with the Agent model
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
