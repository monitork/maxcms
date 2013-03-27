<?php

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Load the Database Module REQUIRED for this to work.
        $this->load->database(); //Without it -> Message: Undefined property: XXXController::$db
    }

    function get($select = "*", $table = "", $where = "", $return_array = false) {
        $this->db->select($select);
        if ($where != "") {
            $this->db->where($where);
        }
        #Query
        $query = $this->db->get($table);
        if ($return_array) {
            $result = $query->row_array();
        } else {
            $result = $query->row();
        }
        $query->free_result();
        return $result;
    }

    function fetch($select = "*", $table = "", $where = "", $order = "", $by = "DESC", $start = -1, $limit = 0, $return_array = false) {

        $this->db->select($select);
        if ($where != "") {
            $this->db->where($where);
        }
        if ($order != "" && (strtolower($by) == "desc" || strtolower($by) == "asc")) {
            if ($order == 'rand') {
                $this->db->order_by('rand()');
            } else {
                $this->db->order_by($order, $by);
            }
        }

        if ((int) $start >= 0 && (int) $limit > 0) {
            $this->db->limit($limit, $start);
        }
        #Query
        $query = $this->db->get($table);
        if ($return_array) {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        $query->free_result();
        return $result;
    }

    function fetch_join($select = "*", $table = "", $where = "", $join_1 = "", $table_1 = "", $on_1 = "", $join_2 = "", $table_2 = "", $on_2 = "", $order = "", $by = "DESC", $start = -1, $limit = 0, $distinct = false, $return_array = false) {
        $this->db->select($select);
        if (($join_1 == "INNER" || $join_1 == "LEFT" || $join_1 == "RIGHT") && $table_1 != "" && $on_1 != "") {
            $this->db->join($table_1, $on_1, $join_1);
        }
        if (($join_2 == "INNER" || $join_2 == "LEFT" || $join_2 == "RIGHT") && $table_2 != "" && $on_2 != "") {
            $this->db->join($table_2, $on_2, $join_2);
        }
        if ($where != "") {
            $this->db->where($where);
        }
        if ($order != "" && (strtolower($by) == "desc" || strtolower($by) == "asc")) {
            $this->db->order_by($order, $by);
        }
        if ((int) $start >= 0 && (int) $limit > 0) {
            $this->db->limit($limit, $start);
        }
        if ($distinct == true) {
            $this->db->distinct();
        }
        #Query
        $query = $this->db->get($table);
        if ($return_array) {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        $query->free_result();
        return $result;
    }

    function insert($table = "", $data) {
        return $this->db->insert($table, $data);
    }

    function update($table = "", $data, $where = "") {
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->update($table, $data);
    }

    function delete($table = "", $where = "") {
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->delete($table);
    }

    function Upload($file = '', $uploadDir = '') {
        if ($file['error'] != 0 || empty($uploadDir))
            return false;
        Newfolder($uploadDir);
        $tmp_name = $file['tmp_name'];
        $path_parts = pathinfo($file['name']);
        $path_parts['dirname'];
        $path_parts['extension'];

        //TODO: Lay extesion
        $ext = "." . strtolower($path_parts['extension']);
        $name = get_folder() . md5(uniqid(mt_rand())) . '_' . time() . $ext;
		$get_folder_date = get_folder();
		@mkdir($uploadDir . $get_folder_date); 
		
        if (move_uploaded_file($tmp_name, $uploadDir . $name)) {
            //Upload  thanh cong
            return $name;
        } else {
            return false;
        }//else	
    }
    // function chí
    public function get_data($params, $type = "object") {
        if (isset($params["select"])) {
            $this->db->select($params["select"]);
        }

        if (isset($params["where"])) {
            $this->db->where($params["where"]);
        }

        if (isset($params["join"])) {
            $i = 0;
            foreach ($params["join"]['table'] as $k => $v) {
                if (isset($params["join"]['type'])) {
                    if (is_array($params["join"]['type'])) {
                        $this->db->join(PREFIX . $k, $v, $params["join"]['type'][$i]);
                    } else {
                        $this->db->join(PREFIX . $k, $v, $params["join"]['type']);
                    }
                } else {
                    $this->db->join(PREFIX . $k, $v);
                }
                $i++;
            }
        }

        if (isset($params["or_where"])) {
            foreach ($params["or_where"] as $k => $v) {
                $this->db->or_where($k, $v);
            }
        }

        if (isset($params["where_in"])) {
            foreach ($params["where_in"] as $k => $v) {
                $this->db->where_in($k, $v);
            }
        }

        if (isset($params["or_where_in"])) {
            foreach ($params["or_where_in"] as $k => $v) {
                $this->db->or_where_in($k, $v);
            }
        }

        if (isset($params["where_not_in"])) {
            foreach ($params["where_not_in"] as $k => $v) {
                $this->db->where_not_in($k, $v);
            }
        }

        if (isset($params["or_where_not_in"])) {
            foreach ($params["or_where_not_in"] as $k => $v) {
                $this->db->or_where_not_in($k, $v);
            }
        }
        if (isset($params["group_by"])) {
            $this->db->group_by($params["group_by"]);
        }

        if (isset($params["having"])) {
            $this->db->having($params["having"]);
        }

        if (isset($params["or_having"])) {
            $this->db->or_having($params["having"]);
        }

        if (isset($params["like"])) {
            foreach ($params["like"] as $k => $v) {
                $this->db->like($k, $v);
            }
        }

        if (isset($params["or_like"])) {
            foreach ($params["or_like"] as $k => $v) {
                $this->db->or_like($k, $v);
            }
        }

        if (isset($params["not_like"])) {
            foreach ($params["not_like"] as $k => $v) {
                $this->db->not_like($k, $v);
            }
        }

        if (isset($params["or_not_like"])) {
            foreach ($params["or_not_like"] as $k => $v) {
                $this->db->not_like($k, $v);
            }
        }

        if (isset($params["order_by"])) {
            if(is_array($params["order_by"])){
                foreach ($params["order_by"] as $k => $v) {
                    $this->db->order_by($k, $v);
                }
            }  else {
                $this->db->order_by($params["order_by"]);
            }
        }
        if (isset($params["distinct"])) {
            $this->db->distinct();
        }

        if (isset($params["limit"])) {
            $limit = explode(',', $params["limit"]);
            if (count($limit) > 1) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($params["limit"]);
            }
        }

        $query = $this->db->get(PREFIX . $params["table"]);
        if ($type == "object")
            $data= $query->result();
        else if ($type == "array")
            $data= $query->result_array();
        else if ($type == "row")
            $data= $query->first_row();
        if($data){
            return $data;
        }
    }
    
    function row_data($table, $where = array()) {
        if (count($where) > 0)
            $this->db->where($where);
        
        $query = $this->db->get(PREFIX . $table);
        if ($query->result())
            return $query->first_row();
        else
            return false;
    }
    
    function insert_id($table, $array = array()) {
        $this->db->set($array);
        $this->db->insert(PREFIX . $table);
        return $this->db->insert_id();
    }

    function getArrVal($table, $keyField = 'id', $valueField){
        $data = $this->fetch('', $table, "", "", "", -1, 0, true);
        $rs = array();
        if( $data ){
            foreach($data as $item){
                $rs[$item[$keyField]] = $item[$valueField];
            }
            return $rs;
        }
        return false;
    }

    function getValue($table, $field, $value, $returnField){

        $query = $this->db->select($returnField)->where($field, $value)->get($table)->row_array();
        return ($query) ? $query[$returnField] : false;

    }
	
	/******VALIDATE FROM******/
	function validate_fullname(&$arr_error='', &$error=''){
		$fullname= mysql_real_escape_string($this->input->post('fullname'));
		if($this->validate_null($arr_error, $f_error, 'fullname')){
		}else{
			$arr_error[]= array(
				'field'	=> 'fullname',
				'txt'	=> 'Bạn chưa nhập họ tên'
			);	
		}
		$this->validate_error($error, $f_error);
	}
	
	function validate_email(&$arr_error='', &$error='', $check= ''){
		$email= mysql_real_escape_string($this->input->post('email'));
		
		if($this->validate_null($arr_error, $f_error, 'email')){
			//CHECK USERNAME
			if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){ 
				if(!empty($check)){
					$email= $this->model->get('*', USER_TB, "`email` = '$email'");
					if(!empty($email)){
						$arr_error[]= array(
							'field'	=> 'email',
							'txt'	=> 'Email đã được đăng ký'
						);
						$t_error= true;
					}
				}	
			}else{
					$arr_error[]= array(
						'field'	=> 'email',
						'txt'	=> 'Email không hợp lệ'
					);
					$f_error= true;
			}
		}else{
			$arr_error[]= array(
				'field'	=> 'email',
				'txt'	=> 'Bạn chưa nhập email'
			);	
		}
		$this->validate_error($error, $f_error);
	}	

	function validate_re_email(&$arr_error='', &$error=''){
		$email= $this->input->post('email');
		$re_email= $this->input->post('re_email');
		
		if(!empty($email)){
			if($this->validate_null($arr_error, $f_error, 're_email')){
				if($email!=$re_email){
					$arr_error[]= array(
						'field'	=> 're_email',
						'txt'	=> 'Nhập lại email không trùng khớp'
					);
					$f_error= true;						
				}
			}else{
				$arr_error[]= array(
					'field'	=> 're_email',
					'txt'	=> 'Bạn chưa nhập lặp lại email'
				);				
			}
		}
		$this->validate_error($error, $f_error);
	}		

	function validate_password(&$arr_error='', &$error='', $skip=''){
		$password= $this->input->post('password');
		$type= mysql_real_escape_string($this->input->post('type'));
		if($this->validate_null($arr_error, $f_error, 'password')){
			if(empty($skip)){
				if(strlen($password)<6){
					$arr_error[]= array(
						'field'	=> 'password',
						'txt'	=> 'Mật khẩu phải gồm ít nhất 6 ký tự'
					);
					$f_error= true;			
				}elseif($password=='123456'){
					$arr_error[]= array(
						'field'	=> 'password',
						'txt'	=> 'Mật khẩu của bạn quá đơn giản'
					);
					$f_error= true;							
				}
			}
		}else{
			$arr_error[]= array(
				'field'	=> 'password',
				'txt'	=> 'Bạn chưa nhập mật khẩu'
			);				
		}
		$this->validate_error($error, $f_error);
	}
	
	function validate_re_password(&$arr_error='', &$error=''){
		$password= $this->input->post('password');
		$re_password= $this->input->post('re_password');
		if(!empty($password)){
			if($this->validate_null($arr_error, $f_error, 're_password')){
				if($password!=$re_password){
					$arr_error[]= array(
						'field'	=> 're_password',
						'txt'	=> 'Mật khẩu lặp lại không trùng khớp'
					);
					$f_error= true;						
				}
			}else{
				$arr_error[]= array(
					'field'	=> 're_password',
					'txt'	=> 'Bạn chưa nhập lặp lại mật khẩu'
				);				
			}
		}
		$this->validate_error($error, $f_error);
	}	
	
	function validate_phone(&$arr_error='', &$error=''){
		$phone= $this->input->post('phone');
		if($this->validate_null($arr_error, $f_error, 'phone')){			
			if(!is_numeric($phone) || strlen($phone)<=9){
				$arr_error[]= array(
					'field'	=> 'phone',
					'txt'	=> 'Số điện thoại không hợp lệ'
				);
				$f_error= true;					
			}else{
				if(substr($phone, 0,2)==='01'){
					if(strlen($phone)<11 || strlen($phone)>11){
						$arr_error[]= array(
							'field'	=> 'phone',
							'txt'	=> 'Số điện thoại không hợp lệ'
						);
						$f_error= true;	
					}
				}else{
					if(strlen($phone)<10 || strlen($phone)>10){
						$arr_error[]= array(
							'field'	=> 'phone',
							'txt'	=> 'Số điện thoại không hợp lệ'
						);
						$f_error= true;	
					}
				}			
			}
		}else{
			$arr_error[]= array(
				'field'	=> 'phone',
				'txt'	=> 'Bạn chưa nhập số điện thoại'
			);		
		}
		$this->validate_error($error, $f_error);
	}
	
	function validate_cmnd(&$arr_error='', &$error=''){
		$cmnd= $this->input->post('cmnd');
		if($this->validate_null($arr_error, $f_error, 'cmnd')){
			if(!is_numeric($cmnd) || strlen($cmnd)<9){
				$arr_error[]= array(
					'field'	=> 'cmnd',
					'txt'	=> 'CMND không hợp lệ'
				);
				$f_error= true;						
			}
		}else{
			$arr_error[]= array(
				'field'	=> 'cmnd',
				'txt'	=> 'Bạn chưa nhập CMND'
			);			
		}
		$this->validate_error($error, $f_error);
	}	
		
	function validate_age(&$arr_error='', &$error=''){
		if($this->validate_null($arr_error, $f_error, 'age')){
			if(((int)$this->input->post('age')) < 16){
				$arr_error[]= array(
					'field'	=> 'age',
					'txt'	=> 'Bạn chưa đủ 16 tuổi'
				);			
				$f_error= true;	
			}
		}else{
			$arr_error[]= array(
				'field'	=> 'age',
				'txt'	=> 'Bạn chưa nhập tuổi'
			);			
		}
		$this->validate_error($error, $f_error);
	}		
	
	function validate_captcha(&$arr_error='', &$error=''){
		if($this->validate_null($arr_error, $f_error, 'captcha')){
			session_start();
			$captcha= strtolower($this->input->post('captcha'));
			$s_captcha= (isset($_SESSION['ss_captcha']))?$_SESSION['ss_captcha']:_token();

			if($captcha!=$s_captcha){
				$arr_error[]= array(
					'field'	=> 'captcha',
					'txt'	=> 'Mã bảo vệ không trùng khớp'
				);			
				$f_error= true;	
			}		
		}else{
			$arr_error[]= array(
				'field'	=> 'captcha',
				'txt'	=> 'Bạn chưa nhập mã bảo vệ'
			);			
		}
		$this->validate_error($error, $f_error);
	}		
	
	function validate_rules(&$arr_error='', &$error=''){
		if($this->input->post('rules')!='on'){
			$arr_error[]= array(
				'field'	=> 'rules',
				'txt'	=> 'Bạn chưa chấp nhận quy định và thể lệ của chương trình'
			);
			$t_error= true;		
		}
		$this->validate_error($error, $t_error);	
	}	
	
	function validate_ext(&$arr_error='', &$error='', $field='', $txt=''){
		if($this->validate_null($arr_error, $f_error, $field)){		
		}else{
			$arr_error[]= array(
				'field'	=> $field,
				'txt'	=> $txt
			);			
		}
		$this->validate_error($error, $f_error);
	}	
	
	function validate_null(&$arr_error='', &$f_error='', $field=''){
		if(!trim($this->input->post($field)))
		{
			$f_error= true;		
		}
		else
		{
			return true;
		}
	}
	
	function validate_error(&$error='', &$f_error=''){
		$error= (empty($error))?$f_error:true;
		return $error;
	}
	
	function send_email($data= '') {
		$this->load->library('email');
		$config['useragent'] = USERAGENT;		
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
			
		$this->email->from(EMAIL_FORM, EMAIL_NAME);
		$this->email->to($data['email']);
		$this->email->subject($data['subject']);
		$this->email->message($data['html']);
		if($this->email->send()) {
			return true;
		}
	}
	
	function loginRemember(){
		if(!empty($_COOKIE["__email"]) && !empty($_COOKIE["__password"]))
		{
			$email= $_COOKIE["__email"];$cookie= $_COOKIE["__password"];
			$USER= $this->get('*', USER_TB, "`email` = '$email' AND `cookie` = '$cookie' AND `status` = 1");
			if(!empty($USER)){
				$ss_user= array(
					'uid'		=> $USER->id,
					'email'		=> $USER->email,
					'fullname'	=> $USER->fullname
				);
				$this->session->set_userdata('ss_user', $ss_user);
				$this->session->set_userdata('userInfo', $USER->email);
				$this->session->set_userdata('info', $USER);					
			}			
		}
	}	
	/*****END VALIDATE FROM*****/
}