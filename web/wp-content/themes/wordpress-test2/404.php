<?php get_header(); ?>
<header class="my-auto h-[50vh] bg-red-100 text-red-500 flex flex-col items-center justify-center">
    <span class="text-center text-[4rem] md:text-[8rem] font-sans mb-6 text-red-600">
        !
    </span>
    <h1 class="text-[2rem] md:text-[4rem] mb-8"><?php _e('Sidan hittades ej', 'wordpress-test2'); ?></h1>
    </h1>
    <a href="/" class="text-red-100 my-5 text-[1.5rem] flex flex-row flex-wrap items-center justify-center gap-4 bg-red-700 hover:bg-red-900  transition-colors duration-200 pl-8 pr-9 py-2 rounded-full">
        <figure class="w-6">
            <svg class="block w-full" height="48" width="48" viewBox="0 0 48 48" viewBox=><path d="M24 40 8 24 24 8l2.1 2.1-12.4 12.4H40v3H13.7l12.4 12.4Z" fill="currentColor" aria-hidden="true"/></svg>
        </figure>

        <span>
            <?php _e('Till startsidan', 'wordpress-test2'); ?>
        </span>

    </a>
</header>
<?php get_footer(); ?>