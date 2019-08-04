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
    
}
