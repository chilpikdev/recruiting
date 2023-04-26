<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Vakancy;
use App\Models\Admin\Resume;

class CheckedVakancy extends Model
{
    use HasFactory;

    protected $table = "checked_vakancies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vakancy_id',
        'author_id',
        'resume_id',
    ];

    public function getVakancy() {
        return $this->hasOne(Vakancy::class, 'id', 'vakancy_id');
    }

    public function getResume() {
        return $this->hasOne(Resume::class, 'id', 'resume_id');
    }
}
