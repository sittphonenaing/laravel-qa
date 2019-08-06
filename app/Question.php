<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title','body'];

    //a question is belongs to user;
    public function user(){
        return $this->belongsTo(User::class);
    }

    /* 
This mutator will be automatically called when we attempt to set the value of the title attribute on the model:
    */
    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);//my-first-title;
    }

    public function getUrlAttribute()
    {
        return route("questions.show",$this->slug);
    }
    //accessor start with get and attriubteName and ends with Attribute
    public function getCreatedDateAttribute()
    {
       return $this->created_at->diffForHumans();//like 1 day ago,1month ago.human readable.
    }
    public function getStatusAttribute()
    {
        if ($this->answers >0){
            if($this->answer_best_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    public function getBodyHtmlAttribute()

    {
        return \Parsedown::instance()->text($this->body);
    }
    
}
