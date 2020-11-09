<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use Overtrue\LaravelWeChat\Facade as EasyWechat;
use App\Models\Wechat;

class WechatController extends Controller
{
    public function jsConfig(Request $request)
    {
        if ($request->has('id')) {
            $wechat = $this->getWechat($request->input('id', 1));
            $officialAccount = $wechat->getOfficialAccount();
        } else {
            $officialAccount = EasyWeChat::officialAccount();
        }
        $origin = $request->header('origin', $request->input('origin'));
        $referer = $request->header('Referer', $request->input('referer'));

        if ($referer) {
            $officialAccount->jssdk->setUrl($referer);
        }

        $jsConfigure = $request->post('configure', ['updateAppMessageShareData', 'updateTimelineShareData']);

        if (is_string($jsConfigure)) {
            $jsConfigure = json_decode($jsConfigure, true);
        }

        $debug = $request->input('debug', false);
        $json = $request->has('json') ? true : false;

        $configure = $officialAccount->jssdk->buildConfig($jsConfigure, $debug, false, $json);

        return $this->json($configure);
    }

    protected function getWechat($id)
    {
        $wechat = Wechat::find($id);

        abort_if(!$wechat, Response::HTTP_BAD_REQUEST, $id.' 公众号尚未在后台添加');

        return $wechat;
    }
}
