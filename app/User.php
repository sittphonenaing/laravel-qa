<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function getUrlAttribute()
    {
        //return route("questions.show",$this->id);
        return "#";
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function getAvatarAttribute()
    {
        $email = $this->email;        
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
    public function favorites()
    {
        return $this->belongsToMany(Question::class,'favorites')->withTimestamps();//user_id,question_id;
    }
    //this is for relationship model
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');//first column is related model and second is singular form ot table name so elquoent will recognize as votable is and votable type
    }
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }
    //this is custom function
    public function voteQuestion(Question $question, $vote)
    {
       $voteQuestion= $this->voteQuestions();

       //check if the question is already vote or not..if not insert new data
       if($voteQuestion->where('votable_id',$question->id)->exists()){

            $voteQuestion->updateExistingPivot($question,['vote' => $vote]);
       }else {
           $voteQuestion->attach($question,['vote'=> $vote]);
       };

       $question->load('votes');//refresh the votes column
       $upVotes= (int)$question->upVotes()->sum('vote');
       $downVotes= (int) $question->downVotes()->sum('vote');
       
       //insert total count to votes_count column
       $question->votes_count= $upVotes +$downVotes;

       $question->save();
    }

}
