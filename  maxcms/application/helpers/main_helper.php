<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * goBack()
 *
 * @return
 */
if ( ! function_exists('goBack'))
{
	function goBack()
	{
	    $CI =& get_instance();
        if ($CI->agent->is_referral()) {
            $referer_url = $CI->agent->referrer();
            redirect($referer_url);
        }
	}
}

/**
 * url_concat()
 *
 * @return
 */
if ( ! function_exists('url_concat'))
{
	function url_concat()
	{
        $url='';
        $arg_list = func_get_args();
        if(!empty($arg_list)){
            for ($i = 0; $i < count($arg_list); $i++) {
                 $url= $url.trim_slashes($arg_list[$i])."/";
            }
        }
        $url = substr($url,0,-1);
        return $url;
	}
}

/**
 * getVNDateTime()
 *
 * @return
 */
if ( ! function_exists('getVNDateTime'))
{
	function getVNDateTime($datetime,$gio=false)
	{
		$date = '';
		if(!empty($datetime)){
			if($gio == true){
                $date = date('d/m/Y H:i:s', strtotime($datetime));
			}else{
				$date = date('d/m/Y', strtotime($datetime));
			}
		}
		return $date;
	}
}

/**
 * getNow()
 *
 * @return
 */
if ( ! function_exists('getNow'))
{
	function getNow()
	{
		return date(DATETIME_FORMAT_DB);
	}
}

if ( ! function_exists('getToday'))
{
	function getToday($day_adding=0)
	{
		$today = date(DATETIME_FORMAT_DB_NO_TIME);  //Lay ngay hien tai
		$today = strtotime($today);   // chuyen chuyen thanh thoi gian
		$result = $today + $day_adding*3600*24; 
		$result = date(DATETIME_FORMAT_DB,$result);
		return $result;
	}
}

/****************************	BEGIN: JSON HELPER ***************************/
if ( ! function_exists('json_encode'))
{
	function json_encode($id_str)
	{
		
	}
}
/****************************	END: JSON HELPER ***************************/

/****************************	BEGIN: DATABASE HELPER ***************************/
if ( ! function_exists('generate_in_query'))
{
	function generate_in_query($id_str)
	{
		$in_query = '';
		if(!empty($id_str)){
			$ids = split(',',$id_str);
			if(!empty($ids)){
				foreach($ids as $id){
					if(!empty($id)){
						$id = (int)$id;
						$in_query .= $id.',';
					}
				}
				$in_query = substr($in_query,0,-1);
			}
		}
		return $in_query;
	}
}
/****************************	END: DATABASE HELPER ***************************/

/****************************	BEGIN: DEBUG HELPER ***************************/
if ( ! function_exists('last_query'))
{
	function last_query($exit=false)
	{
		$CI =& get_instance();
		echo $CI ->db->last_query();
		if($exit){
			exit();
		}
	}
}

if ( ! function_exists('pr'))
{
	function pr($item, $exit=false)
	{
		$output = '';
		
		ob_start();
		echo "<pre/>";
		if(is_array($item) || is_object($item)){
			var_dump($item);
		} else {
			echo $item;
		}
		$output = ob_get_contents();
		ob_end_clean();
		
		echo $output;
		
		if($exit){
			exit();
		}
		return $output;
	}
}

if ( ! function_exists('var_dump_ret'))
{
	function var_dump_ret($mixed = null) {
	  ob_start();
	  var_dump($mixed);
	  $content = ob_get_contents();
	  ob_end_clean();
	  return $content;
	}
}
/****************************	END: DEBUG HELPER ***************************/


/****************************	BEGIN: URL HELPER ***************************/
if ( ! function_exists('full_url'))
{
	function full_url()
	{
		$query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
		$full_url = substr(base_url(),0,-1).uri_string(). $query; 
		return $full_url;
	}
}
/****************************	END: URL HELPER ***************************/

