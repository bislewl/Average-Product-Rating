<?php

/**
 *  average_product_reviews.php
 *
 * @package
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: bislewl  8/27/2015 5:58 PM Modified in Average-Product-Rating
 */


function average_product_reviews_string($products_id)
{
    $count = average_product_reviews_count($products_id);
    $count = average_product_reviews_average($products_id);

    switch (AVG_PRODUCT_REVIEWS_STARS_TYPE) {
        case 'Images':
            $stars_string = average_product_reviews_image($average);
            break;
        case 'UTF-8':
            $stars_string = average_product_reviews_utf($average);
            break;
        case 'Font Awesome':
        default:
            $stars_string = average_product_reviews_font_awesome($average);
            break;
    }

    $reviews_string = '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
    $reviews_string .= TEXT_CURRENT_REVIEWS . '<strong><span itemprop="reviewCount">' . $count . '</span></strong><br />';
    $average_rating = zen_round($average, 2);
    $reviews_string .= TEXT_CURRENT_REVIEWS_RATING . ' <strong><span itemprop="ratingValue">' . $average_rating . '</span></strong> ' . $stars_string;
    $reviews_string .= '</span>';
    return $reviews_string;
}

/**
 * Get average review for product
 * @param products_id int
 * @return reviews average int
 */
function average_product_reviews_average($products_id) {
    global $db;
    $review = $db->Execute('SELECT AVG( reviews_rating ) AS average FROM ' . TABLE_REVIEWS . ' WHERE products_id =' . $products_id);
    return $review->fields['average'] ? round($review->fields['average'],2) : 0;
}

/**
 * Get reviews count for product id
 * @param products_id int
 * @return reviews_count int
 */
function average_product_reviews_count($products_id) {
    global $db;
    $reviews = $db->Execute("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . $products_id . "' and status = 1");
    return $reviews->fields['count'];
}

/**
 * @param $average
 * @return string
 */
function average_product_reviews_image($average)
{
    $stars_image_suffix = str_replace('.', '_', zen_round($average * 2, 0) / 2); // for stars_0_5.gif, stars_1.gif, stars_1_5.gif etc.
    $average_rating = zen_round($average, 2);
    $reviews_string = zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $stars_image_suffix . '.gif', sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $average_rating));
    return $reviews_string;
}

/**
 * @param $average
 * @return string
 */
function average_product_reviews_utf($average)
{
    $rating = (int)$average;
    $count = 0;
    $reviews_string = '';
    while ($count != $rating) {
        $reviews_string .= '&#9733';
        $count++;
    }
    $empty_count = 0;
    $neg_rating = (5 - $rating);
    while ($neg_rating != $empty_count) {
        $reviews_string .= '&#9734';
        $empty_count++;
    }
    return $reviews_string;
}

/**
 * @param $average
 * @return string
 */
function average_product_reviews_font_awesome($average)
{
    $reviews_string = '';
    $rating = zen_round($average * 2, 0) / 2;
    $full_stars = floor($rating);
    $empty_stars = 5 - ceil($rating);
    $half_stars = 5 - $full_stars - $empty_stars;
    $full_stars_count = 0;
    while ($full_stars != $full_stars_count) {
        $reviews_string .= '<i class="fa fa-star"></i>';
        $full_stars_count++;
    }
    if ($half_stars != 0) {
        $reviews_string .= '<i class="fa fa-star-half-o"></i>';
    }
    $empty_stars_count = 0;
    while ($empty_stars != $empty_stars_count) {
        $reviews_string .= '<i class="fa fa-star"></i>';
        $empty_stars_count++;
    }
    return $reviews_string;
}