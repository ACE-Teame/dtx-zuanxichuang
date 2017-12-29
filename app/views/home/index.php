<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>在线申请</title>
    <?php echo css('main.css') ?>
</head>
<body>
    <div class="container home">
        <div class="top">
            <div class="img"><img src="<?php echo base_url('resource/images/1.jpg') ?>" alt=""></div>       
        </div>
        <div class="form">
            <div class="title">请填写真实信息</div>

	        <div class="tab-1 active">	        	
	            <form id="form_application">
	                <div class="entry">
	                    <label>您的姓名:<span>*</span></label>
	                    <input type="text" id="username" name="username" placeholder="请填写姓名">
	                </div>
	                <div class="entry">
	                    <label>身份证号:<span>*</span></label>                
	                    <input type="text" id="cardid" name="cardid" placeholder="请填写身份证号码">
	                </div>
	                <div class="entry">
	                    <label>手机号码:<span>*</span></label>
	                    <input type="text" id="phone" name="phone" placeholder="请填写手机号码">
	                </div>
	                <input type="hidden" name="c" value="<?php echo $c ?>">
	            <!-- </form> -->
	            <a class="btn btn-next" >确认</a>
	        </div>


			<div class="tab-2">
                <div class="entry">
                    <label>贷款金额:<span>*</span></label>
                    <select name="quato" id="">
                         <?php foreach ($quatoData as $key => $quato): ?>
                            <option value="<?php echo $quato['key'] ?>"><?php echo $quato['val'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="entry">
                    <label>贷款期限:<span>*</span></label>
                    <select name="loan_term" id="">
                            <option value="3">3个月</option>
                            <option value="6">6个月</option>
                            <option value="9">9个月</option>
                            <option value="12">12个月</option>
                    </select>
                </div>
                 <div class="entry">
                    <label>所在城市:<span>*</span></label>
                    <select name="address" id="">
                            <option value="广州市">广州市</option>
                    </select>
                </div>
                <div class="entry">
                    <label>身份职业:<span>*</span></label>
                    <select name="occupation" id="">
                            <option value="在职">在职</option>
                            <option value="个体户">个体户</option>
                            <option value="企业主">企业主</option>
                            <option value="无业人士">无业人士</option>
                    </select>
                </div>
                <div class="entry">
                    <label>是否有社保:<span>*</span></label>
                    <select name="social_security" id="">
                            <option value="1">有</option>
                            <option value="0">无</option>
                    </select>
                </div>
                <div class="entry">
                    <label>是否有公积金:<span>*</span></label>
                    <select name="accumulation_fund" id="">
                            <option value="1">有</option>
                            <option value="0">无</option>
                    </select>
                </div>
                <div class="entry">
                    <label>您的信用情况:<span>*</span></label>
                    <select name="degree" id="">
                            <option value="1">信用良好</option>
                            <option value="2">无信用卡或贷款</option>
                            <option value="3">有过逾期</option>
                    </select>
                </div>
                <div class="entry">
                    <input type="checkbox" name="" id="agree-id" onchange="agree_change(this)" checked="checked">本人已阅读《申请合约》
                </div>
                <input type="hidden" name="is_agree" id="is_agree" value="1">
            </form>
            <a class="btn btn-end" onclick="submit_application()" href="javascript:;">立即提交申请</a>
        </div>

            <!-- <a href="javascript:;" class="btn" onClick="submit_application(this)">立即提交申请</a> -->

        </div>
        <div class="comment">
            <div class="item">
                <div class="top clear">
                    <div class="fl">
                        <div class="img"><img src="<?php echo base_url('resource/images/person3.jpg') ?>" alt=""></div>
                    </div>
                    <div class="fl">
                        <div class="name">林小姐
                            <span class="blue">[房贷组合贷款]</span>
                        </div>
                        <div class="tip">贷款金额<span class="red">150万</span> 贷款期限<span class="red">36个月</span></div>
                        <div class="tip">放款时间 7天 月利率 0.49%</div>
                    </div>
                </div>
                <div class="text">
                    <p>林小姐是一家上市公司业务主管，已经在这家公司工作了7年多。现准备自己创办一家新公司，但因缺乏创业资金，准备贷款150万。经核实其名下确实有一套价值200万全款房产可作抵押，从林小姐递交申请到放款仅用7天时间。</p>
                </div>
            </div>
            <div class="item">
                <div class="top clear">
                    <div class="fl">
                        <div class="img"><img src="<?php echo base_url('resource/images/person2.jpg') ?>" alt=""></div>
                    </div>
                    <div class="fl">
                        <div class="name">李先生
                            <span class="blue">[小额贷款]</span>
                        </div>
                        <div class="tip">贷款金额<span class="red">10万</span> 贷款期限<span class="red">24个月</span></div>
                        <div class="tip">放款时间 1天 月利率 1.2%</div>
                    </div>
                </div>
                <div class="text">
                    <p>李先生是一家国企公司雇员，已经稳定工作8年多，打卡工资8000+。现因个人原因急需用钱。联系我司准备贷款10万元。经审核其个人信用为良好，公司当天就完成放款。李先生当然拿到贷款后非常惊讶，直言自己并没有想到会这么快拿到贷款。</p>
                </div>
            </div>
            <div class="item">
                <div class="top clear">
                    <div class="fl">
                        <div class="img"><img src="<?php echo base_url('resource/images/person1.jpg') ?>" alt=""></div>
                    </div>
                    <div class="fl">
                        <div class="name">方先生
                            <span class="blue">[无抵押贷款]</span>
                        </div>
                        <div class="tip">贷款金额<span class="red">5万</span> 贷款期限<span class="red">24个月</span></div>
                        <div class="tip">放款时间 1天 月利率 1.2%</div>
                    </div>
                </div>
                <div class="text">
                    <p>方先生是一名公办学校老师，教书育人已经快10年了，月薪5000+，今年他的第二个儿子出生了。经济压力越来越大，方先生斟酌再三后决定开一家淘宝店做第二职业。因手头资金有限，联系我司申请贷款5万。经核实方先生信用良好，家人也同意其贷款，只用1天时间方先生就收到了贷款。</p>
                </div>
            </div>
        </div>
        <footer>
            <!-- <p>版权所有 © 京ICP备16006674号-1</p> -->
            <p>好贷天下信息技术（北京）有限公司</p>
        </footer>
    </div>
    <input type="hidden" name="" id="allowAddress" value="<?=$allowAddress?>">
    <?php echo js('jquery.min.js') ?>
    <?php echo js('main.js') ?>
    <script>

        /**
         * 点击同意阅读条约事件
         */
        function agree_change(it)
        {
            if ($(it).is(':checked')) {
                $("#is_agree").val(1);
            } else {
                $("#is_agree").val(0);
            }
        }

        /**
         * 提交申请
         */
        function submit_application(it)
        {
            // 本地测试关闭
            if ($allowAddress == '广州') {
                $(it).removeAttr('onClick');
                if($('#agree-id').is(':checked')) {
                    $.ajax({
                        url: '<?php echo base_url('index/submitApplication') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: $('#form_application').serialize(),
                        success:function(data) {
                            if(data.status == 200) {
                                alert('申请成功！工作人员将在一个工作日联系您，确认信息');
                                location.reload();
                            }else {
                                $(it).attr('onClick', 'submit_application(this)');
                                alert(data.msg);
                            }
                        }
                    })
                }else {
                    alert('请先阅读申请合约')
                }
            }
            
        }

    </script>
</body>
</html>