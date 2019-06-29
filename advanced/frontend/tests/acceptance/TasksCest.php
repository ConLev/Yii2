<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TasksCest
{
    public function checkTasks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');
        $I->wait(2);
        $I->seeLink('Tasks');
        $I->click('Tasks');
        $I->wait(2);
        $I->fillField('LoginForm[username]', 'admin');
        $I->wait(2);
        $I->fillField('LoginForm[password]', '123456');
        $I->wait(2);
        $I->click(['name' => 'login-button']);
        $I->wait(2);
        $I->click(['css' => '.task-preview-link']);
        $I->wait(2);
        $I->fillField('Tasks[name]', 'Test');
        $I->wait(2);
        $I->selectOption('Tasks[status_id]', 4);
        $I->wait(2);
        $I->selectOption('Tasks[responsible_id]', 8);
        $I->wait(2);
        $I->fillField('Tasks[deadline]', '2019-06-29');
        $I->wait(2);
        $I->fillField('Tasks[description]', 'Test');
        $I->wait(2);
        $I->click('Сохранить');
        $I->wait(2);
        $I->attachFile('TaskAttachmentsAddForm[attachment]', 'IMG_3474.JPG');
        $I->wait(2);
        $I->click('Загрузить');
        $I->wait(2);
        $I->fillField('TaskComments[content]', 'Test');
        $I->wait(2);
        $I->click('Добавить');
        $I->wait(2);
        $I->click('Logout');
        $I->wait(2);
        $I->click('Tasks');
        $I->wait(2);
        $I->fillField('LoginForm[username]', 'user');
        $I->wait(2);
        $I->fillField('LoginForm[password]', '123456');
        $I->wait(2);
        $I->click(['name' => 'login-button']);
        $I->wait(2);
        $I->click(['css' => '.task-preview-link']);
        $I->wait(2);
        $I->dontSeeLink('Сохранить');
        $I->wait(2);
    }
}