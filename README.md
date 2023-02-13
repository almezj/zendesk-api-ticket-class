# Zendesk API Ticket Class

## Introduction

The Zendesk API Ticket Class is a PHP class that utilizes curl to create tickets in Zendesk. It contains two functions: one that generates a JSON object that fits the Zendesk ticket layout, and a second function that sends a curl request to Zendesk and creates a ticket from the output of the first function.

## Configuration

Before using the class, make sure to change the ZDURL, ZDUSER, and ZDAPIKEY variables to match your Zendesk account information. 

## Default JSON Object Layout

The default JSON object layout for a Zendesk ticket is as follows:
```
$ticket = json_encode(
			array(
				'ticket' => array(
				'subject' => SUBJECT,
				'comment' => array(
					"body" => "Body of the ticket"
				),
				'requester' => array(
					"name" => Requester name,
					"email" => Requester email
				),
				'tags' => array(
					Tags
				),
			)
	)
);
```
