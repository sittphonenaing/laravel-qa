<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{   
    use VotableTrait;
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
        if ($this->answers_count >0){
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
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();//question_id,user_id
    }
    public function isFavorited()
    {
        return $this->favorites()->where('user_id',auth()->id())->count() >0;
    }
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }
   
}
