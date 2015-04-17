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

define('TEXT_PRODUCT_NOT_FOUND', 'Omlouv�me se, ale ��dn� zbo�� nebylo nalezeno.');
define('TEXT_CURRENT_REVIEWS', 'Po�et hodnocen�:');
define('TEXT_MORE_INFORMATION', 'Pro v�ce informac� o tomto zbo�� nav�tivte <a href="%s" target="_blank">domovskou str�nku</a>.');
define('TEXT_DATE_ADDED', 'Toto zbo�� bylo p�id�no do katalogu dne %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Toto zbo�� bude skladem dne %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Z�kazn�ci, kte�� koupili toto zbo��, objednali tak�...');
define('TEXT_PRODUCT_OPTIONS', '<strong>Pros�m vyberte:</strong>');
define('TEXT_PRODUCT_MANUFACTURER', 'V�robce: ');
define('TEXT_PRODUCT_WEIGHT', 'P�epravn� v�ha: ');
define('TEXT_PRODUCT_QUANTITY', ' Balen� skladem');
define('TEXT_PRODUCT_MODEL', 'K�d: ');



// previous next product
define('PREV_NEXT_PRODUCT', 'Zbo�� ');
define('PREV_NEXT_FROM', ' od ');
define('IMAGE_BUTTON_PREVIOUS','P�edchoz� polo�ka');
define('IMAGE_BUTTON_NEXT','Dal�� polo�ka');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','Zp�t na seznam zbo��');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', 'Nov� zbo�� pro %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Upcoming Products');
//define('TABLE_HEADING_DATE_EXPECTED', 'Date Expected');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [byla: ');
define('TEXT_ATTRIBUTE_IS_FREE',' nyn� je: zdarma]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' Jednor�zov� poplatky lze pou��t');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Mno�stevn� slevy dostupn�');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');

define('TEXT_CURRENT_REVIEWS_RATING', 'Pr�m�rn� hodnocen�:'); // 2P added - Average Product Rating
?>