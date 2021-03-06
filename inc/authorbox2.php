<div class="row px-0 mx-0 mt-5 authorbox autorbox-authorpage">
    <div class="col-md-1 col-sm-12 px-0 text-md-start text-center"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div>
    <div class="col-md-11 col-sm-12 ps-md-2 px-0">
        <p class="fw-bold fs-5 text-dark my-0 text-md-start text-center"><?php echo esc_html( get_the_author_meta('display_name') ); ?></p>
        <a href="mailto:<?php echo esc_attr( $author_email ); ?>" class="text-decoration-none text-primary text-md-start text-center d-block"><?php echo esc_html( $author_email ); ?></a>
        <p class="text-muted m-0"><?php echo esc_html( get_the_author_meta('user_description') ); ?></p>
        <ul class="mx-0 my-2 ps-0 d-flex justify-content-start list-unstyled">
        <?php if ( ! empty( $author_instagram ) ) : ?>
            <li><a href="<?php echo esc_attr( $author_instagram ); ?>"><i class="fab fa-instagram-square text-dark"></i></a></li>
        <?php endif;
        if ( ! empty( $author_facebook ) ) : ?>
            <li><a href="<?php echo esc_attr( $author_facebook ); ?>"><i class="fab fa-facebook-square text-dark"></i></a></li>
        <?php endif; ?>
        </ul>
    </div>
</div>