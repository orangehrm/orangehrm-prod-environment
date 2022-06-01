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
        $I->wantTo("verify rhel 8 container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} prod_web_rhel");
        $I->seeInShellOutput("true");
    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel httpd -v");
        $I->seeInShellOutput('Apache/2.4.37');
    }
    
    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand(" docker exec prod_web_rhel systemctl status httpd");
        $I->seeInShellOutput('active (running)');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep cron");
        $I->seeInShellOutput('cronie-1.5.2');

    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web_rhel systemctl status crond");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMemcachedInstallation(UnitTester $I){
        $I->wantTo("verify memcache is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep memcached");
        $I->seeInShellOutput('memcached-1.5.22');

    }

    // public function checkMemcacheServiceIsRunning(UnitTester $I){
    //     $I->wantTo("verify memcache is up and running in the container");
    //     $I->runShellCommand("docker exec prod_web_rhel systemctl status memcached");
    //     $I->seeInShellOutput('active (running)');
    // }

    public function checkImageMagick(UnitTester $I){
        $I->wantTo("verify imagemagick is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel yum list installed | grep ImageMagick");
        $I->seeInShellOutput('ImageMagick');
    }

    public function checkOpensslDevelInstallation(UnitTester $I){
        $I->wantTo("verify openssl-devel is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel yum list installed | grep openssl-devel");
        $I->seeInShellOutput('openssl-devel');
    }

    public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web rpm -qa | grep MariaDB-client");
        $I->seeInShellOutput('MariaDB-client');

    }

    public function checkPopplerUtilInstallation(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep poppler-util");
        $I->seeInShellOutput('poppler-util');
    }

    public function checkLibreOfficeDrawInstallation(UnitTester $I){
        $I->wantTo("verify libreOffice-draw is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep libreoffice-draw");
        $I->seeInShellOutput('libreoffice-draw');
    }

    public function checkLibreOfficeWriterInstallation(UnitTester $I){
        $I->wantTo("verify libreOffice-writer is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep libreoffice-writer");
        $I->seeInShellOutput('libreoffice-writer');
    }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2 is installed in the container");
            $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep libssh2");
            $I->seeInShellOutput('libssh2');
    }

    public function checkUnzipIsInstallation(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep unzip");
        $I->seeInShellOutput('unzip');
    }


    public function checkCurlInstallation(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel rpm -qa | grep curl");
        $I->seeInShellOutput('curl');
    }

    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.4 is installed in the container");
        $I->runShellCommand("docker exec prod_web_rhel php --version");
        $I->seeInShellOutput('PHP 7.4');

    }


    public function checkPHPModules(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec prod_web_rhel php -m");
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
            $I->seeInShellOutput('tidy');
            $I->seeInShellOutput('tokenizer');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('xmlreader');
            $I->seeInShellOutput('xmlwriter');
            $I->seeInShellOutput('xsl');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
