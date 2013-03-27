<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class CI_phantrang {

	var $previous_btn = true;
	var $next_btn = true;
	var $first_btn = true;
	var $last_btn = true;
	var $per_page = 10;
	var $total = 0;
	var $url = '';
	var $uri_segment = 3;
	var $page_get = false;
	var $first = "First";
	var $last = "Last";
	var $previous = " &laquo; ";
	var $next = " &raquo; ";
	var $page_show = 7;
	var $page_add = 4;
    var $show_number = true;
    var $return ="onclick='return false'";

	public function __construct($params = array()) {
		if (count($params) > 0) {
			$this->initialize($params);
		}
	}

	function initialize($params = array()) {
		if (count($params) > 0) {
			foreach ($params as $key => $val) {
				if (isset($this->$key)) {
					$this->$key = $val;
				}
			}
		}
	}

	function link() {
		$CI = & get_instance();
		if(!$this->page_get){
			$trang = $CI->uri->segment($this->uri_segment);
			if ($trang == '')
			$trang = 1;
		}else{
			if(isset($_GET['trang'])){
				$trang=$_GET['trang'];
			}
			else{
				$trang = 1;
			}
		}
		$CI->load->helper('url');
		//kiem tra

		$count = $this->total;
		$tongtrang = ceil($this->total / $this->per_page);
		$num = "";

		if ($count != 0) {
			if ($trang >= $this->page_show) {
				$start_loop = $trang - $this->page_add;
				if ($tongtrang > $trang + $this->page_add)
				$end_loop = $trang + $this->page_add;
				else if ($trang <= $tongtrang && $trang > $tongtrang - ($this->page_show - 1)) {
					$start_loop = $tongtrang - ($this->page_show - 1);
					$end_loop = $tongtrang;
				} else {
					$end_loop = $tongtrang;
				}
			} else {
				$start_loop = 1;
				if ($tongtrang > $this->page_show)
				$end_loop = $this->page_show;
				else
				$end_loop = $tongtrang;
			}
		}


		// FOR ENABLING THE FIRST BUTTON
		if ($this->first_btn && $trang > 1) {
			$dau = "<a class='on' href='" . site_url($this->url . 1) . "'>$this->first</a>";
		} else if ($this->first_btn) {
			$dau = "<a class='off'>$this->first</a>";
		}

		// FOR ENABLING THE PREVIOUS BUTTON
		if ($this->previous_btn && $trang > 1) {
			$tam = $trang - 1;
			$lui = "<a class='on' href='" . site_url($this->url . $tam) . "'>$this->previous</a>";
		} else if ($this->previous_btn) {
			$lui = "<a class='off'>$this->previous</a>";
		}


		if ($this->next_btn && $trang < $tongtrang) {
			$tam2 = $trang + 1;
			$toi = "<a class='on' href='" . site_url($this->url . $tam2) . "'>$this->next</a>";
		} else if ($this->next_btn) {
			$toi = "<a class='off'>$this->next</a>";
		}

		// TO ENABLE THE END BUTTON
		if ($this->last_btn && $trang < $tongtrang) {
			$cuoi = "<a class='on' href='" . site_url($this->url . $tongtrang) . "'>$this->last</a>";
		} else if ($this->last_btn) {
			$cuoi = "<a class='off'>$this->last</a>";
		}
		if ($count > 0) {
			for ($i = $start_loop; $i <= $end_loop; $i++) {
				if ($i == $trang)
				$num.="<span>$i</span>";
				else
				$num.="<a class='on' href='" . site_url($this->url . $i) . "' title=''>$i</a>";
			}
		}
		if ($count > 0 && $tongtrang > 1){
			if($this->last_btn && $this->first_btn){
				$link = $dau . $lui . $num . $toi . $cuoi ;
			}else{
				$link =  $lui . $num . $toi;
			}
		} 
		else
		$link = '';

		return $link;
	}
    
    
    function link_ajax() {
		$CI = & get_instance();
		if(!$this->page_get){
			$trang = $CI->uri->segment($this->uri_segment);
			if ($trang == '')
			$trang = 1;
		}else{
			if(isset($_GET['trang'])){
				$trang=$_GET['trang'];
			}
			else{
				$trang = 1;
			}
		}
		$CI->load->helper('url');
		//kiem tra

		$count = $this->total;
		$tongtrang = ceil($this->total / $this->per_page);
		$num = "";

		if ($count != 0) {
			if ($trang >= $this->page_show) {
				$start_loop = $trang - $this->page_add;
				if ($tongtrang > $trang + $this->page_add)
				$end_loop = $trang + $this->page_add;
				else if ($trang <= $tongtrang && $trang > $tongtrang - ($this->page_show - 1)) {
					$start_loop = $tongtrang - ($this->page_show - 1);
					$end_loop = $tongtrang;
				} else {
					$end_loop = $tongtrang;
				}
			} else {
				$start_loop = 1;
				if ($tongtrang > $this->page_show)
				$end_loop = $this->page_show;
				else
				$end_loop = $tongtrang;
			}
		}


		// FOR ENABLING THE FIRST BUTTON
		if ($this->first_btn && $trang > 1) {
			$dau = "<a class='on' $this->return href='" . site_url($this->url . 1) . "'>$this->first</a>";
		} else if ($this->first_btn) {
			$dau = "<a class='off'>$this->first</a>";
		}

		// FOR ENABLING THE PREVIOUS BUTTON
		if ($this->previous_btn && $trang > 1) {
			$tam = $trang - 1;
			$lui = "<a class='on' $this->return href='" . site_url($this->url . $tam) . "'>$this->previous</a>";
		} else if ($this->previous_btn) {
			$lui = "<a class='off'>$this->previous</a>";
		}


		if ($this->next_btn && $trang < $tongtrang) {
			$tam2 = $trang + 1;
			$toi = "<a class='on' $this->return href='" . site_url($this->url . $tam2) . "'>$this->next</a>";
		} else if ($this->next_btn) {
			$toi = "<a class='off'>$this->next</a>";
		}

		// TO ENABLE THE END BUTTON
		if ($this->last_btn && $trang < $tongtrang) {
			$cuoi = "<a class='on' $this->return href='" . site_url($this->url . $tongtrang) . "'>$this->last</a>";
		} else if ($this->last_btn) {
			$cuoi = "<a class='off'>$this->last</a>";
		}
        if($this->show_number){
            if ($count > 0) {
                for ($i = $start_loop; $i <= $end_loop; $i++) {
                    if ($i == $trang)
                    $num.="<span>$i</span>";
                    else
                    $num.="<a class='on' $this->return href='" . site_url($this->url . $i) . "' title=''>$i</a>";
                }
            }
        }
		if ($count > 0 && $tongtrang > 1){
			if($this->last_btn && $this->first_btn){
				$link = $dau . $lui . $num . $toi . $cuoi ;
			}else{
				$link =  $lui . $num . $toi;
			}
		} 
		else
		$link = '';

		return $link;
	}

	
	/*function paging_ajax($page,$total,$url,$trang=1)
	{
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	//kiem tra


	$count=$total;
	$tongtrang=ceil($total/$page);
	$num="";

	if($count!=0)
	{
	if ($trang >= 7) {
	$start_loop = $trang - 4;
	if ($tongtrang > $trang + 4)
	$end_loop = $trang + 4;
	else if ($trang <= $tongtrang && $trang > $tongtrang - 6) {
	$start_loop = $tongtrang - 6;
	$end_loop = $tongtrang;
	} else {
	$end_loop = $tongtrang;
	}
	} else {
	$start_loop = 1;
	if ($tongtrang > 7)
	$end_loop = 7;
	else
	$end_loop = $tongtrang;
	}
	}


	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $trang > 1) {
	$dau = "<li  class='on'><a href='".$url."#trang-". 1 ."'>Đầu</a></li>";
	} else if ($first_btn) {
	$dau= "<li  class='off'> <a> Đầu</a></li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $trang > 1) {
	$tam=$trang-1;
	$lui = "<li class='on'><a rel='".$tam."' href='".$url."#trang-".$tam."'> Lùi</a></li>";
	} else if ($previous_btn) {
	$lui = "<li class='off'><a>Lùi</a></li>";
	}


	if ($next_btn && $trang < $tongtrang) {
	$tam2=$trang+1;
	$toi = "<li class='on'><a rel='".$tam2."' href='".$url."#trang-".$tam2."'> Tới </a></li>";
	} else if ($next_btn) {
	$toi = "<li class='off'> <a>Tới </a></li>";
	}

	// TO ENABLE THE END BUTTON
	if ($last_btn && $trang < $tongtrang) {
	$cuoi= "<li  class='on'><a rel='".$tongtrang."' href='".$url."#trang-".$tongtrang."'> Cuối </a></li>";
	} else if ($last_btn) {
	$cuoi = "<li class='off'><a>Cuối</a></li>";
	}
	if($count>0)
	{
	for($i=$start_loop;$i<=$end_loop;$i++)
	{
	if($i==$trang)
	$num.="<li class='p'><a>$i</a></li>";
	else
	$num.="<li class='on'><a rel='".$i."'  href='".$url."#trang-".$i."' title=''>$i</a></li>";
	}
	}
	if($count>0&&$tongtrang>1)
	$link="
	<ul class='pagination'>

	".$dau.$lui.$num.$toi.$cuoi."

	</ul>
	";
	else
	$link='';

	return $link;

	} */
}

?>