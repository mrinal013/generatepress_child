<?php
$args = array(
    'category__in' => get_field('sport_nutrition_category_id'),
);
$sport_nutritions = new WP_Query( $args );

if ( $sport_nutritions->have_posts() ) {
    ?>
    <div class="container-fluid gx-0">
    <p class="top-name text-center fw-bold mb-0"><?php the_field('sport_nutrition_name'); ?></p>
    <h1 class="raleway-semibold text-center mb-4"><?php the_field('sport_nutrition_heading'); ?></h1>
    <div class="row">
    <?php
    while ( $sport_nutritions->have_posts() ) {
        $sport_nutritions->the_post();
        $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ?>
        <div class="col-md-4">
            <img src="<?php echo esc_attr( $featured_img_url ); ?>" alt="" class="img-fluid">
            <h3 class="raleway-semibold mt-4 fw-bold"><?php the_title(); ?></h3>
            <p class=""><?php the_field('post_description'); ?></p>
            <p class="post-author"><?php echo esc_html__( 'BY ', 'generatepress' ) . esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
        </div>
        <?php

    }
    ?>
     </div>
     </div>
    <?php
}
wp_reset_postdata();
