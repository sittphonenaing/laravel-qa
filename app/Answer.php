<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{   
    protected $fillable = ['body','user_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function user()

    {
        return $this->belongsTo(User::class);
    }
    public function getBodyHtmlAttribute()

    {
        return \Parsedown::instance()->text($this->body);
    }

    //manually register elquoent event
    public static function boot()
    {
        parent::boot();
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
                       
        });
        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
        });
    }
    public function getCreatedDateAttribute()
    {
       return $this->created_at->diffForHumans();//like 1 day ago,1month ago.human readable.
    } 
    public function getStatusAttribute()
    {
        return $this->id === $this->question->best_answer_id ? "vote-accepted" : "";
    }    
}
