<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Job extends CI_Controller {

	public function index(){
		$users = $this->Gmodel->get_query("tbl_users","status = 1");
		foreach ($users as $users_key => $users_value) {
			$data = array();
			$user_id = $users_value->id;
			$user_email = $users_value->email_address;
			$user_name = $users_value->first_name . " " . $users_value->last_name;

			$query = 'SELECT
				tbl_programs.`name` AS program_name,
				tbl_program_events.title AS event_name,
				tbl_program_event_task.task AS task,
				tbl_program_event_task.id AS task_id,
				tbl_program_event_task.required_volunteers AS required_volunteers,
				COUNT(tbl_program_event_task_volunteers.id) as joined_volunteers
				FROM
				tbl_program_event_task
				INNER JOIN tbl_program_events ON tbl_program_event_task.event_id = tbl_program_events.id
				INNER JOIN tbl_programs ON tbl_program_events.program_id = tbl_programs.id
				LEFT JOIN tbl_program_event_task_volunteers ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
				WHERE
				tbl_programs.created_by = '.$user_id.'
				GROUP BY tbl_program_event_task.id
				ORDER BY
				program_name ASC';
			$result = $this->db->query($query)->result();

			$data = array();
			foreach ($result as $key => $value) {

				$badge_query = 'SELECT
					GROUP_CONCAT(tbl_badges.`name`) as Badges
					FROM
					tbl_program_event_task_badge
					INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
					WHERE tbl_program_event_task_badge.event_task_id = '.$value->task_id.'
					GROUP BY tbl_program_event_task_badge.event_task_id';
				$badge_result = $this->db->query($badge_query)->result();

				$data[] = array(
					"program_name"			=> $value->program_name,
					"event_name"			=> $value->event_name,
					"task"					=> $value->task,
					"required_volunteers"	=> $value->required_volunteers,
					"joined_volunteers"		=> $value->joined_volunteers,
					"badges"				=> $badge_result[0]->Badges,
				);
			}

			$data['listing'] = $data;
			$data['user_name'] = $user_name;
			$content = $this->load->view("site/job/email", $data, true);

			$email_data = array(
				'from' 		=> "alagangunilab@unilab.com.ph",
				'from_name' => "Alagang UNILAB",
				'to' 		=> $user_email,
				'subject' 	=> "VOLUNTEER LIST",
				'content' 	=> $content,
			);

			$email_status = $this->sndgrd->send($email_data);

			echo $email_status;

		}

	}

	public function download(){
		$user_id = $this->input->get("user_id");
		$date_requested = date("Y-m-d H:i:s", strtotime($this->input->get("date_requested")));

		$query = 'SELECT
			tbl_programs.`name` AS program_name,
			tbl_program_events.title AS event_name,
			tbl_program_event_task.task AS task,
			tbl_program_event_task.id AS task_id,
			tbl_program_event_task.required_volunteers AS required_volunteers,
			COUNT(tbl_program_event_task_volunteers.id) as joined_volunteers
			FROM
			tbl_program_event_task
			INNER JOIN tbl_program_events ON tbl_program_event_task.event_id = tbl_program_events.id
			INNER JOIN tbl_programs ON tbl_program_events.program_id = tbl_programs.id
			LEFT JOIN tbl_program_event_task_volunteers ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
			WHERE
			tbl_programs.created_by = '.$user_id.' 
			AND  tbl_program_event_task_volunteers.date_volunteer <= "'.$date_requested.'"
			GROUP BY tbl_program_event_task.id
			ORDER BY
			program_name ASC';
		$result = $this->db->query($query)->result();

		$data = array();
		foreach ($result as $key => $value) {

			$badge_query = 'SELECT
				GROUP_CONCAT(tbl_badges.`name`) as Badges
				FROM
				tbl_program_event_task_badge
				INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
				WHERE tbl_program_event_task_badge.event_task_id = '.$value->task_id.'
				GROUP BY tbl_program_event_task_badge.event_task_id';
			$badge_result = $this->db->query($badge_query)->result();

			$data[] = array(
				"program_name"			=> $value->program_name,
				"event_name"			=> $value->event_name,
				"task"					=> $value->task,
				"required_volunteers"	=> $value->required_volunteers,
				"joined_volunteers"		=> $value->joined_volunteers,
				"badges"				=> $badge_result[0]->Badges,
			);
		}
	}

	public function index_2()
	{
	
		$users = $this->Gmodel->get_query("tbl_users","status = 1");
		foreach ($users as $users_key => $users_value) {
			$data = array();
			$user_id = $users_value->id;
			$user_email = $users_value->email_address;
			$user_name = $users_value->first_name . " " . $users_value->last_name;

			$programs = $this->Gmodel->get_query("tbl_programs","created_by = " . $user_id . " AND status = 1");

			foreach ($programs as $program_key => $program_value) {
				$program_id = $program_value->id;
				$program_name = $program_value->name;



				$events = $this->Gmodel->get_query("tbl_program_events","program_id = " . $program_id . " AND status = 1 AND when >= '" . date("Y-m-d") . "'");

				$event_data = array();
				if(count($events) > 0){
					foreach ($events as $events_key => $events_value) {

						$event_data[] = array(
							"ProgramName" 	=> $program_name,
							"EventId" 		=> $events_value->id,
							"EventTitle" 	=> $events_value->title,
							"EventDate" 	=> date("F d, Y h:i a",strtotime($events_value->when)),
							"DownloadLink" 	=> base_url("job/download") . "/?programeventid=" . $events_value->id . "&date_requested=" . date("Y-m-d H:i:s")
						);
					}
					$data[] = array(
						"ProgramName"	=> $program_name,
						"Events"		=> $event_data
					);
				}

				
			}

			if(@$data[0]){
				if(count($data[0]["Events"]) > 0){
					$data['program_list'] = $data;
					$data['user_name'] = $user_name;

					$content = "";
					$content = $this->load->view("site/job/email", $data, true);
					// echo $email_body;
					print_r($content);
					// $email_data = array(
					// 	'from' 		=> "alagangunilab@unilab.com.ph",
					// 	'from_name' => "Alagang UNILAB",
					// 	'to' 		=> $user_email,
					// 	'subject' 	=> "VOLUNTEER LIST",
					// 	'content' 	=> $content,
					// );

					// $email_status = $this->sndgrd->send($email_data);

					// $logs = array(
					// 	"user_id"		=> $user_id,
					// 	"email_address"	=> $user_email,
					// 	"status"		=> $email_status,
					// 	"date"			=> date("Y-m-d H:i:s")
					// );
					// $this->Gmodel->save_data("tbl_email_job_logs", $logs);
				}
			}

			
		}

		
	}

	public function download_x(){
		$event_id = $this->input->get("programeventid");
		$date_requested = date("Y-m-d H:i:s", strtotime($this->input->get("date_requested")));
		$event_details = $this->Gmodel->get_query("tbl_program_events","id = " . $event_id);
		$program_details = $this->Gmodel->get_query("tbl_programs","id = " . $event_details[0]->program_id );


		$this->load->library("Excel");
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$worksheet = $objPHPExcel->getActiveSheet();


		$worksheet->SetCellValueByColumnAndRow(0, 1, "Program : " . $program_details[0]->name);
		$worksheet->SetCellValueByColumnAndRow(0, 2, "Event : " . $event_details[0]->title);
		$worksheet->SetCellValueByColumnAndRow(0, 3, "Date : " . date("F d, Y h:i a", strtotime($event_details[0]->when)));

		$worksheet->SetCellValueByColumnAndRow(0, 5, "Data as of : " . date("F d, Y h:i a", strtotime($date_requested)));

		$worksheet->SetCellValueByColumnAndRow(0, 7, "#");
		$worksheet->SetCellValueByColumnAndRow(1, 7, "Name");
		$worksheet->SetCellValueByColumnAndRow(2, 7, "Email");
		$worksheet->SetCellValueByColumnAndRow(3, 7, "Task");
		$worksheet->SetCellValueByColumnAndRow(4, 7, "Status");
		$worksheet->SetCellValueByColumnAndRow(5, 7, "Badge");
		$worksheet->SetCellValueByColumnAndRow(6, 7, "Sign up");

		$style_head = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	            'wrap' => true
	        ),
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => '0096b7')
	        ),
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
	        ),
	        'font'  => array(
		        'bold'  => true
		    )
	    );
		$style_body = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
	        )
	    );
		$style_body_index = array(
			'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	            'wrap' => true
	        ),
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN,
	                'color' => array('rgb' => '000000')
	            )
	        )
	    );
	    $worksheet->getCellByColumnAndRow(0,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(1,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(2,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(3,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(4,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(5,7)->getStyle()->applyFromArray($style_head);
	    $worksheet->getCellByColumnAndRow(6,7)->getStyle()->applyFromArray($style_head);



		$query = "SELECT
			CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) AS `Name`,
			tbl_users.email_address,
			tbl_program_event_task.task,
			tbl_program_event_task.id as task_id,
			tbl_program_event_task_volunteers.date_volunteer,
			tbl_program_event_task_volunteers.`status`
			FROM
			tbl_program_event_task_volunteers
			INNER JOIN tbl_program_event_task ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
			INNER JOIN tbl_users ON tbl_program_event_task_volunteers.user_id = tbl_users.id
			INNER JOIN tbl_program_event_task_badge ON tbl_program_event_task.id = tbl_program_event_task_badge.event_task_id
			WHERE tbl_program_event_task_volunteers.event_id = ".$event_id." 
			AND tbl_program_event_task_volunteers.date_volunteer <= '" . $date_requested . "'
			AND tbl_program_event_task_volunteers.status > -3
			GROUP BY tbl_users.id
			ORDER BY tbl_program_event_task_volunteers.date_volunteer ASC
			";
		$result = $this->db->query($query)->result();
		$data = array();
		foreach ($result as $key => $value) {

			$badge_query = 'SELECT
				GROUP_CONCAT(tbl_badges.`name`) as Badges
				FROM
				tbl_program_event_task_badge
				INNER JOIN tbl_badges ON tbl_program_event_task_badge.badge_id = tbl_badges.id
				WHERE tbl_program_event_task_badge.event_task_id = '.$value->task_id.'
				GROUP BY tbl_program_event_task_badge.event_task_id';
			$badge_result = $this->db->query($badge_query)->result();

			$data[] = array(
				"status"			=> $value->status,
				"Name"				=> $value->Name,
				"email_address"		=> $value->email_address,
				"task"				=> $value->task,
				"date_volunteer"	=> $value->date_volunteer,
				"badges"			=> $badge_result[0]->Badges,
			);
		}
		$row = 8;
		if(count($data) > 0){
			foreach ($data as $key => $value) {
				
				switch ($value['status']) {
					case 0:
						$status = "For Approval";
						break;
					case 1:
						$status = "Qualified";
						break;
					case -2:
						$status = "Not Qualified";
						break;
				}

				$worksheet->SetCellValueByColumnAndRow(0, $row, $key + 1);
				$worksheet->SetCellValueByColumnAndRow(1, $row, $value['Name']);
				$worksheet->SetCellValueByColumnAndRow(2, $row, $value['email_address']);
				$worksheet->SetCellValueByColumnAndRow(3, $row, $value['task']);
				$worksheet->SetCellValueByColumnAndRow(4, $row, $status);
				$worksheet->SetCellValueByColumnAndRow(5, $row, $value['badges']);
				$worksheet->SetCellValueByColumnAndRow(6, $row, $value['date_volunteer']);

				$worksheet->getCellByColumnAndRow(0,$row)->getStyle()->applyFromArray($style_body_index);
				$worksheet->getCellByColumnAndRow(1,$row)->getStyle()->applyFromArray($style_body);
				$worksheet->getCellByColumnAndRow(2,$row)->getStyle()->applyFromArray($style_body);
				$worksheet->getCellByColumnAndRow(3,$row)->getStyle()->applyFromArray($style_body);
				$worksheet->getCellByColumnAndRow(4,$row)->getStyle()->applyFromArray($style_body);
				$worksheet->getCellByColumnAndRow(5,$row)->getStyle()->applyFromArray($style_body);
				$worksheet->getCellByColumnAndRow(6,$row)->getStyle()->applyFromArray($style_body);
				$row++;
			}
		} else {
			$worksheet->SetCellValueByColumnAndRow(0, 8, "No Record found.");
		}


		$worksheet->getColumnDimension('A')->setWidth(5);
		$worksheet->getColumnDimension('B')->setWidth(37);
		$worksheet->getColumnDimension('C')->setWidth(37);
		$worksheet->getColumnDimension('D')->setWidth(37);
		$worksheet->getColumnDimension('E')->setWidth(20);
		$worksheet->getColumnDimension('F')->setWidth(20);
		$worksheet->getColumnDimension('G')->setWidth(20);


	

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.strtoupper($event_details[0]->title) . ' ' . date("F-d-Y h-i-a", strtotime($date_requested)) .' .xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate'); 
		header ('Pragma: public'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();
		$objWriter->save('php://output');


	}

	public function test_email(){
		$email_data = array(
			'from' 		=> "alagangunilab@unilab.com.ph",
			'from_name' => "Alagang UNILAB",
			'to' 		=> "c_prvillanueva@unilab.com.ph",
			'subject' 	=> "VOLUNTEER LIST - TEST EMAIL",
			'content' 	=> "TEST EMAIL",
		);

		print_r($email_data);
		echo $this->sndgrd->send($email_data);
	}

}
