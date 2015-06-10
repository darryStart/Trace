<?php
/**
 * 
 * @author Darry
 *产品管理
 */
class ProductModel extends Model{
	
	/**
	 * 添加产品
	 * @param string $data
	 */
	public function insert($data = NULL){
		//操作的表，如果不定义默认找模板名称(product)。下面的默认为$this->date($data)->add();
		$data = is_null($data) ? $_POST : $data;
		return $this->data($data)->add();
	}
	
	/**
	 * 产品的单删除
	 * @param string $id
	 */
	public function delete($id=NULL){
		$id = is_null($id) ? $_POST : $id;
		return $this->where("id = '$id'")->delete();
	}
	
	
	
	/**
	 * 产品多删除
	 * @param array $id
	 */
	public function deleteMulti($id){
		$id = is_null($id) ? $_POST : $id;
		$where['id']=array('in',$id);
		return $this->where($where)->delete();
	}
	
	
	/**
	 * 更新数据
	 * @param string $id
	 */
	public function update($id = NULL){
		$data['addmin_id'] = '1235';
		$id = is_null($id) ? $_POST : $id;
		$condition['id'] = $id;
		$result = $this->where($condition)->save($data);
	}
	
	/**
	 * 将产品设置为无效状态
	 * @param array $id
	 */
	public function status($id){
		$id = is_null($id) ? $_POST : $id;
		$where['id']=array('in',$id);
		$data['status'] = 0; 
		$result = $this->where($where)->save($data);
	}
	
}

?>