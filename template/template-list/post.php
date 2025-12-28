<?php

/**
 * The template content
 * Post type : post (default)
 * Page : List
 * URL : /news/
 * Shortcode : [GET_LIST posts_per_page="9" pagination="false" taxonomy="category"]
 **/
?>
<div class="container">
    <div class="menu-placeholder"></div>
    <div class="blog-categories mb-lg-4 mb-2 border-bottom border-gray">
        <ul id="category-menu" class="list-unstyled d-flex flex-lg-wrap container align-items-center overflow-auto overflow-lg-hidden ">
            <?php
            $categories = get_categories(array(
                'taxonomy' => 'category',
                'hide_empty' => true
            ));
            echo '<li data-category="all" class="active mx-1 my-1 fs-18 cursor-pointer white-space-nowrap me-2 me-lg-0">Tất cả</li>';
            foreach ($categories as $category) {
                echo '<li data-category="' . $category->slug . '" class=" my-1 mx-1 fs-18 cursor-pointer me-2 me-lg-0 white-space-nowrap">' . $category->name . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <div class="h-100 my-lg-4 my-2 position-relative">
            <div id="loading-spinner" style="display: none;">
                <div class="spinner"></div>
            </div>
        <div id="blog-grid" class="row position-relative">
            
        </div>
    </div>    
</div>