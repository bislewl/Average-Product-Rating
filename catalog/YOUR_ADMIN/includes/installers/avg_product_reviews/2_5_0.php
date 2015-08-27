<?php
/*
 *
 * @package zencart_auto_installer
 * @copyright Copyright 2003-2015 ZenCart.Codes a Pro-Webs Company
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 */

// use $configuration_group_id where needed

// For Admin Pages

$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150) { // continue Zen Cart 1.5.0
    $admin_page = 'configAvgProductReviews';
    // delete configuration menu
    $db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
    // add configuration menu
    if (!zen_page_key_exists($admin_page)) {
        if ((int)$configuration_group_id > 0) {
            zen_register_admin_page($admin_page,
                'BOX_CONFIGURATION_AVERAGE_PRODUCT_REVIEWS',
                'FILENAME_CONFIGURATION',
                'gID=' . $configuration_group_id,
                'configuration',
                'Y',
                $configuration_group_id);

            $messageStack->add('Enabled Average Product Reviews Configuration Menu.', 'success');
        }
    }
}


$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description, sort_order, set_function) VALUES (" . (int)$configuration_group_id . ", 'AVG_PRODUCT_REVIEWS_STARS_TYPE', 'Stars Type', 'Font Awesome', 'For the review stars you have the choice of either using Images, Font Awesome, or UTF-8.<br/> if using Font Awesome you will need make sure you are loading it. <br/>Try using this link to get the CDN <a href=\"//www.bootstrapcdn.com/fontawesome/\">http://www.bootstrapcdn.com/fontawesome/</a>', 1, 'zen_cfg_select_option(array(\'Images\', \'Font Awesome\',\'UTF-8\'),');");

