

<?php get_header(); ?>

<?php 

$args = array(
    'post_type' => 'post',  //Till query -vilken typ av post ska visas och antal.
    'posts_per_page' => 3
);

$blogposts = new WP_Query($args);

while($blogposts->have_posts()) {
    $blogposts->the_post();
    echo "hihihi<br>";
?>


<a href="<?php the_permalink();?>">
<h3><?php the_title();?></h3>
</a>
<?php the_excerpt(); ?>





<?php
}

?>

<?php get_footer(); ?>