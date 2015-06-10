<?php
/**
 * 查询显示产品信息及操作
 * @author Darry
 *
 */
class InformationHistoryAction extends Action{
	
	/**
	 * 查询指定产品信息
	 */
	public function index(){
		
		/*测试信息*/
		$_GET['id'] = 31;
		$information_id = htmlspecialchars($_GET['id']);
		$infor = D('Information')->search($information_id);
		
		$this->assign('name',json_encode($infor));
		$this->display();
	}
	
	/**
	 * 查询可用状态的产品信息
	 */
	public function searcheAll() {
		$infor = D('Information')->searchAll();
		p($infor);
	}
	
}

?>