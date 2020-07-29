<?php

namespace homevip;

/**
 * 企业微信 API
 */
class EntWechat
{
    /**
     * access_token 前缀
     *
     * @var string
     */
    private $access_token_key = 'EntWechat_access_token';


    /**
     * 接口地址
     *
     * @var string
     */
    public $url = 'https://qyapi.weixin.qq.com/cgi-bin/';


    /**
     * 企业ID
     *
     * @var string
     */
    public $corpid      = NULL;


    /**
     * 应用的凭证密钥
     *
     * @var string
     */
    public $corpsecret  = NULL;



    /**
     * 初始化参数
     *
     * @param string $corpid
     * @param string $corpsecret
     */
    public function __construct(string $corpid, string $corpsecret)
    {
        $this->corpid       = $corpid;
        $this->corpsecret   = $corpsecret;
    }


    /**
     * 获取 access_token
     *
     * @return string
     */
    public function access_token(): string
    {
        $key = $this->access_token_key . ':' . $this->corpid . ':' . $this->corpsecret;
        if (!S($key)) {
            $array = [
                'corpid'        => $this->corpid,
                'corpsecret'    => $this->corpsecret,
            ];
            $url = $this->url . 'gettoken?' . http_build_query($array);
            $getCurl = getCurl($url);
            if (is_json($getCurl)) {
                $result = json_decode($getCurl, true);
                if (!$result['errcode']) {
                    S($key, $result['access_token'], $result['expires_in']);
                }
            }
        }
        return S($key);
    }


