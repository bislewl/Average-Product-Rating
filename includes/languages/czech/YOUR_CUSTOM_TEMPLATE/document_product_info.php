<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: document_product_info.php 3027 2006-02-13 17:15:51Z drbyte $
 *
 * Modified by Pavel Palek (2P) aka Dedek (zencart@palek.net) - 2007-03-19 - Average Product Rating
 */

define('TEXT_PRODUCT_NOT_FOUND', 'Omlouváme se, ale žádné zboží nebylo nalezeno.');
define('TEXT_CURRENT_REVIEWS', 'Poèet hodnocení:');
define('TEXT_MORE_INFORMATION', 'Pro více informací o tomto zboží navštivte <a href="%s" target="_blank">domovskou stránku</a>.');
define('TEXT_DATE_ADDED', 'Toto zboží bylo pøidáno do katalogu dne %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Toto zboží bude skladem dne %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Zákazníci, kteøí koupili toto zboží, objednali také...');
define('TEXT_PRODUCT_OPTIONS', '<strong>Prosím vyberte:</strong>');
define('TEXT_PRODUCT_MANUFACTURER', 'Výrobce: ');
define('TEXT_PRODUCT_WEIGHT', 'Pøepravní váha: ');
define('TEXT_PRODUCT_QUANTITY', ' Balení skladem');
define('TEXT_PRODUCT_MODEL', 'Kód: ');



// previous next product
define('PREV_NEXT_PRODUCT', 'Zboží ');
define('PREV_NEXT_FROM', ' od ');
define('IMAGE_BUTTON_PREVIOUS','Pøedchozí položka');
define('IMAGE_BUTTON_NEXT','Další položka');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','Zpìt na seznam zboží');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', 'Nové zboží pro %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Upcoming Products');
//define('TABLE_HEADING_DATE_EXPECTED', 'Date Expected');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [byla: ');
define('TEXT_ATTRIBUTE_IS_FREE',' nyní je: zdarma]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' Jednorázové poplatky lze použít');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Množstevní slevy dostupné');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');

define('TEXT_CURRENT_REVIEWS_RATING', 'Prùmìrné hodnocení:'); // 2P added - Average Product Rating
?>