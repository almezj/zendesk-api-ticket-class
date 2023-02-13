<?php

/**
 * @author Josef Žemlička
 * @copyright 2022
 */


class Ticket
{
	const ZDURL = "https://YOUR_SITE.zendesk.com/api/v2";
	const ZDUSER = "YOUR_ZENDESK_USERNAME";
	const ZDAPIKEY = "YOUR_ZENDESK_API_KEY";
	public $ch;
	public $curl;
	public $subject;
	public $description;
	public $name;
	public $email;
	public $create;
	public $json;
	public $address;
	public $error = false;
	public $error_msg;


	//Function to send the json object using curl to Zendesk API v2 and create a ticket
	function curlWrap($url, $json)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($this->ch, CURLOPT_URL, Ticket::ZDURL . $url);
		curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($this->ch, CURLOPT_USERPWD, Ticket::ZDUSER . "/token:" . Ticket::ZDAPIKEY);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($this->ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);

		// execute
		$output = curl_exec($this->ch);

		// errors?
		if (curl_errno($this->ch)) {
			$this->error = true;
			$this->error_msg = curl_error($this->ch);
		}

		// close
		curl_close($this->ch);

		// return
		$decoded = json_decode($output);
		return $decoded;

	}


	//Function to create a json object for Zendesk
	//You can change the json object to fit your needs, this is just an example
	function createJson($subject, $message, $name, $email, $phone, $tag1, $tag2)
	{
		$create = json_encode(
			array(
				'ticket' => array(
					'subject' => $subject,
					'comment' => array(
						"body" => "Name: $name \n
								   Email: $email \n
								   Phone: $phone \n
								   Subject: $subject \n 
								   Message: $message \n
					 			   "
						),
					'requester' => array(
						"name" => $name,
						"email" => $email
					),
					'tags' => array(
						$tag1,
						$tag2
					),
				)
			)
		);
		return $create;

		foreach ($_POST as $key => $value) {
			if (preg_match('/^z_/i', $key)) {
				$arr[strip_tags($key)] = strip_tags($value);
			}
		}
	}

}