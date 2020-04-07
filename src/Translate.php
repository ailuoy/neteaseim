<?php
/**
 * Created by PhpStorm.
 * User: ailuoy
 * Date: 2019/5/7
 * Time: 下午10:38
 */

namespace Ailuoy\NeteaseIm;


class Translate
{
    const FIELD_USER_ACCID = '网易云通信ID : ';
    const FIELD_USER_ACCIDS = '网易云通信ID\'S : ';
    const FIELD_USER_NAME = '用户昵称 : ';
    const FIELD_USER_ICON = '用户头像 : ';
    const FIELD_USER_SIGN = '用户签名 : ';
    const FIELD_USER_TOKEN = '用户token : ';
    const FIELD_USER_PROPS = '用户json数据 : ';
    const FIELD_USER_EMAIL = '用户email : ';

    const FIELD_CHATROOM_ROOM_ID = '聊天室id : ';

    const VALIDATE_REQUIRED = '字段必须填写';
    const VALIDATE_STRING = '类型必须是字符串';
    const VALIDATE_JSON = '类型必须是json';
    const VALIDATE_INT = '类型必须是整型';
    const VALIDATE_BOOLEAN = '类型必须是布尔型';

    const VALIDATE_MAX_16 = '最大16个字符';
    const VALIDATE_MAX_32 = '最大32个字符';
    const VALIDATE_MAX_64 = '最大64个字符';
    const VALIDATE_MAX_128 = '最大128个字符';
    const VALIDATE_MAX_256 = '最大256个字符';
    const VALIDATE_MAX_512 = '最大512个字符';
    const VALIDATE_MAX_1024 = '最大1024个字符';
    const VALIDATE_MAX_2048 = '最大2048个字符';
    const VALIDATE_MAX_4096 = '最大4096个字符';

    const VALIDATE_IN_STRING_TRUE_FALSE = '值只能是字符串类型的 true|false ';
}