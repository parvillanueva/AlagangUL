<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Job extends CI_Controller {



	public function index()
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
							"EventId" 		=> $events_value->id,
							"EventTitle" 	=> $events_value->title,
							"EventDate" 	=> date("F d, Y h:i a",strtotime($events_value->when)),
							"DownloadLink" 	=> base_url("job/download") . "/?programeventid=" . $events_value->id
						);
					}
					$data[] = array(
						"ProgramName"	=> $program_name,
						"Events"		=> $event_data
					);
				}

				
			}

			echo "<pre>";
			if(@$data[0]){
				if(count($data[0]["Events"]) > 0){
					$data['program_list'] = $data;
					$data['user_name'] = $user_name;

					$content = $this->load->view("site/job/email", $data);
					$email_body = htmlspecialchars($content->output->final_output);
					// echo $email_body;
					// print_r($content);
					// $data = array(
					// 	'from' 		=> "phpdev.unilab@gmail.com",
					// 	'from_name' => "ALAGANG UNILAB",
					// 	'to' 		=> $to,
					// 	'subject' 	=> "VOLUNTEER LIST : " . $event_details[0]->title,
					// 	'content' 	=> $html,
					// );

					// print_r($data);
					//$this->sndgrd->send($data);
				}
			}

			
		}

		
	}

	public function download(){
		$event_id = $this->input->get("programeventid");
		$event_details = $this->Gmodel->get_query("tbl_program_events","id = " . $event_id);
		$program_details = $this->Gmodel->get_query("tbl_programs","id = " . $event_details[0]->program_id );


		$this->load->library("Excel");
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$worksheet = $objPHPExcel->getActiveSheet();


		$worksheet->SetCellValueByColumnAndRow(0, 1, "Program : " . $program_details[0]->name);
		$worksheet->SetCellValueByColumnAndRow(0, 2, "Event : " . $event_details[0]->title);
		$worksheet->SetCellValueByColumnAndRow(0, 3, "Date : " . date("F d, Y h:i a", strtotime($event_details[0]->when)));

		$worksheet->SetCellValueByColumnAndRow(0, 5, "Data as of : " . date("F d, Y h:i a"));

		$worksheet->SetCellValueByColumnAndRow(0, 7, "#");
		$worksheet->SetCellValueByColumnAndRow(1, 7, "Name");
		$worksheet->SetCellValueByColumnAndRow(2, 7, "Email");
		$worksheet->SetCellValueByColumnAndRow(3, 7, "Task");
		$worksheet->SetCellValueByColumnAndRow(4, 7, "Status");
		$worksheet->SetCellValueByColumnAndRow(5, 7, "Badge");
		$worksheet->SetCellValueByColumnAndRow(6, 7, "Sign up");


		$query = "SELECT
			CONCAT(tbl_users.first_name, ' ', tbl_users.last_name) as Name,
			tbl_users.email_address,
			tbl_program_event_task.task,
			tbl_program_event_task_volunteers.date_volunteer
			tbl_program_event_task_volunteers.status
			FROM
			tbl_program_event_task_volunteers
			INNER JOIN tbl_program_event_task ON tbl_program_event_task_volunteers.event_task_id = tbl_program_event_task.id
			INNER JOIN tbl_users ON tbl_program_event_task_volunteers.user_id = tbl_users.id
			WHERE
			tbl_program_event_task_volunteers.event_id = ". $event_id . " AND tbl_program_event_task_volunteers.status > -3 ORDER BY tbl_program_event_task_volunteers.date_volunteer DESC";
		$result = $this->db->query($query)->result();
		$row = 8;
		if(count($result) > 0){
			foreach ($result as $key => $value) {
				
				switch ($value->status) {
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
				$worksheet->SetCellValueByColumnAndRow(1, $row, $value->Name);
				$worksheet->SetCellValueByColumnAndRow(2, $row, $value->email_address);
				$worksheet->SetCellValueByColumnAndRow(3, $row, $value->task);
				$worksheet->SetCellValueByColumnAndRow(4, $row, $status);
				$worksheet->SetCellValueByColumnAndRow(5, $row, $value->date_volunteer);
				$worksheet->SetCellValueByColumnAndRow(6, $row, $value->date_volunteer);
				$row++;
			}
		} else {
			$worksheet->SetCellValueByColumnAndRow(0, 8, "No Record found.");
		}


		$worksheet->getColumnDimension('A')->setWidth(5);
		$worksheet->getColumnDimension('B')->setWidth(37);
		$worksheet->getColumnDimension('C')->setWidth(27);
		$worksheet->getColumnDimension('D')->setWidth(37);
		$worksheet->getColumnDimension('E')->setWidth(20);
		$worksheet->getColumnDimension('F')->setWidth(20);
		$worksheet->getColumnDimension('G')->setWidth(20);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.strtoupper($event_details[0]->title) . ' ' . date("F-d-Y h-i-a") .' .xlsx"');
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

}
