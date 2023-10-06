<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    // モデルがデータベースの 'days' テーブルに関連付けられていることを指定
    protected $table = 'days';

    // 複数代入を許可する属性
    protected $fillable = ['day', 'user_id', 'timestamp_id'];

    // 'day' 列を日付型として扱うための属性
    protected $dates = ['day'];

    // Day モデルと User モデルのリレーションシップを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Day モデルと Timestamp モデルのリレーションシップを定義
    public function timestamp()
    {
        return $this->belongsTo(Timestamp::class);
    }
}
