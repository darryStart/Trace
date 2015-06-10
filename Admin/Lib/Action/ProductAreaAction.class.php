<?php

class ProductAreaAction extends Action{
	
		/**
		 * 添加生产区域
		 */
		public function index(){
		//	if(IS_POST){
				
				$_POST['place_id'] =5;
				$_POST['description'] = '2四川成郫县村';
				$_POST['temperature']= 32;
				$_POST['humidity']= 10;
				
					
					
				$data['place_id']  = htmlspecialchars($_POST['place_id']);
				$data['description'] = htmlspecialchars($_POST['description']);
				$data['temperature']  = htmlspecialchars($_POST['temperature']);
				$data['humidity']		 = htmlspecialchars($_POST['humidity']);
				
				//图片上传
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  __ROOT__.'/Admin/Public/Uploads/';// 设置附件上传目录
				if(!$upload->upload()) {// 上传错误提示错误信息
					$this->error($upload->getErrorMsg());
				}else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
				}
				
					// 保存表单数据 包括附件数据
// 					$User = M("User"); // 实例化User对象
// 					$User->create(); // 创建数据对象
// 					$User->photo = $info[0]['savename']; // 保存上传的照片根据需要自行组装
// 					$User->add(); // 写入用户数据到数据库
					//$this->success('数据保存成功！');
				
					$data['image1'] = $info[0]['savename'];
				//放回当前生产点id号
				$result = M('area')->data($data)->add();
				$this->assign('$msg_status',$result);
// 			}
		}
	
	/************************************************以下未做*****************************************/
	
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
				$this->assign('$list',$list);
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