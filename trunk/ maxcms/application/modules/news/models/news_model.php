<?php
class News_model extends MY_Model {
	
	private $table;
	public function __construct(){
		$month_suffix = date("Y_m", time());
		$table_name = 'news_'.$month_suffix;
		$query = $this->db->query("SHOW TABLES LIKE '{$table_name}'");
			$checked_table = $query->result();
			if(empty($checked_table)){
				$create_table_sql = 
						"CREATE TABLE {$table_name} (
						`id` int(11) NOT NULL auto_increment,
						`parent_id` int(11) default '0' COMMENT 'category_news',
						`user_id` int(11) default '0',
						`image` varchar(255) default NULL,
						`video` varchar(255) default NULL,
						`title` varchar(255) default NULL,
						`slug` varchar(255) default NULL,
						`tinnoibat` tinyint(10) NOT NULL,
						`description` text,
						`content` text,
						`datepost` datetime default NULL,
						`created` datetime default NULL,
						`changed` datetime default NULL,
						`status` tinyint(1) default '1',
						`order` int(11) NOT NULL default '0',
						PRIMARY KEY  (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
						
				$this->db->query($create_table_sql);
			}
		$this->table  = $table_name;
  
	}
	function getsearchContent($limit,$page){
      
		$this->db->select($this->table.'.*,'.CATEGORY_NEWS_TB.".name AS categoryName");
		$this->db->join(CATEGORY_NEWS_TB, $this->table.'.parent_id = '.CATEGORY_NEWS_TB.'.id');
		$this->db->from($this->table);
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$content= $this->input->post('content');
			$this->db->where($this->table.".title LIKE '%$content%' OR ".$this->table.".description LIKE '%$content%' OR ".$this->table.".content LIKE '%$content%'");
		}
        /* if($info->group_id==4){
            $this->db->where('user_id',$info->id);
        } */
		if($this->input->post('category')!=''){
			//$this->db->where(CATEGORY_NEWS_TB.".id = ".$this->input->post('category'));
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select($this->table.'.*,'.CATEGORY_NEWS_TB.".name AS categoryName");
		$this->db->from($this->table);
		$this->db->join(CATEGORY_NEWS_TB, $this->table.'.parent_id = '.CATEGORY_NEWS_TB.'.id');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$content= $this->input->post('content');
			$this->db->where($this->table.".title LIKE '%$content%' OR ".$this->table.".description LIKE '%$content%' OR ".$this->table.".content LIKE '%$content%'");
		}
        /* if($info->group_id==4){
            $this->db->where('user_id',$info->id);
        } */
		if($this->input->post('category')!=''){
			//$this->db->where(CATEGORY_NEWS_TB.".id = ".$this->input->post('category'));
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		
		$query = $this->db->count_all_results();

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get($this->table);
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	/* function getdbGiaitri(){
		$db_old = $this->load->database('autobay_old', TRUE);
		$db_old->select('*');
		$db_old->order_by('created', 'asc');
		$query = $db_old->get('cli_giaitri');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}		
	}

	function getdbGiaitriVideo(){
		$db_old = $this->load->database('autobay_old', TRUE);
		$db_old->select('*');
		$db_old->where("parent_id = 36 AND slug != '' AND video != ''");
		$db_old->limit(1);
		$db_old->order_by('id', 'random');
		$query = $db_old->get('cli_giaitri');
		if($query->row()){
			return $query->row();
		}else{
			return false;
		}		
	} */
	
	function updateUpYoutube($id=0){
		$db_old = $this->load->database('autobay_old', TRUE);
		$data['youtube']= 1;
		$this->db->update('cli_giaitri', $data, "id = $id");
	
	}
	
	function getdbTags(){
		$db_old = $this->load->database('autobay_old', TRUE);
		$db_old->select('*');
		$db_old->order_by('id', 'asc');
		$query = $db_old->get('cli_tag2');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}		
	}	
	
	function getdbJoinTags(){
		$db_old = $this->load->database('autobay_old', TRUE);
		$db_old->select('*');
		$db_old->order_by('id', 'asc');
		$query = $db_old->get('cli_giaitri_tag');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}		
	}		
	
