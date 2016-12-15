/* 
 * Expandable Searchform
 */

<div id="search" class="searchbox">
        
  <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">

    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>

    <input type="search" class="search-input"
            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

    <input type="submit" class="search-submit"
        value="" />

    <span class="icon-search"></span>
  </form> <!-- search form -->

</div> <!-- .search -->