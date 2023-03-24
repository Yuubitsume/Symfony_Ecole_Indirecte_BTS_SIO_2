<?php

namespace App\Tests;

use PHPUnit\Framework\Testcase;
use App\PasswordChecker;


class PasswordCheckerTest extends TestCase
{
    public function testPasswordCheck()
    {
        $deb = new PasswordChecker("Password34%");
        $result = $this->passwordCheck($deb);
        $this->assertTrue($result);
    }
}     
