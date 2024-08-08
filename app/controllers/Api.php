<?php

class Api extends Controller
{
	private $API_token = "a6dec8374db13fe2c2b263aeb66370ef";

	public function __construct()
    {
		if ($_GET['token'] == $this->API_token) {
        	ini_set('display_errors', 0);
			header('Access-Control-Allow-Origin: *');
			header('Content-Type: application/json');
		} else {
			redirectTo('/http/forbidden', 403);
		}
	}

	public function index()
	{
		redirectTo('/http/forbidden', 403);
	}

	public function test()
	{
		// example link : "http://sposerp.test/api/test&token=a6dec8374db13fe2c2b263aeb66370ef"
		returnJson(['success' => true]);
	}
}
