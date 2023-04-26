<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Position;
use App\Models\Admin\Skill;

class Vakancy extends Model
{
    use HasFactory;

    protected $table = "vakancies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'position_id',
        'user_id',
        'salary',
        'work_procedures',
        'views',
    ];

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getPosition() {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function getSkills() {
        return $this->belongsToMany(Skill::class);
    }
}
