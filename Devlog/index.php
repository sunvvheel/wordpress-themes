<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <meta charset='<?php bloginfo('charset'); ?>'>
   <link rel='stylesheet' type='text/css' media='all' href='<?php bloginfo('stylesheet_url'); ?>' />
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
   <header id='top'>
      <?php get_header(); ?>
   </header>
   <section id='main'>
      <nav id='navbar'>
         <div id='anchors'>
            <a href='#top'><span class='text'>Home</span><span class='icon' id='home-icon'></span></a>
            <a href='#page1'><span class='text'>The World</span><span class='icon' id='world-icon'></span></a>
            <a href='#page2'><span class='text'>The System</span><span class='icon' id='system-icon'></span></a>
            <a href='#page3'><span class='text'>Gallery</span><span class='icon' id='gallery-icon'></span></a>
            <a id='search-link'><span class='text'>Search</span><span class='icon' id='search-icon'></span></a>
         </div>
      </nav>
      <form id='form' class='hidden' role='search' method='get' action='<?php echo home_url(); ?>'>
         <div>
            <input id='input' class='hidden' value='' name='s' type='text'>
            <input id='enter' class='hidden' value='Enter' type='submit' formtarget='frame'>
            <p id='exit1'>X</p>
         </div>
      </form>
      <div id='page1'>
         <div class='title'>
            <h1>The World</h1>
            <p>Notes about the world, its history and inhabitants</p>
         </div>
         <aside id='left1'>
            <?php get_sidebar(); ?>
         </aside>
         <section id='right1'>
            <?php global $args1;   // Accessed by loader.php via wp_localize_script()
            global $max1;
            $posts1 = new WP_Query(array(
               'category_name' => 'the-world',
               'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
               'posts_per_page' => 3
            ));
            if ($posts1->have_posts()) :
               while ($posts1->have_posts()) : $posts1->the_post() ?>
                  <div class='poster'>
                     <article <?php post_class('posts') ?> id='post-<?php the_ID(); ?>'>
                        <?php if (has_post_thumbnail()) : ?>
                           <span class='post-title'><?php the_title(); ?></span>
                        <?php the_post_thumbnail();
                        else : ?>
                           <span class='center'><?php the_title(); ?></span>
                        <?php endif;
                        the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>'>&raquo;</a>
                     </article>
                  </div>
               <?php endwhile;
            else : ?>
               <p>Nothing Found</p>
            <?php endif;
            $max1 = $posts1->max_num_pages;    // Set value for loader.php
            $args1 = json_encode($posts1->query_vars);
            if ($max1 >= 2) : ?>
               <div id='load1' class='snap'>
                  <input type='submit' value='Continue' id='button1'></input>
               </div>
            <?php endif;
            wp_reset_postdata();
            ?>
         </section>
      </div>
      <div id='page2'>
         <div class='title'>
            <h1>The System</h1>
            <p>Information about systems, technology, and how things work</p>
         </div>
         <section id='left2'>
            <?php global $args2;
            global $max2;
            $posts2 = new WP_Query(array(
               'category_name' => 'the-system',
               'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
               'posts_per_page' => 3
            ));
            if ($posts2->have_posts()) :
               while ($posts2->have_posts()) : $posts2->the_post() ?>
                  <div class='poster'>
                     <article <?php post_class('posts') ?> id='post-<?php the_ID(); ?>'>
                        <?php if (has_post_thumbnail()) : ?>
                           <span class='post-title'><?php the_title(); ?></span>
                        <?php the_post_thumbnail();
                        else : ?>
                           <span class='center'><?php the_title(); ?></span>
                        <?php endif;
                        the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>'>&raquo;</a>
                     </article>
                  </div>
               <?php endwhile;
            else : ?>
               <p>Nothing Found</p>
            <?php endif;
            $max2 = $posts2->max_num_pages;
            $args2 = json_encode($posts2->query_vars);
            if ($max2 >= 2) : ?>
               <div id='load2' class='snap'>
                  <input type='submit' value='Continue' id='button2'></input>
               </div>
            <?php endif;
            wp_reset_postdata(); ?>
         </section>
         <aside id='right2'>
            <?php get_footer(); ?>
         </aside>
      </div>
      <div id='page3'>
         <div class='title'>
            <h1>Gallery</h1>
            <p>Sketches of environments, objects and characters</p>
         </div>
         <div id='gallery'>
            <?php global $args3;
            global $max3;
            $posts3 = new wp_query(array(
               'category_name' => 'gallery',
               'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
               'posts_per_page' => 3
            ));
            if ($posts3->have_posts()) :
               while ($posts3->have_posts()) : $posts3->the_post() ?>
                  <a class='picture' href='<?php the_permalink(); ?>'><?php the_post_thumbnail(); ?></a>
               <?php endwhile;
            else : ?>
               <p>Nothing Found</p>
            <?php endif;
            $max3 = $posts3->max_num_pages;
            $args3 = json_encode($posts3->query_vars);
            if ($max3 >= 2) : ?>
               <div id='load3'>
                  <input type='submit' value='&raquo;' id='button3'></input>
               </div>
            <?php endif;
            wp_reset_postdata(); ?>
         </div>
      </div>
   </section>
   <div id='bottom'>
      <nav id='contacts'>
         <a href='https://github.com/archaion'>&copy; 2022 Archaion</a>
      </nav>
   </div>
   <div id='exit2'>X</div>
   <div id='modal'>
      <iframe name='frame'></iframe>
   </div>
