<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTesterDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tester_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('api_id')->comment('');
            $table->string('title',50)->comment('接口名称');
            $table->string('uri',50)->comment('接口地址');
            $table->string('method',50)->comment('请求方式');
            $table->text('descs')->comment('接口描述');
            $table->text('api_param')->comment('接口参数');
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
        Schema::dropIfExists('api_tester_detail');
    }
}
