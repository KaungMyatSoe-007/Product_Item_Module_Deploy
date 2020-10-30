<?php 

	/**
	 * 
	 */
	class ProductTest extends \PHPUnit\Framework\TestCase
	{
		
		public function testTrueReturnTrue(){
			$this->assertTrue(true);
		}

		public function testClearStringReturnCorrectString(){
			require_once('core/function.php');
			$this->assertEquals('abc', clean_input('    abc'));
			$this->assertEquals('abc', clean_input('    <p><b>abc<b></p>'));
			$this->assertEquals("mg mg's", clean_input("    mg mg's    "));
		}


	}

 ?>