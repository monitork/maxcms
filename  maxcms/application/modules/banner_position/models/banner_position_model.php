<?php
class Banner_position_model extends MY_Model {
	private $module = 'banner_position';
	private $table = 'banner_position';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%")');
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
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%")');
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
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}
		if(!$this->checkPosition($this->input->post('page_ad'), $this->input->post('position_ad'), $this->input->post('hiddenIdAdmincp'))){
			echo 'position-exist';
			exit;
		}	
		if($this->input->post('hiddenIdAdmincp')==0){
		$type = $this->input->post('type_ad');
			$data = array(
				'position'=> $this->input->post('position_ad'),
				'file'=> $fileName['file'],
				'type'=> $type,
				'width'=> $this->input->post('width_ad'),
				'height'=> $this->input->post('height_ad'),
				'title'	=>	$this->input->post('title_ad'),
				'status'=> $status,
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));	
			foreach($fileName as $key=>$val){
				if($fileName[$key]==''){
					if($this->input->post('type_ad') != $result[0]->type){
						@rename(BASEFOLDER.'static/uploads/banner/'.strtolower($result[0]->type).'/'.$result[0]->$key, BASEFOLDER.'static/uploads/banner/'.strtolower($this->input->post('type_ad')).'/'.$result[0]->$key);
					}
					$fileName[$key] = $result[0]->$key;
				}else{
					@unlink(BASEFOLDER.'static/uploads/banner/'.strtolower($result[0]->type).'/'.$result[0]->$key);
				}
			}
			$type = $this->input->post('type_ad');
			$data = array(
				'position'=> $this->input->post('position_ad'),
				'file'=> $fileName['file'],
				'type'=> $type,
				'width'=> $this->input->post('width_ad'),
				'height'=> $this->input->post('height_ad'),
				'title'	=>	$this->input->post('title_ad'),
				'status'=> $status,
				'modified'=> date('Y-m-d H:i:s',time()),
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
	}

	
	/*----------------------FRONTEND----------------------*/
	function getPageBanner($page = ''){
		$now = date('Y-m-d H:i:s');
		$this->db->where(array('page'=>$page,'status',1))->where("`start_date` <= '$now'")->where("`end_date` > '$now'");
		$data = $this->db->get(PREFIX.$this->table)->result();
		$retval = array();
		if(is_array($data)){
			foreach($data as $item){
				$retval[$data->position][] = $item;
			}
		}
		return $retval;
	}
	
	function checkPosition($page, $position, $id){
		$this->db->where(array('position'=>$position));
		if($id > 0)
			$this->db->where('id != '.$id);
		$rows = $this->db->get(PREFIX.'banner_position')->num_rows();
		if($rows > 0)
			return FALSE;
		else
			return TRUE;
	}
	/*--------------------END FRONTEND--------------------*/
}