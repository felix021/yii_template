<?php

//test controller

class TestController extends CController
{
    public function actionTest()
    {
        printf("This is %s @ %s\n", Yii::app()->name, gethostname());
    }
}
