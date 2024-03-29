<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 14:32
 */
namespace joune90\sms;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;

/**
 * 创蓝短信平台
 *
 * @author Cosmo <joune90@gmail.com>
 * @property string $password write-only password
 * @property string $state read-only state
 * @property string $message read-only message
 */
class ChuanglanSms extends Sms
{
    /**
     * @inheritdoc
     */
    public $url = 'http://sapi.253.com/msg/HttpBatchSendSM';

    /**
     * @inheritdoc
     */
    public function send($mobile, $content)
    {
//        if (parent::send($mobile, $content)) {
//            return true;
//        }

        $data = [
            'account' => $this->username,
            'pswd' => $this->password,
            'mobile' => $mobile,
            'msg' => $content
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $result = curl_exec($ch);
        curl_close($ch);

        $resultArr = [];
        parse_str($result, $resultArr);


        $this->state = isset($resultArr['stat']) ? (string) $resultArr['stat'] : null;
        $this->message = isset($resultArr['message']) ? (string) $resultArr['message'] : null;

        return $this->state === '100';
    }

    /**
     * 设置密码
     *
     * @param string $password
     * @throws InvalidConfigException
     */
    public function setPassword($password)
    {
        if ($this->username === null) {
            throw new InvalidConfigException('用户名不能为空');
        }

        $this->password = $password;
    }

    /**
     * @inheritdoc
     */
    public function sendByTemplate($mobile, $data, $id)
    {
        throw new NotSupportedException('中国云信不支持发送模板短信！');
    }
}