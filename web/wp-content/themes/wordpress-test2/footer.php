    
    
    <footer>
        <p>Footer goes here</p>
    </footer>


<!-------------------------------------------------------------------------------------------------------> 
<!--Footer--> 
<footer>
      <div id="left-footer">
        <h3>Quick Links</h3>
        <p>
          <ul>
            <li>
              <a href="#">Home</a>
            </li>
            <li>
              <a href="#">About</a>
            </li>
            <li>
              <a href="#">Privace Policy</a>
            </li>
            <li>
              <a href="#">Blogs</a>
            </li>
            <li>
              <a href="#">Projects</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li>
          </ul>
        </p>
      </div>
    
      <div id="right-footer">
        <h3>Fallow us on</h3>
        <div id="social-media-footer">
          <ul>
            <li>
              <a href="#">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fab fa-github"></i>
              </a>
            </li>
          </ul>
        </div>
        <p>This webside is developed by Marias Team</p>
      </div>
    </footer>
<!--Footer End-->
<!-------------------------------------------------------------------------------------------------------> 
    
   <script src="main.js"></script>








<?php wp_footer(); ?>

    <?php /*
    <!-- analytics -->
    <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
    ga('send', 'pageview');
    </script>
    */ ?>

    <?php
    /*
    *** output the legacy-scripts
    */
        echo vite()->legacy();
    ?>
    </body>
    </html>
