<?php 
namespace app\Controller;

use app\core\Wb_Controller;
use system\core\Config;
use system\core\Page;

/**
 * 后台控制器
 */
class AdminController extends Wb_Controller
{
    // 信用情况列表
    public $degreeList = [
        '1' => '信用良好',
        '2' => '无信用卡或贷款',
        '3' => '有过逾期',
    ];

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * 后台首页
     */
    public function index()
    {
        view('admin/index');
    }

    /**
     * 根据银行ID 取出银行名称
     * @param  int $num 银行ID
     */
    public function getBank($num)
    {
        switch ($num) {
            case 1:
                $bank = '中国建设银行';
                break;
            case 2:
                $bank = '中国农业银行';
                break;
            case 3:
                $bank = '中国银行';
                break;
            case 4:
                $bank = '中国工商银行';
                break;
            case 5:
                $bank = '中国交通银行';
                break;
                         
            default:
                $bank = '';
                break;
        }
        return $bank;
    }

    /**
     * 数据整理
     * @param  array &$data 待整理数据
     */
    public function _arrangeData( &$data )
    {
        foreach ($data['orderData'] as $key => $val) {
            $data['orderData'][$key]['bank'] =parent::$model->select('common', 'val', ['key' => $val['bank'], 'type' => 'bank'])[0];
            $data['orderData'][$key]['quato'] = $val['quato'] . '万';
        }
    }

    /**
     * 拼接查询条件
     * @return array
     */
    public function _getOrderSearch()
    {
        if(get('username')) {
            $where['username[~]'] = get('username');
        }
        if(get('bank')) {
            $where['bank'] = get('bank');            
        }
        if(get('quato')) {
            $where['quato'] = get('quato');
        }
        if(get('c')) {
            $where['c[~]'] = get('c');
        }
        if(get('cardid')) {
            $where['cardid[~]'] = get('cardid');
        }
        if(get('start_date') || get('end_date')) {
            $where['time[<>]'] = [strtotime(get('start_date')), strtotime(get('end_date'))];
        }
        return $where;
    }

    /**
     * 申请列表
     */
    public function orderList()
    {
        // 取出查询条件
        $where = $this->_getOrderSearch();
        // 取出查询参数uri
        $parameter = getSearchParam();
        if(isset($_GET['page'])) {
            $now_page = intval($_GET['page']) ? intval($_GET['page']) : 1;
        }else {
            $now_page = 1;
        }
        // 取得每页条数
        $pageNum           = Config::get('PAGE_NUM', 'page');
        // 计算偏移量
        $offset            = $pageNum * ($now_page - 1);

        $data['count']     = parent::$model->count('order', $where);
        $where['LIMIT']    = [$offset, $pageNum];

        $data['orderData'] = parent::$model->select('order', '*', $where);
        
        // 分页处理
        $objPage           = new page($data['count'], $pageNum, $now_page, '?page={page}' . $parameter);
        $data['pageNum']   = $pageNum;
        $data['pageList']  = $objPage->myde_write();
        $data['quatoData'] = parent::$model->select('common', ['key', 'val'], ['type' => 'quato', 'ORDER' => ['order' => 'ASC']]);
        // 整理数据
        $this->_arrangeData($data);
        
        // 取出导出uri参数
        if($parameter) {
            $data['exportUri'] = '?' . ltrim($parameter, '&');
        }

        if($now_page == 1) {
            $data['number'] = 1;
        }else {
            $data['number'] = $pageNum * ($now_page - 1) + 1;
        }

        $data['degreeList'] = $this->degreeList;
        view('admin/order', $data);
    }

    /**
     * 删除申请
     */
    public function deleteOrderByIds()
    {
        if(post('order') && is_array(post('order'))) {
            $flag = parent::$model->delete('order', ['id' => post('order')]);
            if($flag) redirect('admin/orderList');
        }
    }

    /**
     * 导出CSV
     */
    public function downloadOrder()
    {
        header("Content-Type: application/force-download");
        header("Content-type:text/csv;charset=utf-8");  
        header("Content-Disposition:filename=".date("YmdHis").".csv");  
        $where    = $this->_getOrderSearch();
        $orderIds = post('order');
        if($orderIds && is_array($orderIds)) {
            $where['id'] = $orderIds;
        } else {
            $where = $this->_getOrderSearch();
        }
        $orderData  = parent::$model->select('order', '*', $where);

        echo "\xEF\xBB\xBF子链接,用户名,电话,身份证号,城市,申请额度,期限,职业,是否有社保,是否有公积金,信用情况,提交时间\r";
        ob_end_flush();  
        foreach($orderData as $order) {  
            $social_security = $order['social_security'] ? '有' : '无';
            $accumulation_fund = $order['accumulation_fund'] ? '有' : '无';
            echo $order['c'] . "," . "\"\t" . $order['username'] . "\",\"\t" . $order['phone'] . "\",\"\t" . $order['cardid'] . "\",\"\t" . $order['address'] ."\",\"\t" . $order['quato'] . "万\",\"\t" . $order['loan_term'] ."个月\",\"\t" . $order['occupation'] ."\",\"\t" . $social_security ."\",\"\t" . $accumulation_fund ."\",\"\t" . $this->degreeList[$order['degree']] ."\",\"\t" .get_date($order['time']). "\"\t\r";  
            flush();  
        }  
    }
}