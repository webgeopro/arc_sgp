<?php
use yii\helpers\Html;

$this->title = 'К сожалению, страница не найдена...';
$this->registerCssFile('/css/add-spasibo.css', ['depends'=>['app\assets\AppAsset',]]);
?> <main class="content"><section id="slider1" style="background: url('../images/404.jpg'); min-height: 600px;"><div class="container"><div class="logo col-xs-8 col-xs-offset-2"><a href="/" title="Сибгеопроект - на главную страницу"><h2><span>СИБ<span>ГЕО<span>ПРОЕКТ</span></span></span></h2></a><div class="row"><div class="well well-error"><h1 class="text-center">404-ОШИБКА</h1><h2>Запрашиваемый материал на сайте не найден.</h2></div></div></div></div></section><section id="additional" class="clearfix"><div class="container"><h2 class="text-center">ЧТО МЫ МОЖЕМ ВАМ ПРЕДЛОЖИТЬ</h2><h3>Возможно Вас заинтересуют направления нашей деятельности</h3><div class="row"><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-bullhorn" aria-hidden="true"></span></div><h3>Продающие сайты</h3><p>Современные быстрые сайты для доходного бизнеса.</p><p><a href="/">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-copyright" aria-hidden="true"></span></div><h3>Эксклюзив</h3><p>Сложные нетиповые интернет-решения. Порталы. Мобильные приложения</p><p><a href="/eksklyuziv">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div><div class="col-md-4 col-sm-6 add"><div class="bg-div"><span class="fa fa-rub" aria-hidden="true"></span></div><h3>Лендинги</h3><p>Посадочные страницы, максимально оптимизированные под продажи.</p><p><a href="/landing-pages">Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p></div><!--<div class="col-md-4 col-sm-6 add">
                    <div class="bg-div"><span class="fa fa-bullhorn" aria-hidden="true"></span></div>
                    <h3>Интернет-маркетинг</h3>
                    <p>SEO, Контекстная реклама, SMM, E-mail - маркетинг.</p>
                    <p><a href="/<?/*#internet-marketing*/?>"> Узнать больше &rsaquo;&rsaquo;&rsaquo;</a></p>
                </div>--></div></div></section><section id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2231.239770902923!2d92.8993566!3d55.99719935000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5cd7afd15073fe6d%3A0x3041fd20d1084410!2z0J3QsNCy0LjQs9Cw0YbQuNC-0L3QvdCw0Y8g0YPQuy4sIDUsINCa0YDQsNGB0L3QvtGP0YDRgdC6LCDQmtGA0LDRgdC90L7Rj9GA0YHQutC40Lkg0LrRgNCw0LksIDY2MDA5Mw!5e0!3m2!1sru!2sru!4v1416509131341" width="100%" height="100%" frameborder="0" scrollwheel="false" style="border:0"></iframe><div id="map-label"><div itemscope="" itemtype="http://schema.org/Organization"><h2 itemprop="name">СИБГЕОПРОЕКТ</h2><div><?=$item['mapHeader']?></div><div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" class="margin-top-<?=$item['margin']?>"><h3 class="itmp-adress">Адрес:</h3><span itemprop="postalCode">660000</span>, <span itemprop="addressCountry">Россия</span>, <span itemprop="addressLocality">Красноярск</span>,<br><span itemprop="streetAddress">Навигационная 5, офис 2-12</span></div><h3 class="itmp-phone">Телефон:</h3><span itemprop="telephone" class="itmp-phone-number">+7 (391) 29-655-59</span><h3 class="itmp-email">Электронная почта:</h3><a class="itmp-link" itemprop="email" href="mailto:mail@sibgeopro.ru">mail@sibgeopro.ru</a><!--<span class="itmp-data"></span>--></div></div></section></main>