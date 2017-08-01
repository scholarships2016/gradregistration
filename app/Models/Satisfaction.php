<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Satisfaction
 * 
 * @property int $SATI_NO
 * @property string $stu_citizen_card
 * @property string $SATI_LEVEL
 * @property string $SATI_SUGGESTION
 * @property int $CREATED
 * @property string $CREATOR
 * @property int $MODIFIED
 * @property string $MODIFIER
 *
 * @package App\Models
 */
class Satisfaction extends Eloquent {

    protected $table = 'satisfaction';
    protected $primaryKey = 'SATI_NO';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'CREATED' => 'int',
        'MODIFIED' => 'int'
    ];
    protected $fillable = [
        'stu_citizen_card',
        'SATI_LEVEL',
        'SATI_SUGGESTION',
        'CREATED',
        'CREATOR',
        'MODIFIED',
        'MODIFIER'
    ];

}
