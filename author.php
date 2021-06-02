<?php
get_header();
$author_name = get_the_author_meta('display_name');
$author_email = get_the_author_meta('user_email');
$author_facebook = get_the_author_meta('facebook');
$author_instagram = get_the_author_meta('instagram');
$author_twitter = get_the_author_meta('twitter');

?>
<div class="container-fluid mt-5 px-0">
    <h3 class="text-center text-dark text-bold fs-2"><?php echo esc_html( sprintf( 'About %s', $author_name ) ); ?></h3>
    <?php include_once 'inc/authorbox2.php'; ?>
    <?php include_once 'inc/authorposts.php'; ?>
    
</div>
<?php
get_footer();