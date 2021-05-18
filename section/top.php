<div class="container p-0 m-0 mw-100">
    <div class="row">
        <div class="col-12 mb-4 pt-5">
            <p class="top-name text-center fw-bold mb-0"><?php the_field('top_section_name'); ?></p>
            <h1 class="raleway-bold text-center mb-0"><?php the_field('top_section_heading'); ?></h1>
            <p class="top-subheading text-center"><?php the_field('top_section_subheading'); ?></p>
        </div>
        <div class="col-12">
        <?php include_once 'slider.php'; ?>
        </div>
        <div class="col-12">
        <?php include_once 'top-posts.php'; ?>
        </div>
    </div>

</div>

