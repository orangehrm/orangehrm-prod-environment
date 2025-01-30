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
        $I->runShellCommand("docker inspect -f {{.State.Running}} prod_web_ubuntu");
        $I->seeInShellOutput("true");
    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apache2 -v");
        $I->seeInShellOutput('Server version: Apache/2.4.58');
    }
    
    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        //$I->runShellCommand("ping -c 10 localhost");
        $I->runShellCommand("docker exec prod_web_ubuntu service apache2 status");
        $I->seeInShellOutput('apache2 is running');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep cron");
        $I->seeInShellOutput('cron');

    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu service cron status");
        $I->seeInShellOutput('cron is running');
    }

    public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep mariadb-client");
        $I->seeInShellOutput('mariadb-client');

    }

    public function checkLibreOfficeInstallation(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu libreoffice --version");
        $I->seeInShellOutput('LibreOffice');
    }

    public function checkImageMagick(UnitTester $I){
        $I->wantTo("verify imagemagick is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep imagemagick");
        $I->seeInShellOutput('imagemagick');
    }

  public function checkLibSSLInstallation(UnitTester $I){
          $I->wantTo("verify openssl is installed in the container");
          $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep openssl");
          $I->seeInShellOutput('openssl');
  }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2 is installed in the container");
            $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep libssh2");
            $I->seeInShellOutput('libssh2');
    }

    public function checkZipInstallation(UnitTester $I){
        $I->wantTo("verify zip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu zip -v");
        $I->seeInShellOutput('Zip 3');
    }

    public function checkUnzipIsInstallation(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu unzip -v");
        $I->seeInShellOutput('UnZip 6');
    }


    public function checkCurlInstallation(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu curl --version");
        $I->seeInShellOutput('curl 8.5.0');
    }

    public function checkP7zipInstallation(UnitTester $I){
        $I->wantTo("verify p7zip is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apt list --installed | grep p7zip");
        $I->seeInShellOutput('p7zip');

    }

    public function checkQPDF(UnitTester $I){
        $I->wantTo("verify qpdf is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu qpdf --version");
        $I->seeInShellOutput('11.9');
    }

    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 8.3 is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu php --version");
        $I->seeInShellOutput('PHP 8.3');

    }


    public function checkPHPModules(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec prod_web_ubuntu php -m");
            $I->seeInShellOutput('apcu');
            $I->seeInShellOutput('bcmath');
            $I->seeInShellOutput('bz2');
            $I->seeInShellOutput('calendar');
            $I->seeInShellOutput('Core');
            $I->seeInShellOutput('ctype');
            $I->seeInShellOutput('curl');
            $I->seeInShellOutput('date');
            $I->seeInShellOutput('dom');
            $I->seeInShellOutput('exif');
            $I->seeInShellOutput('fileinfo');
            $I->seeInShellOutput('filter');
            $I->seeInShellOutput('ftp');
            $I->seeInShellOutput('gd');
            $I->seeInShellOutput('gettext');
            $I->seeInShellOutput('gmp');
            $I->seeInShellOutput('hash');
            $I->seeInShellOutput('iconv');
            $I->seeInShellOutput('igbinary');
            $I->seeInShellOutput('imap');
            $I->seeInShellOutput('ionCube Loader');
            $I->seeInShellOutput('json');
            $I->seeInShellOutput('ldap');
            $I->seeInShellOutput('libxml');
            $I->seeInShellOutput('mbstring');
            $I->seeInShellOutput('mcrypt');
            $I->seeInShellOutput('memcached');
            $I->seeInShellOutput('mysqli');
            $I->seeInShellOutput('mysqlnd');
            $I->seeInShellOutput('openssl');
            $I->seeInShellOutput('pcntl');
            $I->seeInShellOutput('pcre');
            $I->seeInShellOutput('PDO');
            $I->seeInShellOutput('pdo_mysql');
            $I->seeInShellOutput('pdo_sqlite');
            $I->seeInShellOutput('Phar');
            $I->seeInShellOutput('posix');
            $I->seeInShellOutput('readline');
            $I->seeInShellOutput('Reflection');
            $I->seeInShellOutput('session');
            $I->seeInShellOutput('shmop');
            $I->seeInShellOutput('SimpleXML');
            $I->seeInShellOutput('soap');
            $I->seeInShellOutput('sockets');
            $I->seeInShellOutput('SPL');
            $I->seeInShellOutput('sqlite3');
            $I->seeInShellOutput('ssh2');
            $I->seeInShellOutput('standard');
            $I->seeInShellOutput('sysvmsg');
            $I->seeInShellOutput('sysvsem');
            $I->seeInShellOutput('tokenizer');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('xmlreader');
            $I->seeInShellOutput('xmlwriter');
            $I->seeInShellOutput('xsl');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
