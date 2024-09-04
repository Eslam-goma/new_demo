<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'country', 'package', 'password', 'convention_team_leader_id'];

    // علاقة كثير لـ واحد مع ConventionTeamLeader
    public function conventionTeamLeader()
    {
        return $this->belongsTo(convention_team_leader::class);
    }
}
