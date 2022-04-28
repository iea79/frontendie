<?php
function setWorks($per_page = -1, $slug = '') {
    // print_r($slug);
    ?>
    <!-- begin works -->
    <section id="works" class="works section">
        <div class="container_center">
            <?php
            if (is_front_page()) {
                ?><h2 class="section__title">Мои <b>Работы</b></h2><?php
            }
             ?>
            <div class="works__content">
                <div class="works__nav">
                    <?php
                        $taxonomies = get_terms('project-category', 'orderby=count&order=desc&hide_empty=1');
                        $query = new WP_Query([
                            'post_type'          => 'projects',
                            'posts_per_page'     => $per_page,
                            'project-category'   => $slug,
                        ]);
                        $count_posts = wp_count_posts('projects');
                        $published_posts = $count_posts->publish;
                        // print_r($taxonomies);
                        // print_r($projects);
                    ?>
                    <ul>
                        <?php
                            if (!is_front_page()) {
                                ?>
                                <li>
                                    <a href="/projects">Все (<?php echo $published_posts ?>)</a>
                                </li>
                                <?php
                            }
                            if( $taxonomies ) {
                                foreach ( $taxonomies as $taxonomy ) {
                                        ?>
                                        <li>
                                            <a href="/projects/<?php echo $taxonomy->slug ?>"><?php echo $taxonomy->name ?> (<?php echo $taxonomy->count ?>)</a>
                                            <!--$taxonomy->description -->
                                        </li>
                                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="works__plate">
                    <div class="works__list">
                        <?php
                        $count = 1;
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();

                                    ?>
                                        <a href="<?php echo SCF::get( 'project__link' ); ?>" class="works__item cursor_showed" target="_blank">
                                            <span><?php // echo $count ?></span>
                                            <span class="works__pict">
                                                <?php echo the_post_thumbnail( 'large'); ?>
                                            </span>
                                            <span class="works__name"><?php the_title(); ?></span>
                                            <span class="works__date"><?php echo get_post_time( 'F Y', true, null, true ) ?></span>
                                        </a>
                                    <?php
                                    $count++;
                                }
                            }
                            wp_reset_postdata();
                         ?>
                    </div>
                    <?php
                    if (is_front_page()) {
                        ?>
                        <div class="works__more">
                            <a href="/projects" class="btn">Смотреть все</a>
                            <div class="section__info">*На сайте размещены работы разрешенные к показу</div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- end works -->
    <script>
        function toggleActiveCat() {
            document.addEventListener('DOMContentLoaded', ev => {
                let catItem = document.querySelectorAll('.works__nav a'),
                    pageHref = location.href.slice(0, -1);
                if (location.pathname === '/projects/') {
                    catItem[0].classList.add('active');
                }

                catItem.forEach(item => {
                    if (item.href === pageHref) {
                        item.classList.add('active');
                    }
                });

            });
        }
        toggleActiveCat();
    </script>

    <?php
}
