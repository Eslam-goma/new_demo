<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class broker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'country', 'package', 'password'];
    protected $hidden = ['password'];
    public function conventionTeamLeaders()
    {
        return $this->hasMany(convention_team_leader::class);
    }

}
