<?php
$team_member_args = array(
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'team_member',
            'value'   => 1,
            'compare' => '=',
        ),
        array(
            'key'     => 'department',
            'value'   => 'Executive',
            'compare' => '=',
        ),
    ),
    'order'      => 'DESC',
);
$team_members = new WP_User_Query( $team_member_args );
?>
<div class="container-fluid my-5">
    <?php
    if ( ! empty( $team_members->get_results() ) ) {
        ?>
        <div class="row">
        <?php
        foreach ( $team_members->get_results() as $key => $team_member ) {
            $user_id = $team_member->data->ID;
            $user_info = get_userdata( $user_id );
            ?>
            <div class="member col-md-6 mb-md-0 mb-3 <?php echo ( $key % 2 ) === 0 ? 'ps-0 pe-md-2 pe-0' : 'pe-0 ps-md-2 ps-0'; ?>">
                <div class="shadow p-3 h-100">
                    <div class="text-center"><?php //echo get_avatar( get_the_author_meta( 'ID', $user_id ), 192 ); ?></div>
                    <div class="text-center"><img src="<?php echo esc_url( get_avatar_url( $user_id, array( 'size' => 192 ) ) ); ?>" class="rounded-circle" /></div>
                    <div class="text-center"><a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>" class="text-dark fw-bold fs-4"><?php echo esc_html( get_the_author_meta( 'display_name', $user_id ) ); ?></a></div>
                    <?php if ( ! empty( get_the_author_meta( 'certification', $user_id ) ) ) : ?>
                        <h5 class="text-center text-dark fw-bold"><?php echo esc_html( get_the_author_meta( 'certification', $user_id ) ); ?></h5>
                    <?php endif; if ( ! empty( get_the_author_meta( 'designation', $user_id ) ) ) : ?>
                        <h5 class="text-center text-dark fw-bold"><?php echo esc_html( get_the_author_meta( 'designation', $user_id ) ); ?></h5>
                    <?php endif; if ( ! empty( get_the_author_meta( 'description', $user_id ) ) ) : ?>
                        <p class="text-dark"><?php echo nl2br( get_the_author_meta( 'description', $user_id ) ); ?></p>
                    <?php endif; if ( ! empty( $user_info->user_email ) ) : ?>
                        <p class="fw-bold"><?php echo sprintf( 'Email %1$s: <a href="mailto:%2$s" class="text-decoration-none">%2$s</a>', get_the_author_meta( 'first_name', $user_id ), $user_info->user_email ); ?></p>
                    <?php endif; ?>
                    <ul class="ms-0 list-unstyled d-flex">
                        <?php
                        if ( ! empty( get_the_author_meta( 'facebook', $user_id ) ) ) :
                            echo sprintf( '<li><a href="%s" class="text-decoration-none">Facebook</a></li>', esc_url( get_the_author_meta( 'facebook', $user_id ) ) );
                        endif;
                        if ( ! empty( get_the_author_meta( 'twitter', $user_id ) ) ) :
                            echo sprintf( '<li><a href="%s" class="text-decoration-none">Twitter</a></li>', esc_url( get_the_author_meta( 'twitter', $user_id ) ) );
                        endif;
                        if ( ! empty( get_the_author_meta( 'youtube', $user_id ) ) ) :
                            echo sprintf( '<li><a href="%s" class="text-decoration-none">Youtube</a></li>', esc_url( get_the_author_meta( 'youtube', $user_id ) ) );
                        endif;
                        if ( ! empty( get_the_author_meta( 'instagram', $user_id ) ) ) :
                            echo sprintf( '<li><a href="%s" class="text-decoration-none">Instagram</a></li>', esc_url( get_the_author_meta( 'instagram', $user_id ) ) );
                        endif;
                        if ( ! empty( get_the_author_meta( 'linkedin', $user_id ) ) ) :
                            echo sprintf( '<li><a href="%s" class="text-decoration-none">LinkedIn</a></li>', esc_url( get_the_author_meta( 'linkedin', $user_id ) ) );
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }
    ?>
    </div>
</div>