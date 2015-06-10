<?php
class IndexAction extends Action {
	
	/**
	 * 注册控制器
	 */
	public function index(){
		$date = array(name =>name_date,id =>id_date,pwd => pwd_date);
		$this->assign('date',$date);
		$this->display();
	}
	
	/**
	 *登录控制器 
	 */
    public function login(){
       $this->display();
    }
    
    
    /**
     * 发送邮件
     */
   public function email() {
		$_POST['email'] = 'darrydq@126.com';
		import ( 'ORG.Util.Email' ); // 导入本类
		$data ['mailto'] = htmlspecialchars_decode($_POST['email']); // 收件人
		$data ['subject'] = '溯源系统审核结果'; // 邮件标题
		$data ['body'] = '审核通过可以尽情使用......'; // 邮件正文内容
		$mail = new Email();
        if($mail->send($data)){
			$this->success('发送成功',U('login'));
		} 
		else {
			
			$this->error('邮件发送失败...',U('login'));
		}
	}
    
}