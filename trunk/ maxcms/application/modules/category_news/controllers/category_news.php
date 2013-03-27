<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_news extends MX_Controller {

	private $module = 'category_news';
	private $table = 'category_news';
	function __construct(){
		parent::__construct();
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
		$default_sort = 'DESC';
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
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result[0] = array();
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
		}
		$data = array(
			'result'=>$result[0],
			'module'=>$this->module,
			'id'=>$id
		);
		$this->template->write_view('content','BACKEND/ajax_editContent',$data);
		$this->template->render();
	}

	public function admincp_save(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($_POST){
			//Upload Image
			$fileName = '';
			if($_FILES){
				if(isset($_FILES['fileAdmincp']['error'])){
					$typeFileImage = strtolower(substr($_FILES['fileAdmincp']['type'],0,5));
					if($typeFileImage == 'image'){
						$tmp_name = $_FILES['fileAdmincp']["tmp_name"];
						$file_name = $_FILES['fileAdmincp']['name'];
						$ext = strtolower(substr($file_name, -4, 4));
						if($ext=='jpeg'){
							$fileName = time().'_'.md5(substr($file_name,0,-5)).'.jpg';
						}else{
							$fileName = time().'_'.md5(substr($file_name,0,-4)).$ext;
						}
					}else{
						print 'Only upload Image.';
						exit;
					}
				}
			}
			//End Upload Image
			
			$id = $this->model->saveManagement($fileName);
			if($id){
				// Update left menu for Category of news
				$this->update_left_menu($id);
					
				$this->admincp_clean_cache();
				$result['message'] = 'success';
				$result['id'] = $id;
				echo json_encode($result);
				exit;
			}
		}
	}
	function update_left_menu($category_id){
		// Get category
		$number_type = $this->input->post('type');
		$category_news = $this->model->get('*', PREFIX.$this->table, "id = $category_id");
		if(!empty($category_news)){
			$category_name = $category_news->name;
			// Check existed menu
			$check_menu = $this->model->get('*', 'cli_menu', "var_id = $category_id");
			if($number_type == 1){
						$name_type = "category_news";
					}else{
						$name_type = "kinh-nghiem";
					} 
			$type_category_news = $this->model->get('*', PREFIX.'menu',"type = '{$name_type}'");
			if(!empty($check_menu)){
				$menu_data['name'] = $category_name;
				//$menu_data['parent_id'] = $type_category_news->id;
				$this->model->update('cli_menu',$menu_data,"id = {$check_menu->id}");
			} else {
				$menu_category_news = $this->model->get('*',PREFIX.'menu',"type = '{$type_category_news->type}'");
				if(!empty($menu_category_news)){
					$menu_data['parent_id'] = $menu_category_news->id;
					$menu_data['var_id'] = $category_id;
					$menu_data['name'] = $category_name;
					$menu_data['link'] = 'news?category='.$category_id;
					$menu_data['status'] = 1;
					$menu_data['created'] = getNow();
					if(!$this->model->insert('cli_menu',$menu_data)){
						// echo 'update_left_menu fail';
					}
				}
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
			$id = (int)$this->input->post('id');
			modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
			$this->db->where('id',$id);
			$this->db->delete(PREFIX.$this->table);
			
			// Update left menu for Category of news
			modules::run('menu_category/delete_category',$id);
			
			$this->admincp_clean_cache();
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
			modules::run('menu_category/UpdateStatus',$this->input->post('id'),$this->input->post('status'));
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
			$this->db->update(PREFIX.$this->table, $data);
			$this->db->where('parent_id', $this->input->post('id'));
			$this->db->update(NEWS_TB,$data);
			$this->admincp_clean_cache();
		}
		
		$update = array(
			'status'=>$status,
			'id'=>$this->input->post('id'),
			'module'=>$this->module
		);
		$this->load->view('BACKEND/ajax_updateStatus',$update);
	}
	
	function admincp_change_data()
	{
		if($this->model->moveDatabase() == false){
			echo "Đã tồn tại dữ liệu";
		}
	}
	
	function admincp_clean_cache(){
		//delete_cache_path($this->config,'tin-tuc');
		//delete_cache_path($this->config,'kinh-nghiem');
	}
	
	/*------------------------------------ End Admin Control Panel --------------------------------*/
	
	/*------------------------------------ BEGIN Admin Control Panel --------------------------------*/
	public function index()
	{
		
	}
	
	
	


	/*------------------------------------ End Admin Control Panel --------------------------------*/
}