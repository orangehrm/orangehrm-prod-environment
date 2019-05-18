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
        $I->runShellCommand("docker inspect -f {{.State.Running}} prod_web_72");
        $I->seeInShellOutput("true");
    }

    public function checkApacheServiceIsRunning(UnitTester $I){
        sleep(3);
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec prod_web_72 service httpd status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 httpd -v");
        $I->seeInShellOutput('Server version: Apache/2.4');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 yum list installed | grep cron");
        $I->seeInShellOutput('crontabs');
    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web_72 service crond status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 mysql --version");
        $I->seeInShellOutput('-MariaDB');
    }

    public function checkLibreOfficeInstallation(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 libreoffice --version");
        $I->seeInShellOutput('LibreOffice 5.3');
    }

  public function checkPopplerUtilInstallation(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 yum list installed | grep poppler-util");
        $I->seeInShellOutput('poppler-utils');
  }

  public function checkLibSSLInstallation(UnitTester $I){
          $I->wantTo("verify libssl is installed in the container");
          $I->runShellCommand("docker exec prod_web_72 ldconfig -p | grep libssl");
          $I->seeInShellOutput('libssl');
  }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2-1 is installed in the container");
            $I->runShellCommand("docker exec prod_web_72  yum list installed | grep libssh2");
            $I->seeInShellOutput('libssh2');
    }

    public function checkZipInstallation(UnitTester $I){
        $I->wantTo("verify zip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 zip -v");
        $I->seeInShellOutput('Zip 3');
    }

    public function checkUnzipIsInstallation(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 unzip -v");
        $I->seeInShellOutput('UnZip 6');
    }


    public function checkCurlInstallation(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 curl --version");
        $I->seeInShellOutput('curl 7.29');
    }

    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.2 is installed in the container");
        $I->runShellCommand("docker exec prod_web_72 php --version");
        $I->seeInShellOutput('PHP 7.2');
    }


    public function checkPHPModules(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec prod_web_72 php -m");
            $I->seeInShellOutput('apcu');
            $I->seeInShellOutput('bz2');
            $I->seeInShellOutput('bcmath');
            $I->seeInShellOutput('calendar');
            $I->seeInShellOutput('Core');
            $I->seeInShellOutput('ctype');
            $I->seeInShellOutput('curl');
            $I->seeInShellOutput('date');
            $I->seeInShellOutput('dom');
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
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
