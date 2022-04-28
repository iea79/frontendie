<!-- begin homeScreen -->
<section id="homeScreen" class="homeScreen section">
    <div class="homeScreen__bg" id="homeBg">
        <?php echo wp_get_attachment_image(SCF::get( 'first__bg' ),'full', false, array("loading"=>"lazy")) ?>
    </div>
    <div class="homeScreen__content">
        <div class="container_center">
            <div class="homeScreen__title"><h1><?php echo SCF::get( 'first__title' ); ?></h1></div>
            <div class="homeScreen__name"><span><?php echo SCF::get( 'first__name' ); ?></span></div>
            <div class="homeScreen__sub"><?php echo SCF::get( 'first__text' ); ?></div>
        </div>
    </div>
</section>
<!-- end homeScreen -->

<?php setWorks(6) ?>

<!-- begin skills -->
<section id="skills" class="skills section section_dark">
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'skills__title' ); ?></h2>
        <div class="skills__item">
            <div class="skills__label"><?php echo SCF::get( 'skills__label' ); ?></div>
            <div class="skills__list">
                <?php
                    $skillsList = SCF::get('skills-list');

                    foreach ($skillsList as $item) {
                        ?>
                        <div class="skills__row">
                            <div class="skills__title"><?php echo $item['skills__name'] ?></div>
                            <div class="skills__props"><?php echo $item['skills__list'] ?></div>
                            <div class="skills__line"></div>
                        </div>
                        <?php
                    };
                ?>
            </div>
        </div>
        <div class="skills__item">
            <div class="skills__label"><?php echo SCF::get( 'skills__label2' ); ?></div>
            <div class="skills__list">
                <div class="skills__row">
                    <div class="skills__text"><?php echo SCF::get( 'skills__text' ); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end skills -->

<!-- begin prices -->
<section id="prices" class="prices section">
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'prices__title' ); ?></h2>
        <div class="prices__content">
            <div class="prices__item">
                <div class="prices__label"><?php echo SCF::get( 'prices__label' ); ?></div>
                <div class="prices__list">
                    <?php
                        $prices_list = SCF::get('prices_list');

                        foreach ($prices_list as $item) {
                            ?>
                            <div class="prices__row">
                                <div class="prices__left">
                                    <div class="prices__name"><?php echo $item['prices__name'] ?></div>
                                    <div class="prices__text"><?php echo $item['prices__text'] ?></div>
                                </div>
                                <div class="prices__price"><?php echo $item['prices__summ'] ?></div>
                                <div class="prices__line"></div>
                            </div>
                            <?php
                        };
                    ?>
                </div>
            </div>
            <div class="prices__item">
                <div class="prices__label"><?php echo SCF::get( 'prices__label_opt' ); ?></div>
                <div class="prices__list">
                    <?php
                        $prices_list_opt = SCF::get('prices_list_opt');

                        foreach ($prices_list_opt as $item) {
                            ?>
                            <div class="prices__row">
                                <div class="prices__left">
                                    <div class="prices__name"><?php echo $item['prices__name_opt'] ?></div>
                                    <div class="prices__text"><?php echo $item['prices__text_opt'] ?></div>
                                </div>
                                <div class="prices__price"><?php echo $item['prices__summ_opt'] ?></div>
                                <div class="prices__line"></div>
                            </div>
                            <?php
                        };
                    ?>
                    <div class="prices__row">
                        <div class="prices__left">
                            <div class="prices__info"><?php echo SCF::get( 'prices__info' ); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end prices -->
