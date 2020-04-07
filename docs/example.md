## 发送普通消息
- [各种消息的body文档](https://dev.yunxin.163.com/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E6%B6%88%E6%81%AF%E5%8A%9F%E8%83%BD?#%E6%B6%88%E6%81%AF%E6%A0%BC%E5%BC%8F%E7%A4%BA%E4%BE%8B)

### 发送文本消息
```php
$response  = $neteaseIm->msg->sendMsg->go('netease_3031', 0, 'netease_3032', 0, ['msg' => 'Hi']);
```

### 发送图片
```php
$response  = $neteaseIm->msg->sendMsg->go('netease_3031', 1, 'netease_3032', 1, [
            'name' => 'xxxx',
            'md5'  => 'xxxx',
            'url'  => 'http://www.ixiupet.com/uploads/allimg/160823/1101221M2-1.jpg?imageView&thumbnail=1680x0&quality=96&stripmeta=0&type=jpg',
            'ext'  => 'jpg',
            'w'    => 630,
            'h'    => 630,
            'size' => 1111
]);
```