	function getdbConsultants(){
		$db_old = $this->load->database('autobay_old', TRUE);
		$db_old->select('*');
		$db_old->order_by('created', 'asc');
		$query = $db_old->get('cli_consultants');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}		
	}		
	
	function saveManagement($fileName=''){
		//$USER= $this->session->userdata('ss_user');
		$id = (int)$this->input->post('hiddenIdAdmincp');
		$image= (isset($_FILES['image']))?$this->Upload($_FILES['image'],DIR_NEWS_IMAGES):'';
		if($this->input->post('hiddenIdAdmincp')==0){
			$title_slug= htmlspecialchars($this->input->post('title'), ENT_QUOTES, "UTF-8");
			$slug= create_slug($title_slug);
			//CHECK SLUG
			$check_slug= $this->get('id', $this->table, "`slug` = '$slug'");
			if(!empty($check_slug)) {echo 'SLUG_EXIST';exit();}
			
			$data = array(
				'parent_id'			=> $parent_id = $this->input->post('parent_id'),
				//'user_id'			=> $USER->id,
			    'tinnoibat'			=> ($this->input->post('tinnoibat')=='on')?1:0,
				'image'				=> $image,
				/* 'video'				=> youtube_id($this->input->post('video')), */
				'title'				=> htmlspecialchars($this->input->post('title'), ENT_QUOTES, "UTF-8"),
				'slug'				=> $slug,
				'description'		=> $this->input->post('description'),
				'content'			=> $this->input->post('contentAdmincp'),
				'datepost'			=> date('Y-m-d H:i:s', time()),
				'status'			=> ($this->input->post('statusAdmincp')=='on')?1:0,
				'order'				=> $this->input->post('order'),
				'created'			=> date('Y-m-d H:i:s',time()),
				'changed'			=> date('Y-m-d H:i:s',time())
			);
			
			// Get table_name based on current month
			$month_suffix = date("Y_m", time());
			$table_name = 'news_'.$month_suffix; 
			
			// Check if table exists
			$query = $this->db->query("SHOW TABLES LIKE '{$table_name}'");
			$checked_table = $query->result();
			if(empty($checked_table)){
				$create_table_sql = 
						"CREATE TABLE {$table_name} (
						`id` int(11) NOT NULL auto_increment,
						`parent_id` int(11) default '0' COMMENT 'category_news',
						`user_id` int(11) default '0',
						`image` varchar(255) default NULL,
						`video` varchar(255) default NULL,
						`title` varchar(255) default NULL,
						`slug` varchar(255) default NULL,
						`tinnoibat` tinyint(10) NOT NULL,
						`description` text,
						`content` text,
						`datepost` datetime default NULL,
						`created` datetime default NULL,
						`changed` datetime default NULL,
						`status` tinyint(1) default '1',
						`order` int(11) NOT NULL default '0',
						PRIMARY KEY  (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
						
				$this->db->query($create_table_sql);
			}
			
			$max_id_record = $this->get('MAX(id) AS id',$table_name);
			$max_id = !empty($max_id_record->id) ? $max_id_record->id : 0;
			$max_id++;
			$data_blog = array(
				'new_id'			=> $max_id,
				'table_name'		=> $table_name,
				'title'				=> htmlspecialchars($this->input->post('title'), ENT_QUOTES, "UTF-8"),
				'slug'				=> $slug,
				'created'			=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert($table_name,$data)){
				$this->session->set_userdata('category_filter',$parent_id);
				$id= $this->db->insert_id();
				$this->insert_tags($id);
				return $id;
			}
		}else{
			$id= $this->input->post('hiddenIdAdmincp');
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			
			//SLUG
			$slug= $result[0]->slug;
			$title_slug= htmlspecialchars($this->input->post('title'), ENT_QUOTES, "UTF-8");
			if($result[0]->title!=$title_slug)
			{
				$slug= create_slug($title_slug);
				//CHECK SLUG
				$check_slug= $this->get('id', $this->table, "`slug` = '$slug'");
				if(!empty($check_slug)) {echo 'SLUG_EXIST';exit();}
			}
			//END SLUG
			
			if(isset($_FILES['image']) && $_FILES['image']['error']==0){@unlink(DIR_NEWS_IMAGES.$result[0]->image);}
			
			$this->insert_tags($id);
			$data = array(
				'parent_id'			=> $parent_id = $this->input->post('parent_id'),
				//'user_id'			=> $USER->id,
				'tinnoibat'			=> ($this->input->post('tinnoibat')=='on')?1:0,
				'image'				=> !empty($image)?$image:$result[0]->image,
				/* 'video'				=> youtube_id($this->input->post('video')), */
				'title'				=> htmlspecialchars($this->input->post('title'), ENT_QUOTES, "UTF-8"),
				'slug'				=> $slug,
				'description'		=> $this->input->post('description'),
				'content'			=> $this->input->post('contentAdmincp'),
				'datepost'			=> date('Y-m-d H:i:s', strtotime($this->input->post('datepost'))),
				'status'			=> ($this->input->post('statusAdmincp')=='on')?1:0,
				'order'				=> $this->input->post('order'),
				'changed'			=> date('Y-m-d H:i:s',time())
			);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update($this->table,$data)){
				$this->session->set_userdata('category_filter',$parent_id);
				return $id;
			}
		}
		return false;
	}
	
	function insert_tags($id= 0){
		//TAGS
		$tags= $this->input->post('tags');
		if(!empty($tags))
		{
			$arr_tags= explode(',', $tags);
			//ALL TAGS
			$all_tags= $this->model->fetch('*', JOIN_TAGS_TB, "item_id = '$id'");
			foreach($all_tags as $at){
				//CHECK IN ARRAY
				$item_id= $at->item_id;
				$tags_id= $at->tags_id;
				$tmp_tags= $this->model->get('*', TAGS_TB, "id = '$tags_id'");
				$name_tags= $tmp_tags->tags;
				if(!in_array($name_tags, $arr_tags))
				{
					//CHECK OLD TAGS
					$this->db->where("item_id = '$item_id' AND tags_id = '$tags_id'");
					$this->db->delete(JOIN_TAGS_TB);
				}
				$check_tags= $this->model->get('*', JOIN_TAGS_TB, "item_id = '$item_id' AND tags_id = '$tags_id'");
			}
			//CHECK TAGS INPUT
			foreach($arr_tags as $row){
				$row_tags= $this->model->get('*', TAGS_TB, "tags = '$row'");
				if(!empty($row_tags))
				{
					//TAGS EXIST
					$row_tags_id= $row_tags->id;
					$check_join= $this->model->get('*', JOIN_TAGS_TB, "item_id = '$id' AND tags_id = '$row_tags_id'");
					if(empty($check_join))
					{
						//INSERT JOIN
						$data_join= array(
							'item_id' => $id,
							'tags_id' => $row_tags_id,
							'created' => date('Y-m-d H:i:s')
						);
						$this->db->insert(JOIN_TAGS_TB, $data_join);
					}
				}
				else
				{
					$data_tags= array(
						'tags' 		=> $row,
						'slug' 		=> create_slug($row),
						'created'	=> date('Y-m-d H:i:s')
					);
					$this->db->insert(TAGS_TB, $data_tags);
					$tags_id= $this->db->insert_id();
					//INSERT JOIN
					$data_join= array(
						'item_id' => $id,
						'tags_id' => $tags_id,
						'created' => date('Y-m-d H:i:s')
					);
					$this->db->insert(JOIN_TAGS_TB, $data_join);					
				}
			}
		}
		else
		{
			//EMPTY TAGS DELETE ALL TAGS IN TABLE JOIN
			$this->db->where("item_id = '$id'");
			$this->db->delete(JOIN_TAGS_TB);
		}
		//END TAGS
	}

	/*DB*/
	function get_tags($tags=''){
		$this->db->select('*');
		$this->db->where("tags LIKE '%$tags%'");
		$this->db->limit(50);
		$query= $this->db->get(TAGS_TB);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function get_all_tags($item_id){
		$this->db->select(JOIN_TAGS_TB.'.* ,'.TAGS_TB.'.tags, slug');
		$this->db->from(JOIN_TAGS_TB);
		$this->db->where(JOIN_TAGS_TB.".item_id = '$item_id'");
		$this->db->order_by(JOIN_TAGS_TB.'.id', 'asc');
		$this->db->join(TAGS_TB, JOIN_TAGS_TB.'.tags_id = '.TAGS_TB.'.id');
		$query= $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}		
	}

	function get_join_tags(){
		$this->db->select('*');
		//$this->db->group_by('item_id');
		$this->db->order_by('item_id', 'asc');
		$query= $this->db->get('cli_join_tags');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}	
	/*END DB*/
	
	function getList($limit = -1, $page = -1, $parent_id = 0, $order=''){
		$this->db->select('*');
		$this->db->where("parent_id = '$parent_id' AND status = 1");
		
		if(empty($order)){
			$this->db->order_by('order desc, datepost desc');
		}else{
			switch($order){
				case('moi-nhat'):
					$this->db->order_by('order desc, datepost desc');
					break;
				case('cu-nhat'):
					$this->db->order_by('order desc, datepost asc');
					break;					
			}
		}
		
		if ($limit != -1) {
			$this->db->limit($limit, $page);
		}
		$query = $this->db->get($this->table);

		if ($query->result()) {
			if ($limit == -1) {
				return count($query->result());
			} else {
				return $query->result();
			}
		}else{
			return false;		
		}
	}
	
	function getDetail($slug){
		$this->db->select($this->table.'.*, '.CATEGORY_NEWS_TB.'.name, '.CATEGORY_NEWS_TB.'.slug as c_slug, type');
		$this->db->join(CATEGORY_NEWS_TB, $this->table.'.parent_id = '.CATEGORY_NEWS_TB.'.id');
		$this->db->where($this->table.".slug = '{$slug}' AND ".$this->table.".status = 1");
		$query= $this->db->get($this->table);
		if($query->row()){
			return $query->row();
		}else{
			return false;
		}
	}
	
	function getNews($id=0){
		$this->db->select($this->table.'.*, '.CATEGORY_NEWS_TB.'.name, '.CATEGORY_NEWS_TB.'.slug as c_slug, type');
		$this->db->join(CATEGORY_NEWS_TB, $this->table.'.parent_id = '.CATEGORY_NEWS_TB.'.id');
		$this->db->where($this->table.".id = '{$id}' AND ".$this->table.".status = 1");
		$query= $this->db->get($this->table);
		if($query->row()){
			return $query->row();
		}else{
			return false;
		}
	}	
	
	
   
    // chi function
    function get_user($username){
        $this->db->where('username',$username);
        $query = $this->db->get('cli_user');
        if($query->num_rows() == 1)
		{
			return $query->first_row();
		}else{
            return false;
        }
    }

}