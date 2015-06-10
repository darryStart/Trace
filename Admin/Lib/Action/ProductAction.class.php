<?php

/**
 * 产品的增、删、改、查
 * @author Darry
 *
 */
class ProductAction extends Action{

	
	/**
	 * 添加产品
	 */
	public function index(){
		$_SESSION['id'] = 10110;
		$_SESSION['company_id']= 119;
		//提取POST数据
		$data = array(
			'company_id' => session('company_id'),
			// 操作员登录时保持的id
			'generate_by'=> session(id),
			'generate_time'=> time()
		);

		//添加
		$Dao  = D('Product');
	    $id = $Dao->insert($data);
	    
	    //添加二维码信息
	    $data = array('qr_img' => "admin/public/$id.png");
	    $Dao->where('id = '.$id.'')->save($data);
	    
	   /*调用添加二维码，调用_code(字符串二维码名称)*/
	    if($id){
	    	$this->_code($id);
	    }
	
	}
	
	
	/**
	 * 二维码生成
	 * @param char $num
	 */
	private function _code($num,$data){
		vendor("phpqrcode.phpqrcode");
		$data = 'http://localhost/getwhere3.1/index.php/Product/index/?id='.$num.'';//数据的生成
		$level = 'L';
		$size = 4;
		$path = APP_PATH.'\Public\Code/';
		$fileName = $path.$num.'.png';
		QRcode::png($data, $fileName, $level, $size);
	}
	
	
	/**
	 * 修改产品
	 */
	public function update(){
		//修改
		$id = $_POST['id'];
		$dd = D('Product')->update($id);
	}
	
	
	
	/**
	 *删除产品
	 */
	public function delete(){
		
		//批量删除，传过去的是数组
		$id = array(11,12,13);
		$dd = D('Product')->deleteMulti($id);
		
		//单一id删除
		$dd = D('Product')->delete($id);
	}
	
	/**
	 * 产品的无效状态设置
	 */
	public function InvalidStatus(){
		$id = array(21,20);
		$dd = D('Product')->status($id);
	}
	
	
	/**
	 * 分页显示所有产品
	 */
	public function ProductAll(){
		$rows = htmlspecialchars($_POST['rows']);
		//多少页
		$page = htmlspecialchars($_POST['page']);
		$_SESSION['company_id'] = 119;
		$Dao = M("product");
		// 计算总数
		$count = $Dao->where('company_id='.$_SESSION['company_id'].'')->count();
		// 导入分页类
		import("ORG.Util.Page");
		// 实例化分页类
		$p = new Page($count,3);
		echo $p->show();
		// 当前页数据查询
// 		$list = $Dao->table('t_place as pl,t_operator as ope')
// 		->where('pl.company_id=1 AND pl.admin_id = ope.id')
// 		->order ( 'pl.id DESC' )
// 		->limit ( $p->firstRow . ',' . $p->listRows )
// 		->field('ope.username,pl.id,pl.description,pl.staff_count,pl.name,pl.address,pl.addr_lat,pl.addr_long')
// 		->select();
		$list = $Dao->where('company_id= '.$_SESSION['company_id'].'')
					->order('id DESC')
					->limit ( $p->firstRow . ',' . $p->listRows )
					->field(t_product,status,generate_by,generate_time,qr_img)
					->select();
		echo json_encode(array("total"=>"4","rows"=>$list));
		
		p($list);
		//$this->assign('$list',$list);
	}
	
	
}

?>