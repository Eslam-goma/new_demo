<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class convention_team_leader extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'activity', 'permanent_address', 'password', 'broker_id'];

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    protected $hidden = ['password'];
}