</body>

</html>

<script>
   let page = document.querySelector('html'),
      form = document.getElementById('form'),
      modal = document.getElementById('modal'),
      exit2 = document.getElementById('exit2')

   snapSwitch = () => {
      document.getElementById('load1') && document.getElementById('load1').classList.toggle('snap')
      document.getElementById('load2') && document.getElementById('load2').classList.toggle('snap')
   }

   formSwitch = () => {
      snapSwitch()
      form.classList.toggle('hidden')
      setTimeout(() => snapSwitch(), 300)
   }

   document.getElementById('search-link').onclick = () => formSwitch()
   document.getElementById('exit1').onclick = () => formSwitch()

   form.onsubmit = () => {
      snapSwitch()
      page.classList.add('stop')
      modal.classList.add('show')
      exit2.classList.add('show')
      form.classList.toggle('hidden')
   }

   addClickEvents = () => {
      let links = document.getElementsByTagName('a'),
         images = document.querySelectorAll('.posts > img') // Select child elements
      /*posters = document.getElementsByClassName('poster')
        for (let i in posters) {
         posters[i].classList.add('fadeIn')
      }*/
      for (let i in images) {
         if (!images[i].onclick) { // Omit previous images
            images[i].onclick = function() {
               snapSwitch()
               let title = this.parentElement.querySelector('span')
               if (this.classList.contains('expand')) {
                  this.classList.remove('expand')
                  title.classList.remove('center')
               } else {
                  this.classList.add('expand')
                  title.classList.add('center')
               }
               setTimeout(() => snapSwitch(), 300)
            }
         }
      }

      for (let i in links) {
         if (links[i].target != 'frame' &&
            links[i].parentElement != document.getElementById('anchors')) {
            links[i].target = 'frame'
            if (!links[i].onclick) {
               links[i].onclick = () => {
                  snapSwitch()
                  modal.classList.add('show')
                  exit2.classList.add('show')
                  page.classList.add('stop')
               }
            }
         }
      }

      exit2.onclick = () => {
         modal.classList.remove('show')
         modal.innerHTML = "<iframe name='frame'></iframe>" // Clear iframe content
         exit2.classList.remove('show')
         page.classList.remove('stop')
         snapSwitch()
      }
   }

   window.onload = addClickEvents()
</script>