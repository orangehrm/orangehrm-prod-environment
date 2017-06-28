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
        $I->runShellCommand("docker exec prod_web apt list --installed | grep supervisor");
        $I->seeInShellOutput('supervisor/now 3.0');
    }

    public function checkSupervisorServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec prod_web service supervisor status");
        $I->seeInShellOutput('supervisord is running');
    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web apache2 -v");
        $I->seeInShellOutput('Server version: Apache/2.4.10');
    }

    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("ping -c 10 localhost");
        $I->runShellCommand("docker exec prod_web service apache2 status");
        $I->seeInShellOutput('apache2 is running');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web apt list --installed | grep cron");
        $I->seeInShellOutput('cron/now 3.0');
    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web service cron status");
        $I->seeInShellOutput('cron is running');
    }

    public function checkMemcachedInstallation(UnitTester $I){
        $I->wantTo("verify memcache is installed in the container");
        $I->runShellCommand("docker exec prod_web apt list --installed | grep memcached");
        $I->seeInShellOutput('memcached/now 1.4.21');
    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify memcache is up and running in the container");
        $I->runShellCommand("docker exec prod_web ps aux | grep memcached");
        $I->seeInShellOutput('/usr/bin/memcached');
    }

  public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web apt list --installed | grep mysql-client");
        $I->seeInShellOutput('mysql-client/now 5.5');
    }

    public function checkLibreOfficeInstallation(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec prod_web libreoffice --version");
        $I->seeInShellOutput('LibreOffice 4.3.3.2');
    }


  public function checkPopplerUtilInstallation(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec prod_web apt list --installed | grep poppler-util");
        $I->seeInShellOutput('poppler-util');
  }

  public function checkLibSSLInstallation(UnitTester $I){
          $I->wantTo("verify libssl-dev is installed in the container");
          $I->runShellCommand("docker exec prod_web apt list --installed | grep libssl-dev");
          $I->seeInShellOutput('libssl-dev');
  }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2-1 is installed in the container");
            $I->runShellCommand("docker exec prod_web apt list --installed | grep libssh2-1");
            $I->seeInShellOutput('libssh2-1');
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
        $I->seeInShellOutput('curl 7.38');
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
            $I->seeInShellOutput('mysqlnd');
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
            $I->seeInShellOutput('stats');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
