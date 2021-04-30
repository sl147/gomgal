<aside>
<?=Auxiliary::showKurs()?>
<!-- <?=Auxiliary::showReklamaArg('/insurance','velocityProduct','калькулятор автоцивілки','розрахунок вартості страхування автоцивілки')?> -->
<br>
<?=Auxiliary::showWeather()?>
<?=Auxiliary::showReklamaArg('http://drohobych-rada.gov.ua/webcams/','webCamera','вебкамери Дрогобича','вебкамери в Дрогобичі')?>
<?=Auxiliary::showRelaxRandom(1)?>
<?=Auxiliary::showRelaxRandom(2)?>
<?=Auxiliary::showReklRand()?>
<?=Vote::showVote()?>
<!-- <?=Auxiliary::showReklama('https://artargus.in.ua','/rekl/art.jpg','товари для художників','все для художників')?> -->
<?=Auxiliary::showReklama('https://www.facebook.com/teatr.drohobych/','/rekl/theatre.jpg','Дрогобицький театр','театр ім.Ю.Дрогобича')?>
<?=Auxiliary::showArchive()?>
<?=Auxiliary::showLivecount()?>

<?=Auxiliary::up()?>
</aside>