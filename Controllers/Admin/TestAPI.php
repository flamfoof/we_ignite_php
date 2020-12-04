<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class TestAPI extends AdminController {

	public function __construct(){
	}

	public function login() {
		$headers = [
			'Content-Type: application/json',
		    'Authorization: Basic '. base64_encode("project_secretkey:Z4d2Vvcg9bCRafwFhr31H")
		];
		$payload = [

		];
		$ch = curl_init(base_url("api/project/1/login"));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		print_r ($result);
	}

	public function access(){
		$headers = [
			'Content-Type: application/json',
		    'Authorization: Basic '. base64_encode("project_accesstoken:1PhfvbdR7A8BUkEiHqcM6")
		];

		$fichas = [
			[
				"access_email" => "pepito@gmail.com",
				"access_date" => "2020-10-20",
				"access_horainicio" => "10:55:00",
				"access_horafin" => "11:00:00"
			], [
				"access_email" => "david@gmail.com",
				"access_date" => "2020-10-20",
				"access_horainicio" => "10:00:00",
				"access_horafin" => "10:50:35"
			], [
				"access_email" => "sara@gmail.com",
				"access_date" => "2020-10-20",
				"access_horainicio" => "10:10:00",
				"access_horafin" => "11:50:35"
			], [
				"access_email" => "gabriel@gmail.com",
				"access_date" => "2020-10-20",
				"access_horainicio" => "11:10:00",
				"access_horafin" => "11:20:35"
			], [
				"access_email" => "pepito@gmail.com",
				"access_date" => "2020-10-20",
				"access_horainicio" => "11:10:00",
				"access_horafin" => "11:30:35"
			], [
				"access_email" => "pepito@gmail.com",
				"access_date" => "2020-10-19",
				"access_horainicio" => "11:10:00",
				"access_horafin" => "11:30:35"
			], [
				"access_email" => "pepito@gmail.com",
				"access_date" => "2020-10-19",
				"access_horainicio" => "10:10:00",
				"access_horafin" => "11:30:35"
			],
		];
		foreach ($fichas as $payload) {
			$ch = curl_init(base_url("api/project/1/access"));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			print_r ($result);
		}

	}

	public function action(){
		$headers = [
			'Content-Type: application/json',
		    'Authorization: Basic '. base64_encode("project_accesstoken:1PhfvbdR7A8BUkEiHqcM6")
		];

		$fichas = [
			[
				"action_email" => "pepito@gmail.com",
				"action_type" => "video_click",
				"action_data" => "video1.mp4",
				"action_date" => "2020-10-17 10:16:00"
			], [
				"action_email" => "david@gmail.com",
				"action_type" => "video_click",
				"action_data" => "video2.mp4",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "sara@gmail.com",
				"action_type" => "video_click",
				"action_data" => "video1.mp4",
				"action_date" => "2020-10-17 10:30:00"
			], [
				"action_email" => "david@gmail.com",
				"action_type" => "link_click",
				"action_data" => "https://google.com",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "sara@gmail.com",
				"action_type" => "link_click",
				"action_data" => "https://google.com",
				"action_date" => "2020-10-17 11:00:00"
			], [
				"action_email" => "pepito@gmail.com",
				"action_type" => "link_click",
				"action_data" => "https://facebook.com",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "pepito@gmail.com",
				"action_type" => "emoji",
				"action_data" => "smile",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "pepito@gmail.com",
				"action_type" => "emoji",
				"action_data" => "love",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "pepito@gmail.com",
				"action_type" => "emoji",
				"action_data" => "hand rise",
				"action_date" => "2020-10-17 10:00:00"
			], [
				"action_email" => "pepito@gmail.com",
				"action_type" => "emoji",
				"action_data" => "money",
				"action_date" => "2020-10-17 10:00:00"
			]
		];
		foreach ($fichas as $key => $payload) {
			$ch = curl_init(base_url("api/project/1/action"));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			print_r ($result);
		}

	}

	public function login_user($project_id){
		echo "Login user <br>";
		$headers = [
			'Content-Type: application/json',
		    'Authorization: Basic '. base64_encode("project_accesstoken:1PhfvbdR7A8BUkEiHqcM6")
		];

		$payload = [
			"user_email" => "davidroura@gmail.com",
			"user_password" => base64_encode('7/rv2\'[u6R8Cf"Y[#!6J'),
		];

		$url = base_url("api/project/$project_id/login/user");
		echo "$url <br>";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		print_r ($result);
	}
}
