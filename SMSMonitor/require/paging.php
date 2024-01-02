<?php

class paging {
    
    var $sql, $records, $pages;
    var $page_no, $total, $limit, $first, $previous, $next, $last, $start, $end;

    function paging($sql, $records = 5, $pages = 4) {
        
        global $db;
        
        if ($pages % 2 == 0)
            $pages++;
        
        $res = $db->prepare($sql) or die($db->errorInfo());
        $res->execute(array('1'));
        $total = $res->rowCount();
        $page_no = isset($_REQUEST["page_number"]) ? $_REQUEST["page_number"] : 1;
        $limit = ($page_no - 1) * $records;
        $sql .= " LIMIT $records OFFSET $limit ";
        $first = 1;
        $previous = $page_no > 1 ? $page_no - 1 : 1;
        $next = $page_no + 1;
        $last = ceil($total / $records);
        
        if ($next > $last)
            $next = $last;
        
        $start = $page_no;
        $end = $start + $pages - 1;
        
        if ($end > $last)
            $end = $last;
        
        if (($end - $start + 1) < $pages) {
            $start -= $pages - ($end - $start + 1);
            if ($start < 1)
                $start = 1;
        }
        
        if (($end - $start + 1) == $pages) {
            $start = $page_no - floor($pages / 2);
            $end = $page_no + floor($pages / 2);
            while ($start < $first) {
                $start++;
                $end++;
            }
            while ($end > $last) {
                $start--;
                $end--;
            }
        }
        
        $this->sql = $sql;
        $this->records = $records;
        $this->pages = $pages;
        $this->page_no = $page_no;
        $this->total = $total;
        $this->limit = $limit;
        $this->first = $first;
        $this->previous = $previous;
        $this->next = $next;
        $this->last = $last;
        $this->start = $start;
        $this->end = $end;
    }

    function show_paging($url)
    {
        $paging = "";
        if (isset($_REQUEST['pid'])) {
            $params = 'pid=' . $_REQUEST['pid'];
        }
        if (isset($_REQUEST['keyword'])) {
            $params .= 'keyword=' . $_REQUEST['keyword'];
        }
        if (isset($_REQUEST['pricefrom'])) {
            $params .= '&pricefrom=' . $_REQUEST['pricefrom'];
        }
        if (isset($_REQUEST['priceto'])) {
            $params .= '&priceto=' . $_REQUEST['priceto'];
        }
        if (isset($_REQUEST['sort_by'])) {
            $params .= '&sort_by=' . $_REQUEST['sort_by'];
        } 
        
        if ($this->total > $this->records) {
            $page_no = $this->page_no;
            $first = $this->first;
            $previous = $this->previous;
            $next = $this->next;
            $last = $this->last;
            $start = $this->start;
            $end = $this->end;
            if ($params == "")
                $params = "&page_number=";
            else
                $params = "&$params&page_number=";
            $paging .= '<ul class="pagination">';
            if ($page_no == $first)
                $paging .= "<!--<li class='paging-disabled'><a href='javascript:void(0)'>&nbsp;<<&nbsp;</a></li>-->";
            else
                $paging .= '<li class="page-item pagination-prev disabled"><a class="page-link" href="'.$url.$params.$first.'"><<</a></li>';
            if ($page_no == $previous)
                $paging .= "<!--<li class='paging-disabled'><a href='javascript:void(0)'>&nbsp;<&nbsp;</a></li>-->";
            else
                $paging .= "<!--<li><a class='page-numbers' href='$url$params$previous'>&nbsp;<&nbsp;</a></li>-->";
            for ($p = $start; $p <= $end; $p++) {
                $paging .= "<li class='page-item ";
                if ($page_no == $p)
                    $paging .= "active'";
                else
                    $paging .= "'";
                $paging .= "><a class='page-link' href='$url$params$p'>$p</a></li>";
            }
            if ($page_no == $next)
                $paging .= "<!--<li class='paging-disabled'><a href='javascript:void(0)'>&nbsp;Next&nbsp;</a></li>-->";
            else
                $paging .= "<!--<li><a href='$url$params$next'>&nbsp;>&nbsp;</a></li>-->";
            if ($page_no == $last)
                $paging .= "<!--<li class='paging-disabled'><a href='javascript:void(0)'>&nbsp;Last&nbsp;</a></li>-->";
            else
                $paging .= '<li class="page-item pagination-next"><a class="page-link" href="'.$url.$params.$last.'">>></a></li>';
            $paging .= "</ul>";
        }
        return $paging;
    }

}
