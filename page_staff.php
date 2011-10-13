<?php
/**
 * Template Name: Staff
 * @package WordPress
 *
 * The Template for displaying all staff single posts or pulling in staff web service for counties.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */




function county_office_info() {
     GLOBAL $options;
     if (is_array($options)) {
         echo '<div class="vcard">';                   
        
         echo '<p><a class="url fn org" href="'.get_bloginfo('home').'">'.$options['county-name-human'].' County Extension Office</a></p>';
    
         if($options['phone']<>'') {
              echo '<p class="tel">';
              echo '<span class="type">Office</span>: ';
                    echo '<span class="value">'.$options['phone'].'</span>';
                    echo '</p>';
               }
               if($options['fax']<>'') {
              echo '<p class="tel">';
              echo '<span class="type">Fax</span>: ';
                    echo '<span class="value">'.$options['fax'].'</span>';
                    echo '</p>';
               }


               echo "<div class=\"adr\">";
               echo "<p class=\"street-address\">".$options['address-street1'].'<br />';
               if($options['address-street2']<>'')
               echo '<span class="extended-address">'.$options['address-street2'].'</span><br />';
          echo '<span class="locality">'.$options['address-city'].'</span>, ';
          echo '<span class="region">TX</span> <span class="postal-code">'.$options['address-zip'].'</span>';
          echo '<span class="country-name"> U.S.A.</span></p>';
          echo '</div>';
          if($options['address-mail-street1']<>'') {
               echo "<div class=\"adr\">";
                    echo "<p class=\"street-address\">".$options['address-mail-street1']."<br />";
                    if($options['address-mail-street2']<>'')
                    echo '<span class="extended-address">'.$options['address-mail-street2'].'</span>';
               echo '<span class="locality">'.$options['address-mail-city'].'</span>, ';
               echo '<span class="region">TX</span> <span class="postal-mail-code">'.$options['address-mail-zip'].'</span>';
               echo '<span class="country-name"> U.S.A.</span></p>';
               echo '</div>';                             
          }                             
          echo '</div> <!-- .vcard -->';
     }
}




function show_county_directory($options) {
     // Get The County's Code to pass to web service
     // As configured on the county's setting page
        if (is_array($options))
             $countycode = (int) $options['county-name'];
                   
     //echo "county: ".$countycode;              
     require_once("includes/nusoap/nusoap.php");
                   
     //Get a handle to the webservice
     $wsdl = new nusoap_client('https://agrilifepeople.tamu.edu/applicationAPI/organizationalModule.cfc?wsdl',true);
     $proxy = $wsdl->getProxy();
    
     /*
      * This API will not be open to the public so we will be requiring all
      * applications to authenticate themselves with a validation key that is a
      * Base64 MD5 hash comprised of three data points:
      *          1. Site ID: a numeric value assigned by SDG Team for your application
      *          2. Access Key: a secure "password" usually created by the developer
      *          3. The method name being called (all lower case)
      * The hash we use is raw binary format with a length of 16 before we encode it to base64
      * Functions below are explained on PHP Manual http://php.net/manual/en/
      */

     $hash = md5('3rVj\hK{s%gB$8*pgetpersonnel',true);

     $base64 = base64_encode($hash);

    

     /*
      * Call the webservice getPersonnel method and pass in the parameters
      * All parameters are required to be passed in
      *           3 = The TECO site ID
      *           $base64 = The Hash we just created
      *          '' = blank space (new)
      *          '' = blank space (new)
      *           999 = AgriLife IT Unit number
      *          true = filter old positions
      */

     

     /*

      * Revised Fields:
      * personnelid, uin, firstname, middleinitial, lastname,
      * suffix, preferred_name, emailaddress, phonenumber, faxnumber,
      * positionid, positiontitle, percentappointment, unitid, unitname,
      * unitnumber, activestatus
      */

     

     $result = $proxy->getPersonnel(3,$base64,'','',$countycode,true);
     // Checking for a faults

     if ($proxy->fault) {
          echo '<h2>Fault</h2><pre>';
          print_r($result);
          echo '</pre>';

     } else {
          // Check for errors
          $err = $proxy->getError();

          if ($err) {
               // Display the error
               echo '<h2>Error</h2><pre>' . $err . '</pre>';

          } else {

               // Display the result
               echo "<table>";
               echo "<tr>";
               echo "<th scope=\"col\">Name</th>";
               echo "<th scope=\"col\">Title</th>";
               echo "<th scope=\"col\">Phone/Fax/Email</th>";
               echo "</tr>";
               foreach ( $result['ResultQuery']['data'] as $item ) {
                    echo "<tr>";
                    echo "<td>".$item[2]." ".$item[3]." ".$item[4]."</td>";
                    echo "<td>".$item[11]."</td>";
                    echo "<td>";
                    if($item[8]<>'')
                         preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $item[8]).'<br />';

                    if($item[9]<>'')
                         echo preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $item[9]).'<br />';

                    if($item[7]<>'')
                      echo "<a href=\"mailto:".$item[7]."\">".$item[7]."</a><br />";
                    echo "</td>";
                    echo "</tr>";

               }
               echo "</table>";

               //echo '<!-- <h2>Result</h2><pre>';
               //echo $countycode;
               //print_r($result);
               //echo '</pre>-->';

          }

     }

}



