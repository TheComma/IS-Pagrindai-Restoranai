<?php
    /*
        Function to create standard bootstrap pagination, returns pagination HTML code
            Always renders first and last page, page counter starts from 1 and stops at $pagecount
        @param currentPage - on which page pagination currently is, int
        @param pageCount - how many pages there are in total, int
        @param paramList - additional parameters to add to pagination hrefs, given as a single formated string
        @param pageCountPerSide - how many pages per side of current page to render, exlcluding the first one and last one, int
        @param paginatorClass - optional class for styling the paginator <div>
    */
    function paginate($currentPage, $pageCount, $paramList, $pageCountPerSide, $paginatorClass = "") {
        $paginator  = '<div class="row pagination-row text-center {$paginatorClass}">';
        $paginator .= '<ul class="pagination">';

        // Startpage starts at 2 unless the current page is too far, $pageCountPerSide + 1 is used to avoid duplicating the first page
        $startPage = $currentPage > ($pageCountPerSide + 1) ? $currentPage - $pageCountPerSide : 2;
        // Endpage is further ahead of current page, unless it doesn't fit, then it ends before the last one,
        //  as last one is always rendered anyways
        $endPage   = $currentPage + $pageCountPerSide < $pageCount - 1 ? $currentPage + $pageCountPerSide : $pageCount - 1;

        // Apend the starting ampersand if it is missing
        if (strncmp($paramList, "&", strlen("&")) != 0 ) {
            $parmaList = "&" . $paramList;
        }

        // Previous arrow
        // Make sure to do not go into invalid pages even if href is disabled
        $destPage = $currentPage - 1 > 0 ? $currentPage - 1 : 1;
        $url = '?page=' . $destPage . $paramList;
        $active = $currentPage == 1 ? 'class="disabled"' : '';
        $paginator .='<li ' . $active . '><a href="' . $url . '">&laquo;</a></li>';

        // First page
        $url = '?page=1' . $paramList;
        $active = $currentPage == 1 ? 'class="disabled active"' : '';
        $paginator .='<li ' . $active . '><a href="' . $url . '">1</a></li>';

        // Missing pages, only if there actually is something missing, to achieve this, +2 is used
        if ( $currentPage > ($pageCountPerSide + 2) ){
            $paginator .= '<li class="disabled"><span>...<span></li>';
        }

        // Mid pages
        for ($page = $startPage; $page <= $endPage; $page++){
            $url = '?page=' . $page . $paramList;
            $active = $currentPage == $page ? 'class="disabled active"' : '';
            $paginator .='<li ' . $active . '><a href="' . $url . '">' . $page . '</a></li>';
        }

        // Missing pages at the end, only if there actually is something missing, to achieve this, -2 is used
        if ( $endPage <= ($pageCount - 2) ){
            $paginator .= '<li class="disabled"><span>...<span></li>';
        }

        // Last page, only if there actually is more than one page
        if ($pageCount > 1) {
            $url = '?page=' . $pageCount .  $paramList;
            $active = $currentPage == $pageCount ? 'class="disabled active"' : '';
            $paginator .='<li ' . $active  . '><a href="' . $url . '">' . $pageCount . '</a></li>';
        }

        // Next page
        // Make sure to do not go into invalid pages even if href is disabled
        $destPage = $currentPage + 1 < $pageCount ? $currentPage + 1 : $pageCount;
        $url = '?page=' . $destPage .  $paramList;
        $active = $currentPage >= $pageCount ? 'class="disabled"' : '';
        $paginator .='<li ' . $active . '><a href="' . $url . '">&raquo;</a></li>';

        $paginator .= '</ul>';
        $paginator .= '</div>';

        return $paginator;
    }
