<?php

/**
 * 验证是否登录类.当没有设置session【id】时就不能操作，跳转到login
 * @author Darry
 *
 */
class CommonAction extends Action {

	
	public function _initialize() {
		if (! isset ( $_SESSION ['id'] )) {
			redirect ( U ( 'index/login' ) );
		}
	}
	
	
	
	/**
	 * 分页
	 */
	public function page(){
		$company_id = htmlspecialchars($_POST['company_id']);
		$page 		= htmlspecialchars($_POST['page']);
		$row 		= htmlspecialchars($_POST['row']);
		
		$Dao = M('place');
		
		$count = $Dao->where('id = '.$company_id.'')->count();
		$i = ceil($count / $row);
		if($i > $page && $page > 0){
			$j = ($page-1)*$row;
			$Dao->limit('$j,$rows')->order('id DESC')->field()->select();
		}
		
	}
}

?>