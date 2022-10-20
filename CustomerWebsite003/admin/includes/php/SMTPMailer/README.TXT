(E)SMTP Mailer for PHP
----------------------------

MTA(Mail Transfer Agent) Simulator class written in PHP for your PHP application.
SMTP Mailer for PHP compliance with RFC822.

Copyright (C) 2006  S.H.Mohanjith <moha@mohanjith.net>


Contents
-----------

1. Requirements
2. How to use
3. Contacting
4. Donations


1. Requirements
    -----------------

SMTPMailer class requires PHP5 or higher.


2. How to use
    ---------------

Simply include SMTPMailer.php in your PHP script and make an instance of SMTPMailer class and use it.

e.g. 	
      <?php
	require_once 'SMTPMailer.php';

	$from = "Foo <foo@example.com>";
	$to = array("Foo1 <foo1@example.com>", "Foo2 <foo2@example.com>");
	$subject = "LGPL";
	$message = "Hi All,\n Just testing.\n Cheers";

	$mailer = new SMTPMailer();

	$response = $mailer->sendMail($from, $to, $subject, $message);

	if ($response) {
		echo "Success\n";
	} else {
		echo "Failure\n";
	}
     ?>

Example assumes SMTPMailer.php is in same folder as the script.

Please make sure to have all PHP files (*.php) are in one folder because there are cross references between these files.


3. Contacting
    --------------

If you have any problem please feel free to contact me on moha@mohanjith.net (moha_at_mohanjith_dot_net). Make sure you hav e SMTP Mailer query on the Subject line.

4. Donations
    -------------

Donations are greatly appreciated. Contact me on how to make donations. 

