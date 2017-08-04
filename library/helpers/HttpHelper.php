<?php
namespace app\library\helpers;
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 16:49
 */
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Cookie;

class HttpHelper
{
    public static function postOrGet($key, $default = '')
    {
        $val = \Yii::$app->request->post($key);
        if (null == $val) {
            $val = \Yii::$app->request->get($key);
        }

        return $val !== null ? trim($val) : $default;
    }


    public static function postOrGets(array $skipFields = [])
    {
        $gets = Yii::$app->request->get();
        $posts = Yii::$app->request->post();

        $out = ArrayHelper::merge($gets, $posts);
        if ($skipFields) {
            foreach ($skipFields as $skipField) {
                unset($out[$skipField]);
            }
        }
        foreach ($out as &$value) {
            $value = trim($value);
        }

        return $out;
    }

    public static function antiInject($value)
    {
        $value = str_replace("'", "", $value);

        return str_replace("\\", "", $value);
    }

    public static function postOrGetLimit()
    {
        $val = static::postOrGet('limit', 15);
        if ($val <= 0) {
            $val = 15;
        }
        if ($val > 50) {
            $val = 50;
        }

        return $val;
    }

    public static function setCookie(
        $name,
        $val,
        $expire = 0,
        $path = '/',
        $domain = '',
        $httpOnly=true
    ) {
        $cookies = \Yii::$app->response->cookies;

        $cookies->add(new Cookie([
            'name' => $name,
            'value' => $val,
            'expire' => $expire,
            'path' => $path,
            'domain' => $domain,
            'httpOnly'=>$httpOnly
        ]));
    }

    public static function deleteCookie($name)
    {
        $cookies = \Yii::$app->response->cookies;

        $cookies->remove($name);
    }

    /**
     * @param string $name cookie name
     *
     * @return null|string cookie value
     */
    public static function getCookie($name)
    {
        $cookie = \Yii::$app->request->cookies->get($name);
        if (null != $cookie) {
            return $cookie->value;
        }

        return null;
    }

    public static function curlGet(
        $url,
        $connect_timeout = 10,
        $timeout = 30,
        $optionalHeaders = array()
    ) {
        $ch = curl_init();
        if ($ch === false) {
            Yii::warning("init curlGet fail url: $url ", 'system');

            return false;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,
            $connect_timeout); // wait to connect
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//wait to execute
        curl_setopt($ch, CURLOPT_HTTPHEADER, $optionalHeaders);

        $result = curl_exec($ch);
        if ($result === false) {
            curl_close($ch);
            Yii::warning("exec curlGet fail url: $url result:".json_encode($result), 'system');

            return false;
        }
        curl_close($ch);

        return $result;
    }

    public static function curlPost(
        $url,
        $data,
        $connect_timeout = 10,
        $timeout = 30,
        $headers = [],
        $shouldBuildQuery = true
    ) {
        $ch = curl_init();
        if ($ch === false) {
            Yii::warning("init curlPost fail url: $url data:"
                .Json::encode($data), 'system');

            return false;
        }

        //对于上传文件,不要进行http_build_query
        if (is_array($data) && $shouldBuildQuery) {
            $data = http_build_query($data);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,
            $connect_timeout); // wait to connect
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//wait to execute
        if (empty($headers)) {
            $headers[]
                = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        if ($result === false) {
            curl_close($ch);
            Yii::warning("exec curlPost fail url: $url data:"
                .Json::encode($data),
                'system');

            return false;
        }
        curl_close($ch);

        return $result;
    }

    public static function redirect($url, $statusCode = 303)
    {
        header('Location: '.$url, true, $statusCode);
        exit(0);
    }

    public static function appendParameters($url, array $parameters)
    {
        if (!is_array($parameters)) {
            throw new InvalidParamException("参数无效".Json::encode($parameters));
        }
        $parameterPair = [];
        foreach ($parameters as $key => $value) {
            if($value){
                $parameterPair[] = $key.'='.$value;
            }
        }
        $separator = strpos($url, '?') === false ? '?' : '&';

        return $url.$separator.implode('&', $parameterPair);
    }

    public static function setSession($cookieName, $cookieValue)
    {
        HttpHelper::setCookie($cookieName, $cookieValue, 1735664461);
    }

    public static function getErrorPage()
    {
        $host = Yii::$app->params['system']['host'];

        return $host."error.html";
    }
}