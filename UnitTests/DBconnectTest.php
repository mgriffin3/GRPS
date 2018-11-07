<?php
/* How to use this unit test:
1. get phpunit from the internet
2. run GSRTB php in a localhost servername
3. move this file into the directery you plan on running the server from
4. open console and type: " phpunit DBconnectTest.php"

This should generate at least 1 error and 1 failure 
todo: add sql database extension to make database testing easier

*/
use PHPUnit\framework\TestCase;
require 'index.php';
class ConnectTest extends TestCase
{
	
	public function testConnect()
    {
        $servername = "localhost";
		$username = "root";
		$password = "root_123";
		$dbname = "scraper";
		
		
		//this is expected to be susscessful
		$this->assertInstanceOf(mysqli::class,connectDB($servername,$username, $password, $dbname));
		
		//every time DBconnect is called it generates a new mysqli class and new connection so even if we call the same paramaters should generate two different objects
		$this->assertNotSame(connectDB($servername,$username, $password, $dbname),connectDB($servername,$username, $password, $dbname));
		
		
		//this is an obviously fail left it to check if phpunit has been installed correctly and catches failures
		$this->assertNotInstanceOf(mysqli::class,connectDB($servername,$username, $password, $dbname));
    }
	
	public function testError()
	{
		$servername = "localhost";
		$username = "root";
		$password = "root_123";
		$dbname = "scraper";
		
		//should return unkown database error
		$this->assertInstanceOf(mysqli::class, connectDB($servername,$username, $password, "none"));
		
		//should return deny access error
		$this->assertInstanceOf(mysqli::class, connectDB($servername,$username, "RoOt_123", $dbname));
		
	}
	
}
?>