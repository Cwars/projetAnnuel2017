<div class="top-image">
    <!--<img src="images/header.png" width="100%" alt="header">-->
    <h1 class="slide-label"><?php echo $title;?></h1>
</div>

<section class="un" id="Dedicaces">
    <div class="container">
            <div class="col">
                <?php echo htmlspecialchars_decode($content); ?>
            </div>
    </div>
</section>
<section class="deux" id="Dedicaces">
    <div class="container">
        <div class="col firstcol">
            <img src="<?php echo PATH_RELATIVE ; ?>assets/front/images/Dedicaces.png" alt="" class="img-responsive">
        </div>

        <div class="col">
            <h2>Dédicaces à venir</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, asperiores autem deserunt, dolor et facere inventore laudantium maxime modi nisi non, reiciendis suscipit. Consequatur dolor itaque, mollitia pariatur quia sed.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, asperiores autem deserunt, dolor et facere inventore laudantium maxime modi nisi non, reiciendis suscipit. Consequatur dolor itaque, mollitia pariatur quia sed.</p>
        </div>
    </div>

</section>

<section class="un" id="Event">
    <div class="container">
        <h2 class="text-center">Evenements à venir</h2>
        <div class="col1 firstcol">
            <img class="center img-responsive" src="<?php echo PATH_RELATIVE ; ?>assets/front/images/event.png" alt="event">
            <p class="text-center">Mardi 3 Janvier 2017 Galerie Arts Factory / Bastille</p>
            <div class="bouton"><a href="<?php echo PATH_RELATIVE ; ?>event">En savoir plus</a></div>
        </div>
    </div>
</section>