<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Make report PDF used Yii Framework

</h1>
    <br>
</p>

## Install Yii advanced

Extract and Rename Advanced to Advanced_yii

Open Command Prompt

move to folder c:\xampp\php>

Either run
```
php.exe c:/xampp/htdocs/advanced_yii/init
```
>If error check file php.ini.

## PDF used kartik-v/ yii2-mpdf

Dont Forget Composer Install

move to folder c:\xampp\htdocs\advanced_yii>

Either run
```
composer require kartik-v/yii2-mpdf "dev-master"
```

Running Apache and Open Browser http://localhost/advanced_yii/frontend/web/index.php?r=site/report

>Edit File in Frontend -> SiteController.php and _reportView.php
