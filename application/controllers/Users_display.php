<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_display extends CI_Controller {

	public function index()
	{
		$query = "SELECT tbl_users.*, tbl_division.name as division_name FROM tbl_users LEFT JOIN tbl_division ON tbl_division.id = tbl_users.division";
		$result = $this->db->query($query)->result();

		$this->load->view("site/layout/header");
		echo "<div class='container'>";
		echo "	<table class='table tabl-bordered'>";
		foreach ($result as $key => $value) {
			echo "<tr>";
			echo "	<td style='width: 100px;'><img src='" . $value->imagepath . "' style='width: 100px;' /></td>";
			echo "	<td>";
			echo "ID : " . $value->id . "<br />";
			echo $value->first_name . " " . $value->last_name . "<br />";
			echo $value->email_address . "<br />";
			echo $value->division_name . "<br />";
			echo "</td>";
			echo "</tr>";
		}
		echo "	</table>";
		echo "</div>";
	}
   
}
