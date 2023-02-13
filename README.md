# zendesk-api-ticket-script


Change ZDURL, ZDUSER and ZDAPIKEY

The default json object layout for a ticket is:

		$create = json_encode(
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
