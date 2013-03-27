<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MX_Controller {
	private $module = 'news';
	private $table;
	function __construct(){
		parent::__construct();
		$month_suffix = date("Y_m", time());
		$table_name = 'news_'.$month_suffix;
		$this->table  = $table_name;
		$this->load->model($this->module.'_model','model');
		//$this->load->model('admincp_modules/admincp_modules_model');
		if($this->uri->segment(1)=='admincp'){
			if($this->uri->segment(2)!='login'){
				if(!$this->session->userdata('userInfo')){
					header('Location: '.PATH_URL.'admincp/login');
					return false;
				}
				/* $get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
				$this->session->set_userdata('ID_Module',$get_module[0]->id);
				$this->session->set_userdata('Name_Module',$get_module[0]->name); */
			}
			$this->template->set_template('admin');
			$this->template->write('title','Admin Control Panel');
		}
	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'changed';
		$default_sort = 'desc';
		if($this->input->get('category'))
		{
			$this->session->set_userdata('category_filter', $this->input->get('category'));
		}
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort
		);
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}
	
	public function admincp_update($id=0){
        $info=$this->session->userdata('ss_user');
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result = $this->model->getDetailManagement($id);
         if ($info->group_id ==4 )
         {
              if($id!=0){                
                if($result[0]->user_id!=$info->id){
                        header('Location: '.PATH_URL.'admincp/permission');
                        exit();
                    }
    		}
         }
		//ALL TAGS
		$all_tags= $this->model->get_all_tags($id);
		$data = array(
			'result'=>$result[0],
			'op_list' => $this->model->fetch('*', CATEGORY_NEWS_TB, "parent_id != 0"),
			'module'=>$this->module,
			'id'=>$id,
			'all_tags' => $all_tags
		);
		$this->template->write_view('content','BACKEND/ajax_editContent',$data);
		$this->template->render();
	}

	public function admincp_save(){
		if($_POST){
			$id = $this->model->saveManagement();
			if($id){
				// Update left menu for Category of news
				$result['message'] = 'success';
				$result['id'] = $id;
				echo json_encode($result);
				exit;
			}
		}
	}
	
	public function admincp_delete(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$result = $this->model->getDetailManagement($id);
			modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
			$this->db->where('id',$id);
			if($this->db->delete($this->table)){
				$this->admincp_clean_cache();
				
				//Xóa hình khi Delete
				@unlink(DIR_NEWS_IMAGES.$result[0]->image);
				return true;
			}
		}
	}
	
	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);
		$result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'category'=>$this->input->post('category'),
			'module'=>$this->module
		);
		$this->session->set_userdata('start',$this->input->post('start'));
		$this->load->view('BACKEND/ajax_loadContent',$data);
	}
	
	public function admincp_ajaxUpdateStatus(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print '<script type="text/javascript">show_perm_denied()</script>';
			$status = $this->input->post('status');
			$data = array(
				'status'=>$status
			);
		}else{
			if($this->input->post('status')==0){
				$status = 1;
			}else{
				$status = 0;
			}
			$data = array(
				'status'=>$status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'status','update',$this->input->post('status'),$status);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update($this->table, $data);
			$this->admincp_clean_cache();
		}
		
		$update = array(
			'status'=>$status,
			'id'=>$this->input->post('id'),
			'module'=>$this->module
		);
		$this->load->view('BACKEND/ajax_updateStatus',$update);
	}
	
	function admincp_get_tags(){
		$tags= $this->input->get('term');
		$result= $this->model->get_tags($tags);
		$data= array();
		if(!empty($result))
		{
			foreach($result as $row){
				$data[]= array(
					'id' => $row->id,
					'label' => $row->tags,
					'value' => $row->tags
				);
			}
		}
		print_r(json_encode($data));
	}	
	
	function admincp_youtube(){
		if(isset($_FILES['video-youtube'])){
			$file= $_FILES['video-youtube'];
			if($file['error']==0){
				$params = array(
					'source'			=> $file,
					'filename'			=> $this->input->post('title-youtube')
				);
				$this->load->library('youtube', $params);
				$youtube_id= $this->youtube->upload();				
				$json['st']= 'SUCCESS';
				$json['youtube']= $youtube_id;
			}else{
				$json['st']= 'FALSE';
			}
		}else{
			$json['st']= 'FALSE';
		}
		print_r(json_encode($json));
	}
	
	function admincp_clean_cache(){
		/* delete_cache_path($this->config,'tin-tuc');
		delete_cache_path($this->config,'kinh-nghiem'); */
	}

	/*------------------------------------ End Admin Control Panel --------------------------------*/
	function index(){
		$CATEGORY= $this->model->fetch('*', CATEGORY_NEWS_TB, "status = 1 and type = 1", 'order', 'asc');
		if(!empty($CATEGORY)){
			foreach($CATEGORY as $CATE){
				$CATE->news= $this->model->fetch_join($this->table.'.*,'.CATEGORY_NEWS_TB.'.slug as c_slug', $this->table, $this->table.".status = 1 AND ".$this->table.".parent_id = '{$CATE->id}'", 'INNER',CATEGORY_NEWS_TB, CATEGORY_NEWS_TB.".id = ".$this->table.".parent_id", '', '', '', 'datepost', 'desc', 0, 4);
			}
		}
		
		$CATEGORY_2= $this->model->fetch('*', CATEGORY_NEWS_TB, "status = 1 and type = 2", 'order', 'asc');
		if(!empty($CATEGORY_2)){
			foreach($CATEGORY_2 as $CATE_2){
				$category_new_2= $this->model->fetch('*', $this->table, "status = 1 and parent_id = '{$CATE_2->id}'", 'created', 'desc', 0, 3);
			}
		}
		
		$news_created = $this->model->fetch('*', $this->table , "status = 1 and tinnoibat = 1", 'created', 'desc', 0, 3);
		//$news_created_update = $this->model->fetch('*', $this->table , "status = 1", 'created', 'desc', 0, 3);
		$data= array(
			'NEW'		=> $this->model->fetch_join($this->table.'.*,'.CATEGORY_NEWS_TB.'.slug as c_slug', $this->table, $this->table.".status = 1 AND ".CATEGORY_NEWS_TB.".type = 1", 'INNER',CATEGORY_NEWS_TB, CATEGORY_NEWS_TB.".id = ".$this->table.".parent_id", '', '', '', 'datepost', 'desc', 0, 4),
			'CATEGORY'	=> $CATEGORY,
			'CATEGORY_2'	=> $CATEGORY_2,
			'news_created' => $news_created,
			//'news_created_update' => $news_created_update,
			'category_new_2' => $category_new_2
		);
		$data['banner']	= Modules::run('banner/getPageBanner','tin-tuc');
		
		$this->template->write('meta_description', 'Tin tức');
		$this->template->write('meta_keywords', 'tin tuc game');		
		$this->template->write('title', SEO_TITLE('Tin tức'));
		$this->template->write_view('content','FRONTEND/index',$data);
		$this->template->render();			
	}
	
	function category($slug=''){
		
		$slug= mysql_real_escape_string($slug);
		$CATEGORY= $this->model->get('*', CATEGORY_NEWS_TB, "slug = '{$slug}' AND status = 1");
		$RESULT_LIST= $this->model->fetch('*', $this->table, "parent_id = '{$CATEGORY->id}' AND status = 1",'datepost', 'desc', 0, 2);
		
		if(!empty($RESULT_LIST)){
			/* $pageNum = (int)$this->input->get('p');$pageSize = $view_page; $order= $this->input->get('o');
			if($pageNum<=1) $pageNum=1;
			$totalRows = $this->model->getList(-1, -1, $CATEGORY->id);
			echo $pageSize;
			$totalPage= ceil($totalRows/$pageSize);
			if($pageNum>$totalPage) redirect(PATH_URL);	
			$PAGINATION = pagination($totalRows, $pageNum, $pageSize);
			$startRow = ($pageNum - 1) * $pageSize;
			$RESULT_LIST = $this->model->getList($pageSize, $startRow, $CATEGORY->id, $order); */
			$TOTAL_LIST= $this->model->fetch('*', $this->table, "parent_id = '{$CATEGORY->id}' AND status = 1");
			$data= array(
				'CATEGORY'		=> $CATEGORY,
				'RESULT_LIST'	=> $RESULT_LIST,
				'TOTAL_LIST'	=> $TOTAL_LIST,
				/* 'PAGINATION'	=> $PAGINATION,
				'pageSize'		=> $pageSize, */
			);
			
			$this->template->write('meta_description', SEO_TITLE($CATEGORY->name));
			$this->template->write('meta_keywords', 'tin tuc, kinh nghiem, kinh nghiem xe may, mua ban oto');
			$parent_cate = $this->model->get('*', CATEGORY_NEWS_TB, 'id = '.$CATEGORY->parent_id);
			if($CATEGORY->type == 2){
				$type = 'kinh-nghiem-cac-danh-muc';
			}
			else{
				$type = 'tin-tuc-cac-danh-muc';
			}
			$data['banner']	= Modules::run('banner/getPageBanner',$type);
			
			$this->template->write('title', SEO_TITLE($CATEGORY->name));
			$this->template->write_view('content','FRONTEND/category',$data);
			$this->template->render();
		}else{
			redirect(PATH_URL);
		}		
	}
	
	function list_ajax_category($slug=''){
		$view_page_first = $this->input->post('view_page_first');
		$view_page_last = $this->input->post('view_page_last');
		$view_page = $view_page_first + $view_page_last;
		$slug= mysql_real_escape_string($slug);
		$CATEGORY= $this->model->get('*', CATEGORY_NEWS_TB, "slug = '{$slug}' AND status = 1");
		$RESULT_LIST= $this->model->fetch('*', $this->table, "parent_id = '{$CATEGORY->id}' AND status = 1",'datepost', 'desc', 0, $view_page);
		$TOTAL_LIST= $this->model->fetch('*', $this->table, "parent_id = '{$CATEGORY->id}' AND status = 1");
		
		if(!empty($RESULT_LIST)){
			$data= array(
				'CATEGORY'		=> $CATEGORY,
				'RESULT_LIST'	=> $RESULT_LIST,
				'TOTAL_LIST'	=> $TOTAL_LIST,
			);	
		 echo $this->load->view('FRONTEND/category',$data ,true);
		}		
	}
	function list_new_update(){
			
			$news_created_update= $this->model->fetch_join($this->table.'.*,'.CATEGORY_NEWS_TB.'.slug as c_slug', $this->table, $this->table.".status = 1", 'INNER',CATEGORY_NEWS_TB, CATEGORY_NEWS_TB.".id = ".$this->table.".parent_id", '', '', '', 'created', 'desc', 0, 3); 

			$data= array(
			'news_created_update' => $news_created_update,
			);
			
			echo $this->load->view('FRONTEND/tinmoinhat',$data ,true);
	}
	
	function tags($slug=''){
		$slug= mysql_real_escape_string($slug);
		$TAGS= $this->model->get('*', TAGS_TB, "slug = '{$slug}' AND status = 1");
		if(!empty($TAGS)){
			$pageNum = (int)$this->input->get('p');$pageSize = 6;$order= $this->input->get('o');
			if($pageNum<=1) $pageNum=1;
			$totalRows = $this->model->getListTags(-1, -1, $TAGS->id);
			$PAGINATION = pagination($totalRows, $pageNum, $pageSize);
			$totalPage= ceil($totalRows/$pageSize);
			if($pageNum>$totalPage) redirect(PATH_URL);				
			$startRow = ($pageNum - 1) * $pageSize;
			$RESULT_LIST = $this->model->getListTags($pageSize, $startRow, $TAGS->id, $order);
			
			$data= array(
				'TYPE'			=> 1,
				'TAGS'			=> $TAGS,
				'RESULT_LIST'	=> $RESULT_LIST,
				'PAGINATION'	=> $PAGINATION,
				'pageSize'		=> $pageSize
			);
			$data['banner']	= Modules::run('banner/getPageBanner','tin-tuc-tags');
			
			$this->template->write('meta_description', SEO_TITLE($TAGS->tags));
			$this->template->write('meta_keywords', 'tin tuc, kinh nghiem, kinh nghiem xe may, mua ban oto');				
			$this->template->write('title', SEO_TITLE('Tin tức - Tags: '.$TAGS->tags));
			$this->template->write_view('content','FRONTEND/tags',$data);
			$this->template->render();
		}else{
			redirect(PATH_URL);
		}		
	}
	
	
	function detail($slug=''){
		$slug= mysql_real_escape_string($slug);
		$NEWS= $this->model->getDetail($slug);
		if(!empty($NEWS)){
			$NEWS->tags= $this->model->get_all_tags($NEWS->id);

			$data= array(
				'NEWS'	=> $NEWS
			);
			$data['banner']	= Modules::run('banner/getPageBanner','chi-tiet-tin-tuc');
			
			$this->template->write('meta_description', $NEWS->description);
			$this->template->write('meta_keywords', 'tin tuc, kinh nghiem, kinh nghiem xe may, mua ban oto');
			$this->template->write('meta_image', img(DIR_NEWS_IMAGES.$NEWS->image,200,200));
			$this->template->write('title', SEO_TITLE($NEWS->title));
			$this->template->write_view('content','FRONTEND/detail',$data);
			$this->template->render();		
		}
	}
	function block_header(){
		$menu_top= $this->model->fetch('*', CATEGORY_NEWS_TB, "status = 1", 'order', 'asc');
		$data= array(
			'menu_top' => $menu_top
		);
		echo $this->load->view('FRONTEND/block/block_header',$data ,true);
	}
	
	function block_footer(){
		$data= array();
		 echo $this->load->view('FRONTEND/block/block_footer',$data ,true);
	}
	
	
	/*------------------------------------ FRONTEND ------------------------------------*/
	function db_category(){
		$result= $this->model->fetch('*', 'tmp_cli_category');
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$data= array(
					'id'		=> $row->id,
					'parent_id' => $row->parent_id,
					'name' 		=> $row->name,
					'slug' 		=> $row->slug,
					'created' 	=> date('Y-m-d H:i:s'),
					'status'	=> $row->is_active
				);
				$this->db->insert(CATEGORY_NEWS_TB, $data);
			}
		}
	}
	
	
	
	function db_tags(){
		$result= $this->model->getdbTags();
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$slug= create_slug($row->name);
				$data= array(
					'id'		=> $row->id,
					'tags' 		=> $row->name,
					'slug' 		=> $slug,
					'created' 	=> date('Y-m-d H:i:s'),
					'status'	=> $row->is_active
				);
				$this->db->insert(TAGS_TB, $data);
			}
		}		
	}
	
	function db_join_tags(){
		$result= $this->model->getdbJoinTags();
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$data= array(
					'item_id' 	=> 	$row->giaitri_id,
					'tags_id' 	=> $row->tag2_id,
					'created' 	=> date('Y-m-d H:i:s'),
				);
				$this->db->insert(JOIN_TAGS_TB, $data);
			}
		}		
	}

	function db_tags_news(){
		set_time_limit(0);
		$result= $this->model->get_join_tags();
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$news_id= $row->item_id;
				$tags_id= $row->tags_id;
				$news= $this->model->get('*', NEWS_TB, "id = '$news_id'");
				$row_tags= $this->model->get('*', TAGS_TB, "id = '$tags_id'");
				if(!empty($news))
				{	
					$tags= $news->tags;
					pr($tags);
					if($tags=='')
					{
						$tags= $row_tags->tags;
					}
					else
					{
						$tags.= ','.$row_tags->tags;
					}
					$data= array(
						'tags' 	=> 	$tags
					);
					$this->db->where('id', $news_id);
					$this->db->update(NEWS_TB, $data);		
					pr($news->id);
				}
			}
		}		
	}	
	
	//CONSULTANT
	

	
	
	
	/*------------------------------------ End FRONTEND --------------------------------*/
}