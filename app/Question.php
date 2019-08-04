<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//a question is belongs to user;
class Question extends Model
{
    protected $fillable=['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    };

    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug('$value');//my-first-title;
    }
}
