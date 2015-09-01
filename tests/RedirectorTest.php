<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 01/09/15
 * Time: 13:15
 */

namespace YPRedirector;


class RedirectorTest extends \PHPUnit_Framework_TestCase {

	public function testRequireNoWwwWhenNoRedirect(){
		$envMock = $this->getMockBuilder('\YPRedirector\Environment')->disableOriginalConstructor()->getMock();
		$envMock->method('getHost')
			->willReturn('somehost.com');
		$envMock->expects($this->never())->method('setHeader');
		$envMock->expects($this->never())->method('finishOutput');

		$redirector = new Redirector($envMock);
		$redirector->requireNoWww();

	}

	public function testRequireNoWwwWithRedirect(){
		$envMock = $this->getMockBuilder('\YPRedirector\Environment')->disableOriginalConstructor()->getMock();
		$envMock->method('getHost')->willReturn('www.somehost.com');
		$envMock->expects($this->exactly(2))->method('setHeader');
		$envMock->expects($this->at(3))->method('setHeader')->with('Location: http://somehost.com');
		$envMock->expects($this->once())->method('finishOutput');

		$redirector = new Redirector($envMock);
		$redirector->requireNoWww();
	}
	
}
