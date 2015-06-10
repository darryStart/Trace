<?php

/**
 * 公司信息
 * @author Darry
 *
 */
class CompanyAction extends Action{
	
	/**
	 * 通过id查看公司的相关信息
	 */
	public function index(){
		if(IS_POST){
			//$_POST['id'] =1;
			$id = htmlspecialchars($_POST['id']);
			$product = M('company')->where('id = '.$id.'')->field('name,address,type,description,phone,email,status')->select();
				
			//第一种放回方式
			$this->ajaxReturn($product);
				
			//第二种返回方式
			$productl = json_encode($product);
			echo $this->assign('$company',$productl);
		}else {
			echo '非法提交';
		}
	}	
	
}

?>