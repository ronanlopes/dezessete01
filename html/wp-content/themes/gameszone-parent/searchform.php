<div class="widget widget_search">
    <h3 class="widget-title"><?php _e('Search widget','tfuse');?></h3>
    <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
        <label class="screen-reader-text" for="s"><?php _e('Search for:','tfuse');?>:</label>
        <input type="text" value="" placeholder="<?php _e('Search this blog','tfuse');?>" name="s" id="s" class="inputtext" />
        <button type="submit" id="searchsubmit"  class="btn btn-primary"><span class="tficon-search"></span></button>
    </form>
</div>
