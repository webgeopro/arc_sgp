<?php
use yii\helpers\Html;

$this->title = 'Сибгеопроект - спасибо за Вашу заявку!';
$this->registerCssFile('/css/add-spasibo.css', ['depends'=>['app\assets\AppAsset',]]);
?> <div class="content"><section id="slider" style="background: url('../images/<?=$item['bgImage']?>')"><div class="container"><div class="logo col-xs-8 col-xs-offset-2"><a href="/" title="Сибгеопроект - на главную страницу"><h2><span>СИБ<span>ГЕО<span>ПРОЕКТ</span></span></span></h2></a></div><div class="container" id="middle-line"><div class="spasibo col-xs-8 col-xs-offset-2"><h2><?=$item['header']?></h2><h3 class="margin-top-40">Менеджер свяжется с Вами в ближайшее время</h3></div></div></div><div id="bottom-line" class="hidden-xs hidden-sm"><p>Как правило, время отклика составляет 20 минут.</p><p>Мы заранее извиняемся если менеджер, в силу занятости, задержится с ответом.</p><div class="container well-sm"><h3>МЫ ПРЕДОСТАВИМ ВАМ ДОПОЛНИТЕЛЬНУЮ СКИДКУ В СЛУЧАЕ ДОЛГОГО ОТВЕТА!</h3></div></div></section><section id="questions-header"><div class="container"><h2>НАШИ ВОПРОСЫ</h2><h3>Менеджер, для уточнения задачи, может Вам задать некоторые вопросы</h3></div></section><section id="questions"><div class="container"><div class="row"><?=$item['htmlQuestions']?></div></div></section><section id="additional"><div class="container"><h2>ЧТО МЫ МОЖЕМ ВАМ ПРЕДЛОЖИТЬ</h2><h3>Возможно Вас заинтересуют другие направления нашей деятельности</h3><div class="row"><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-copyright" aria-hidden="true"></span></div><h3>Эксклюзив</h3><p>Сложные нетиповые интернет-решения. Порталы. Мобильные приложения</p><p><a href="/eksklyuziv">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-rub" aria-hidden="true"></span></div><h3>Лендинги</h3><p>Посадочные страницы, максимально оптимизированные под продажи.</p><p><a href="/landing-pages">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-bullhorn" aria-hidden="true"></span></div><h3>Интернет-маркетинг</h3><p>SEO, Контекстная реклама, SMM, E-mail - маркетинг.</p><p><a href="/internet-marketing">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div></div></div></section> <?/*<section id="requisites">
        <div class="container">
            <div class="row">

                <div class="address">
                    <h2>СПАСИБО ЗА ПРОЯВЛЕННЫЙ ИНТЕРЕС</h2>
                    <p>
                        <a href="http://twitter.com/sibgeopro" target="_blank"><span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                        </span></a>
                        <a href="http://facebook.com/sibgeopro" target="_blank"><span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span></a>
                        <a href="http://vk.com/sibgeopro" target="_blank"><span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-vk fa-stack-1x fa-inverse"></i>
                        </span></a>
                    </p>
                </div>
            </div>
    </section>*/?> <section id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2231.239770902923!2d92.8993566!3d55.99719935000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5cd7afd15073fe6d%3A0x3041fd20d1084410!2z0J3QsNCy0LjQs9Cw0YbQuNC-0L3QvdCw0Y8g0YPQuy4sIDUsINCa0YDQsNGB0L3QvtGP0YDRgdC6LCDQmtGA0LDRgdC90L7Rj9GA0YHQutC40Lkg0LrRgNCw0LksIDY2MDA5Mw!5e0!3m2!1sru!2sru!4v1416509131341" width="100%" height="100%" frameborder="0" scrollwheel="false" style="border:0"></iframe></section></div>