    /**
     * 
     * 获取部门列表
     *
     * @param string $userid
     * @return void
     */
    public function department_list()
    {
        $array = [
            'access_token'  => $this->access_token(),
        ];
        $url = $this->url . 'department/list?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取部门成员
     *
     * @param string $department_id
     * @return void
     */
    public function user_simplelist(string $department_id)
    {
        $array = [
            'access_token'  => $this->access_token(),
            'department_id' => $department_id,
        ];
        $url = $this->url . 'user/simplelist?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取部门成员详情
     *
     * @param string $department_id 获取的部门id
     * @return void
     */
    public function user_list(string $department_id)
    {
        $array = [
            'access_token'  => $this->access_token(),
            'department_id' => $department_id,
        ];
        $url = $this->url . 'user/list?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 读取成员
     *
     * @param string $userid 成员UserID
     * @return void
     */
    public function user_get(string $userid)
    {
        $array = [
            'access_token'  => $this->access_token(),
            'userid'        => $userid,
        ];
        $url = $this->url . 'user/get?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取客户列表
     *
     * @param string $userid 企业成员的userid
     * @return void
     */
    public function externalcontact_lis(string $userid)
    {
        $array = [
            'access_token'  => $this->access_token(),
            'userid'        => $userid,
        ];
        $url = $this->url . 'externalcontact/list?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取客户详情
     *
     * @param string $external_userid 外部联系人的userid，注意不是企业成员的帐号
     * @return void
     */
    public function externalcontact_get(string $external_userid)
    {
        $array = [
            'access_token'      => $this->access_token(),
            'external_userid'   => $external_userid,
        ];
        $url = $this->url . 'externalcontact/get?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取客户群列表
     *
     * @param integer $status_filter
     * @param integer $owner_filter
     * @param integer $userid_list
     * @param integer $partyid_list
     * @param integer $offset
     * @param integer $limit
     * @return void
     */
    public function externalcontact_groupchat_list(int $status_filter = 0, int $owner_filter = 0, int $userid_list = 100, int $partyid_list = 100, int $offset = 0, int $limit = 1000)
    {
        $array = [
            'access_token'  => $this->access_token(),
            'status_filter' => $status_filter,
            'owner_filter'  => $owner_filter,
            'userid_list'   => $userid_list,
            'offset'        => $offset,
            'limit'         => $limit,
        ];
        $url = $this->url . 'externalcontact/groupchat/list?' . http_build_query($array);
        $getCurl = getCurl($url);
        if (is_json($getCurl)) {
            return json_decode($getCurl, true);
        }
    }


    /**
     * 获取客户群详情
     *
     * @param string $chat_id 客户群ID
     * @return void
     */
    public function externalcontact_groupchat_get(string $chat_id)
    {
        $array = [
            'access_token'  => $this->access_token(),
        ];
        $url = $this->url . 'externalcontact/groupchat/get?' . http_build_query($array);

        $json = [
            'chat_id'  => $chat_id,
        ];
        $postCurl = postCurl($url, json_encode($json));
        if (is_json($postCurl)) {
            return json_decode($postCurl, true);
        }
    }


    /**
     * 获取联系客户统计数据
     *
     * @return void
     */
    public function externalcontact_get_user_behavior_data(string $userid = NULL, string $partyid = NULL, string $start_time, string $end_time)
    {
        $array = [
            'access_token'  => $this->access_token(),
        ];
        $url = $this->url . 'externalcontact/get_user_behavior_data?' . http_build_query($array);
        $json = [
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
        if (!empty($userid))        $json['userid']        = $userid;
        if (!empty($partyid))       $json['partyid']       = $partyid;
        if (!empty($start_time))    $json['start_time']    = $start_time;
        if (!empty($end_time))      $json['end_time']      = $end_time;
        $postCurl = postCurl($url, json_encode($json));
        if (is_json($postCurl)) {
            return json_decode($postCurl, true);
        }
    }


    /**
     * 获取客户群统计数据
     *
     * @param string $day_begin_time
     * @param string $owner_filter
     * @param string $userid_list
     * @param string $partyid_list
     * @param integer $order_by
     * @param integer $order_asc
     * @param integer $offset
     * @param integer $limit
     * @return void
     */
    public function externalcontact_groupchat_statistic(string $day_begin_time, string $owner_filter = NULL, string $userid_list = NULL, string $partyid_list = NULL, int $order_by = 1, int $order_asc = 0, int $offset = 0, int $limit = 1000)
    {
        $array = [
            'access_token'  => $this->access_token(),
        ];
        $url = $this->url . 'externalcontact/groupchat/statistic?' . http_build_query($array);

        if (!empty($day_begin_time))    $json['day_begin_time']     = $day_begin_time;
        if (!empty($owner_filter))      $json['owner_filter']       = $owner_filter;
        if (!empty($userid_list))       $json['userid_list']        = $userid_list;
        if (!empty($partyid_list))      $json['$partyid_list']      = $partyid_list;
        if (!empty($order_by))          $json['order_by']           = $order_by;
        if (!empty($order_asc))         $json['order_asc']          = $order_asc;
        if (!empty($offset))            $json['offset']             = $offset;
        if (!empty($limit))             $json['limit']              = $limit;

        $postCurl = postCurl($url, json_encode($json));
        if (is_json($postCurl)) {
            return json_decode($postCurl, true);
        }
    }


    public function externalcontact_add_msg_template(
        string $chat_type = NULL,
        string $external_userid = NULL,
        string $sender = NULL,
        string $text_content = NULL,
        string $image_media_id = NULL,
        string $image_pic_url = NULL,
        string $link_title = NULL,
        string $link_picurl = NULL,
        string $link_desc = NULL,
        string $link_url = NULL,
        string $miniprogram_title = NULL,
        string $miniprogram_pic_media_id = NULL,
        string $miniprogram_appid = NULL,
        string $miniprogram_page = NULL
    ) {
        $array = [
            'access_token'  => $this->access_token(),
        ];
        $url = $this->url . 'externalcontact/add_msg_template?' . http_build_query($array);

        dd($url);

        if (!empty($chat_type))                 $json['chat_type']                  = $chat_type;
        if (!empty($external_userid))           $json['external_userid']            = $external_userid;
        if (!empty($sender))                    $json['sender']                     = $sender;
        if (!empty($text_content))              $json['text.content']               = $text_content;
        if (!empty($image_media_id))            $json['image.media_id']             = $image_media_id;
        if (!empty($image_pic_url))             $json['image.pic_url']              = $image_pic_url;
        if (!empty($link_title))                $json['link.title']                 = $link_title;
        if (!empty($link_picurl))               $json['link.picurl']                = $link_picurl;
        if (!empty($link_desc))                 $json['link.desc']                  = $link_desc;
        if (!empty($link_url))                  $json['link.url']                   = $link_url;
        if (!empty($miniprogram_title))         $json['miniprogram.title']          = $miniprogram_title;
        if (!empty($miniprogram_pic_media_id))  $json['miniprogram.pic_media_id']   = $miniprogram_pic_media_id;
        if (!empty($miniprogram_appid))         $json['miniprogram.appid']          = $miniprogram_appid;
        if (!empty($miniprogram_page))          $json['miniprogram.page']           = $miniprogram_page;

        $postCurl = postCurl($url, json_encode($json));
        if (is_json($postCurl)) {
            return json_decode($postCurl, true);
        }
    }



    public function media_get()
    {
    }
}
