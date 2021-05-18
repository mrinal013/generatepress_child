<?php

$slider_posts = get_field( 'slider_posts' );
if ( ! empty( $slider_posts ) ) {
    $args = array(
        'post__in' => $slider_posts,
        'ignore_sticky_posts' => true,
    );
    $sliders = new WP_Query( $args );

    if ( $sliders->have_posts() ) {
    ?>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
        <?php
        while ( $sliders->have_posts() ) {
            $sliders->the_post();
            $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            ?>
            <div class="carousel-item <?php echo ( ! $sliders->current_post ) ? 'active' : ''; ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <img src="<?php echo esc_html( $featured_img_url ); ?>" class="" alt="slider">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="carousel-caption position-relative bg-white">
                            <div class="caption-div">
                                <h1 class="raleway-semibold text-dark fw-bold"><?php the_title(); ?></h1>
                                <p class="post-author"><?php echo esc_html__( 'BY ', 'generatepress' ) . esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
                                <p class="slider-description"><?php the_field('post_description'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <div class="carousel-control d-flex justify-content-end">
            <button class="carousel-control-prev position-relative bg-dark" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                </svg>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next position-relative float-right bg-dark" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                </svg>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <?php
    }
    wp_reset_postdata();
}