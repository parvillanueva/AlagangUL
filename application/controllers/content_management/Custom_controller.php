<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_controller extends CI_Controller {

	public function index()
	{

	}

	public function get_list_data_query_csv() 
	{	
	      set_time_limit(30); 
	      date_default_timezone_set('Asia/Manila');
	      $prefix  = $_GET['prefix'];
	      $alphabet = range('A', 'Z'); 
          $table = $_GET['table'];
          $select = $_GET['select'];
          $string_arr = $_GET['custom_th'];
          $custom_th = [];

          $cth_counter = 0;
		 foreach( explode( ',', $string_arr ) as $v )
		 {
		 	$custom_th[ $cth_counter ] = $v;
		 	$cth_counter++;
		 }

          $query = $_GET['query'];
          $selected = explode( "," , $select);      
	      $counter = count($selected);
		  $cell_header = $alphabet[$counter-1];
 		  $date = date('Y-m-d');
		  $filename = $_GET['filename'];
		  $result = $this->Custom_model->get_data_excel($table,$select,$counter,$query);

		  $this->load->library("PHPExcel/Classes/PHPExcel.php");
		  $obj = new PHPExcel();
		  $obj->getProperties()->setCreator($this->session->userdata('sess_email'));
		  $y = 'A';

		  $db_fields = $this->db->list_fields($table);
		  $field_label = "";
		  foreach ($db_fields as $key => $val) {
		  	foreach ($selected as $skey => $sval) {
	  			if ($val == $sval) {
	  				foreach ($custom_th as $ckey => $cval) {
						if ($key == $ckey) {
							$field_label = $cval;
							$obj->setActiveSheetIndex(0)
							->setCellValue($y.'1', $field_label);
					 		$y++;
						}
			  		}
	  			}
		  	}
		  }

		  $z = 2;
		  $id_counter = 1;
	      foreach ($result as $key => $value) {
			$y = 'A';
			for($x = 0; $x < $counter; $x++) {
				if ($selected[$x] == "id") {
					$value->{$selected[$x]} = $id_counter++;
				}

				if ($selected[$x] == "gender") {
					if ($value->{$selected[$x]} == 1) {
						$value->{$selected[$x]} = "Male";
					} else {
						$value->{$selected[$x]} = "Female";
					}
				}

				if ($selected[$x] == "birthdate" || $selected[$x] == "birthday" || $selected[$x] == "dob") {
					$value->{$selected[$x]} =  date("F j, Y", strtotime($value->{$selected[$x]}));
				}

				if ($selected[$x] == "status") {
					if ($value->{$selected[$x]} == 1) {
						$value->{$selected[$x]} = "Active";
					} else {
						$value->{$selected[$x]} = "Inactive";
					}
				}

				if ($selected[$x] == "create_date" || $selected[$x] == "update_date" || $selected[$x] == "date_created" || $selected[$x] == "date_updated" || $selected[$x] == "created_at" || $selected[$x] == "updated_at") {
					$value->{$selected[$x]} =  date("F j, Y g:i:s A", strtotime($value->{$selected[$x]}));
				}

				$obj->setActiveSheetIndex(0)
			          ->setCellValue($y.$z,$value->{$selected[$x]});
				$y++;
			}
			$z++;
		 }

	     $header_style = array(
	    'font'  => array(
	        'color' => array('rgb' => 'FFFFFF'),
	    ));
	      $obj->getActiveSheet(0)->getColumnDimension('A')->setWidth(20);      
	      $obj->getActiveSheet(0)->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	      $obj->getActiveSheet(0)->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('5a5a5a');
	      $obj->getActiveSheet(0)->getStyle('A1')->applyFromArray($header_style);
	      foreach ( range("A",$cell_header) as $value) {
	        $obj->getActiveSheet(0)->getColumnDimension($value)->setAutoSize(true);  
	        $obj->getActiveSheet(0)->getStyle($value."1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $obj->getActiveSheet()->getStyle($value.'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('5a5a5a');
	        $obj->getActiveSheet(0)->getStyle($value."1")->applyFromArray($header_style);
	        $obj->getActiveSheet(0)->getStyle($value."1")->getAlignment()->setWrapText(true);
	      }
	      $obj->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	      $obj->getActiveSheet()->getStyle("A1:M1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	      $obj->getActiveSheet()->getStyle("A1:M1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	      $obj->getActiveSheet()->setTitle($filename);
	      $obj->setActiveSheetIndex(0);
			// // We'll be outputting an excel file
	      $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
		  header('Content-type: application/vnd.ms-excel');
		  header('Content-Disposition: attachment;filename="'.$filename.'"');
		  header('Cache-Control: max-age = 0');
		  ob_end_clean();
		  // ob_get_contents();
		  $objWriter->save('php://output');

	      exit();
	}

}
