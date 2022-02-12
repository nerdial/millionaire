<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Option
 *
 * @property $id
 * @property $title
 * @property $question_id
 * @property $is_correct
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Option extends Model
{

    static $rules = [
        'title' => 'required',
        'question_id' => 'required',
        'is_correct' => 'required|boolean',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','question_id','is_correct'];


    protected $visible = [
      'id' , 'title', 'is_correct'
    ];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    use HasFactory;
}
