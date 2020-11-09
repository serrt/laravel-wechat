<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat', function (Blueprint $table) {
            $table->id('id');
            $table->integer('type')->default(0)->comment('类型: 0公众号, 1小程序');
            $table->string('name', 100)->comment('名称');
            $table->string('logo')->nullable()->comment('logo图片');
            $table->string('app_id')->nullable();
            $table->string('app_secret')->nullable();
            $table->string('redirect_url')->nullable()->comment('在微信平台上配置的回跳地址');
            $table->string('success_url')->nullable()->comment('授权成功后的地址');
            $table->integer('scope')->default(0)->comment('网页授权: 0静默授权, 1非静默授权');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `wechat` comment '微信MP'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat');
    }
}
