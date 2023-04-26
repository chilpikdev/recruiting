<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Resume extends Model
{
    use HasFactory;

    protected $table = "resumes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'files',
        'experience',
        'expected_salary',
    ];

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getPositions() {
        return $this->belongsToMany(Position::class);
    }

    public function getSkills() {
        return $this->belongsToMany(Skill::class);
    }

    public function getLanguages() {
        return $this->belongsToMany(Language::class);
    }
}
