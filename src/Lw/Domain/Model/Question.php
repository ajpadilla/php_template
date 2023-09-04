<?php

namespace Template\Php\Domain\Model;

use \Illuminate\Database\Eloquent\Model;

class Question extends Model {

  protected $table = 'questions';

  protected $fillable = ['question', 'user_id'];

  public static function create_question($question, $user_id) {
    $question = Question::create(['question' => $question, 'user_id' => $user_id]);
    return $question;
  }
}
