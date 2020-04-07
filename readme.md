<p align="center">
    <h1 align="center">NeteaseIm</h1>
</p>

<p align="center">
    <a href="https://packagist.org/packages/ailuoy/neteaseim"><img src="https://travis-ci.org/mingyoung/dingtalk.svg" alt="Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/mingyoung/dingtalk/?branch=master"><img src="https://scrutinizer-ci.com/g/mingyoung/dingtalk/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"></a>
    <a href="https://packagist.org/packages/ailuoy/neteaseim"><img src="https://poser.pugx.org/mingyoung/dingtalk/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/ailuoy/neteaseim"><img src="https://poser.pugx.org/mingyoung/dingtalk/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/ailuoy/neteaseim"><img src="https://poser.pugx.org/mingyoung/dingtalk/license.svg" alt="License"></a>
</p>

## Introduce
NeteaseIm 封装了网易云信 IM即时通讯API 

## Requirement
- PHP 7.0+
- [Composer](https://getcomposer.org/)

## Installation
```bash
composer require ailuoy/neteaseim
```

## Usage
```php
$appId = 'your neteaseim appid';
$secret = 'your neteaseim secret';
$neteaseIm = new \Ailuoy\NeteaseIm\Client($appId, $secret);
try {
    $response = $neteaseIm->user->getUinfos->go(['1']);
} catch (\Ailuoy\NeteaseIm\Exceptions\NeteaseImException $e) {
    var_dump($e->getMessage());
}
var_dump($response);
```

## API List
### 网易云通信ID
- [x] [创建网易云通信ID](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E5%88%9B%E5%BB%BA%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID)
- [x] [网易云通信ID更新](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID%E6%9B%B4%E6%96%B0)
- [x] [更新并获取新token](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E6%9B%B4%E6%96%B0%E5%B9%B6%E8%8E%B7%E5%8F%96%E6%96%B0token)
- [x] [封禁网易云通信ID](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E5%B0%81%E7%A6%81%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID)
- [x] [解禁网易云通信ID](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID?#%E8%A7%A3%E7%A6%81%E7%BD%91%E6%98%93%E4%BA%91%E9%80%9A%E4%BF%A1ID)
### 用户名片
- [x] [更新用户名片](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87?#%E6%9B%B4%E6%96%B0%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87)
- [x] [获取用户名片](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87?#%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7%E5%90%8D%E7%89%87)
### 用户设置
- [x] [设置桌面端在线时，移动端是否需要推送](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E8%AE%BE%E7%BD%AE?#%E8%AE%BE%E7%BD%AE%E6%A1%8C%E9%9D%A2%E7%AB%AF%E5%9C%A8%E7%BA%BF%E6%97%B6%EF%BC%8C%E7%A7%BB%E5%8A%A8%E7%AB%AF%E6%98%AF%E5%90%A6%E4%B8%8D%E6%8E%A8%E9%80%81)
- [x] [账号全局禁言](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E8%AE%BE%E7%BD%AE?#%E8%B4%A6%E5%8F%B7%E5%85%A8%E5%B1%80%E7%A6%81%E8%A8%80)
- [x] [账号全局禁用音视频](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E8%AE%BE%E7%BD%AE?#%E8%B4%A6%E5%8F%B7%E5%85%A8%E5%B1%80%E7%A6%81%E7%94%A8%E9%9F%B3%E8%A7%86%E9%A2%91)
### 用户关系依托
- [x] [加好友](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E5%8A%A0%E5%A5%BD%E5%8F%8B)
- [x] [更新好友相关信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E6%9B%B4%E6%96%B0%E5%A5%BD%E5%8F%8B%E7%9B%B8%E5%85%B3%E4%BF%A1%E6%81%AF)
- [x] [删除好友](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E5%88%A0%E9%99%A4%E5%A5%BD%E5%8F%8B)
- [x] [获取好友关系](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E8%8E%B7%E5%8F%96%E5%A5%BD%E5%8F%8B%E5%85%B3%E7%B3%BB)
- [x] [设置黑名单/静音](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E8%AE%BE%E7%BD%AE%E9%BB%91%E5%90%8D%E5%8D%95/%E9%9D%99%E9%9F%B3)
- [x] [查看指定用户的黑名单和静音列表](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%94%A8%E6%88%B7%E5%85%B3%E7%B3%BB%E6%89%98%E7%AE%A1?#%E6%9F%A5%E7%9C%8B%E6%8C%87%E5%AE%9A%E7%94%A8%E6%88%B7%E7%9A%84%E9%BB%91%E5%90%8D%E5%8D%95%E5%92%8C%E9%9D%99%E9%9F%B3%E5%88%97%E8%A1%A8)
### 消息功能
- [x] [发送普通消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E5%8F%91%E9%80%81%E6%99%AE%E9%80%9A%E6%B6%88%E6%81%AF)
- [x] [批量发送点对点普通消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%89%B9%E9%87%8F%E5%8F%91%E9%80%81%E7%82%B9%E5%AF%B9%E7%82%B9%E6%99%AE%E9%80%9A%E6%B6%88%E6%81%AF)
- [x] [发送自定义系统通知](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E5%8F%91%E9%80%81%E8%87%AA%E5%AE%9A%E4%B9%89%E7%B3%BB%E7%BB%9F%E9%80%9A%E7%9F%A5)
- [x] [批量发送点对点自定义系统通知](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%89%B9%E9%87%8F%E5%8F%91%E9%80%81%E7%82%B9%E5%AF%B9%E7%82%B9%E8%87%AA%E5%AE%9A%E4%B9%89%E7%B3%BB%E7%BB%9F%E9%80%9A%E7%9F%A5)
- [x] [文件上传](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%96%87%E4%BB%B6%E4%B8%8A%E4%BC%A0)
- [ ] [文件上传（multipart方式）](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%96%87%E4%BB%B6%E4%B8%8A%E4%BC%A0%EF%BC%88multipart%E6%96%B9%E5%BC%8F%EF%BC%89)
- [ ] [上传NOS文件清理任务](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E4%B8%8A%E4%BC%A0NOS%E6%96%87%E4%BB%B6%E6%B8%85%E7%90%86%E4%BB%BB%E5%8A%A1)
- [x] [消息撤回](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%B6%88%E6%81%AF%E6%92%A4%E5%9B%9E)
- [ ] [发送广播消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E5%8F%91%E9%80%81%E5%B9%BF%E6%92%AD%E6%B6%88%E6%81%AF)
### 群组功能（高级群）
- [x] [创建群](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E5%88%9B%E5%BB%BA%E7%BE%A4)
- [x] [拉人入群](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E6%8B%89%E4%BA%BA%E5%85%A5%E7%BE%A4)
- [x] [踢人出群](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%B8%A2%E4%BA%BA%E5%87%BA%E7%BE%A4)
- [x] [解散群](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%A7%A3%E6%95%A3%E7%BE%A4)
- [x] [编辑群资料](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%BC%96%E8%BE%91%E7%BE%A4%E8%B5%84%E6%96%99)
- [x] [群信息与成员列表查询](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%BE%A4%E4%BF%A1%E6%81%AF%E4%B8%8E%E6%88%90%E5%91%98%E5%88%97%E8%A1%A8%E6%9F%A5%E8%AF%A2)
- [x] [获取群组详细信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E7%BE%A4%E7%BB%84%E8%AF%A6%E7%BB%86%E4%BF%A1%E6%81%AF)
- [x] [获取群组已读消息的已读详情信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E7%BE%A4%E7%BB%84%E5%B7%B2%E8%AF%BB%E6%B6%88%E6%81%AF%E7%9A%84%E5%B7%B2%E8%AF%BB%E8%AF%A6%E6%83%85%E4%BF%A1%E6%81%AF)
- [x] [移交群主](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%A7%BB%E4%BA%A4%E7%BE%A4%E4%B8%BB)
- [x] [任命管理员](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BB%BB%E5%91%BD%E7%AE%A1%E7%90%86%E5%91%98)
- [x] [移除管理员](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%A7%BB%E9%99%A4%E7%AE%A1%E7%90%86%E5%91%98)
- [x] [获取某用户所加入的群信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E6%9F%90%E7%94%A8%E6%88%B7%E6%89%80%E5%8A%A0%E5%85%A5%E7%9A%84%E7%BE%A4%E4%BF%A1%E6%81%AF)
- [x] [修改群昵称](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BF%AE%E6%94%B9%E7%BE%A4%E6%98%B5%E7%A7%B0)
- [x] [修改消息提醒开关](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%BF%AE%E6%94%B9%E6%B6%88%E6%81%AF%E6%8F%90%E9%86%92%E5%BC%80%E5%85%B3)
- [x] [禁言群成员](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E7%A6%81%E8%A8%80%E7%BE%A4%E6%88%90%E5%91%98)
- [x] [主动退群](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E4%B8%BB%E5%8A%A8%E9%80%80%E7%BE%A4)
- [x] [将群组整体禁言](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E5%B0%86%E7%BE%A4%E7%BB%84%E6%95%B4%E4%BD%93%E7%A6%81%E8%A8%80)
- [x] [获取群组禁言列表](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E7%BE%A4%E7%BB%84%E5%8A%9F%E8%83%BD%EF%BC%88%E9%AB%98%E7%BA%A7%E7%BE%A4%EF%BC%89?#%E8%8E%B7%E5%8F%96%E7%BE%A4%E7%BB%84%E7%A6%81%E8%A8%80%E5%88%97%E8%A1%A8)
### 聊天室
- [x] [创建聊天室](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%9B%E5%BB%BA%E8%81%8A%E5%A4%A9%E5%AE%A4)
- [x] [查询聊天室信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9F%A5%E8%AF%A2%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF)
- [x] [批量查询聊天室信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%89%B9%E9%87%8F%E6%9F%A5%E8%AF%A2%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF)
- [x] [更新聊天室信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9B%B4%E6%96%B0%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BF%A1%E6%81%AF)
- [x] [修改聊天室开/关闭状态](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BF%AE%E6%94%B9%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%BC%80/%E5%85%B3%E9%97%AD%E7%8A%B6%E6%80%81)
- [x] [设置聊天室内用户角色](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E8%AE%BE%E7%BD%AE%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E7%94%A8%E6%88%B7%E8%A7%92%E8%89%B2)
- [x] [请求聊天室地址](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E8%AF%B7%E6%B1%82%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%9C%B0%E5%9D%80)
- [x] [发送聊天室消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%8F%91%E9%80%81%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%B6%88%E6%81%AF)
- [x] [往聊天室内添加机器人](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%BE%80%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E6%B7%BB%E5%8A%A0%E6%9C%BA%E5%99%A8%E4%BA%BA)
- [x] [从聊天室内删除机器人](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BB%8E%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E5%88%A0%E9%99%A4%E6%9C%BA%E5%99%A8%E4%BA%BA)
- [x] [设置临时禁言状态](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E8%AE%BE%E7%BD%AE%E4%B8%B4%E6%97%B6%E7%A6%81%E8%A8%80%E7%8A%B6%E6%80%81)
- [x] [往聊天室有序队列中新加或更新元素](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%BE%80%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%9C%89%E5%BA%8F%E9%98%9F%E5%88%97%E4%B8%AD%E6%96%B0%E5%8A%A0%E6%88%96%E6%9B%B4%E6%96%B0%E5%85%83%E7%B4%A0)
- [x] [从队列中取出元素](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E4%BB%8E%E9%98%9F%E5%88%97%E4%B8%AD%E5%8F%96%E5%87%BA%E5%85%83%E7%B4%A0)
- [x] [排序列出队列中所有元素](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%8E%92%E5%BA%8F%E5%88%97%E5%87%BA%E9%98%9F%E5%88%97%E4%B8%AD%E6%89%80%E6%9C%89%E5%85%83%E7%B4%A0)
- [x] [删除清理整个队列](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%A0%E9%99%A4%E6%B8%85%E7%90%86%E6%95%B4%E4%B8%AA%E9%98%9F%E5%88%97)
- [x] [初始化队列](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%9D%E5%A7%8B%E5%8C%96%E9%98%9F%E5%88%97)
- [x] [将聊天室整体禁言](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%B0%86%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%95%B4%E4%BD%93%E7%A6%81%E8%A8%80)
- [x] [查询聊天室统计指标TopN](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9F%A5%E8%AF%A2%E8%81%8A%E5%A4%A9%E5%AE%A4%E7%BB%9F%E8%AE%A1%E6%8C%87%E6%A0%87TopN)
- [x] [分页获取成员列表](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%88%86%E9%A1%B5%E8%8E%B7%E5%8F%96%E6%88%90%E5%91%98%E5%88%97%E8%A1%A8)
- [x] [批量获取在线成员信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%89%B9%E9%87%8F%E8%8E%B7%E5%8F%96%E5%9C%A8%E7%BA%BF%E6%88%90%E5%91%98%E4%BF%A1%E6%81%AF)
- [x] [变更聊天室内的角色信息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%8F%98%E6%9B%B4%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%86%85%E7%9A%84%E8%A7%92%E8%89%B2%E4%BF%A1%E6%81%AF)
- [x] [批量更新聊天室队列元素](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%89%B9%E9%87%8F%E6%9B%B4%E6%96%B0%E8%81%8A%E5%A4%A9%E5%AE%A4%E9%98%9F%E5%88%97%E5%85%83%E7%B4%A0)
- [x] [查询用户创建的开启状态聊天室列表](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E6%9F%A5%E8%AF%A2%E7%94%A8%E6%88%B7%E5%88%9B%E5%BB%BA%E7%9A%84%E5%BC%80%E5%90%AF%E7%8A%B6%E6%80%81%E8%81%8A%E5%A4%A9%E5%AE%A4%E5%88%97%E8%A1%A8)
### 历史记录
- [x] [单聊云端历史消息查询](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E5%8D%95%E8%81%8A%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF%E6%9F%A5%E8%AF%A2)
- [x] [群聊云端历史消息查询](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E7%BE%A4%E8%81%8A%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF%E6%9F%A5%E8%AF%A2)
- [x] [聊天室云端历史消息查询](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF%E6%9F%A5%E8%AF%A2)
- [x] [删除聊天室云端历史消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E5%88%A0%E9%99%A4%E8%81%8A%E5%A4%A9%E5%AE%A4%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF)
- [x] [用户登录登出事件记录查询](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95%E7%99%BB%E5%87%BA%E4%BA%8B%E4%BB%B6%E8%AE%B0%E5%BD%95%E6%9F%A5%E8%AF%A2)
- [x] [批量查询广播消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E6%89%B9%E9%87%8F%E6%9F%A5%E8%AF%A2%E5%B9%BF%E6%92%AD%E6%B6%88%E6%81%AF)
- [x] [查询单条广播消息](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%8E%86%E5%8F%B2%E8%AE%B0%E5%BD%95?#%E6%9F%A5%E8%AF%A2%E5%8D%95%E6%9D%A1%E5%B9%BF%E6%92%AD%E6%B6%88%E6%81%AF)
### 在线状态
- [x] [订阅在线状态事件](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E8%AE%A2%E9%98%85%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6)
- [x] [取消在线状态事件订阅](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E5%8F%96%E6%B6%88%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6%E8%AE%A2%E9%98%85)
- [x] [取消全部在线状态事件订阅](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E5%8F%96%E6%B6%88%E5%85%A8%E9%83%A8%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6%E8%AE%A2%E9%98%85)
- [x] [查询在线状态事件订阅关系](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81?#%E6%9F%A5%E8%AF%A2%E5%9C%A8%E7%BA%BF%E7%8A%B6%E6%80%81%E4%BA%8B%E4%BB%B6%E8%AE%A2%E9%98%85%E5%85%B3%E7%B3%BB)

## todo
- [ ] 目前没有检查json count 的[rule](https://learnku.com/docs/laravel/5.8/validation/3899#rule-size) 所以先暂时去掉json的元素个数统计,看是否可以自定义validate规则