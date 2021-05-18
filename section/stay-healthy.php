<?php
$sticky = get_option( 'sticky_posts' );

$sticky_args = array(
    'category__in' => get_field('stay_healthy_category_id'),
    'p'            => $sticky[0],
);
$stay_healthy_sticky_post = new WP_Query( $sticky_args );

$not_sticky_args = array(
    'category__in' => get_field('stay_healthy_category_id'),
    'post__not_in' => $sticky,
);
$stay_healthy_posts = new WP_Query( $not_sticky_args );
?>
<div class="container-fluid gx-0 mb-5 border-bottom">
<p class="top-name text-center fw-bold m-0"><?php the_field('stay_healthy_name'); ?></p>
<h1 class="text-center fw-bold mb-4"><?php the_field('stay_healthy_heading'); ?></h1>
    <div class="row mb-5">
        <div class="col-lg-6 col-md-12">
            <?php
            if ( $stay_healthy_sticky_post->have_posts() ) {
                while ( $stay_healthy_sticky_post->have_posts() ) {
                    $stay_healthy_sticky_post->the_post();
                    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    ?>
                    <img src="<?php echo esc_attr( $featured_img_url ); ?>" alt="" class="img-fluid">
                    <h3 class="raleway-semibold fw-bold mt-4 fs-1"><?php the_title(); ?></h3>
                    <p class="post-author mt-4"><?php echo esc_html__( 'BY ', 'generatepress' ) . esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
                    <p class="mt-4"><?php the_field('post_description'); ?></p>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="row stay-healthy-posts">
                <?php
                if ( $stay_healthy_posts->have_posts() ) {
                    ?>
                    <div class="container">
                        <div class="row">                        
                        <?php
                        while ( $stay_healthy_posts->have_posts() ) {
                            $stay_healthy_posts->the_post();
                            $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        ?>
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <img src="<?php echo esc_attr( $featured_img_url ); ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h5 class="raleway-semibold top-post-heading <?php echo esc_attr( $heading_class ); ?>"><?php the_title(); ?></h5>
                                        <p class="top-post-description"><?php the_field('post_description'); ?></p>
                                        <p class="post-author"><?php echo esc_html__( 'BY ', 'generatepress' ) . esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
wp_reset_postdata();