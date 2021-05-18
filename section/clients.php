<?php
if ( have_rows('client') ) {
    ?>
    <div class="container bg-clients m-0 mt-5 mb-5 pb-1 pt-1 mw-100">
        <div class="row p-md-5 p-sm-2 m-4 m-sm-0">
    <?php
    while ( have_rows('client') ) {
        the_row();
        $logo = get_sub_field('logo');
        $logo_url = wp_get_attachment_image_src( $logo['ID'], 'full' )[0];
        ?>
        <div class="col-md-3 position-relative d-flex justify-content-center align-items-center">
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
