<?php
/** Template name: Eat & drink */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['eat-page']);
});

$pageID = get_the_ID();
$eatFields = get_fields( $pageID );

get_header(); ?>

    <div class="banner">
        <div class="container">
        <?php if(isset($eatFields['eat_main_title']) && !empty($eatFields['eat_main_title'])) { ?>
            <h1 class=""><?php echo $eatFields['eat_main_title']; ?></h1>
        <?php } if(isset($eatFields['eat_main_subtitile']) && !empty($eatFields['eat_main_subtitile'])) { ?>
            <p><?php echo $eatFields['eat_main_subtitile']; ?></p>
        <?php } ?>
        </div>
    </div>

    <div class="products-section">
        <div class="products-types">
            <div class="swiper">
                <div class="swiper-wrapper">
                     <?php foreach ($eatFields['products'] as $key=>$product) {
                        $newImg = get_repeater_images($pageID, 'products', 'img')[$key]; ?>
                        <div class="swiper-slide item <?php echo $key === 1 ? 'active' : ''; ?>" data-type="<?php echo $key?>">
                            <img src="<?php echo wp_get_attachment_image_src($newImg, $size = 'full')[0] ?>" alt="food">
                            <div class="content">
                                <?php if(isset($product['title']) && !empty($product['title'])) { ?>
                                    <h2><?php echo $product['title'] ?></h2>
                                <?php } if(isset($product['description']) && !empty($product['description'])) { ?>
                                    <p><?php echo $product['description']; ?></p>
                                <?php } ?>
                                <div class="start-at">STARTING AT</div>
                                <?php if(isset($product['price']) && !empty($product['price'])) { ?>
                                    <div class="price">$<?php echo $product['price']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="product-types-menu">
            <?php foreach ($eatFields['products'] as $key=>$product) { ?>
                <div class="container hidden" data-type-selected="<?php echo $key ?>">
                    <div class="menu">
                        <?php foreach ($eatFields['menu_'.($key + 1)] as $item) { ?>
                            <div class="menu-item">
                            <?php if(isset($item['title']) && !empty($item['title'])) { ?>
                                <h3><?php echo $item['title']; ?>  <span><?php echo $item['price']; ?>  <?php if(isset($item['type']) && !empty($item['type'])) { ?> // <?php echo $item['type']; ?><?php } ?></span></h3>
                            <?php } if(isset($item['text']) && !empty($item['text'])) { ?>
                                <p><?php echo $item['text']; ?></p>
                            <?php } ?>
                            </div>
                         <?php } ?>
                        <?php if ($key === 1) { ?>
                            <div class="menu-item info">
                                GF = Gluten Free
                                <br>
                                <br>
                                V = Vegetarian
                            </div>
                        <?php } ?>
                    </div>
                    <div class="bottom-text">
                        <?php if(isset($eatFields['bottom_text']) && !empty($eatFields['bottom_text'])) {
                            echo $eatFields['bottom_text'];
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php
get_footer();
