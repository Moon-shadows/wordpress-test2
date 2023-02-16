<!doctype html>
<html lang="sv">

<head>

    <?php
    /*
    ***  Use this if you need to preconnect to things
    */
    /*
    <link rel="preconnect" href="https://some-image-server-example.com">
    */
    ?>

    <?= vite(); ?>

    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">

    <?php /*
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
 		*/
    ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    /*
        <script nonce="<?= CSP_NONCE; ?>">
            var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    */
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<!------------------------------------------------------------------------------------------> 
<!--Mobile navigation Menu (outside Navigation Bar)--> 
<!--Slidout Menu (Hamburger Menu)--> 
    <div id="slidout-menu">
      <ul>
        <li>
          <a href="<?php echo site_url(); ?>">Home</a>
        </li>
        <li>
        <a href="<?php echo site_url('/blog'); ?>">Blog</a>
        </li>
        <li>
        <a href="<?php echo site_url('/projects'); ?>">Projects</a>
        </li>
        <li>
        <a href="<?php echo site_url('/about'); ?>">About</a>
        </li>
        <li>
          <input type="text" placeholder="Search Here">
        </li>
      </ul>
    </div>
<!-------------------------------------------------------------------------------------------------------> 


<!--Header-->    
<!--Main Navigation--------------------------------------------------------------------------------------> 
<!-- Logotype (right corner) --> 
    <nav>
      <div id="logo-image">
        <a href="#">
        <img src="<?= get_template_directory_uri();?>/img/logo.png"  height="50px" alt="Lilla Hjärtat Logo">
        </a>
        <p>Lilla hjärtat</p>
      </div>

<!--****Menu Bar *****--> 
      <div id="menu-icon">
        <i class="fa-solid fa-bars"></i>
      </div>
      <ul>
      <li>
          <a class="active"  href="<?php echo site_url(); ?>">Home</a>
        </li>
        <li>
        <a href="<?php echo site_url('/blog'); ?>">Blog</a>
        </li>
        <li>
        <a href="<?php echo site_url('/projects'); ?>">Projects</a>
        </li>
        <li>
        <a href="<?php echo site_url('/about'); ?>">About</a>
        </li>
        <li>
        <div id="search-icon">
          <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
        </div>
        </li>
      </ul>
    </nav>
    <!--Main Navigation End--------------------------------------------------------------------------------------> 

<!--Searchbox--> 
    <div id="searchbox">
      <input type="text" placeholder="Search Here">
    </div>
    