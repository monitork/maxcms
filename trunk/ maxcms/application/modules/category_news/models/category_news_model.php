<?php
class Category_news_model extends MY_Model {
	private $module = 'category_news';
	private $table = 'category_news';
	private $search_field = array('name');
	
	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			if( count($this->search_field) > 0 ){
				$keyFlat = 1;
				$queryWhere = '';
				foreach($this->search_field as $item){
					if($keyFlat == 1){
						$queryWhere .= "`".$item."` LIKE '%".$this->input->post('content')."%'";
					}else{
						$queryWhere .= "OR `".$item."` LIKE '%".$this->input->post('content')."%'";
					}
					$keyFlat++;
				}
				$this->db->where($queryWhere);
			}
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			if( count($this->search_field) > 0 ){
				$keyFlat = 1;
				$queryWhere = '';
				foreach($this->search_field as $item){
					if($keyFlat == 1){
						$queryWhere .= "`".$item."` LIKE '%".$this->input->post('content')."%'";
					}else{
						$queryWhere .= "OR `".$item."` LIKE '%".$this->input->post('content')."%'";
					}
					$keyFlat++;
				}
				$this->db->where($queryWhere);
			}
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function saveManagement($fileName=''){
		$id = (int)$this->input->post('hiddenIdAdmincp');
		$return_result = false;
		if($id==0){
			$slug= create_slug($this->input->post('name'));
			//CHECK SLUG
			$check_slug= $this->get('id', CATEGORY_NEWS_TB, "`slug` = '$slug'");
			if(!empty($check_slug)) {exit('SLUG_EXIST');}
			$data = array(
				'parent_id'		=> 34,//Parent giai tri
				'type'			=> $this->input->post('type'),
				'name'			=> $this->input->post('name'),
				'slug'			=> $slug,
				'order'			=> $this->input->post('order'),
				'status'		=> $status = ($this->input->post('statusAdmincp')=='on')?1:0,
				'changed'		=> date('Y-m-d H:i:s',time()),
				'created'		=> date('Y-m-d H:i:s',time())
			);
			
			if($this->db->insert(PREFIX.$this->table,$data)){
				$id = $this->db->insert_id();
				
				$this->db->where('parent_id', $this->db->insert_id());
				$this->db->update(NEWS_TB, array('status' => $status));
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				$return_result = true;
			}
		} else {
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//SLUG
			$slug= $result[0]->slug;
			if($result[0]->name!=$this->input->post('name'))
			{
				$slug= create_slug($this->input->post('name'));
				//CHECK SLUG
				$check_slug= $this->get('id', CATEGORY_NEWS_TB, "`slug` = '$slug'");
				if(!empty($check_slug)) {exit('SLUG_EXIST');}
			}
			//END SLUG
			
			$data = array(
				'type'			=> $this->input->post('type'),
				'name'			=> $this->input->post('name'),
				'slug'			=> $slug,
				'order'			=> $this->input->post('order'),
				'status'		=> $status = ($this->input->post('statusAdmincp')=='on')?1:0,
				'changed'		=> date('Y-m-d H:i:s',time())
			);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				$this->db->where('parent_id', $this->input->post('hiddenIdAdmincp'));
				$this->db->update(NEWS_TB, array('status' => $status));
				$return_result = true;
			}
		}
		$id = $return_result ? $id : 0;
		return $id;
	}
	
	function checkData($title){
		$this->db->select('id');
		$this->db->where('name',$title);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkSlug($slug){
		$this->db->select('id');
		$this->db->where('slug',$slug);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkExistRecord(){
		$query = $this->db
					->select('id')
					->limit(1)
					->get(PREFIX.$this->table)
					->row_array();
		return ($query) ? true : false;
	}
	
	function moveDatabase(){
	
		if($this->checkExistRecord() === true){
			return false;
		}
	
		$oldData 		=	$this->getOldData();
		$newData		=	array();
		$fieldChangeName =	array(
			'is_active'	=>	'status'
		);
		$fieldRemove	= 	array(
			'keywords','car_count'
		);
		foreach($oldData as $num =>	$item){
			foreach($item as $key	=>	$value){
				if( !in_array($key, $fieldRemove) ){
					if( in_array($key, array_keys($fieldChangeName)) ){
						$newData[$num][$fieldChangeName[$key]]	=	$value;
					}else{
						$newData[$num][$key]	=	$value;
					}
				}
			}
			
		}
		if($this->db->insert_batch(PREFIX.$this->table, $newData)){
			return true;
		}
	}
	
	//	OLD DATABASE
	function getOldData(){
		$db2 = $this->load->database('autobay_old', true);
		$query =	$db2->select('*')
					->order_by('id', 'asc')
					->get(PREFIX.'color')
					->result_array();
		return ($query) ? $query : false;
	}
	//	END OLD DATABASE
	
	/*----------------------FRONTEND----------------------*/
	
	/*--------------------END FRONTEND--------------------*/
}