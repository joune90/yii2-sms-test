# yii2-sms
Yii2 SMS extension （短信扩展）

包含接口：

* [中国云信](http://www.sms.cn/)
* [中国网建](http://www.smschinese.cn/)
* [商信通](http://www.sxtsms.com/)
* [云片网络](http://www.yunpian.com/)
* [云通讯](http://www.yuntongxun.com/)
* [螺丝帽](http://www.luosimao.com/)
* [创蓝](https://www.253.com)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/joune90/yii2-sms/composer.json) for this extension's requirements and dependencies.

To install, either run

```
$ php composer.phar require joune90/yii2-sms "*"
```

or add

```
"joune90/yii2-sms": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

```php
return [
    'components' => [
        'sms' => [
            // 中国云信
            'class' => 'joune90\sms\CloudSmser',
            'username' => 'username',
            'password' => 'password',
            'fileMode' => false
        ]
    ],
];
```

OR

```php
return [
    'components' => [
        'sms' => [
            // 创蓝
            'class' => 'joune90\sms\Chuanglan',
            'username' => 'username',
            'password' => 'password',
            'fileMode' => false
        ]
    ],
];
```

```php
Yii::$app->sms->send('15000000000', '短信内容');
```

```php

