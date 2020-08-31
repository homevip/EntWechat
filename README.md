# EntWechat



#### 使用说明

```
// 实例化类
$EntWechat = (new EntWechat('corpid 企业ID', 'corpsecret 应用的凭证密钥'));

// 获取部门列表
$department_list = $EntWechat->department_list();

// 获取部门成员
$user_simplelist = $EntWechat->user_simplelist('部门ID');

// 获取部门成员详情
$user_list = $EntWechat->user_list('部门ID);

// 读取成员
$user_get = $EntWechat->user_get('成员UserID');


/**
* 获取客户列表
* 
* "wo50nkEQAAfg3m2niUVOTYPf_Dy8Vr-w"
* "wm50nkEQAAIVgBHAvlAYanM50rMEr1wQ"
* "wm50nkEQAAntSbfH8gzoLTIE9bGFe8JA"
*/
$externalcontact_lis = $EntWechat->externalcontact_lis('成员UserID');

// 获取客户详情
$externalcontact_get = $EntWechat->externalcontact_get('外部联系人的userid，注意不是企业成员的帐号');


// 获取客户群列表
$externalcontact_groupchat_list = $EntWechat->externalcontact_groupchat_list();

// 获取客户群详情
$ext_groupchat_get = $EntWechat->externalcontact_groupchat_get('wr50nkEQAAwIcbLBKuV7iX7URmG04wQg');


// 获取联系客户统计数据
$ext_get_user_behavior_data = $EntWechat->externalcontact_get_user_behavior_data('', '1', '1593532800', '1596038400');

// 获取客户群统计数据
$ext_groupchat_statistic = $EntWechat->externalcontact_groupchat_statistic('1595779200');

// 添加企业群发消息任务
$ext_add_msg_template = $EntWechat->externalcontact_add_msg_template('single', '', '', 'aaa');
```
