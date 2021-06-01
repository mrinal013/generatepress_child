<div class="row px-4 py-5 mx-0 mt-5 authorbox">
    <div class="col-3"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div>
    <div class="col-9">
        <a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" class="fw-bold fs-5 text-decoration-none text-dark"><?php echo esc_html( get_the_author_meta('display_name') ); ?></a>
        <p class="text-muted"><?php echo esc_html( get_the_author_meta('user_description') ); ?></p>
        <ul class="m-0 ps-0 d-flex justify-content-end list-unstyled">
            <li class="me-3"><a href="#" class="fs-2"><i class="fab fa-instagram-square text-dark"></i></a></li>
            <li><a href="#" class="fs-2"><i class="fab fa-twitter-square text-dark"></i></a></li>
        </ul>
    </div>
</div>