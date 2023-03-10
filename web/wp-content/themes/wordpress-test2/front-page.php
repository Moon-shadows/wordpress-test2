
    
<?php get_header(); ?>

<!--Banner-------------------------------------------------------------------------------------------------------->    
    <div id="banner">
      <h1 class="huvudrubrik">Lilla Hjärtat - med fokus på barn & barnfamiljer!</h1>  
      <h3>Bli månadsgivare eller ge bort ett paket  -  Tack vare våra bidragsgivare 
          får fler barn  möjlighet att delta i sporter och roliga aktiviter.
      </h3><br>
    </div>
<!--Banner End------------------------------------------------------------------------------------------>


<main>
<!---All Blogs--> 
    <a href="<?php echo site_url('/blog'); ?>">
        <h2 class="section-heading-news">All Blogs</h2>
    </a>

   <?php $args = array(
    'post_type' => 'post',  //Till query -vilken typ av post ska visas och antal.
    'posts_per_page' => 2,
);

$blogposts = new WP_Query($args);

while($blogposts->have_posts()) {
    $blogposts->the_post();
    echo "hi<br>";


    ?>

    <section>
        <div class="card">
            <div class="card-image">
                <a href="<?php echo the_permalink(); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" 
                    alt="Card Image">
                </a>
            </div> 

          <div class="card-description">
            <a href="#">
              <h3><?php the_title(); ?></h3>
            </a>
            <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="btn-readmore">Read more</a>
          </div>
        </div>
                
        <div class="card">
            <div class="card-image">
            <a href="#">
            <img src="<?= get_template_directory_uri();?>/img/aaron-burden-1zR3WNSTnvY-unsplash.jpg" alt="Card Image">
            </a>
          </div>
                    
          <div class="card-description">
            <a href="#">
              <h3>The News Title Here</h3>
            </a>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, a.

            </p>
            <a href="#" class="btn-readmore">Read more</a>
          </div>
        </div>
      </section>
      <?php }?>

<!--Section Project-->
<a href="#">
  <h2 class="section-heading">Kommande projekt</h2>
</a>

<section>
  <div class="card">
      <div class="card-image">
      <a href="#">
      <img src="<?= get_template_directory_uri();?>/img/markus-spiske-Fm4KFTgwK0Q-unsplash.jpg"  alt="Card Image">
      </a>
    </div>
              
    <div class="card-description">
      <a href="#">
        <h3>The Project Title Here</h3>
      </a>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, a.
        </p>
      <a href="#" class="btn-readmore">Read more</a>
    </div>
  </div>

  <div class="card">
      <div class="card-image">
      <a href="#">
      <img src="<?= get_template_directory_uri();?>/img/skogslek.jpg"  alt="Card Image">
      </a>
    </div>

    <div class="card-description">
      <a href="#">
        <h3>The Project Title Here</h3>
      </a>
      <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, a.

      <a href="#" class="btn-readmore">Read more</a>
    </div>
  </div>
</section>


      <a href="#">
        <h2 class="section-heading">Tidigare genomförda projekt</h2>
      </a>
    
      <section>
        <div class="card">
            <div class="card-image">
            <a href="#">
            <img src="<?= get_template_directory_uri();?>/img/markus-spiske-Fm4KFTgwK0Q-unsplash.jpg"  alt="Card Image">
            </a>
          </div>
                    
          <div class="card-description">
            <a href="#">
              <h3>The Project Title Here</h3>
            </a>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, a.
              </p>
            <a href="#" class="btn-readmore">Read more</a>
          </div>
        </div>
    
        <div class="card">
            <div class="card-image">
            <a href="#">
            <img src="<?= get_template_directory_uri();?>/img/skogslek.jpg"  alt="Card Image">
            </a>
          </div>

          <div class="card-description">
            <a href="#">
              <h3>The Project Title Here</h3>
            </a>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, a.

            <a href="#" class="btn-readmore">Read more</a>
          </div>
        </div>
      </section>


    
<!--Section About-->        
      <h2 class="section-heading">Om oss</h2>
    
      <div id="section-source">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, et dolorum eveniet numquam rerum, esse soluta saepe praesentium totam eaque laborum ipsum. Nemo, iure. Sunt explicabo at eligendi ipsam tempora.</p>
        <a href="#" class="btn-readmore">XXXXXXXXXXXXXXX</a>
      </div>
    </main>
<!--Main End--> 
<!-------------------------------------------------------------------------------------------------------> 
 
<?php get_footer(); ?>

