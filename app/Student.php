<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = [
      'first_name',
      'last_name',
      'email_address',
      'active_whatsapp_number',
      'task_completion',
      'comprehensibility',
      'fluency',
      'vocabulary',
      'language_control',
      'score',
      'comment',
      'scored',
  ];
}
