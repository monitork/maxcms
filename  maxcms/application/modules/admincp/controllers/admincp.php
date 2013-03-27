<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admincp extends MX_Controller {

    function __construct() {
        parent::__construct();
        if ($this->uri->segment(2) != 'login') {
            if (!$this->session->userdata('userInfo')) {
                header('Location: ' . PATH_URL . 'admincp/login');
                return false;
            }
        }
        $this->load->model('admincp_model', 'model');
        $this->template->set_template('admin');
        $this->template->write('title', 'Admin Control Panel');
    }

    function index() {
        redirect(PATH_URL . 'admincp/setting');
        $data['module'] = 'admincp';
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    function menu() {
        $module_id = '';
        $ss = $this->session->userdata('ss_user');
        if (!empty($ss->permission)) {
            $pem = explode(',', $ss->permission);
            
            if (count($pem) > 0) {
                foreach ($pem as $k => $v) {
                    $pm = explode('|', $v);
                    if(count($pm)==2){
                        if ($pm[1] == '---') {
                            $module_id.= $pm[0] . ',';
                        }
                    }
                }
            }
        }
        $qr = '';
        $module_id = substr($module_id, 0, -1);
        if (!empty($module_id)) {
            if ($ss->group_id != 1) {
                if (count($module_id > 0)) {
                    $qr = "AND module_id not in ($module_id)";
                }
            }
        }

        //$this->load->model('admincp_modules/admincp_modules_model');
        //$this->load->model('admincp_accounts/admincp_accounts_model');
        $this->load->model('menu_category/menu_category_model');
        $group_list = $this->model->fetch('*', 'cli_menu', "parent_id = 0 AND status = 1 $qr", 'order desc, id', 'asc');

        foreach ($group_list as &$group) {
            $group->module_list = $this->model->fetch('id,name,link,module_id', 'cli_menu', "status = 1 AND parent_id = {$group->id} $qr", 'order desc, id', 'asc');
            foreach ($group->module_list as $module) {
                $module->sub_module_list = $this->model->fetch('id,name,link,module_id', 'cli_menu', "status = 1 AND parent_id = {$module->id} $qr", 'order desc, id', 'asc');
            }
        }
        $data['group_list'] = $group_list;
        $this->load->view('menu', $data);
    }

    function login() {
        if (!empty($_POST)) {
            if (md5($this->input->post('pass')) == $this->model->checkLogin($this->input->post('user'))) {
                $this->session->set_userdata('userInfo', $this->input->post('user'));
                $info = $this->model->getInfo($this->input->post('user'));
                $this->session->set_userdata('ss_user', $info[0]);
                print 1;
            } else {
                print 0;
            }
        } else {
            $this->load->view('BACKEND/login');
        }
    }

    function logout() {
        $this->session->unset_userdata('userInfo');
        $this->session->unset_userdata('ss_user');
        header('Location: ' . PATH_URL . 'admincp/login');
    }

    function permission() {
        $data['module'] = 'admincp';
        $this->template->write_view('content', 'permission', $data);
        $this->template->render();
    }

    function chk_perm($id_module, $type, $isAjax) {
       /*  $this->load->model('admincp_accounts/admincp_accounts_model');
        $this->load->model('admincp/admincp_model'); */
        /* $info = $this->admincp_model->getInfo($this->session->userdata('userInfo'));
        $pos = strpos($info[0]->permission, ',' . $id_module . '|');
        if ($pos != 0) {
            $pos = $pos + strlen($id_module);
        } else {
            $pos = 0;
        }
        $sub_str = substr($info[0]->permission, $pos, 5);
        $pos_result = strpos($sub_str, $type);
        if ($pos_result === false) {
            if ($isAjax == 0) {
                header('Location: ' . PATH_URL . 'admincp/permission');
                exit();
            } else {
                return 'permission-denied';
                exit;
            }
        } */
    }

    function saveLog($func, $func_id, $field, $type, $old_value = '', $new_value = '') {
        /* if ($field != '') {
            $data = array(
                'function' => $func,
                'function_id' => $func_id,
                'field' => $field,
                'type' => $type,
                'old_value' => $old_value,
                'new_value' => $new_value,
                'account' => $this->session->userdata('userInfo'),
                'ip' => getIP(),
                'created' => date('Y-m-d H:i:s')
            );
            $this->db->insert('admin_nqt_logs', $data);
        } else {
            foreach ($new_value as $k => $v) {
                if ($v != $old_value[0]->$k) {
                    $data = array(
                        'function' => $func,
                        'function_id' => $func_id,
                        'field' => $k,
                        'type' => $type,
                        'old_value' => $old_value[0]->$k,
                        'new_value' => $v,
                        'account' => $this->session->userdata('userInfo'),
                        'ip' => getIP(),
                        'created' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('admin_nqt_logs', $data);
                }
            }
        } */
    }

    function update_profile() {
        if (!empty($_POST)) {
            if (md5($this->input->post('oldpassAdmincp')) == $this->model->checkLogin($this->session->userdata('userInfo'))) {
                $data = array(
                    'email' => $this->session->userdata('userInfo'),
                    'password' => md5($this->input->post('newpassAdmincp')),
                );
                $this->db->where('email', $this->session->userdata('userInfo'));
                if ($this->db->update('cli_user', $data)) {
                   /*  $this->load->model('admincp_accounts/admincp_accounts_model');
                    $userInfo = $this->admincp_accounts_model->getData($this->session->userdata('userInfo')); */
                    $this->saveLog('update_profile', $userInfo[0]->id, 'password', 'Update', $this->input->post('oldpassAdmincp'), $this->input->post('newpassAdmincp'));
                    print 'success_update_profile';
                    exit;
                }
            } else {
                print 'error_update_profile';
                exit;
            }
        } else {
            $this->template->write_view('content', 'update_profile');
            $this->template->render();
        }
    }

    function setting() {
        if (!empty($_POST)) {
            foreach ($this->input->post('hd_slugAdmincp') as $k => $v) {
                $content = $this->input->post('contentAdmincp');
                $chk_slug = $this->model->checkSlug($v);
                if ($chk_slug) {
                    $data = array(
                        'content' => $content[$k],
                        'modified' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('id', $chk_slug[0]->id);
                    $this->db->update('admin_nqt_settings', $data);
                } else {
                    $data = array(
                        'slug' => $v,
                        'content' => $content[$k],
                        'modified' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('admin_nqt_settings', $data);
                }
            }
            print 'success-setting';
            exit;
        } else {
            $data['setting'] = $this->model->getSetting();
            $this->template->write_view('content', 'setting', $data);
            $this->template->render();
        }
    }

    function getSetting($slug = '') {
        $this->load->model('admincp_model');
        $data['setting'] = $this->admincp_model->getSetting($slug);
        $this->load->view('getSetting', $data);
    }

}