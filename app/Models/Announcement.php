<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Announcement
 * 
 * @property int $anno_id
 * @property string $anno_title
 * @property string $anno_title_en
 * @property string $anno_detail
 * @property string $anno_detail_en
 * @property string $anno_flag
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Announcement extends Eloquent {

    protected $table = 'announcement';
    protected $primaryKey = 'anno_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $dates = [
        'created',
        'modified'
    ];
    protected $casts = [
        'anno_seq' => 'int'
        ];
    protected $fillable = [
        'anno_title',
        'anno_title_en',
        'anno_detail',
        'anno_detail_en',
        'anno_flag',
        'creator',
        'created',
        'modifier',
        'modified'
    ];

}
