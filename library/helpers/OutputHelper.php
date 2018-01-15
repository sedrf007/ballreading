<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/17
 * Time: 16:50
 */

namespace app\library\helpers;


class OutputHelper
{
    public static function makeOutput(
        $returnCode,
        $message = '',
        $data = [],
        $pagerInfo = []
    ) {
        if (is_int($returnCode)) {
            $returnCode = (string)$returnCode;
        }
        $ret['return_code'] = $returnCode;
        $ret['return_message'] = $message;
        $ret['data'] = $data;
        if (!empty($pagerInfo)) {
            $ret['pager_info'] = $pagerInfo;
        }
        return json_encode($ret);
    }

    public static function makeSuccOutput($data = [], $pagerInfo = [])
    {
        $ret['return_code'] = '0';
        $ret['return_message'] = '';
        $ret['data'] = $data;
        if (!empty($pagerInfo)) {
            $ret['pager_info'] = $pagerInfo;
        }
        return json_encode($ret);
    }
}