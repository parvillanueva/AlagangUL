<?php

 /**
        @title       Form Table Library
        @method      display_data
        @copyright   2019 PHP Dev Group

        @var   array    $data['table']            Associative array of table name and prefix
        @example                                  value: ['table_name' => 'prefix_name']

        @var   array    $data['sortable']         Array of sorting through row or column
        @example                                  value: ['row', 'column']

        @var   int      $data['checkbox']         Display status of checkbox listing
        @example                                  value: (1 = show, 0 = hide)

        @var   array    $data['order']            Associative array of ascending or descending order with field value
        @example                                  value: ['asc' => 'id']
        
        @var   array    $data['join']             Associative array of table join settings
        @example                                  value: [0 => [table, query, type] ] (0 = hide, 1 = show)

        @var   array    $data['display_fields']   Associative array of database field names with <th> settings
        @example                                  value: ['databse field' => [
                                                                                'alternative_name', 
                                                                                'column size px', 
                                                                                 max character length (int)
                                                                            ] 
                                                        ]
                                                  Note: If the database field content is greater than the max character length, then the ellipsis will be showed. 

        @var   array    $data['search_keyword']   Array of keywords used for searching
        @example                                  value: ['search1', 'search2']

        @var   string   $data['query']            Initialize custom query on page load
        @example                                  value: "query_message"

        @var   array    $data['custom_action']    Associative array of custom action button settings
        @example                                  value: [1 => [
                                                                    'type' => 'icon',
                                                                    'id' => 'sample-id', 
                                                                    'class' => 'sample-class', 
                                                                    'icon' => 'fa fa-cog', 
                                                                    'value' => '', 
                                                                    'function' => 'view_sample'
                                                                ]
                                                        ] (0 = hide, 1 = show) (type = icon/button)

        @var   array    $data['button']           Array of cms standard buttons
        @example                                  value: ['add', 'close', 'search', 'export']

        @var array      $data['export_name']      Array of alternative name for pdf and excel export
        @example                                  value: ['ID', 'First Name', "Last Name", "Status"]
                                                  Note: Export name must follow the database field order arrangement

        @return  string                           Display the html table listing

    */

    // Output:  $this->form_table->display_data($data); 

class Form_table {

