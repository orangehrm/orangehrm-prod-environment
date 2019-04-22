<?php

class ProdEnvironmentAllConnectionCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec prod_web_71 git clone -b db-creation https://github.com/orangehrm/environment-test-helpers.git db-creation");
        $I->runShellCommand('docker exec prod_web_71 chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec prod_web_71 rm -rf /var/www/html/db-creation');
        $I->runShellCommand('docker exec prod_web_71 mysql -hdb -uroot -p1234 -e "drop database php_simple"');
    }

    public function checkLoginToDBFromPhpmyadmin(AcceptanceTester $I){
        $I->wantTo("log into mysql 5.5 server through phpmyadmin");
        $I->runShellCommand("docker exec prod_web_71 php /var/www/html/db-creation/app.php");
        $I->cantSeeInShellOutput("false");
        $I->amOnPage('http://localhost:9090');
        $I->fillField('Username:', 'root');
        $I->fillField('Password:', '1234');
        $I->click('Go');
        $I->see('Server: db');
        $I->see('php_simple');
    }
}