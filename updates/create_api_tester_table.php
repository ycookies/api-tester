<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tester', function (Blueprint $table) {
            $table->engine = 'MyISAM'; // InnoDB
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->default(0);
            $table->integer('order')->default(0)->nullable();
            $table->string('title',50)->comment('接口名称');
            $table->string('uri',50)->comment('接口地址');
            $table->string('method',50)->comment('请求方式')->default('GET');
            $table->string('type','100')->comment('请求类型')->nullable();
            $table->text('descs')->comment('接口描述')->nullable();
            $table->text('head_param')->comment('请求头参数')->nullable();
            $table->text('api_param')->comment('接口参数')->nullable();
            $table->text('resp_param')->comment('响应字段')->nullable();
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
        Schema::dropIfExists('api_tester');
    }
}
