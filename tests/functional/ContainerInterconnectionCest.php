<?php


class ContainerInterconnectionCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }


    public function connectionBetween_db_and_web(FunctionalTester $I){
        $I->wantTo("verify php 7.1 centos container is linked with MariaDB 10.2 properly");
        $I->runShellCommand("docker exec prod_web_72 ping db -c 2");
        $I->seeInShellOutput('2 packets transmitted, 2 received, 0% packet loss');
    }

    public function connectionBetween_phpmyadmin_db(FunctionalTester $I){
        $I->wantTo("verify phpmyadmin container is linked with MariaDB 10.2 container properly");
        $I->runShellCommand("docker exec prod_phpmyadmin ping db -c 2");
        $I->seeInShellOutput('2 packets transmitted, 2 packets received, 0% packet loss');
    }

}