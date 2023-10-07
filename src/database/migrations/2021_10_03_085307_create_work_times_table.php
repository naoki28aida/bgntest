<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTimesTable extends Migration  // ← クラス名を変更
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->id();
            $table->time('work_start_time')->nullable();  // ← カラム名を変更
            $table->time('work_end_time')->nullable();    // ← カラム名を変更
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('day_id')->constrained('days')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_times');  // ← テーブル名を変更
    }
}
