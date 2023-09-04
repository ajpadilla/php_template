<?php

namespace Template\Php\Domain\Model;

use \Illuminate\Database\Eloquent\Model;

class User extends Model {

  protected $table = 'users';

  protected $fillable = ['username', 'email', 'password'];

  public static function create_user($username, $email, $password) {
    $user = User::create(['username' => $username, 'email' => $email, 'password' => $password]);
    return $user;
  }

  public function questions() {
    return $this->hasMany('\Template\Php\Domain\Model\Question', 'user_id');
  }
}