get_header(); ?>

          <div id="wrap">
               <div id="content" role="main">

               <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<div id="breadcrumbs">','</div>');
               } ?>


               <?php
               if (($options['extension_type'] == 2 || $options['extension_type'] == 3) && $isextensiononly) :
                    // For County Extension Offices
                    // This pulls from a managed staff database web service
                    if ( have_posts() ) while ( have_posts() ) : the_post();
                         county_office_info(); ?>
                        
                        
                         <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                         <h1 class="entry-title"><?php the_title(); ?></h1>                   
                              <div class="entry-content">
                                   <?php the_content(); ?>
                              </div><!-- .entry-content -->
                              <?php show_county_directory($options); ?>
                         </div><!-- #post-## -->
                    <?php endwhile; // end of the loop. ?>
                        
               <?php else:
                    // Everyone else gets info from 'Staff' custom post type ?>
                   
                    <h1 class="entry-title">Staff</h1>
                         <div class="staff-search-form">
                              <label>
                              <h4>Search Staff Database</h4>
                              </label>
                              <form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                   <input type="text" class="s" name="s" id="s" placeholder="Wilber B. Snodgrass" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
                                   <input type="hidden" name="post_type" value="staff" />
                              </form>
                         </div>

						<ul class="staff-listing-ul">
							<?php 
							$args = array(
								'post_type' => 'staff',
								'posts_per_page' => -1,
								'orderby' => 'title',
								'order' => 'ASC'
							);
							
							$my_query = new WP_Query($args);
							
							// The Loop
							while ($my_query->have_posts()) : $my_query->the_post();	
							    $my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
							    ?>
							
							     <li class="staff-listing-item">
							          <div class="role staff-container">
							          <a href="<?php the_permalink(); ?>" rel="bookmark">
							          <?php if ( has_post_thumbnail() ) {
							                 the_post_thumbnail('staff_archive');
							          } else  {
							               echo '<img src="'.get_bloginfo("template_url").'/images/AgriLife-default-staff-image.png" alt="AgriLife Logo" title="AgriLife" />';
							          }
							          ?></a>
							               <hgroup class="staff-head">
							               <h2 class="staff-title" title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php echo $my_meta['firstname'].' '.$my_meta['lastname']; ?></a></h2>
							               <h3 class="staff-position"><?php echo $my_meta['position']; ?></h3>
							               </hgroup>                                  
							               <div class="staff-contact-details">
							                    <p class="staff-phone tel"><?php echo $my_meta['phone']; ?></p>
							                    <p class="staff-email email"><a href="mailto:<?php echo $my_meta['email']; ?>"><?php echo $my_meta['email']; ?></a></p>
							               </div>
							          </div>
							          </a>
							     </li>
							 <?php endwhile; ?>
						 </ul>
                         <div class="navigation">
                              <div class="alignleft"><?php next_posts_link('Previous entries') ?></div>
                              <div class="alignright"><?php previous_posts_link('Next entries') ?></div>
                         </div>
                         <?php wp_reset_query(); ?>
         
               <?php endif;?>

               </div><!-- #content -->

          </div><!-- #wrap -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