    public function display_data($data)
    {
        $CI =& get_instance();
        $html = "";

        $table_err = "";
        $fields_err = "";
        $sort_err = "";
        $action_err = "";
        $search_err = "";
        $export_err = "";
        $button_err = "";

        $sort_val = "";
        foreach ($data['sortable'] as $key => $val) {
            $sort_val = $val;
            if (count($data['sortable']) > 1) {
                if ($sort_val !== "column" && $sort_val !== "row") {
                    $sort_err = "<p>Sort type must contain column, row or both only.</p> ";
                }
                } else {
                    if ($sort_val !== "column") {
                        if ($sort_val !== "row") {
                            $sort_err = "<p>Sort type must contain column, row or both only.</p> ";
                        }
                    }
            }
        }

        if (isset($data['checkbox'])) {
            $checkbox = $data['checkbox'];
        } else {
            $data['checkbox'] = 0;
            $checkbox = $data['checkbox'];
        }

        if (isset($data['table'])) {
            $table = $data['table'];
        } else {
            $data['table'] = ['cms_users' => 'cms_'];
            $table = $data['table'];
            ini_set('display_errors', false);
            $table_err = "<p>Table name is not defined.</p> ";
        }

        $table_name = "";
        $table_prefix = "";
        $tbl_name = "";
        foreach ($table as $key => $val) {
            $table_name = $key;
            $table_prefix = $val;
        }

        $field_name = $CI->db->list_fields($table_name);

        if (!$CI->db->table_exists($table_name)) {
            $table_err .= "<p>Table name does not exist.</p> ";
        }

        if (isset($data['order'])) {
            $order_by = $data['order'];
        } else {
            $data['order'] = ['asc' => 'id'];
            $order_by = $data['order'];
        }

        if (isset($data['join'])) {
            $join_table = $data['join'];
        } else {
            $data['join'] = [''];
            $join_table = $data['join'];
        }

        if (isset($data['query'])) {
            $init_query = $data['query'];
        } else {
            $data['query'] = "status >= 0";
            $init_query = $data['query'];
        }

        if (isset($data['sortable'])) {
            $sort_col_row = array_unique($data['sortable']);
        } else {
            $data['sortable'] = [''];
            $sort_col_row = $data['sortable'];
        }

        if (isset($data['custom_action'])) {
            $custom_action = $data['custom_action'];
        } else {
            $data['custom_action'] = [''];
            $custom_action = $data['custom_action'];
        }

        if (isset($data['display_fields'])) {
            $display_fields = $data['display_fields'];

            $fields_arr = [];
            foreach($data['display_fields'] as $key => $val) {
                array_push($fields_arr, $key);
            }

            $fields_result = array_diff($fields_arr,$field_name);
            if (count($fields_result) >= 0) {
                foreach($fields_result as $key => $val) {
                    $fields_err .= "<p>Display field '".$val."' is not defined in database field.</p> ";
                }
            }

        } else {
            $data['display_fields'] = [''];
            $display_fields = $data['display_fields'];
            $fields_err = "<p>Display field is not defined.</p> ";
        }

        $search_keyword = array_diff($data['search_keyword'],$field_name);
        if (count($search_keyword) >= 0) {
            foreach($search_keyword as $key => $val) {
                $search_err .= "<p>Search keyword '".$val."' is not defined in database field.</p> ";
            }
        }

        if (isset($data['search_keyword'])) {
            $search_keyword = array_unique($data['search_keyword']);
        } else {
            $data['search_keyword'] = [''];
            $search_keyword = $data['search_keyword'];
        }

        $button_list = ['add', 'update', 'save', 'close', 'delete', 'sitemap', 'reset', 'status', 'search', 'export', 'date_range', 'category'];

        $button_result = array_diff($data['button'],$button_list);
        if (count($button_result) >= 0) {
            foreach($button_result as $key => $val) {
                $button_err .= "<p>Button '".$val."' is not defined in button standards.</p> ";
            }
        }

        if (isset($data['button'])) {
            $buttons['buttons']= array_unique($data['button']);
            if (in_array('export', $data['button'])) {
                if (isset($data['export_name'])) {
                    $export_name = $data['export_name'];
                } else {
                    $data['export_name'] = [''];
                    $export_name = $data['export_name'];
                }
            }
        } else {
            $data['button'] = [''];
            $buttons['buttons'] = $data['button'];
        }


        $date_field_format = null;
        if(isset($data['date_field_format'])){
            $date_field_format = $data['date_field_format']; 
        }



        if (preg_match("/cms_/i", $table_name)) {
            $tbl_name = strtolower(ucwords(str_replace("cms_", "", $table_name)));
        } else if (preg_match("/site_/i", $table_name)) {
            $tbl_name = strtolower(ucwords(str_replace("site_", "", $table_name)));
        } else if (preg_match("/pckg_/i", $table_name)) {
            $tbl_name = strtolower(ucwords(str_replace("pckg_", "", $table_name)));
        }

        $result = $CI->Global_model->get_list_all($table_name);
        $CI->load->view("content_management/template/buttons", $buttons);

        if (isset($data['export_name'])) {
            if (count($field_name) !== count($export_name)) {
                $export_err = "<p>Export name must be the same count with database field.</p> ";
            }
        }

        $html .= '<style type="text/css">';
            if (in_array('export', $buttons['buttons'])) {
                $html .= '#modalExport .modal-dialog {';
                $html .=    'min-height: calc(100vh - 60px);';
                $html .=    'display: flex;';
                $html .=    'flex-direction: column;';
                $html .=    'justify-content: center;';
                $html .=    'overflow: auto;';
                $html .=    'background-color: transparent;';
                $html .= '}';
                $html .= '.hidden-table, .table_body_contact_us_tr:first-child {';
                $html .=    'display: none;';
                $html .= '}';
                $html .= '.btn_group #btn_export_excel {';
                $html .= '    margin: 0 10px 0 0;';
                $html .= '}';
                $html .= '#modalExport hr {';
                $html .= '  margin-bottom: 35px';
                $html .= '}';
            }
        $html .= '</style>';

        if ($table_err !== "" || $fields_err !== "" || $button_err !== "" || $export_err !== "" || $action_err !== "" || $search_err !== "" || $sort_err !== "") {
            $html .=        '<div class="alert alert-danger">';
            $html .=            '<a style="text-decoration:none;" href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a>';
            $html .=            '<strong>Error!</strong> The following must be resolve to complete the configuration:<br><br>';
                $html .= $table_err.$fields_err.$search_err.$sort_err.$action_err.$export_err.$button_err;

            $html .=        '</div><br>';
        }

        $html .=        '<div class="form-group">';
        $html .=            '<div class="col-sm-12">';
        $html .=                '<div class="clearfix"></div>';

        $html .=                '<div class="form-group record-entries pull-right">';
        $html .=                    '<label>Show</label> ';
        $html .=                    '<select id="record-entries">';
        $html .=                        '<option value="10" selected>10</option>';
        $html .=                        '<option value="20">20</option>';
        $html .=                        '<option value="30">30</option>';
        $html .=                        '<option value="40">40</option>';
        $html .=                        '<option value="50">50</option>';
        $html .=                        '<option value="100">100</option>';
        $html .=                    '</select>';
        $html .=                    '<label>entries</label>';
        $html .=                '</div>';
        $html .=            '</div>';
        $html .=        '</div>';

        $html .=        '<div class="clearfix"></div>';
        $html .=        '<div class="table-responsive">';
                            if ($sort_col_row == 'row') {
        $html .=            '<table class="table table-bordered sorted_table">';
                            } else {
        $html .=            '<table class="table table-bordered tablesorter">';
                            }
        $html .=                '<thead>';
                                    if (in_array('row',$sort_col_row)) {
                                        $html .= '<tr id="sortable">';
                                        $html .= '<th class="th_sorter" style="width: 10px;"><i class="fa pull-right sort-icon"></i></th>';
                                    } else {
                                        $html .= '<tr>';
                                    }

                                        if ($checkbox == 1) {
                                            $html .= '<th class="th_checkbx" style="width:25px;"><input class="selectall" type="checkbox" ><i class="fa pull-right sort-icon"></i></th>';
                                        }

                                        foreach ($display_fields as $key => $val) {

                                            if (isset($val[1])) {
                                                $width = $val[1]."px";
                                            } else {
                                                $width = "auto";
                                            }

                                            if (!empty($val[0])) {
                                                $html .= '<th style="width:'.$width.' !important;">'.ucwords(str_replace('_', ' ', $val[0])).' <i class="fa pull-right sort-icon"></i></th>';
                                            } else {
                                                $html .= '<th style="width:'.$width.' !important;">'.ucwords(str_replace('_', ' ', $key)).' <i class="fa pull-right sort-icon"></i></th>';
                                            }

                                        }

                                        if (in_array('add', $buttons['buttons'])) {
                                            $html .= '<th>Edit <i class="fa pull-right sort-icon"></i></th>';
                                        }
                                        if (isset($custom_action)) {
                                            foreach ($custom_action as $key => $val) {
                                                if ($key == 1) {
                                                    $html .= '<th>Action <i class="fa pull-right sort-icon"></i></th>';
                                                }
                                            }
                                        }

        $html .=                    '</tr>';
        $html .=                '</thead>';

                                if (in_array('row',$sort_col_row)) {
        $html .=                '<tbody class="table_body ui-sortable"></tbody>';
                                } else {
        $html .=                '<tbody class="table_body"></tbody>';
                                }

        $html .=            '</table>';
        $html .=            '<div class="list_pagination"></div>';
        $html .=        '</div>';
        $html .=                '<div class="col-sm-12">';
        $html .=                    '<div class="clearfix"></div>';
        $html .=                    '<div class="form-group record-entries pull-right">';
        $html .=                        '<label>Show</label> ';
        $html .=                        '<select>';        
        $html .=                            '<option value="10" selected>10</option>';
        $html .=                            '<option value="20">20</option>';
        $html .=                            '<option value="30">30</option>';
        $html .=                            '<option value="40">40</option>';
        $html .=                            '<option value="50">50</option>';
        $html .=                            '<option value="100">100</option>';
        $html .=                        '</select>';
        $html .=                        '<label>entries</label>';
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=            '</div>';
        $html .=        '</div>';

        if (in_array('export', $buttons['buttons'])) {
            $html .= '<!-- Export PDF Hidden Table -->';
            $html .= '<div class="hide">';
            $html .=    '<table class="table listdata table-bordered" id="site_contact_us_table">';
            $html .=        '<thead>';
            $html .=        '</thead>';
            $html .=        '<tbody class="table_body_contact_us">';
            $html .=        '</tbody>';
            $html .=    '</table>';
            $html .= '</div>';

            $html .= '<div class="modal fade" id="modalExport" role="dialog">';
            $html .=    '<div class="modal-dialog modal-sm">';
            $html .=        '<div class="modal-content">';
            $html .=            '<div class="modal-header">';
            $html .=                '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            $html .=                '<h4 class="modal-title">Export Method</h4>';
            $html .=            '</div>';
            $html .=            '<div class="modal-body" style="text-align: center;overflow-y:scroll;height:400px;">';
            $html .=                '<p class="text-left">Please select field name to export:</p>';
            $html .=                '<table class="table list-data table-bordered">';
            $html .=                    '<thead>';
            $html .=                    '<tr>';
            $html .=                    '<th class="text-center"><input id="select_all_export" type ="checkbox"></th>';
            $html .=                    '<th class="text-center">Field Name</th>';
            $html .=                    '</tr>';
            $html .=                    '</thead>';
            $html .=                    '<tbody class="table_body_checkbox"></tbody>';
            $html .=                '</table>';
            $html .=                '<hr>';
            $html .=                '<div class="btn_group"><button type="button" id="btn_export_excel" class="btn btn-success btn-export-excel" disabled><i class="fa fa-file-excel-o"></i> Excel</button>';
            $html .=                '<button type="button" id="btn_export_pdf" class="btn btn-danger btn-export-pdf" disabled><i class="fa fa-file-pdf-o"></i> PDF</button></div>';
            $html .=                '<br>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .= '</div>';
        }

        // Javascript
        $html .= '<script type="text/javascript">';
        $html .=    '$(".status_details").hide();';

                    $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
                    $urls = explode('/', $escaped_url);
                    array_pop($urls);

        $html .=    'var current_url = "'.$url.'";';

        $html .=    '$(document).on("click", "#btn_close", function(e){';
        $html .=        'location.href = "'.implode('/', $urls).'";';
        $html .=    '});';

        $html .=    'var query = "'.$init_query.'";';
        $html .=    'var limit = 10;';

        $html .=    '$(document).ready(function(){';

        $html .=         'if ($(".table-responsive th:first-child").hasClass("th_checkbx")) {';
        $html .=             '$(".th_checkbx i").hide();';
        $html .=          '}';
        $html .=          'if ($(".table-responsive th:nth-child(2n)").hasClass("th_checkbx")) {';
        $html .=                '$(".th_checkbx i").hide();';
        $html .=          '}';
        $html .=          'if ($(".table-responsive th:first-child").hasClass("th_sorter")) {';
        $html .=                '$(".th_sorter i").hide();';
        $html .=          '}';

                        if (in_array('column',$sort_col_row)) {
                            $html .= '$("table th .sort-icon").addClass("fa-sort");';
                        }

        $html .=        'get_data();';
        $html .=        'get_pagination();';

        $html .=        '$(document).on("cut copy paste input", ".start-date, .end-date", function(e) {';
        $html .=            'e.preventDefault();';
        $html .=        '});';

        $html .=        '$(document).on("keypress", "#search_query", function(e) {';
        $html .=            'if (e.keyCode == 13) {';
        $html .=        '       offset = 1;';
        $html .=        '       var from = $(".start-date").val();';
        $html .=        '       var to = $(".end-date").val();';
        $html .=                'var keyword = $(this).val().replace("\'", "");';
      
                $html .=        'if(keyword == ""){';
                $html .=                    'query = "id != 0";';
                $html .=                    'get_data();';
                $html .=                    'get_pagination();';

                $html .=            'if(from != "" && to != ""){';
                $html .=            '   query = " DATE(update_date) BETWEEN \'"+ from +"\' AND \'"+to+"\' AND status >= 0 ";';

                $html .=        '   }else{';
                $html .=            '   query = "status >= 0 ";';
                $html .=        '   }';
                $html .=        '} else {';
                $html .=            'if(from != "" && to != ""){';
                $html .=            '   query = " DATE(update_date) BETWEEN \'"+ from +"\' AND \'"+to+"\' AND status >= 0 ";';

                $html .=        '   }else{';
                $html .=            '   query = "status >= 0 ";';
                $html .=        '   }';

                                        $keyword_count = count($search_keyword);
                                        $sk_counter = 0;
                $html .=                'query += " AND ';
                                        foreach($search_keyword as $keyword) {

                                            if (++$sk_counter === $keyword_count) {
                                                $html .= '('.$keyword.' like \'%" + keyword + "%\')";';
                                            } else {
                                                $html .= '('.$keyword.' like \'%" + keyword + "%\') OR ';
                                            }
                                        }
                $html .=        '}';
                $html .=                'get_data();';
                $html .=                'get_pagination();';
        $html .=            '}';
        $html .=        '});';

                        if (in_array('row',$sort_col_row)) {
        $html .=            'var sorttable = $("tbody").sortable();';
        $html .=            '$("tbody").bind("sortupdate", function(event, ui) {';
        $html .=            'var order = 0;';
        $html .=                '$(".order").each(function() {';
        $html .=                    'order++;';
        $html .=                    '$(this).attr("data-order",order);';
        $html .=                 '});';
        $html .=                'save_sort();';
        $html .=            '});';
                        }

        $html .=    '});';

        $html .=    'function get_data(){';

                        $order_key = "";
                        $order_val = "";

                        foreach($order_by as $key => $val) {
                           $order_key = $key;
                           $order_val = $val;
                        }

                        $join_key = "";
                        $join_tablename = "";
                        $join_query = "";
                        $join_type = "";

                        // foreach ($join_table as $key => $val) {
                        //     $join_key = $key;
                        //     $join_tablename = $val[0];
                        //     $join_query = $val[1];
                        //     $join_type = $val[2];
                        // }

        $html .=        'var url = "'.base_url('content_management/global_controller').'";';
        $html .=        'var data = {';
        $html .=            'event : "list",';
        $html .=            'select : "",';
        $html .=            'query : query,';
        $html .=            'offset : offset,';
        $html .=            'limit : limit,';
        $html .=            'table : "'.$table_name.'",';
        $html .=            'order : {';
                                if (in_array('row',$sort_col_row)) {
                                    $html .= 'field : "orders",';
                                    $html .= 'order : "'.$order_key.'"';
                                } else {
                                    $html .= 'field : "'.$order_val.'",';
                                    $html .= 'order : "'.$order_key.'"';
                                }
        $html .=            '},';
                                if ($join_key == 1) {
                                    $html .= 'join : [';
                                    $html .=    '{';
                                    $html .=        'table : "'.$join_tablename.'",';
                                    $html .=        'query : "'.$join_query.'",';
                                    $html .=        'type : "'.$join_type.'"';
                                    $html .=    '}';
                                    $html .= ']';
                                }
        $html .=        '};';
        $html .=        'aJax.post(url,data,function(result){';
        $html .=            'var obj = is_json(result);';

        $html .=            'var html = ""; ';
        $html .=            'if(obj.length > 0){';
        $html .=                '$.each(obj, function(x,y){';
        $html .=                    'if (y == "gender") {';
        $html .=                        'var gender = (y.gender == 1) ? gender = "Male" : gender = "Female";';
        $html .=                    '}';

        $html .=                    'if (y == "signup_gender") {';
        $html .=                        'var gender = (y.signup_gender == 1) ? gender = "Male" : gender = "Female";';
        $html .=                    '}';

        $html .=                    'if (y.start_date != null) {';
        $html .=                        'var start_date = y.start_date;';
        $html .=                    '}';
        $html .=                    'if (y.end_date != null) {';
        $html .=                        'var end_date = y.end_date;';
        $html .=                    '}';

        
        $html .=                    'var status = ""; if (y.status == 1) { status = "Active"; }';
        $html .=                                    'else if (y.status == 0) { status = "Inactive";}';
        $html .=                                    'else if (y.status == -2) { status = "Deleted";}';

        $html .=                    'var featured = (y.featured == 1) ? featured = "Show" : featured = "Hide";';

        // $html .=                    'var expiration = "Always";';
        // $html .=                    'if(y.article_start != "0000-00-00" || y.article_end != "0000-00-00" ){';
        // $html .=                    '    expiration = moment(y.article_start).format("LL") + " to " + moment(y.article_end).format("LL");';
        // $html .=                    '}';

        $html .=                    'var notif_contactus = "";';
        $html .=                    'if (y.notif_contactus == 1) {';
        $html .=                       'notif_contactus = "<td class=\"text-center\"><a href=\"'.base_url().'content_management/users/edit_users/"+y.id+"\" data-status=\""+y.status+"\" id=\""+y.id+"\" class=\"black\"><i class=\"fa fa-check\"></i></a></td>";';
        $html .=                    '} else {';
        $html .=                       'notif_contactus = "<td class=\"text-center\"><a href=\"'.base_url().'content_management/users/edit_users/"+y.id+"\" data-status=\""+y.status+"\" id=\""+y.id+"\" class=\"black\"><i class=\"fa fa-times\"></i></a></td>";';
        $html .=                    '}';

        $html .=                    'var notif_signup = "";';
        $html .=                    'if (y.notif_signup == 1) {';
        $html .=                       'notif_signup = "<td class=\"text-center\"><a href=\"'.base_url().'content_management/users/edit_users/"+y.id+"\" data-status=\""+y.status+"\" id=\""+y.id+"\" class=\"black\"><i class=\"fa fa-check\"></i></a></td>";';
        $html .=                    '} else {';
        $html .=                       'notif_signup = "<td class=\"text-center\"><a href=\"'.base_url().'content_management/users/edit_users/"+y.id+"\" data-status=\""+y.status+"\" id=\""+y.id+"\" class=\"black\"><i class=\"fa fa-times\"></i></a></td>";';
        $html .=                    '}';

                                    if (in_array('row',$sort_col_row)) {
                                        $html .= 'html += "<tr class=\'ui-sortable-handle\'>";';
                                        $html .=    'html += "<td class=\'hide\' style=\'background-color:  #c3c3c3;\'><p class=\'order\' data-order=\'\' data-id=\'"+y.id+"\'></p></td>";';
                                        $html .=  'html += "<td style=\'background-color:#c3c3c3;\'><span style=\'color: #fff;\' class=\'move-menu glyphicon glyphicon-th\'></span></td>";';
                                    } else {
                                        $html .= 'html += "<tr>";';
                                    }

                                    if ($checkbox == 1) {
                                        $html .= 'html += "<td><input class = \'select\'  data-id = \'"+y.id+"\' data-name=\'"+y.name+"\' type =\'checkbox\'></td>";';
                                    }

                                    foreach($display_fields as $key => $val) {
                                        switch ($key) {
                                            case 'gender':
                                                 $html .= 'html += "<td>"+ gender +"</td>";';
                                                break;
                                            case 'status':
                                                $html .= 'html += "<td>"+ status +"</td>";';
                                                break;
                                            case 'featured':
                                                $html .= 'html += "<td>"+ featured +"</td>";';
                                                break;
                                            case 'notif_signup': 
                                                $html .= 'html += notif_signup;';
                                                break;
                                            case 'notif_contactus':
                                                $html .= 'html += notif_contactus;';
                                                break;
                                            case 'meta_type':
                                                $html .= 'html += "<td>"+ meta_type +"</td>";';
                                                break;
                                            case 'expiration':
                                                $html .= 'html += "<td>"+ expiration +"</td>";';
                                                break;
                                            case 'start_date':
                                                if(array_key_exists("start_date",$date_field_format)){
                                                    $html .= 'html += "<td>"+  moment(start_date).format("'.$date_field_format["start_date"].'"); +"</td>";';
                                                }else{
                                                     $html .= 'html += "<td>"+ start_date +"</td>";';
                                                }

                                                break;
                                            case 'end_date':
                                                if(array_key_exists("end_date",$date_field_format)){
                                                    $html .= 'html += "<td>"+  moment(end_date).format("'.$date_field_format["end_date"].'"); +"</td>";';
                                                }else{
                                                     $html .= 'html += "<td>"+ end_date +"</td>";';
                                                }
                                                break;
                                            case '':
                                                $html .= 'html += "<td>Empty</td>";';
                                                break;
                                            default:
                                                if (isset($val[2])) {
                                                    $html .= 'if ((/\.(gif|jpg|jpeg|tiff|png)$/i).test(y.'.$key.')) {';
                                                    $html .= '  html += "<td><img class=\'img-responsive\' src=\''.base_url().'"+y.'.$key.'+"\'/></td>";';
                                                    $html .= '} else {';
                                                    $html .= '  if (y.'.$key.'.length > '.$val[2].') {';
                                                    $html .= '      html += "<td>" + y.'.$key.'.substring(0,'.$val[2].') + "...</td>";';
                                                    $html .= '  } else {';
                                                    $html .= '      html += "<td>" + y.'.$key.' + "</td>";';
                                                    $html .= '  };';  
                                                    $html .= '}';

                                                } else {
                                                    $html .= 'if ((/\.(gif|jpg|jpeg|tiff|png)$/i).test(y.'.$key.')) {';
                                                    $html .= '  html += "<td><img class=\'img-responsive\' src=\''.base_url().'"+y.'.$key.'+"\'/></td>";';
                                                    $html .= '} else {';
                                                    $html .= '  html += "<td>" + y.'.$key.' + "</td>";';
                                                    $html .= '}';
                                                }

                                                break;
                                        }

                                        if ($key == "meta_type") {
                                            $sitemap_checker = 1;
                                        } else {
                                            $sitemap_checker = 0;
                                        }

                                    }

                                        if (in_array('add', $buttons['buttons'])) {
                                            $html .= 'html += "<td class=\'text-center\'><a href=\''.base_url()."content_management/".$CI->uri->segment(2)."/edit".'/"+y.id+"\' class=\'edit\' title=\'edit\' data-id="+y.id+"><span class=\'glyphicon glyphicon-pencil\'></span></a></td>";';
                                         }

                                    foreach ($custom_action as $key => $val) {
                                        if ($key == 1) {
                                            $html .= 'html += "<td>";';
                                            if ($val['type'] == "button") {
                                                if ($val['function'] == "") {
                                                    $html .= 'html += "<button style=\"margin:auto;display:block;\" class=\"'.$val['class'].'\" id=\"'.$val['id'].'\" data-id=\""+y.id+"\"><i class=\"'.$val['icon'].'\"></i> '.$val['value'].'</button>";';
                                                } else {
                                                    $html .= 'html += "<button style=\"margin:auto;display:block;\" class=\"'.$val['class'].'\" id=\"'.$val['id'].'\" onclick=\"'.$val['function'].'()\" data-id=\""+y.id+"\"><i class=\"'.$val['icon'].'\"></i> '.$val['value'].'</button>";';
                                                }
                                            } else if ($val['type'] == "icon") {
                                                $val['class'] = str_replace("btn", "", $val['class']);
                                                if ($val['function'] == "") {
                                                    $html .= 'html += "<a href=\"javascript:void(0)\" style=\"margin:auto;display:block;\" class=\"text-center '.$val['class'].'\" id=\"'.$val['id'].'\" data-id=\""+y.id+"\"><i class=\"'.$val['icon'].'\"></i> '.$val['value'].'</a>";';
                                                } else {
                                                    $html .= 'html += "<a href=\"javascript:void(0)\" style=\"margin:auto;display:block;\" class=\"text-center '.$val['class'].'\" id=\"'.$val['id'].'\" onclick=\"'.$val['function'].'()\" data-id=\""+y.id+"\"><i class=\"'.$val['icon'].'\"></i> '.$val['value'].'</a>";';
                                                }
                                            }
                                            $html .= 'html += "</td>";';
                                        }
                                    }

        $html .=                    'html += "</tr>";';
        $html .=                '});';

        if (in_array('export', $buttons['buttons'])) {
            $html .= 'var maintable_htm = 0;';
            $html .= 'var db_field = "";';
            $html .= 'var new_field = "";';

            $html .= 'function trim_field_name(str){';
            $html .=    'return str.toLowerCase().replace(/contact_us_|_/gi, " ");';
            $html .= '}';

            $html .= 'function ucwords_js(str){';
            $html .=    'return (str + "").replace(/^([a-z])|\s+([a-z])/g, function ($1){';
            $html .=        'return $1.toUpperCase();';
            $html .=    '});';
            $html .= '}';

            $html .= 'var custom_database_field = "";';
            $html .= '$.each(obj[0], function(x,y){';

            $export_counter = count($export_name);
            for ($x = 0; $x < $export_counter; $x++) {
                    $html .= 'if (x == "'.$field_name[$x].'") {';
                    $html .= '    custom_database_field = "'.$export_name[$x].'";';   
                    $html .= '}';   
            }

            $html .=    'db_field += "<tr class=\'table_body_contact_us_tr\'>";';
            $html .=    'db_field += "<td><input class=\'select_export\' type=\'checkbox\' data-field-name=\'"+x+"\'></td>";';
            $html .=    'db_field += "<td>"+ucwords_js(trim_field_name(custom_database_field))+"</td>";';
            $html .=    'db_field += "</tr>";';

            $html .=    'maintable_htm += "<th><p>"+ucwords_js(trim_field_name(custom_database_field))+"</p></th>";';
            $html .= '});';
        }

        $html .=            '} else {';
        $html .=                '$("#btn_sitemap").hide();';
        $html .=                'html = "<tr><td colspan=\'10\' style=\'text-align: center;\'>No records to show.</td></tr>";';
        $html .=            '}';
        $html .=            '$(".table_body").html(html);';
        
                            if (in_array('export', $buttons['buttons'])) {
                                $html .= '$(".table_body_checkbox").html(db_field);';
                                $html .= '$("#main_table thead>tr").html(maintable_htm);';
                            }

                            if (in_array('column',$sort_col_row)) {
        $html .=                '$("table").tablesorter();';
        $html .=                '$("table").trigger("update", [true]);';
                            }
        $html .=        '});';
        $html .=    '}';

        $html .=    'function get_pagination(){';
        $html .=        'var url = "'.base_url('content_management/global_controller').'";';
        $html .=        'var data = {';
        $html .=            'event : "pagination",';
        $html .=            'select : "",';
        $html .=            'query : query,';
        $html .=            'offset : offset,';
        $html .=            'limit : limit,';
        $html .=            'table : "'.$table_name.'"';
        $html .=        '};';

        $html .=        'aJax.post(url,data,function(result){';
        $html .=            'var obj = is_json(result);';
        $html .=            'if(obj.total_page > 1){';
        $html .=                'pagination.generate(obj.total_page, ".list_pagination", get_data);';
        $html .=            '}';
        $html .=        '});';
        $html .=    '}';

        $html .=    'pagination.onchange(function(){';
        $html .=        'offset = $(this).val();';
        $html .=        'modal.loading(true);';
        $html .=        'get_data();';
        $html .=        '$("#search_query").val("");';
        $html .=        'modal.loading(false);';
        $html .=    '});';

        $html .=    '$(document).on("click", "#btn_filter", function(){';
        $html .=        'var from = $(".start-date").val();';
        $html .=        'var to = $(".end-date").val();';

        $html .=        'var keyword = $(".search-query").val();';
        $html .=        '$(".start-date").css("border-color","#ccc");';
        $html .=        '$(".end-date").css("border-color","#ccc");';
        $html .=        'if(from == ""){';
        $html .=            '$(".start-date").css("border-color","red");';
        $html .=        '}else if(to == ""){';
        $html .=            '$(".end-date").css("border-color","red");';
        $html .=        '}else if(keyword == ""){';
        $html .=            'if(from != "" && to != ""){';
        $html .=            '   query = "DATE(update_date) BETWEEN \'"+ from +"\' AND \'"+to+"\' AND status >= 0 ";';

        $html .=        '   }else{';
        $html .=            '   query = "DATE(update_date) BETWEEN \'"+ from +"\' AND \'"+to+"\' AND status >= 0 ";';
        $html .=        '   }';
        $html .=        '} else {';

                            $keyword_count = count($search_keyword);
                            $sk_counter = 0;
        $html .=            'query += " AND ';
                            foreach($search_keyword as $keyword) {

                                if (++$sk_counter === $keyword_count) {
                                    $html .= '('.$keyword.' like \'%" + keyword + "%\')";';
                                } else {
                                    $html .= '('.$keyword.' like \'%" + keyword + "%\') OR ';
                                }
                            }

        $html .=        '}';
        $html .=        'get_data();';
        $html .=        'get_pagination();';
        $html .=    '});';

        $html .=    '$(document).on("click", "#btn_reset", function(){';
        $html .=        '$(".start-date").val("");';
        $html .=        '$(".end-date").val("");';
        $html .=        '$(".search-query").val("");';
        $html .=        'query = "id != 0 AND status >= 0";';
        $html .=        'get_data();';
        $html .=        'get_pagination();';
        $html .=    '});';

        $html .=    '$(document).on("change", ".record-entries select", function(e) {';
        $html .=        '$(".record-entries option").removeAttr("selected");';
        $html .=        '$(".record-entries select").val($(this).val());';
        $html .=        '$(".record-entries option:selected").attr("selected","selected");';
        $html .=        'var test = $(this).prop( "selected",true ).val();';
        $html .=        'limit = parseInt(test);';
        $html .=        'get_data();';
        $html .=        'get_pagination();';
        $html .=    '});';

        $html .= '$(document).on("click",".btn_status",function(e){';
        $html .=    'var status = $(this).attr("data-status");';
        $html .=    'var id = "";';

        $html .=    'modal.confirm("Are you sure you want to Update this record?",function(result){';
        $html .=        'if(result){';
        $html .=            '$(".selectall").prop("checked", false);';
        $html .=            '$(".select:checked").each(function(index) { ';
        $html .=                'id = $(this).attr("data-id");';
        $html .=                'var url = "'.base_url("content_management/global_controller").'";';
        $html .=                'var data = {';
        $html .=                    'event : "update",';
        $html .=                    'table : "'.$table_name.'",';
        $html .=                    'field : "id", ';
        $html .=                    'where : id, ';
        $html .=                    'data : {';
        $html .=                        'status : status,';
        $html .=                        'update_date : moment(new Date()).format("YYYY-MM-DD HH:mm:ss")';
        $html .=                    '}, ';
        $html .=                '};';
        $html .=                'aJax.post(url,data,function(result){';
        $html .=                    'var obj = is_json(result);';
        $html .=                    'if(obj == "success"){';
        $html .=                        'get_data();';
        $html .=                        'get_pagination();';
        $html .=                        '$(".btn_status").hide();';
        $html .=                    '}else{';
        $html .=                        'alert(obj);';
        $html .=                    '}';
        $html .=                '});';
        $html .=            '});';
        $html .=        '}';
        $html .=    '});';
        $html .= '});';

        $html .= 'function save_sort() {';
        $html .=    '$(".order").each(function() {';
        $html .=        'var orders = $(this).attr("data-order");';
        $html .=        'var url = "'.base_url("content_management/global_controller").'";';
        $html .=        'var data = {';
        $html .=            'event : "update", ';
        $html .=            'table : "'.$table_name.'",';
        $html .=            'field : "id", ';
        $html .=            'where : $(this).attr("data-id"), ';
        $html .=            'data : {orders : orders} ';
        $html .=        '};';

        $html .=        'aJax.post(url,data,function(result){ });';
        $html .=    '});';

        $html .= '}';

        // Add button Function
        $html .= '$(document).on("click", "#btn_add", function(e){';
        $html .=    'location.href = "'.base_url("content_management/".$CI->uri->segment(2)."/add").'";';
        $html .= '});';

        //Sitemap javascript function
        $html .= '$(document).on("click","#btn_sitemap",function(){';
        $html .=    'var url = "<?= base_url(\'content_management/sitemap/html\');?>";';
        $html .=    'var data = {};';
        $html .=    'aJax.post(url,data,function(result){ ';
        $html .=        'window.open("<?= base_url(\'sitemap.html\');?>", "_blank");';
        $html .=        'window.open("<?= base_url(\'sitemap.xml\');?>", "_blank");';
        $html .=    '});';
        $html .= '});';

        //Table sorter Function
        $html .= '$(document).on("click", "table th", function() {';
        $html .=    '$(this).find(".sort-icon").addClass("fa-caret-down");';
        $html .=    'if ($(this).find(".sort-icon").hasClass("fa-caret-up")) {';
        $html .=        '$(this).find(".sort-icon").removeClass("fa-caret-up");';
        $html .=        '$(this).find(".sort-icon").addClass("fa-caret-down");';
        $html .=        '$(this).find(".sort-icon").removeClass("fa-sort");';
        $html .=        '$("table th").not(this).find(".sort-icon").addClass("fa-sort");';

        $html .=    '} else {';
        $html .=        '$(this).find(".sort-icon").removeClass("fa-caret-down");';
        $html .=        '$(this).find(".sort-icon").addClass("fa-caret-up");';
        $html .=        '$(this).find(".sort-icon").removeClass("fa-sort");';
        $html .=        '$("table th").not(this).find(".sort-icon").addClass("fa-sort");';
        $html .=    '}';
        $html .= '});';

        if(in_array('export', $buttons['buttons'])){
            $html .= '$(document).on("click", "#select_all_export", function () {';
            $html .=    '$(".select_export").prop("checked", this.checked);';
            $html .= '});';

            $html .= '$(document).on("click", "#btn_export", function(){';
            $html .=    'var modal_obj = '.$CI->standard->confirm_return("confirm_export").';';
            $html .=    'modal.confirm(modal_obj.message, function(result){';
            $html .=        'if(result){';
            $html .=            '$("#modalExport").modal("show");';
            $html .=        '}';
            $html .=    '});';
            $html .= '});';

            $html .= '$(document).on("change", "#select_all_export", function(){';
            $html .=    'if($("#select_all_export").prop("checked")){';
            $html .=        '$(".btn-export-excel").attr("disabled", false);';
            $html .=        '$(".btn-export-pdf").attr("disabled", false);';
            $html .=    '}else{';
            $html .=        '$(".btn-export-excel").attr("disabled", "disabled");';
            $html .=        '$(".btn-export-pdf").attr("disabled", "disabled");';
            $html .=    '}';
            $html .= '});';

            $html .= '$(document).on("click", ".select_export", function(){';
            $html .=    'if($(this).prop("checked")){';
            $html .=        '$(".btn-export-excel").attr("disabled", false);';
            $html .=        '$(".btn-export-pdf").attr("disabled", false);';
            $html .=    '}';

            $html .=    'if($("input[class=\'select_export\']:checked").length == 0){';
            $html .=        '$(".btn-export-excel").attr("disabled", "disabled");';
            $html .=        '$(".btn-export-pdf").attr("disabled", "disabled");';
            $html .=    '} else {';
            $html .=    '   $(\'input[data-field-name="id"]\').prop(\'checked\',true);';
            $html .=    '}';
            $html .= '});';

            $html .= '$(document).on("click", "#btn_export_excel", function(){';
            $html .=    'var select = [];';
            $html .=    'var custom_th = [];';
            $html .=    'var table = "'.$table_name.'";';
            $html .=    'var prefix = "'.$table_prefix.'";';
            $html .=    'var filename = "'.strtolower($tbl_name).'_list.xls";';
            $html .=    'var keyword = $(".search_query").val();';
            $html .=    'var from = $(".start-date").val();';
            $html .=    'var to = $(".end-date").val();';
            $html .=    'if (!keyword == "") {';
            $html .=        'if (from != "" && to != "") {';
                                $html .= 'query += " AND ';
                                $keyword_count = count($search_keyword);
                                $sk_counter = 0;
                                foreach($search_keyword as $keyword) {
                                    if (++$sk_counter === $keyword_count) {
                                        $html .= '('.$keyword.' like \'%" + keyword + "%\') AND DATE(update_date) BETWEEN \'"+from+"\' AND \'"+to+"\'';
                                    } else {
                                        $html .= '('.$keyword.' like \'%" + keyword + "%\') OR ';
                                    }
                                }
                                $html .= ' ";';
            $html .=        '} else {';
                                $html .= 'query += " AND ';
                                foreach($search_keyword as $keyword) {
                                    if (++$sk_counter === $keyword_count) {
                                        $html .= '('.$keyword.' like \'%" + keyword + "%\')';
                                    } else {
                                        $html .= '('.$keyword.' like \'%" + keyword + "%\') OR ';
                                    }
                                }
                                $html .= ' ";';
            $html .=        '}';
            $html .=    '} else {';
            $html .=        'if (from != "" && to != "") {';
            $html .=            'query = "DATE(update_date) BETWEEN \'" + from + "\' AND \'" + to + "\'";';
            $html .=        '} else {';
            $html .=            'query = "status >= 0";';
            $html .=        '}';
            $html .=    '}';

            $html .=    '$("#select_all_export").prop("checked", false);';

            $html .=    '$(".select_export:checked").each(function(index){ ';
            $html .=    '       select.push($(this).attr("data-field-name"));';
            $html .=    '});';

            foreach($export_name as $key => $val) {
                $html .= 'custom_th.push("'.$val.'");';
            }

            $html .=    'var uri = "'.base_url("content_management/custom_controller/get_list_data_query_csv").'?table="+table+"&select="+select+"&custom_th="+custom_th+"&prefix="+prefix+"&filename="+filename+"&query="+query+"";';

            $html .=    'window.open(uri);';

            $html .=    'add_audit_trail("Export '.$tbl_name.' List");';
            $html .=    '$("#modalExport").modal("hide");';

            $html .=    'modal.alert("Success! Export completed.",function(){   ';
            // $html .=    'query = "status >= 0";';
            // $html .=    '   get_data();';
            // $html .=    '   get_pagination();';
            $html .=    '});';

            $html .=    '$("#select_all_export").prop("checked", false);';
            $html .=    '$(".select_export").prop("checked", false);';
            $html .=    '$(".btn-export-excel").attr("disabled", "disabled");';
            $html .=    '$(".btn-export-pdf").attr("disabled", "disabled");';
            $html .= '});';

            $html .= '    $(document).on("click", "#btn_export_pdf", function(){';
            $html .= '        var url = "'.base_url("content_management/global_controller").'";';
            $html .= '        var pdf_arr = [];';

            $html .= '        function trim_field_name(str){';
            $html .= '          return str.toLowerCase().replace(/contact_us_|_/gi, " ");';
            $html .= '        }';

            $html .= '        function ucwords_js(str){';
            $html .= '           return (str + "").replace(/^([a-z])|\s+([a-z])/g, function ($1){';
            $html .= '              return $1.toUpperCase();';
            $html .= '          });';
            $html .= '        }';

            $html .= '        $.each($("input[class=\'select_export\']:checked"), function() {';
            $html .= '            if ($(this).attr("data-field-name") !== "id") {';
            $html .= '              pdf_arr.push($(this).attr("data-field-name"));';
            $html .= '            }';
            $html .= '        });';

            $html .= '        if($("input[class=\'select_export\']:checked").length == $("input[class=\'select_export\']").length){';
            $html .= '            $(".btn-export-excel").attr("disabled", false);';
            $html .= '            $(".btn-export-pdf").attr("disabled", false);';
            $html .= '            $("#select_all_export").prop("checked", true);';
            $html .= '        }else{';
            $html .= '            if($("input[class=\'select_export\']:checked").length == 0){';
            $html .= '                $(".btn-export-excel").attr("disabled", "disabled");';
            $html .= '                $(".btn-export-pdf").attr("disabled", "disabled");';
            $html .= '            }';
            $html .= '            $("#select_all_export").prop("checked", false);';
            $html .= '        }';

            $html .= '            var data = {';
            $html .= '                event : "list",';
            $html .= '                select : "",';
            $html .= '                query : query,';
            $html .= '                offset : offset,';
            $html .= '                limit : 0,';
            $html .= '                table : "'.$table_name.'",';
            $html .= '            };';

            $html .= '            aJax.post(url,data,function(result){';
            $html .= '                var obj = is_json(result);';
            $html .= '                var expo_thead = "";';
            $html .= '                var expo = "";';

            $html .= '                expo_thead+= "<th>ID</th>";';

            $html .= '                var custom_array_length = pdf_arr.length;';
            $html .= '                var custom_th = "";';
            $html .= '                for (var i = 0; i < custom_array_length; i++) {';

            $export_counter = count($export_name);
            for ($x = 1; $x < $export_counter; $x++) {
                    $html .= 'if (pdf_arr[i] == "'.$field_name[$x].'") {';
                    $html .= '    custom_th = "'.$export_name[$x].'";';   
                    $html .= '                      expo_thead+= "<th>"+custom_th+"</th>";';
                    $html .= '}';   
            }

            $html .= '                }';

            $html .= '                if(obj.length > 0){';
            $html .= '                    var counter = 0;';
            $html .= '                    var id_counter = 1;';
            $html .= '                    $.each(obj, function(x,y){';
            $html .=                    'if (y == "gender") {';
            $html .=                        'var gender = (y.gender == 1) ? gender = "Male" : gender = "Female";';
            $html .=                    '}';

             $html .=                    'if (y == "signup_gender") {';
            $html .=                        'var gender = (y.signup_gender == 1) ? gender = "Male" : gender = "Female";';
            $html .=                    '}';
            $html .= '                      var status = ""; if (y.status == 1) { status = "Active"; }';
            $html .= '                      else if (y.status == 0) { status = "Inactive";}';
            $html .= '                      else if (y.status == -2) { status = "Deleted";}';

            $html .= '                        expo+= "<tr>";';
            $html .= '                        expo+= "<td>"+ id_counter++ +"</td>";';
                                        foreach ($field_name as $key => $val) {
                                                    if($val == "id") {
                                                        continue;
                                                    }
                    $html .= '                      var '.$val.'_pattern = new RegExp("'.$val.'");';
                    $html .= '                      var '.$val.'_result = '.$val.'_pattern.test(pdf_arr);';
        
                                                    if ($val.'_result' == 'create_date') {
                    $html .= '                          if ('.$val.'_result == true) {';
                    $html .= '                          expo += "<td>"+moment(y.create_date).format(\"LLL\")+"</td>";'; 
                    $html .= '                          }';                                
                                                    } else if ($val.'_result' == 'update_date') {
                    $html .= '                          if ('.$val.'_result == true) {';
                    $html .= '                          expo += "<td>"+moment(y.update_date).format(\"LLL\")+"</td>";'; 
                    $html .= '                          }'; 
                                                    }  else {
                    $html .= '                          if ('.$val.'_result == true) {';
                                                            if ($val == "gender" || $val == "status") {
                    $html .= '                                  expo += "<td>"+'.$val.'+"</td>";';
                                                            } else if ($val == "birthdate" || $val == "dob" || $val == "birthday") {
                    $html .= '                                 expo += "<td>"+moment(y.'.$val.').format("LL")+"</td>";';
                                                            } else if ($val == "create_date" || $val == "update_date") {
                    $html .= '                                 expo += "<td>"+moment(y.'.$val.').format("LLL")+"</td>";';
                     
                                                            } else {
                    $html .= '                                  expo += "<td>"+y.'.$val.'+"</td>";';
                                                            }
                    $html .= '                          }';
                                                    }
                                          
                                        }
                                       
            $html .= '                        expo+= "</tr>";';
            $html .= '                    });';

            $html .= '                }else{';
            $html .= '                    expo = "";';
            $html .= '                }';

            $html .= '                $("#site_contact_us_table > thead > tr").remove();';
            $html .= '                $("#site_contact_us_table > thead").append("<tr class=\'maintable_head_contact_us\'></tr>");';
            $html .= '                $("#site_contact_us_table .maintable_head_contact_us").html(expo_thead);';
            $html .= '                $("#site_contact_us_table .table_body_contact_us").html(expo);';
            $html .= '                modal.loading(false);';

            $html .= '                var doc = new jsPDF("l", "pt", "legal");';
            $html .= '                var res = doc.autoTableHtmlToJson(document.getElementById("site_contact_us_table"));';

            $html .= '                doc.autoTable(res.columns, res.data, {';
            $html .= '                    startY: 10,';
            $html .= '                    margin: 10,';
            $html .= '                    styles: {';
            $html .= '                        fontSize: 8';
            $html .= '                    },';
            $html .= '                    theme: "grid"';
            $html .= '                });       ';

            $html .= '                doc.save("'.strtolower($tbl_name).'_list.pdf");';
            $html .= '                add_audit_trail("Export '.$tbl_name.' List");';
            $html .= '                  modal.alert("Success! Export completed.",function(){   ';
            // $html .= '                     get_data();';
            // $html .= '                     get_pagination();';
            $html .= '                  });';
            $html .= '            });';

            $html .= '        $("#modalExport").modal("hide");';
            $html .= '        $("#select_all_export").prop("checked", false);';
            $html .= '        $(".select_export").prop("checked", false);';
            $html .= '        $(".btn-export-exce").attr("disabled", "disabled");';
            $html .= '        $(".btn-export-pdf").attr("disabled", "disabled");    ';
            $html .= '    });';
        }

        $html .= '</script>';

        echo $html;
    }

}