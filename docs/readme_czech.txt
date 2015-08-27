===============================================================================
 �esky
===============================================================================
Pou�it� a popis
---------------
Toto roz���en� p�id� ��dku s pr�m�rn�m hodnocen�m na str�nku s detaily zbo��.
Pr�m�rn� hodnocen� je vypo�teno z hodnocen� pro ID aktu�ln�ho zbo�� a aktu�ln� jazyk
a je zobrazeno jako ��slo zaokrouhlen� na 2 desetinn� m�sta a obr�zek s hv�zdi�kami hned za ��dkem s po�tem hodnocen�.
Sou��st� roz���en� jsou nov� obr�zky s "p�lhv�zdi�kami", aby bylo mo�no zobrazovat hodnocen� 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5 a 5 hv�zdi�ek.

Jednoduch� n�hled na pr�m�rn� hodnocen�:

  Po�et hodnocen�: 3
  Pr�m�rn� hodnocen�: 3.67 ****
  
Obr�zky se skute�n�m vyobrazen�m jsou v adre��i /screenshots/ tohoto roz���en�.

Instalace
---------
!!! Z�LOHUJTE !!! Z�LOHUJTE !!! Z�LOHUJTE !!!

M�te-li novou (neupravenou) instalaci Zen Cartu, jednodu�e zkop�rujte soubory z tohoto roz���en�
do odpov�daj�c�ch adres��� va�� instalace Zen Cartu.

-- nebo --

Pokud chcete nebo pot�ebujete vyu��t "override" vlastnost Zen Cartu, zkop�rujte soubory z tohoto roz���en�
  - z adres��e /includes/languages/JAZYK/ do adres��e V��_ZENCART_ADRES��/includes/languages/JAZYK/V��_TEMPLATE/
  - z adres��e /includes/modules/pages/ do adres��e V��_ZENCART_ADRES��/includes/modules/V��_TEMPLATE/pages/
  - z adres��e /includes/templates/template_default/templates/ do adres��e V��_ZENCART_ADRES��/includes/templates/V��_TEMPLATE/templates/
  - z adres��e /includes/templates/template_default/images/ do adres��e V��_ZENCART_ADRES��/includes/templates/V��_TEMPLATE/images/
    nebo si vytvo�te vlastn� "p�lhv�zdi�kov�" obr�zky odpov�daj�c� "hv�zdi�kov�m" obr�zk�m pou�it�m pro v� template
    
-- nebo --

Pokud ji� m�te upraven� n�kter� z v��e uveden�ch soubor�:
  1. Pro v�echny soubory z adres��e /includes/languages/czech/ tohoto roz���en� P�IDEJTE na konec va�eho odpov�daj�c�ho souboru n�sleduj�c� ��dek

       define('TEXT_CURRENT_REVIEWS_RATING', 'Pr�m�rn� hodnocen�:');
       
     a kv�li lep��mu p�izp�soben� voliteln� upravte ��dek
       
       define('TEXT_CURRENT_REVIEWS', 'Ji� hodnoceno:');
       
     na
     
       define('TEXT_CURRENT_REVIEWS', 'Po�et hodnocen�:');

  2. Pro v�echny soubory main_template_vars.php z adres��e /includes/modules/pages/ tohoto roz���en� NAJD�TE ve va�em odpov�daj�c�m souboru ��dku
  
        $reviews = $db->Execute($reviews_query);
     
     a hned za n� P�IDEJTE n�sleduj�c� ��dky
     
        $reviews_average_rating_query = "select avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r, "
                                                           . TABLE_REVIEWS_DESCRIPTION . " rd
                           where r.products_id = '" . (int)$_GET['products_id'] . "'
                           and r.reviews_id = rd.reviews_id
                           and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           $review_status;

        $reviews_average_rating = $db->Execute($reviews_average_rating_query);
        
      abyste dostali tento v�sledn� k�d
       
        $reviews = $db->Execute($reviews_query);
     
        $reviews_average_rating_query = "select avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r, "
                                                           . TABLE_REVIEWS_DESCRIPTION . " rd
                           where r.products_id = '" . (int)$_GET['products_id'] . "'
                           and r.reviews_id = rd.reviews_id
                           and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           $review_status;

        $reviews_average_rating = $db->Execute($reviews_average_rating_query);
      }    

  3. Pro v�echny souborz z adres��e /includes/templates/template_default/templates/ tohoto roz���en� NAJD�TE ve va�em odpov�daj�cm souboru tuto ��dku

       <p class="reviewCount"><?php echo ($flag_show_product_info_reviews_count == 1 ? TEXT_CURRENT_REVIEWS . ' ' . $reviews->fields['count'] : ''); ?></p>
       
     a NAHRA�TE ji n�sleduj�c�mi ��dky
     
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
  
     abyste dostali tento v�sledn� k�d
     
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
      
Voliteln� instalace
-------------------
Pro lep�� svisl� zarovn�n� obr�zk� s hv�zdi�kami m��ete P�IDAT n�sleduj�c� ��dky na konec souboru
/includes/templates/V��_TEMPLATE/css/stylesheet.css

  /* Average Product Rating */
  .reviewCount img {
    vertical-align: middle;
  }

Podpora
-------
�esk� podpora je poskytov�na v�hradn� prost�ednictv�m f�ra na www.zencart.cz

