<?php

/**
 * 生产点的操作
 * @author Darry
 *
 */
class ProductPlaceAction extends Action {
	
	/**
 	* 添加生产点
 	*/
	public function index(){
		if(IS_POST){
			
// 			$_POST['company_id'] =5;
// 			$_POST['description'] = '1四川成郫县村';
// 			$_POST['staff_count']= 103;
// 			$_POST['name']= '乐子二';
// 			$_POST['admin_id']=1115 ;
// 			$_POST['address']='四川理工3学苑街56号';
// 			$_POST['addr_lat']=1454.8;
// 			$_POST['addr_long'] =1154.1;
			
			
			$data['company_id']  = htmlspecialchars($_POST['company_id']);
			$data['description'] = htmlspecialchars($_POST['description']);
			$data['staff_count']  = htmlspecialchars($_POST['staff_count']);
			$data['name']		 = htmlspecialchars($_POST['name']);
			$data['admin_id']   = htmlspecialchars($_POST['admin_id']);
			$data['address']	 = htmlspecialchars($_POST['address']);
			$data['addr_lat']	 = htmlspecialchars($_POST['addr_lat']);
			$data['addr_long']   = htmlspecialchars($_POST['addr_long']);
			
			//放回当前生产点id号
			$result = M('place')->data($data)->add();
			$this->assign('$msg_status',$result);
		}else {
			echo '生产点添加非法提交';
		}
	}
	

	
	/**
	 * 分页显示生产点
	 */
	public function showPlace(){
		if(IS_POST){
			//多少行
			$rows = htmlspecialchars($_POST['rows']);
			//多少页
			$page = htmlspecialchars($_POST['page']);
			$Dao = M("place");
			// 计算总数
			$count = $Dao->where('company_id=1')->count();
			// 导入分页类
			import("ORG.Util.Page");
			// 实例化分页类
			$p = new Page($count,$rows);
			echo $p->show();
			// 当前页数据查询
			 $list = $Dao->table('t_place as pl,t_operator as ope')
							->where('pl.company_id=1 AND pl.admin_id = ope.id')
							->order ( 'pl.id DESC' )
							->limit ( $p->firstRow . ',' . $p->listRows )
							->field('ope.username,pl.id,pl.description,pl.staff_count,pl.name,pl.address,pl.addr_lat,pl.addr_long')
							->select();	
			 echo $listl= json_encode($list);
			 //$this->assign('$list',$list);
		}
		
	}
	
	
	
	/**
	 * 修改生成点
	 */
	public function editPlace (){
		if(IS_POST){
// 			$_SESSION ['company_id'] = 2;
// 			$_SESSION ['admin_id'] = 11;
// 			$_POST ['id'] = 4;
// 			$_POST ['description'] = 'desc';
// 			$_POST ['staff_count'] = 10;
// 			$_POST ['name'] = 'name';
// 			$_POST ['address'] = 'adddr';
// 			$_POST ['addr_lat'] = 150.4;
// 			$_POST ['addr_long'] = 147.4;
			
			$companyId = $_SESSION ['company_id'];
			$admin_id = $_SESSION ['admin_id'];
			$id = htmlspecialchars ( $_POST ['id'] );
			$description = htmlspecialchars ( $_POST ['description'] );
			$staff_count = htmlspecialchars ( $_POST ['staff_count'] );
			$name = htmlspecialchars ( $_POST ['name'] );
			$address = htmlspecialchars ( $_POST ['address'] );
			$addr_lat = htmlspecialchars ( $_POST ['addr_lat'] );
			$addr_long = htmlspecialchars ( $_POST ['addr_long'] );
			
			// 实例化
			$Dao = M ( 'place' );
			
			// 条件
			$condition->company_id = $_SESSION ['company_id'];
			$condition->id = $_POST ['id'];
			
			// 描述
			if (! empty ( $description )) {
				$data ['description'] = $description;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 人数
			if (! empty ( $staff_count )) {
				$data ['staff_count'] = $staff_count;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 名字
			if (! empty ( $name )) {
				$data ['name'] = $name;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 地址
			if (! empty ( $address )) {
				$data ['address'] = $address;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 经度
			if (! empty ( $addr_lat )) {
				$data ['addr_lat'] = $addr_lat;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 纬度
			if (! empty ( $addr_long )) {
				$data ['addr_long'] = $addr_long;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
			
			// 操作员id
			if (! empty ( $admin_id )) {
				$data ['admin_id'] = $admin_id;
				$Dao->where ( 'id = ' . $id . '' )->data ( $data )->save ();
			}
		}
	}
	
	
	/**
	 * 删除生产点
	 */
	public function delPlace(){
		if (IS_POST){
			//$_POST['id'] =4 ;
			$PlaceId = $_POST['id'];
			$result = M('place')->where('id = '.$PlaceId.'')->delete();
		}
		$this->assign('$msg_status',$result);
	}
	
	
	
	
}

?>