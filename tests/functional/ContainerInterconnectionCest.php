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
        $I->wantTo("verify php 7.3 centos container is linked with MariaDB 10.2 properly");
        $I->runShellCommand("docker exec prod_web_73 ping db -c 2");
        $I->seeInShellOutput('2 packets transmitted, 2 received, 0% packet loss');
    }
}