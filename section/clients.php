<?php
if ( have_rows('client') ) {
    ?>
    <div class="container bg-secondary m-0 mt-5 mb-5 pb-1 pt-1 mw-100">
        <div class="row m-4 m-sm-0 pt-sm-0 pt-5 pb-sm-0 pb-3">
    <?php
    while ( have_rows('client') ) {
        the_row();
        $logo = get_sub_field('logo');
        $logo_url = wp_get_attachment_image_src( $logo['ID'], 'full' )[0];
        ?>
        <div class="col-md-3 col-6 position-relative d-flex justify-content-center align-items-center pb-sm-5 pb-5 pe-sm-3 pt-sm-5">
            <div class="img-wrapper">
                <img src="<?php echo esc_attr( $logo_url ); ?>" alt="" class="img-fluid">
            </div>
        </div>
        <?php
    }
    ?>
    </div>
    </div>
    <?php
}
