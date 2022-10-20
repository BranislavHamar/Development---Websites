<?php

/**
 *	(E)SMTP Mailer for PHP
 *	----------------------
 *
 *	MTA(Mail Transfer Agent) Simulator class written in PHP for your PHP application.
 *	SMTP Mailer for PHP compliance with RFC822.
 *
 *  Copyright (C) 2006  S.H.Mohanjith <moha@mohanjith.net>
 *
 *	This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License along
 *  with this program; if not, write to the Free Software Foundation, Inc.,
 *  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 *
 *	Notice
 *	-----
 *
 *	This PHP class requires PHP5 or higher.
 *
 */ 
 
 require_once 'htmlMimeMail5.php';

/**
 *	MTA(Mail Transfer Agent) Simulator class written in PHP for your PHP application.
 *	Complies with <b>RFC822</b>.
 *
 *	@author	S.H.Mohanjith <mohanjith@gmail.com>
 *	@date	2006-10-15
 *	@copyright S.H.Mohanjith (c) 2006
 *	@license GNU LGPL <http://www.gnu.org/licenses/lgpl.html>
 */
 class SMTPMailer {
 
 	// Class atributes
 	
	private $from;
  private $bcc;			
	private $recepients;	
	private $subject;	
	private $body;	
	private $recepientServer;	
	private $connection;
	private $mailer;
	
	private $type = 'smtp';
	
	/**
	 *	Class constructor
	 *
	 */	
	public function __construct() {
		$mail = new htmlMimeMail5();
		$this->setMailer($mail);
	}
	
	/**
	 *	Class districtor
	 *	resets any connections
	 *
	 */
	public function __distruct() {
		fclose($this->getConnection());
		$this->setConnection(null);
	}
	
	// Class atribute setters
	
	public function setFrom($from) {
		$this->from = $from;
	}
	
	public function setRecepients($recepient) {
		$this->recepients = $recepient;
	}	

	public function setBcc($bcc) {
		$this->bcc = $bcc;
	}	

	
	public function setSubject($subject) {
		$this->subject = $subject;
	}
	
	public function setBody($body) {
		$this->body = $body;
	}
	
	public function setAttachments($attachment) {
		$this->attachments = $attachment;
	}
	
	public function setRecepientServers($recepientServer) {		
		$this->recepientServer = $recepientServer;				
	}
	
	public function setConnection($connection) {
		$this->connection = $connection;
	}
	
	public function setMailer($mailer) {
		$this->mailer = $mailer;
	}
	
	// Class atribute getters
	
	public function getFrom() {
		return $this->from;
	}


	public function getBcc() {
		return $this->bcc;
	}
  	
	public function getRecepients() {
		return $this->recepients;
	}
	
	public function getSubject() {
		return $this->subject;
	}
	
	public function getBody() {
		return $this->body;
	}
	
	public function getAttachments() {
		return $this->attachments;
	}
	
	public function getRecepientServers() {		
		return $this->recepientServer;
	}
	
	public function getConnection() {
		return $this->connection;
	}
	
	public function getMailer() {
		return $this->mailer;
	}
	
	/**
	 *	Sends the mail to mutiple recepients.
	 *
	 *	@access public
	 *	@param	String $from, String[] $to, String $subject, String $message
	 *	@return	void
	 *	@author	S.H.Mohanjith <mohanjith@gmail.com>
	 */	
	public function sendMail($from, $to, $bcc, $subject, $message) {	
	
		set_time_limit(60);
		
		$this->setFrom($from);		
		$this->setSubject($subject);
		$this->setBody($message);
		
		//$this->_parseRecepientInfo($to);
		$this->_parseRecepientInfo($bcc);
		
		$this->_fillMailer();		
		
		return $this->_sendAll();
	}
	
	private function _sendAll() {
	
		$servers = $this->getRecepientServers();		
		
		foreach ($servers as $server => $recepients) {			
			if (!($success = $this->_sendToDomain($server, $recepients))) {
				break;
			}	
		}
		
		return $success;	
	}
	
	private function _sendToDomain($server, $recepients) {
		
		set_time_limit(60);
		
		$mailServers = $this->_checkMX($server);
			
		if (is_array($mailServers)) {
			$success = $this->_tryMailServer($mailServers, $recepients);
		} else {
			$success = $this->_transactServer($server, $recepients);
		}
				
		return $success;
	}
	
	private function _tryMailServer($mailServers, $recepients) {
	
		$success = false;
				
		foreach ($mailServers as $mailServer) {		
			$success = $this->_transactServer($mailServer, $recepients);
			
			if ($success) {
				return $success;
			}										
		}
		
		return $success;
	}
	
	private function _transactServer($server, $recepients) {
	
		set_time_limit(60);
		
		$this->getMailer()->setSMTPParams($server, 25, $this->_extractServerName($this->getFrom()));
					
		if($this->getMailer()->send($recepients, $this->type) == 1) {
			return true;
		}
			
		return false;		
	}
	
	private function _fillMailer() {
	
		$this->getMailer()->setFrom($this->getFrom());		
		$this->getMailer()->setSubject($this->getSubject());		
		$this->getMailer()->setText(strip_tags(
                                  str_replace('&nbsp;',' ',
                                                          str_replace('<br>',chr(10),$this->getBody()))
                                  ));
    
		$this->getMailer()->setHTML($this->getBody());
		
		$this->getMailer()->setPriority('normal');
		$this->getMailer()->setBcc($this->getBcc());			
	}
	
	private function _parseRecepientInfo($bcc) {
		
		$servers = null;
		
		for ($i=0; $i < count($bcc); $i++) {			
			$server = $this->_extractServerName($bcc[$i]);
			$servers[$server][] = $bcc[$i];			
		}
		
		$this->setRecepientServers($servers);		
	}
	
	
	private function _extractServerName($email) {		
		
		$subject = $this->_extractEmail($email);
		
		$pattern = "/@/";
				
		$subject = preg_split($pattern, $subject, 2);
		
		return $subject[1];					
			
	}
	
	private function _extractEmail($email) {
		$pattern = '/(^"(.)*"||^([a-zA-Z0-9]* )*||^[a-zA-Z0-9]*||<||>|| )/';
		$replace = "";
		
		$subject = $email;
		
		$subject = preg_replace($pattern, $replace, $subject);
		
		return $subject;
	}	
	
	private function _checkMX($hostName, $recType = 'MX') {
   		
		if($recType == '') 
			$recType = "MX";		
		
		if (!($arr = $this->_checkMXDefault($hostName, $recType))) {
			$arr = $this->_checkMXWindows($hostName, $recType = 'MX');
		}
			
   		return $arr; 		
	}
	
	private function _checkMXWindows($hostName, $recType = 'MX') {
	
		//exec("nslookup -type=$recType $hostName", $result);
		
		//$arr = null;
		//$count = -1;
		//$pattern = '/mail exchanger = /';
			   
   	//	foreach ($result as $line) {
     //		if(preg_match('/^'.$hostName.'\tMX /', $line) === 1) {
				
		//		$tmp = preg_split($pattern, $line);
				
		//		if (count($tmp) == 2) {
	//				$arr[] = $tmp[1];					
	//				$count++;
	//			}		
  //   		}
  // 		}
		
		return $arr;  

	}
	
	private function _checkMXDefault($hostName, $recType = 'MX') {
		
		$pattern = '/Win/';
		
		$arr = null;
		
		if (preg_match($pattern, $_SERVER['SERVER_SIGNATURE']) == 0) {
			getmxrr ($hostName, $arr);
			$this->type = "mail"; 
		}
			
		if (is_array($arr)) {
			return $arr;
		}
		
		return false;		
	}
 
 } 
?>
