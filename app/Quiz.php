<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
   protected $table = 'quiz';

 	public $timestamps = false;

    protected $fillable = [
      "mainquestion_1","mainquestion_2","question1_1","question2_1",
      "question2_2_1","lastquestion1_1","lastquestion2_1","question1_2","question2_2",
        "question1_2_1","lastquestion1_2","lastquestion2_2","answer1_1", 'answer1_1_2',
      'answer2_1_2','answer1_2','answer2_2','answer1_2_2','updated_at'
    ];
}
