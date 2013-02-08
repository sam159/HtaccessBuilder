            <div style="clear: both;">&nbsp;</div>
            </div> <!-- / content -->
  

            <?php if (isset($sidebar) && $sidebar == True) include('sidebar.php'); ?>
          </div><!-- / page-content -->
        </div><!-- / page-bgbtm -->
      </div><!-- / page-bgtop -->
    </div><!-- / page -->
  </div><!-- / wrapper -->
  <?php include('footer.php'); ?>
  <div style="clear: both;">&nbsp;</div>
  <?php
  if (is_file(dirname(__FILE__).'/bottom-custom.php'))
    include(dirname(__FILE__).'/bottom-custom.php');
  ?>
  </body>
</html>
<!--
GentleBreeze Design by Free CSS Templates
-->