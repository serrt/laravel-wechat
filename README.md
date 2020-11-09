# Laravel-wechat

## 环境要求

- php >= 7.4
- nginx

## Feature

### Wechat JS-SDK

文档[https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html]

- 地址: `POST`, `{{host}}/api/js-config`
- 参数

| 名称 | 类型 | 必填 | 备注 |
| -- | -- | -- | -- |
| id | int | 否 | 公众号ID, 由管理员提供 |
| origin | string | 否 | 当前URL路径 |
| referer | string | 否 | 来源URL路径 |
| configure| array  | 否 | 需要使用的JS接口列表, 默认 ['updateAppMessageShareData', 'updateTimelineShareData'] |
| debug | boolean | 否 | 开启调试模式, 默认 false |
| json | boolean | 否 | 是否返回JSON字符串, 默认 false |
