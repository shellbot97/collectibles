function give_andoid_application_response_without_terminating($status='0', $message='', $payload=array())
	{

		ignore_user_abort(true);
        set_time_limit(0);
        //Buffer all upcoming output...
		ob_start();
		
		if (!empty($payload)) {
			
			echo json_encode(array("status" => $status, "message" => $message, "data" => $payload), JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array("status" => $status, "message" => $message), JSON_PRETTY_PRINT);
		}

		//Get the size of the output.
		$size = ob_get_length();
		//Set content type Of the response
        header('Content-Type: application/json');
        //Disable compression (in case content length is compressed).
        header("Content-Encoding: none");
        //Set the content length of the response.
        header("Content-Length: {$size}");
        //Close the connection.
        header("Connection: close");
        //Flush all output.
        ob_end_flush();
        ob_flush();
        flush();
	}
