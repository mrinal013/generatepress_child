<div class="row px-0 mx-0 mt-5 authorbox">
    <div class="col-2 px-0"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div>
    <div class="col-10 px-0">
        <p class="fw-bold fs-5 text-dark my-0"><?php echo esc_html( get_the_author_meta('display_name') ); ?></p>
        <a href="mailto:<?php echo esc_attr( $author_email ); ?>" class="text-decoration-none text-primary"><?php echo esc_html( $author_email ); ?></a>
        <p class="text-muted"><?php echo esc_html( get_the_author_meta('user_description') ); ?></p>
        <ul class="m-0 ps-0 d-flex justify-content-end list-unstyled">
        <?php if ( ! empty( $author_instagram ) ) : ?>
            <li class="ms-3"><a href="<?php echo esc_attr( $author_instagram ); ?>" class="fs-2"><i class="fab fa-instagram-square text-dark"></i></a></li>
        <?php endif;
        if ( ! empty( $author_facebook ) ) : ?>
            <li class="ms-3"><a href="<?php echo esc_attr( $author_facebook ); ?>" class="fs-2"><i class="fab fa-facebook-square text-dark"></i></a></li>
        <?php endif; ?>
        </ul>
    </div>
</div>