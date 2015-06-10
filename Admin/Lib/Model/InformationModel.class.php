<?php

class InformationModel extends Model {
	
	/**
	 * 和下面的join方法实现都一致
	 */
	public function searche(){
	return $this->table('t_information as inf, t_product as pro')
					 ->where('inf.product_id = pro.id')
					 ->field('inf.*, pro.* ')
					 ->select();
			
	}
	
	
	/**
	 * 通过information的id查询information表和Product表的信息
	 * 可以用于扫码获得的相应信息
	 * field：
	 * @param int $id
	 */
	public function search($id) {
		 return  $this->join('t_product ON t_information.product_id = t_product.id')
		 				->where('t_information.status = 1 AND t_information.id = '.$id.' ')
		 				->getField('t_product.company_id,
		 							t_information.id,
		 							t_information.type,
		 							t_information.key,
		 							t_information.value,
		 							t_product.company_id,
		 							t_product.generate_by,
		 							t_product.generate_time'
								  );
		 				//->select();
	}
	
	/**
	 * 查询可用状态的产品信息
	 */
	public function searchAll() {
		 return  $this->join('t_product ON t_information.product_id = t_product.id')
		 				->where('t_information.status = 1')
		 				->getField('t_information.id,
		 							t_information.id,
		 							t_information.type,
		 							t_information.key,
		 							t_information.value,
		 							t_product.company_id,
		 							t_product.generate_by,
		 							t_product.generate_time'
								  );
		 				//->select();;
	}
	
	
	
}













?>