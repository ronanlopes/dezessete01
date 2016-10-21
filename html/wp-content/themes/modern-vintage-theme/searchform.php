<?php
/**
 * The template for displaying search forms 
 *
 */
?>

<div class="box_widget_search">
      <div class="widget_search">

            <form role="search" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">

		
		
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', '' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( '', 'label', '' ); ?>">
	
	
	<!-- <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', '' ); ?>">-->
	
	
	
          </form>
      </div>
</div>