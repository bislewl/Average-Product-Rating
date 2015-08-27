===============================================================================
 Èesky
===============================================================================
Použití a popis
---------------
Toto rozšíøení pøidá øádku s prùmìrným hodnocením na stránku s detaily zboží.
Prùmìrné hodnocení je vypoèteno z hodnocení pro ID aktuálního zboží a aktuální jazyk
a je zobrazeno jako èíslo zaokrouhlené na 2 desetinná místa a obrázek s hvìzdièkami hned za øádkem s poètem hodnocení.
Souèástí rozšíøení jsou nové obrázky s "pùlhvìzdièkami", aby bylo možno zobrazovat hodnocení 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5 a 5 hvìzdièek.

Jednoduchý náhled na prùmìrné hodnocení:

  Poèet hodnocení: 3
  Prùmìrné hodnocení: 3.67 ****
  
Obrázky se skuteèným vyobrazením jsou v adreáøi /screenshots/ tohoto rozšíøení.

Instalace
---------
!!! ZÁLOHUJTE !!! ZÁLOHUJTE !!! ZÁLOHUJTE !!!

Máte-li novou (neupravenou) instalaci Zen Cartu, jednoduše zkopírujte soubory z tohoto rozšíøení
do odpovídajících adresáøù vaší instalace Zen Cartu.

-- nebo --

Pokud chcete nebo potøebujete využít "override" vlastnost Zen Cartu, zkopírujte soubory z tohoto rozšíøení
  - z adresáøe /includes/languages/JAZYK/ do adresáøe VÁŠ_ZENCART_ADRESÁØ/includes/languages/JAZYK/VÁŠ_TEMPLATE/
  - z adresáøe /includes/modules/pages/ do adresáøe VÁŠ_ZENCART_ADRESÁØ/includes/modules/VÁŠ_TEMPLATE/pages/
  - z adresáøe /includes/templates/template_default/templates/ do adresáøe VÁŠ_ZENCART_ADRESÁØ/includes/templates/VÁŠ_TEMPLATE/templates/
  - z adresáøe /includes/templates/template_default/images/ do adresáøe VÁŠ_ZENCART_ADRESÁØ/includes/templates/VÁŠ_TEMPLATE/images/
    nebo si vytvoøte vlastní "pùlhvìzdièkové" obrázky odpovídající "hvìzdièkovým" obrázkùm použitým pro váš template
    
-- nebo --

Pokud již máte upravené nìkteré z výše uvedených souborù:
  1. Pro všechny soubory z adresáøe /includes/languages/czech/ tohoto rozšíøení PØIDEJTE na konec vašeho odpovídajícího souboru následující øádek

       define('TEXT_CURRENT_REVIEWS_RATING', 'Prùmìrné hodnocení:');
       
     a kvùli lepšímu pøizpùsobení volitelnì upravte øádek
       
       define('TEXT_CURRENT_REVIEWS', 'Již hodnoceno:');
       
     na
     
       define('TEXT_CURRENT_REVIEWS', 'Poèet hodnocení:');

  2. Pro všechny soubory main_template_vars.php z adresáøe /includes/modules/pages/ tohoto rozšíøení NAJDÌTE ve vašem odpovídajícím souboru øádku
  
        $reviews = $db->Execute($reviews_query);
     
     a hned za ní PØIDEJTE následující øádky
     
        $reviews_average_rating_query = "select avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r, "
                                                           . TABLE_REVIEWS_DESCRIPTION . " rd
                           where r.products_id = '" . (int)$_GET['products_id'] . "'
                           and r.reviews_id = rd.reviews_id
                           and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           $review_status;

        $reviews_average_rating = $db->Execute($reviews_average_rating_query);
        
      abyste dostali tento výsledný kód
       
        $reviews = $db->Execute($reviews_query);
     
        $reviews_average_rating_query = "select avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r, "
                                                           . TABLE_REVIEWS_DESCRIPTION . " rd
                           where r.products_id = '" . (int)$_GET['products_id'] . "'
                           and r.reviews_id = rd.reviews_id
                           and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           $review_status;

        $reviews_average_rating = $db->Execute($reviews_average_rating_query);
      }    

  3. Pro všechny souborz z adresáøe /includes/templates/template_default/templates/ tohoto rozšíøení NAJDÌTE ve vašem odpovídajícm souboru tuto øádku

       <p class="reviewCount"><?php echo ($flag_show_product_info_reviews_count == 1 ? TEXT_CURRENT_REVIEWS . ' ' . $reviews->fields['count'] : ''); ?></p>
       
     a NAHRAÏTE ji následujícími øádky
     
       <?php
         echo '<p class="reviewCount">';
         if ($flag_show_product_info_reviews_count == 1) {
           echo TEXT_CURRENT_REVIEWS . ' <strong>' . $reviews->fields['count'] . '</strong><br />';
           $stars_image_suffix = str_replace('.', '_', zen_round($reviews_average_rating->fields['average_rating'] * 2, 0) / 2); // for stars_0_5.gif, stars_1.gif, stars_1_5.gif etc.
           $average_rating = zen_round($reviews_average_rating->fields['average_rating'], 2);
           echo TEXT_CURRENT_REVIEWS_RATING . ' <strong>' . $average_rating . '</strong> ' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $stars_image_suffix . '.gif', sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $average_rating));
         } else {
           echo '';
         }
         echo '</p>';
       ?>
  
     abyste dostali tento výsledný kód
     
       <!--bof Reviews button and count-->
       <?php
         if ($flag_show_product_info_reviews == 1) {
           // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button
           if ($reviews->fields['count'] > 0 ) { ?>
       <div id="productReviewLink" class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params()) . '">' . zen_image_button(BUTTON_IMAGE_REVIEWS, BUTTON_REVIEWS_ALT) . '</a>'; ?></div>
       <br class="clearBoth" />
       <?php
         echo '<p class="reviewCount">';
         if ($flag_show_product_info_reviews_count == 1) {
           echo TEXT_CURRENT_REVIEWS . ' <strong>' . $reviews->fields['count'] . '</strong><br />';
           $stars_image_suffix = str_replace('.', '_', zen_round($reviews_average_rating->fields['average_rating'] * 2, 0) / 2); // for stars_0_5.gif, stars_1.gif, stars_1_5.gif etc.
           $average_rating = zen_round($reviews_average_rating->fields['average_rating'], 2);
           echo TEXT_CURRENT_REVIEWS_RATING . ' <strong>' . $average_rating . '</strong> ' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $stars_image_suffix . '.gif', sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $average_rating));
         } else {
           echo '';
         }
         echo '</p>';
       ?>
       <?php } else { ?>
       <div id="productReviewLink" class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array())) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></div>
       <br class="clearBoth" />
       <?php
       }
       }
       ?>
       <!--eof Reviews button and count -->     
      
Volitelná instalace
-------------------
Pro lepší svislé zarovnání obrázkù s hvìzdièkami mùžete PØIDAT následující øádky na konec souboru
/includes/templates/VÁŠ_TEMPLATE/css/stylesheet.css

  /* Average Product Rating */
  .reviewCount img {
    vertical-align: middle;
  }

Podpora
-------
Èeská podpora je poskytována výhradnì prostøednictvím fóra na www.zencart.cz

