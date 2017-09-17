<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumUser
 *
 * @property int $user_special_id
 * @property int $user_id
 * @property int $doc_id
 * @property int $doc_type
 *
 * @package App\Models
 */
class CurriculumUser extends Eloquent
{
    protected $table = 'curriculum_user';
    protected $primaryKey = 'curr_user_id';
    public $timestamps = false;
    const CREATED_AT = 'created';

    protected $casts = [
        'curr_user_id' => 'int',
        'curriculum_id' => 'int',
        'user_id' => 'int'
    ];

    protected $dates = [
        'created'
    ];

    protected $fillable = [
        'curriculum_id',
        'user_id',
        'created',
        'creator'
    ];

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created'] = \Carbon\Carbon::now();
    }
}
