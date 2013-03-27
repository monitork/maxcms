<?php
if (!function_exists('paginationG')) {

    function paginationG($totalRows, $pageNum = 1, $pageSize, $limit = 5) {
        settype($totalRows, "int");
        settype($pageSize, "int");
        if ($totalRows <= 0)
            return "";
        $totalPages = ceil($totalRows / $pageSize);
        if ($totalPages <= 1)
            return "";
        $currentPage = $pageNum;
        if ($currentPage <= 0 || $currentPage > $totalPages)
            $currentPage = 1;

        //From to
        $form = $currentPage - $limit;
        $to = $currentPage + $limit;

        //Tinh toan From to
        if ($form <= 0) {
            $form = 1;
            $to = $limit * 2;
        };
        if ($to > $totalPages)
            $to = $totalPages;

        //Tinh toan nut first prev next last
        $first = '';$prev = '';$next = '';$last = '';$link = '';

        //Link URL
        $linkUrl = current_url();

        $get = '';
        $querystring = '';
        if ($_GET) {
            foreach ($_GET as $k => $v) {
                if ($k != 'p')
                    $querystring = $querystring . "&{$k}={$v}";
            }
            $querystring = substr($querystring, 1);
            $get.='?' . $querystring;
        }
        $sep = (!empty($querystring)) ? '&' : '';
        $linkUrl = $linkUrl . '?' . $querystring . $sep . 'p=';

        if ($currentPage > $limit + 2) {
            /** first */
            //$first= "<li><a href='$linkUrl' class='first'>Đa</a></li>";
        }

        /*         * **** prev ** */
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $prev = "<li><a href='$linkUrl$prevPage' class='prev'>Trước</a></li>";
        }

        /*         * *Next** */
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $next = "<li><a href='$linkUrl$nextPage' class='next'>Tiếp</a></li>";
        }

        /*         * *Last** */
        if ($currentPage < $totalPages - 4) {
            $lastPage = $totalPages;
            //$last= "<a href='$linkUrl$lastPage' class='last'>...</a>";
        }

        /*         * *Link** */
        for ($i = $form; $i <= $to; $i++) {
            if ($currentPage == $i)
                $link.= "<li><span>$i</span></li>";
            else
                $link.= "<li><a href='$linkUrl$i'>$i</a></li>";
        }
	
        $pagination = '<div class="pagination"><ul>' . $first . $prev . $link . $next . $last . '</ul></div>';

        return $pagination;
    }

//pagelistLimited	
}

function search_highlight($text, $search_terms, $hl_class = 'hl')
{	
	$search_terms= trim($search_terms);
	if ( ! is_array($search_terms))
	{
		$search_terms = explode(' ', $search_terms);
	}
	
	// Highlight each of the terms
	foreach ($search_terms as $term)
	{
		$term= trim($term);
		if(!empty($term)){
			//$text = str_replace($term, '<strong>'.$term.'</strong>', $text);
			$text = preg_replace('/\b(' . preg_quote($term) . ')\b/i', '<strong>\1</strong>', $text);
		}
	}
	
	return $text;
}

function bonbanh_list($url){
	$arr=array();
	$html = file_get_html($url);
	$count=0;
	foreach ($html->find("div.car-item") as $item){
		$link= $item->find('div.cb2_02 a', 0);
		$title= $link->title;
		$price= $item->find('div.cb3',0);
		$arr_price = $price->find('<span style="color:#aaa;font-size:11px">',0);
		$arr_price->outertext=''; //Xóa div quảng cáo		
		if (substr($link->href,0,1)=="/") $link->href=$url. $link->href;
		$arr[$count]['title']= $title .' - '.trim(strip_tags($price->innertext));
		$arr[$count]['address']= trim($item->find("div.cb7",0)->innertext);
		$arr[$count]['link']=$link->href;
		$arr[$count]['image']= $item->find("div.cb5 img.h-car-img",0)->src;
		$count++;
	}
	$html->clear();//Hủy bỏ cây DOM HTML
	unset($html); //Hủy bỏ cây DOM HTML
	return $arr;
}

