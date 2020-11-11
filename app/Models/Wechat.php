<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EasyWeChat\Factory;

class Wechat extends Model
{
    use HasFactory;

    // 静默授权
    const SCOPE_BASE = 0;
    // 非静默授权
    const SCOPE_USERINFO = 1;
    // 微信公众号
    const TYPE_MP = 0;
    // 微信小程序
    const TYPE_MIN = 1;

    protected $table = 'wechat';

    protected $fillable = ['type', 'name', 'logo', 'app_id', 'app_secret', 'redirect_url', 'success_url', 'scope'];

    public static $typeMap = [
        self::TYPE_MP => '公众号',
        self::TYPE_MIN => '小程序'
    ];

    public function getTypeNameAttribute()
    {
        return data_get(self::$typeMap, $this->attributes['type'], '未知类型');
    }

    public function getOfficialAccount()
    {
        $config = [
            'app_id' => $this->app_id,
            'secret' => $this->app_secret,

            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file' => storage_path('logs').'/wechat.log',
            ],
        ];
        $app = Factory::officialAccount($config);
        if ($this->type == self::TYPE_MIN){
            $app = Factory::miniProgram($config);
        }
        return $app;
    }
}
