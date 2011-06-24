<?php 
	/*
	 * Import the SOAP library
	 * SourceForge SOAP Toolkit for PHP http://sourceforge.net/projects/nusoap/
	 */ 
	require_once("nusoap/nusoap.php");
	
	//Get a handle to the webservice 
	$wsdl = new nusoap_client('https://agrilifepeople.tamu.edu/applicationAPI/organizationalModule.cfc?wsdl',true); 
	$proxy = $wsdl->getProxy();
	
	
	/* 
	 * This API will not be open to the public so we will be requiring all
	 * applications to authenticate themselves with a validation key that is a
	 * Base64 MD5 hash comprised of three data points:
	 *		1. Site ID: a numeric value assigned by SDG Team for your application
	 *		2. Access Key: a secure "password" usually created by the developer 
	 *		3. The method name being called (all lower case)
	 * The hash we use is raw binary format with a length of 16 before we encode it to base64
	 * Functions below are explained on PHP Manual http://php.net/manual/en/
	 */ 
	$hash = md5('3rVj\hK{s%gB$8*pgetpersonnel',true);
	$base64 = base64_encode($hash);
	
	/*
	 * Call the webservice getPersonnel method and pass in the parameters
	 * All parameters are required to be passed in
	 * 		3 = The TECO site ID
	 * 		$base64 = The Hash we just created
	 * 		999 = AgriLife IT Unit number
	 */
	$result = $proxy->getPersonnel(3,$base64,999);
	
	// Checking for a faults
	if ($proxy->fault) {
		echo '<h2>Fault</h2><pre>';
		print_r($result);
		echo '</pre>';
	} else {
		// Check for errors
		$err = $proxy->getError();
		if ($err) {
			// Display the error
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		} else {
			// Display the result
			echo '<h2>Result</h2><pre>';
			print_r($result);
			echo '</pre>';
		}
	}
?>