function bonbanh_content($url) {
	$html = file_get_html($url);
	$data = array();
	$title = $html->find('div#car_detail div.title h1',0);//Trả về obj
	
	$arr_title = $title->find('<font style="color:#999;font-size:15px">',0);
	$arr_title->outertext=''; //Xóa div quảng cáo
	
	$data['title']= trim(str_replace("&nbsp;"," ",$title->plaintext)); //Gán vào phần tử có tên là tiêu đề
	$title->outertext='';//Xóa tiêu đề

	$description = $html->find('div.des_txt',0);
	$data['description']= trim(strip_tags($description->innertext));
	$description->outertext = ''; //Xóa tóm tắt, vì trong content đã bao gồm tomtat
	
	$fullname = $html->find('div.contact-txt span.cname',0);	
	$data['fullname']= trim($fullname->innertext);
	
	$phone= $html->find('div.contact-txt span.cphone',0);
	$data['phone']= trim($phone->innertext);
	
	$created= $html->find('div.title div.notes',0);
	$arr_created= explode(' ', $created->innertext);	
	$data['created']= date('Y-m-d', strtotime(str_replace('/', '-', trim($arr_created[5]))));
	
	$html->clear();
	unset($html);
	return $data;
 }//bonbanh_content
 
function muaban_list($url){
	$arr=array();
	$html = file_get_html($url);
	$count=0;

	$tinvip = $html->find('div#vip_list_top',0);
	$tinvip->outertext=''; //Xóa div quảng cáo		
	foreach ($html->find("ul.list_4 li.item_bold") as $item){
		$link= $item->find('a', 0);
		$title= $item->find('a b', 0)->innertext;
		$arr[$count]['link_title']= $title;
		$arr[$count]['price']= $item->find("div.item_price",0)->innertext;
		if(!empty($arr[$count]['price'])){
			$arr[$count]['title']= $title.' - '.$arr[$count]['price'];
		}else{
			$arr[$count]['title']= $title;
		}
		$arr[$count]['link']= 'http://muaban.net'.$link->href;
		$arr[$count]['image']= $item->find("img.thumb",0)->src;
		$count++;
	}
	$html->clear();//Hủy bỏ cây DOM HTML
	unset($html); //Hủy bỏ cây DOM HTML
	return $arr;
}

function muaban_content($url) {
	$html = file_get_html($url);
	$data = array();
	$created= $html->find('table#pC_DV_tableHeader div.source_2',0);
	if(!empty($created)){
		$created= $created->parent();
		$arr_created= explode('-', $created->innertext);	
		$data['created']= date('Y-m-d', strtotime(str_replace('/', '-', trim($arr_created[0]))));			
	}else{
		$data['created']= date('Y-m-d');
	}
	
	$fullname= $html->find('table#pC_DV_tableHeader span#postId',0);
	$data['fullname']= $fullname->innertext;
	
	$description = $html->find('table#pC_DV_tableHeader',0)->next_sibling();
	if(!empty($description)){
		$table_1description= $description->find('table#classifiedExpand',0);
		if(!empty($table_1description)){
			$table_2description= $table_1description->next_sibling();
			$table_1description->outertext=''; //Xóa div quảng cáo	
		}
		if(!empty($table_2description)){
			$script= $table_2description->next_sibling();
			$table_2description->outertext=''; //Xóa div quảng cáo	
			$script->outertext=''; //Xóa div quảng cáo				
		}
	}
	$data['description']= trim(strip_tags($description->innertext));

	//$description->outertext = ''; //Xóa tóm tắt, vì trong content đã bao gồm tomtat
		

	$html->clear();
	unset($html);
	return $data;
 }//bonbanh_content