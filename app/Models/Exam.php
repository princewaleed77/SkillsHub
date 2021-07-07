<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\App;



class Exam extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        // to relate the model to other fields in exam-user pivot table
        return $this->belongsToMany(User::class)
        ->withPivot('score', 'time_mins', 'status')
        ->withTimestamps();
    }

    //choose language set in session automaticaly insteade of using it  in blade views;
    public function name($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    //choose language set in session automaticaly insteade of using it in blade views;
    public function desc($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->desc)->$lang;
    }
}
