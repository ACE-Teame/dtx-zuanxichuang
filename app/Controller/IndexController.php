<?php

namespace app\Controller;

use app\core\Home_Controller;
/**
 * 默认控制器
 */
class IndexController extends Home_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $data['quatoData'] = parent::$model->select('common', ['key', 'val'], ['type' => 'quato', 'ORDER' => ['order' => 'ASC']]);
        $data['c'] = get('c');

        $nowAddress = GetIpLookup();
        $data['allowAddress'] = $nowAddress ? $nowAddress : '0';

		view('home/index', $data);
	}

    /**
     * 验证申请参数
     * @param  array $data 申请参数
     */
    private function _ckeckData($data)
    {

        // 本地测试注释
        if (GetIpLookup() != '广州') {
            ajaxReturn(202, '申请失败');
        }

        if(empty($data['username'])) {
            ajaxReturn(202, '请输入姓名');
        }
        if(empty($data['phone'])) {
            ajaxReturn(202, '请输入手机号码');
        }else {
            if($this->checkPhoneNumber($data['phone']) == false) {
                ajaxReturn(202, '请填写正确的手机号码');
            }
        }
        if(empty($data['cardid'])) {
            ajaxReturn(202, '请输入身份证号码');
        }else{
            if($this->validation_filter_id_card($data['cardid']) == false) {
                ajaxReturn(202, '请填写真实的身份证号码');
            }
        }
        if(empty($data['address'])) {
            ajaxReturn(202, '请选择地址');
        }

        if(empty($data['quato'])) {
            ajaxReturn(202, '请选择申请额度');
        }

        if(empty($data['loan_term'])) {
            ajaxReturn(202, '请选择贷款期限');
        }

        if(empty($data['is_agree'])) {
            ajaxReturn(202, '请先阅读申请合约');
        }
        unset($data['address'], $data['quato'], $data['c'], $data['is_agree'], $data['bank']);

        $check_info = [
            'username' => $data['username'],
            'phone'    => $data['phone'],
            'cardid'   => $data['cardid']
        ];
        // 根据 姓名+身份证号+手机号判断申请是否存在
        $count = parent::$model->count('order', $check_info);
        if (!empty($count)) {
            ajaxReturn(202, '申请正在审核中，请勿重复提交！');
        }
    }

    /**
     * 提交申请
     */
    public function submitApplication()
    {
        $postData = post();
        $this->_ckeckData($postData);

        unset($postData['is_agree']);
        $postData['time'] = time();
        $postData['ip']   = getIp();

        parent::$model->insert('order', $postData);
        if(parent::$model->id()) {
            ajaxReturn(200);
        }else {
            ajaxReturn(202, '申请失败');
        }
    }
}
