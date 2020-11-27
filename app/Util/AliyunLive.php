<?php


namespace App\Util;


class AliyunLive
{

    const PLAY_TYPE_RTMP = "RTMP";
    const PLAY_TYPE_FLV = "FLV";
    const PLAY_TYPE_M3U8 = "M3U8";
    const PALY_TYPE_UDP = "UDP";//UDP格式即低延迟直播RTS使用地址，需提前开通RTS服务

    /**
     * @var self
     */
    public static $instance;

    /**
     * AliyunLive constructor.
     * 禁止new
     */
    private function __construct(){}

    /**
     * 禁止clone
     */
    private function __clone(){}

    /**
     * 全局唯一实例化对象
     * @return static
     */
    public static function getInstance() :self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 生成推流地址
     * @param string $pushDomain
     * @param string $pushKey
     * @param int $expireTime
     * @param string $appName
     * @param string $streamName
     * @return string
     */
    public function pushUrl(string $pushDomain, string $pushKey, int $expireTime, string $appName, string $streamName) :string
    {
        //未开启鉴权Key的情况下
        if($pushKey==''){
            $pushUrl = "rtmp://{$pushDomain}/{$appName}/{$streamName}";
        } else {
            $timeStamp = time() + $expireTime;
            $sstring = "/{$appName}/{$streamName}-{$timeStamp}-0-0-{$pushKey}";
            $md5hash = md5($sstring);
            $pushUrl = "rtmp://{$pushDomain}/{$appName}/{$streamName}?auth_key={$timeStamp}-0-0-{$md5hash}";
        }
        return $pushUrl;
    }

    /**
     * 生成播流地址
     * @param string $playDomain
     * @param string $playKey 为空就是 未开启鉴权Key
     * @param int $expireTime
     * @param string $appName
     * @param string $streamName
     * @param string $type
     * @return string|null
     * @throws \Exception
     */
    public function playUrl(string $playDomain, string $playKey, int $expireTime, string $appName, string $streamName, string $type = self::PLAY_TYPE_M3U8) :?string
    {
        $timeStamp = time() + $expireTime;
        switch ($type) {
            case self::PLAY_TYPE_M3U8:
                if ($playKey == '') {
                    $playUrl = "https://{$playDomain}/{$appName}/{$streamName}.m3u8";
                } else {
                    $hlsSstring = "/{$appName}/{$streamName}.m3u8-{$timeStamp}-0-0-{$playKey}";
                    $hlsMd5hash = md5($hlsSstring);
                    $playUrl = "https://{$playDomain}/{$appName}/{$streamName}.m3u8?auth_key={$timeStamp}-0-0-{$hlsMd5hash}";
                }
                break;
            case self::PLAY_TYPE_RTMP:
                if ($playKey == '') {
                    $playUrl = "rtmp://{$playDomain}/{$appName}/{$streamName}";
                } else {
                    $rtmpSstring = "/{$appName}/{$streamName}-{$timeStamp}-0-0-{$playKey}";
                    $rtmpMd5hash = md5($rtmpSstring);
                    $playUrl = "rtmp://{$playDomain}/{$appName}/{$streamName}?auth_key={$timeStamp}-0-0-{$rtmpMd5hash}";
                }
                break;
            case self::PLAY_TYPE_FLV:
                if ($playKey == '') {
                    $playUrl = "http://{$playDomain}/{$appName}/{$streamName}.flv";
                } else {
                    $flvSstring = "/{$appName}/{$streamName}.flv-{$timeStamp}-0-0-{$playKey}";
                    $flvMd5hash = md5($flvSstring);
                    $playUrl    = "http://{$playDomain}/{$appName}/{$streamName}.flv?auth_key={$timeStamp}-0-0-{$flvMd5hash}";
                }
                break;
            case self::PALY_TYPE_UDP:
                if ($playKey == '') {
                    $playUrl = "artc://{$playDomain}/{$appName}/{$streamName}";
                } else {
                    $udpString  = "/{$appName}/{$streamName}-{$timeStamp}-0-0-{$playKey}";
                    $udpMd5hash = md5($udpString);
                    $playUrl    = "artc://{$playDomain}/{$appName}/{$streamName}?auth_key={$timeStamp}-0-0-{$udpMd5hash}";
                }
                break;
            default:
                throw new \Exception("请选择正确的播放方式");
        }
        return $playUrl;
    }

}