/****************************	BEGIN: PAGINATION HELPER ***************************/
function paginate($ci_instance, $base_url, $total_rows = 100, $current_page = 1, $per_page=10){
    if($ci_instance != null){
    	$ci_instance->load->library('pagination');
    	$config['cur_page'] = $current_page;					
    	$config['base_url'] = $base_url;
    	$config['total_rows'] = $total_rows;
    	$config['per_page'] = $per_page;
    	$config['page_query_string'] = false;
    	$config['uri_segment'] = 100;
    	$config['next_link'] = '';
    	$config['next_tag_open'] = '<div class="next">';
    	$config['next_tag_close'] = '</div>';
        $config['prev_link'] = '';
        $config['prev_tag_open'] = '<div class="prev">';
        $config['prev_tag_close'] = '</div>';
    	$config['cur_tag_open'] = '<span>';
    	$config['cur_tag_close'] = '</span>';
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['num_links'] = 3;
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        
        $config['first_link'] = '';
        $config['first_tag_open'] = '<div style="display:none;">';
        $config['first_tag_close'] = '</div>';
        
        $config['last_link'] = '';
        $config['last_tag_open'] = '<div style="display:none;">';
        $config['last_tag_close'] = '</div>';
    	
    	$ci_instance->pagination->initialize($config);	
    	$paginator = $ci_instance->pagination->create_links(false,true);

		// Change format of pagination link
		// From: 	http://localhost/autobay/Code/mua-ban-oto/tu-khoa/acura+mdx+2007+2010+ho+chi+minh/tim-kiem/trang/15
		// To: 		http://localhost/autobay/Code/mua-ban-oto/tu-khoa/acura+mdx+2007+2010+ho+chi+minh/trang/15/tim-kiem
		$pattern = '/tim-kiem\/trang\/(\d+)/'; // $pattern = '/(.*)\/tim-kiem\/(\d+)/'; // -> Wrong???
		$replacement = 'trang/$1/tim-kiem';
		$paginator = preg_replace($pattern, $replacement, $paginator);
		// Fix first link
		$paginator = str_replace('tim-kiem/trang/"','tim-kiem/"',$paginator);
			
		$data['paginator'] = $paginator;
        $ci_instance->load->vars($data);
    }
}
/****************************	END: PAGINATION HELPER ***************************/

/****************************	BEGIN: QUERY HELPER ***************************/
if ( ! function_exists('cond_and'))
{
	function cond_and(&$query, $condition)
	{
		if(empty($query)){
			$query = $condition;
		} else {
			$query = "$query AND $condition";
		}
	}
}
/****************************	END: QUERY HELPER ***************************/

/****************************	BEGIN: TEXT HELPER ***************************/
function bo_dau($cs){
    $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
	"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
	,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
	,"ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
	,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
	,"Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ");

	$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
	,"a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o"
	,"o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A"
	,"A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O"
	,"O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D");
	return str_replace($marTViet,$marKoDau,$cs);
}

function split_combine(&$normalized_keyword,$keyword_value){
	$pos = false;
	$pos = strpos($normalized_keyword,$keyword_value);
	if($pos !== false){
		$left_part = substr($normalized_keyword,0,$pos);
		$pos2 = $pos+strlen($keyword_value);
		$right_part = substr($normalized_keyword,$pos2,strlen($normalized_keyword));
		$left_part = trim($left_part);
		$right_part = trim($right_part);
		$normalized_keyword = $left_part.' '.$right_part;
		$normalized_keyword = trim($normalized_keyword);
	}
	return $pos;
}

if ( ! function_exists('html2text'))
{
	function html2text($html)
	{
		// Include the class definition file.
		require_once('class.html2text.php');

		// Instantiate a new instance of the class. Passing the string
		// variable automatically loads the HTML for you.
		$h2t = new html2text($html);

		// Simply call the get_text() method for the class to convert
		// the HTML to the plain text. Store it into the variable.
		return $h2t->get_text();
	}
}

function sub($s, $count, $from = 0, $a3p = true)
{
	$INT_MAX = 2147483647;
	if($count+$from >= strlen($s))
	{
		return substr($s, $from);
	}
	$sp = strpos($s, ' ', $from+$count);
	$tp = strpos($s, '\t', $from+$count);
	$np = strpos($s, '\n', $from+$count);
	if($sp === false)
	{
		$sp= $INT_MAX;
	}
	if($tp === false)
	{
		$tp= $INT_MAX;
	}
	if($np === false)
	{
		$np= $INT_MAX;
	}
	$count = min($sp,$tp,$np);
	if($count >= strlen($s))
	{
		return substr($s, $from);
	}
	return substr($s, $from, $count-$from).($a3p?' ...':'');
}
/****************************	END: TEXT HELPER ***************************/

