<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

  public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} prod_web");
        $I->seeInShellOutput("true");
    }

    public function checkSupervisorInstallation(UnitTester $I){
        $I->wantTo("verify supervisor is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep supervisor");
        $I->seeInShellOutput('supervisor-3.1.3');
    }

//    public function checkSupervisorServiceIsRunning(UnitTester $I){
//        $I->wantTo("verify supervisor is up and running in the container");
//        $I->runShellCommand("docker exec prod_web service supervisord status");
//        $I->seeInShellOutput('active (running)');
//    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web httpd -v");
        $I->seeInShellOutput('Server version: Apache/2.4.6');
    }

    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        //$I->runShellCommand("ping -c 10 localhost");
        $I->runShellCommand("docker exec prod_web service httpd status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep cron");
        $I->seeInShellOutput('cronie-1.4.11');
    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web service crond status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMemcachedInstallation(UnitTester $I){
        $I->wantTo("verify memcache is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep memcached");
        $I->seeInShellOutput('memcached-1.4.15');
    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify memcache is up and running in the container");
        $I->runShellCommand("docker exec prod_web service memcached status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep mariadb");
        $I->seeInShellOutput('mariadb-5.5.52');
    }

     public function checkOracleClientInstallation(UnitTester $I){
            $I->wantTo("verify oralce client is installed in the container");
            $I->runShellCommand("docker exec prod_web sqlplus -v");
            $I->seeInShellOutput('SQL*Plus: Release 11.2.0.2.0 Production');
     }

    public function checkLibreOfficeInstallation(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec prod_web libreoffice --version");
        $I->seeInShellOutput('LibreOffice 5.0.6.2 00');
    }


  public function checkPopplerUtilInstallation(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep poppler-util");
        $I->seeInShellOutput('poppler-util');
  }

  public function checkLibSSLInstallation(UnitTester $I){
          $I->wantTo("verify openssl is installed in the container");
          $I->runShellCommand("docker exec prod_web rpm -qa | grep ssl");
          $I->seeInShellOutput('openssl');
  }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2 is installed in the container");
            $I->runShellCommand("docker exec prod_web rpm -qa | grep libssh2");
            $I->seeInShellOutput('libssh2');
    }

    public function checkZipInstallation(UnitTester $I){
        $I->wantTo("verify zip library is installed in the container");
        $I->runShellCommand("docker exec prod_web zip -v");
        $I->seeInShellOutput('Zip 3');
    }

    public function checkUnzipIsInstallation(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec prod_web unzip -v");
        $I->seeInShellOutput('UnZip 6');
    }


    public function checkCurlInstallation(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec prod_web curl --version");
        $I->seeInShellOutput('curl 7.29.0');
    }

    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 5.6 is installed in the container");
        $I->runShellCommand("docker exec prod_web php --version");
        $I->seeInShellOutput('PHP 5.6');
    }


    public function checkPHPModules(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec prod_web php -m");
            $I->seeInShellOutput('bcmath');
            $I->seeInShellOutput('calendar');
            $I->seeInShellOutput('Core');
            $I->seeInShellOutput('ctype');
            $I->seeInShellOutput('curl');
            $I->seeInShellOutput('date');
            $I->seeInShellOutput('dom');
            $I->seeInShellOutput('ereg');
            $I->seeInShellOutput('exif');
            $I->seeInShellOutput('fileinfo');
            $I->seeInShellOutput('filter');
            $I->seeInShellOutput('gd');
            $I->seeInShellOutput('gettext');
            $I->seeInShellOutput('hash');
            $I->seeInShellOutput('iconv');
            $I->seeInShellOutput('json');
            $I->seeInShellOutput('ldap');
            $I->seeInShellOutput('libxml');
            $I->seeInShellOutput('mbstring');
            $I->seeInShellOutput('mcrypt');
            $I->seeInShellOutput('memcache');
            $I->seeInShellOutput('mysql');
            $I->seeInShellOutput('mysqli');
           // $I->seeInShellOutput('mysqlnd');
            $I->seeInShellOutput('PDO');
            $I->seeInShellOutput('pdo_mysql');
            $I->seeInShellOutput('pdo_sqlite');
            $I->seeInShellOutput('Phar');
            $I->seeInShellOutput('posix');
            $I->seeInShellOutput('readline');
            $I->seeInShellOutput('Reflection');
            $I->seeInShellOutput('session');
            $I->seeInShellOutput('SimpleXML');
            $I->seeInShellOutput('ssh2');
            //$I->seeInShellOutput('stats');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
