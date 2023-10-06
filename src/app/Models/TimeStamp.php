<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timestamp extends Model
{
    /**
     * モデルで使用するテーブル名を指定します。
     */
    protected $table = 'timestamp';

    /**
     * モデルで複数代入を許可する属性を指定します。
     */
    protected $fillable = [
        'start_time', 'end_time', 'break_time', 'break_end_time',
    ];

    /**
     * Timestamp モデルと Day モデルのリレーションシップを定義します。
     */
    public function days()
    {
        return $this->hasMany(Day::class);
    }
}