if ( ! function_exists('getmicrotime'))
{
	// a function to  get microtime
	function getmicrotime(){
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
}

if ( ! function_exists('fillTaggedItemsIntoList'))
{
	function fillTaggedItemsIntoList(&$item_list,$model='giaitri'){
		if(!empty($item_list)){
			for($i=0;$i<count($item_list);$i++){
				$item = &$item_list[$i];
				if($i==0){
					fillTaggedItems($item,$model,-1,-1);
				} else {
					fillTaggedItems($item,$model,0,2);
				}
			}
		}
	}
}

if ( ! function_exists('fillTaggedItems'))
{
	function fillTaggedItems(&$item,$model='giaitri',$start=-1,$limit=-1){
		if(!empty($item)){
			$item_id = is_array($item)?$item['id']:$item->id;
			$table = "cli_{$model}";
			if($model == 'consultant'){
				$table = "cli_{$model}s";
			}
			$query = "SELECT {$table}.* FROM {$table} WHERE id <> {$item_id} AND id IN (SELECT {$model}_id FROM cli_{$model}_tag WHERE tag2_id IN (SELECT tag2_id FROM cli_{$model}_tag WHERE {$model}_id = {$item_id})) ORDER BY {$table}.id DESC";
			if($start != -1 && $limit != -1){
				$query .= " LIMIT $start, $limit";
			}
			$CI =& get_instance();
			$query = $CI->db->query($query);
			$tag_list = $query->result_array();
			if(!empty($tag_list)){
				if(is_array($item)){
					$item['tag_list'] = $tag_list;
				} else {
					$item->tag_list = $tag_list;
				}
			}
		}
	}
}

/****************************	BEGIN: EXCHANGE RATE - TY GIA VND/USD ***************************/
if ( ! function_exists('getExchangeRate'))
{
	/*
	 * Lay ty gia (exchange rate) cua ngay hom nay.
	 * Neu khong co thi fill vao (selling2 lay tu ty gia cu).
	 * Bat buoc phai co du lieu san trong db
	 */
	function getExchangeRate(){
		$CI =& get_instance();
		$today = mktime(0, 0, 0, date("m"), date("d"), date("y"));
		//$today = date(DATETIME_FORMAT_DB,$today);
		$exchange_rate = $CI->base_model->fetch('id,code,modified,selling,selling2,created','car_exchange_rate',"code = 'USD'",'id','desc',-1,0,true);
		if(!empty($exchange_rate)){// Bat buoc phai ty gia cu trong db
			$exchange_rate = $exchange_rate[0];
			$created = strtotime($exchange_rate['created']);
			if($created < $today){
				$exchange_rate['id']='';
				$exchange_rate['code']='USD';
				$exchange_rate['is_active']=1;
				$exchange_rate['created']=getNow();
				$exchange_rate['modified']=getNow();
				fillExchangeRate($exchange_rate);
				if($CI->base_model->insert('car_exchange_rate',$exchange_rate)){
				}
			}
		}
		return $exchange_rate;
	}
}

if ( ! function_exists('fillExchangeRate'))
{
	function fillExchangeRate(&$exchange_rate){
		if(!empty($exchange_rate)){
			$url = "http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx";
			$xml = file_get_contents($url);
			$pattern = '/CurrencyCode=\"USD\"(.*)Sell=\"(.*)\"/';
			$offset = 0;
			$flag = PREG_OFFSET_CAPTURE;
			preg_match_all($pattern, $xml, $matches, $flag, $offset);
			if(!empty($matches[2][0][0])){
				$selling = $matches[2][0][0];
				$exchange_rate['selling']=$selling;
			}
		}
	}
}
if(! function_exists("promotion_check_salon"))
{
	function promotion_check_salon($promotion_from,$promotion_to)
	{
		$result = false;
		if(!empty($promotion_from) && !empty($promotion_to))
		{
			$now = time();
			$from = strtotime($promotion_from);
			$to=strtotime($promotion_to);
			$compared_time=strtotime('2000-01-01');
			$result = (($from<$compared_time && $to<$compared_time) || ($from<=$now && $now<=$to));
		}
		return $result;
	}
}
if ( ! function_exists('promotion_check'))
{
	function promotion_check($promotion){
		$result = false;
		if(!empty($promotion)){
			$now = time();
			$from = strtotime($promotion['from_time']);
			$to = strtotime($promotion['to_time']);
			$compared_time = strtotime('2000-01-01');
			$result = (($from<$compared_time && $to<$compared_time) || ($from<=$now && $now<=$to));
		}
		return $result;
	}
}

if ( ! function_exists('admin_log'))
{
	function admin_log($message,$is_append=false){
		$html = '';
		if($is_append && !empty($_SESSION['admin_log'])){
			$html = $_SESSION['admin_log'];
		}
		$html .= "<div>$message</div>";
		$_SESSION['admin_log'] = $html;
	}
}
if ( ! function_exists('show_admin_log'))
{
	function show_admin_log(){
		$CI =& get_instance();
		$data['show_admin_log'] = 1;
		$CI->load->vars($data);
	}
}
if ( ! function_exists('process_url'))
{
	function process_url($url){
		if(!$url)
			return '';
		$http_post = strpos($url,'http://') === false ? strpos($url, 'https://') : strpos($url, 'http://');	
		if($http_post !== false)
				return $url;
		return 'http://'. $url;
	}
}