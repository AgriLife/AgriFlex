<?php
/**
 * Extension county-specific functions
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

/**
 * Retrieves all county names or just the selected county name
 * if ID is specified.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param int $id The county ID number
 * @return array|string All county names or the specified
 * county name.
 */
function agriflex_county_listing( $id = 0 ) {

    $counties = array(
        0 => '',
        1 => 'Anderson',
        3 => 'Andrews',
        5 => 'Angelina',
        7 => 'Aransas',
        9 => 'Archer',
        11 => 'Armstrong',
        13 => 'Atascosa',
        15 => 'Austin',
        17 => 'Bailey',
        19 => 'Bandera',
        21 => 'Bastrop',
        23 => 'Baylor',
        25 => 'Bee',
        27 => 'Bell',
        29 => 'Bexar',
        31 => 'Blanco',
        33 => 'Borden',
        35 => 'Bosque',
        37 => 'Bowie',
        39 => 'Brazoria',
        41 => 'Brazos',
        43 => 'Brewster',
        45 => 'Briscoe',
        47 => 'Brooks',
        49 => 'Brown',
        51 => 'Burleson',
        53 => 'Burnet',
        55 => 'Caldwell',
        57 => 'Calhoun',
        59 => 'Callahan',
        61 => 'Cameron',
        63 => 'Camp',
        65 => 'Carson',
        67 => 'Cass',
        69 => 'Castro',
        71 => 'Chambers',
        73 => 'Cherokee',
        75 => 'Childress',
        77 => 'Clay',
        79 => 'Cochran',
        81 => 'Coke',
        83 => 'Coleman',
        85 => 'Collin',
        87 => 'Collingsworth',
        89 => 'Colorado',
        91 => 'Comal',
        93 => 'Comanche',
        95 => 'Concho',
        97 => 'Cooke',
        99 => 'Coryell',
        101 => 'Cottle',
        103 => 'Crane',
        105 => 'Crockett',
        107 => 'Crosby',
        109 => 'Culberson',
        111 => 'Dallam County & Hartley',
        113 => 'Dallas',
        115 => 'Dawson',
        117 => 'Deaf Smith',
        119 => 'Delta',
        121 => 'Denton',
        123 => 'DeWitt',
        125 => 'Dickens',
        127 => 'Dimmit',
        129 => 'Donley',
        131 => 'Duval',
        133 => 'Eastland',
        135 => 'Ector',
        137 => 'Edwards',
        139 => 'Ellis',
        141 => 'El Paso',
        143 => 'Erath',
        145 => 'Falls',
        147 => 'Fannin',
        149 => 'Fayette',
        151 => 'Fisher',
        153 => 'Floyd',
        155 => 'Foard',
        157 => 'Fort Bend',
        159 => 'Franklin',
        161 => 'Freestone',
        163 => 'Frio',
        165 => 'Gaines',
        167 => 'Galveston',
        169 => 'Garza',
        171 => 'Gillespie',
        173 => 'Glasscock',
        175 => 'Goliad',
        177 => 'Gonzales',
        179 => 'Gray',
        181 => 'Grayson',
        183 => 'Gregg',
        185 => 'Grimes',
        187 => 'Guadalupe',
        189 => 'Hale',
        191 => 'Hall',
        193 => 'Hamilton',
        195 => 'Hansford',
        197 => 'Hardeman',
        199 => 'Hardin',
        201 => 'Harris',
        203 => 'Harrison',
        // 205 => 'Hartley',
        207 => 'Haskell',
        209 => 'Hays',
        211 => 'Hemphill',
        213 => 'Henderson',
        215 => 'Hidalgo',
        217 => 'Hill',
        219 => 'Hockley',
        221 => 'Hood',
        223 => 'Hopkins',
        225 => 'Houston',
        227 => 'Howard',
        229 => 'Hudspeth',
        231 => 'Hunt',
        233 => 'Hutchinson',
        235 => 'Irion',
        237 => 'Jack',
        239 => 'Jackson',
        241 => 'Jasper',
        243 => 'Jeff Davis',
        245 => 'Jefferson',
        247 => 'Jim Hogg',
        249 => 'Jim Wells',
        251 => 'Johnson',
        253 => 'Jones',
        255 => 'Karnes',
        257 => 'Kaufman',
        259 => 'Kendall',
        // 261 => 'Kenedy',
        263 => 'Kent',
        265 => 'Kerr',
        267 => 'Kimble',
        269 => 'King',
        271 => 'Kinney',
        273 => 'Kleberg County & Kenedy',
        275 => 'Knox',
        277 => 'Lamar',
        279 => 'Lamb',
        281 => 'Lampasas',
        283 => 'La Salle',
        285 => 'Lavaca',
        287 => 'Lee',
        289 => 'Leon',
        291 => 'Liberty',
        293 => 'Limestone',
        295 => 'Lipscomb',
        297 => 'Live Oak',
        299 => 'Llano',
        301 => 'Loving',
        303 => 'Lubbock',
        305 => 'Lynn',
        307 => 'McCulloch',
        309 => 'McLennan',
        311 => 'McMullen',
        313 => 'Madison',
        315 => 'Marion',
        317 => 'Martin',
        319 => 'Mason',
        321 => 'Matagorda',
        323 => 'Maverick',
        325 => 'Medina',
        327 => 'Menard',
        329 => 'Midland',
        331 => 'Milam',
        333 => 'Mills',
        335 => 'Mitchell',
        337 => 'Montague',
        339 => 'Montgomery',
        341 => 'Moore',
        343 => 'Morris',
        345 => 'Motley',
        347 => 'Nacogdoches',
        349 => 'Navarro',
        351 => 'Newton',
        353 => 'Nolan',
        355 => 'Nueces',
        357 => 'Ochiltree',
        359 => 'Oldham',
        361 => 'Orange',
        363 => 'Palo Pinto',
        365 => 'Panola',
        367 => 'Parker',
        369 => 'Parmer',
        371 => 'Pecos',
        373 => 'Polk',
        375 => 'Potter',
        377 => 'Presidio',
        379 => 'Rains',
        381 => 'Randall',
        383 => 'Reagan',
        385 => 'Real',
        387 => 'Red River',
        389 => 'Reeves',
        391 => 'Refugio',
        393 => 'Roberts',
        395 => 'Robertson',
        397 => 'Rockwall',
        399 => 'Runnels',
        401 => 'Rusk',
        403 => 'Sabine',
        405 => 'San Augustine',
        407 => 'San Jacinto',
        409 => 'San Patricio',
        411 => 'San Saba',
        413 => 'Schleicher',
        415 => 'Scurry',
        417 => 'Shackelford',
        419 => 'Shelby',
        421 => 'Sherman',
        423 => 'Smith',
        425 => 'Somervell',
        427 => 'Starr',
        429 => 'Stephens',
        431 => 'Sterling',
        433 => 'Stonewall',
        435 => 'Sutton',
        437 => 'Swisher',
        439 => 'Tarrant',
        441 => 'Taylor',
        443 => 'Terrell',
        445 => 'Terry',
        447 => 'Throckmorton',
        449 => 'Titus',
        451 => 'Tom Green',
        453 => 'Travis',
        455 => 'Trinity',
        457 => 'Tyler',
        459 => 'Upshur',
        461 => 'Upton',
        463 => 'Uvalde',
        465 => 'Val Verde',
        467 => 'Van Zandt',
        469 => 'Victoria',
        471 => 'Walker',
        473 => 'Waller',
        475 => 'Ward',
        477 => 'Washington',
        479 => 'Webb',
        481 => 'Wharton',
        483 => 'Wheeler',
        485 => 'Wichita',
        487 => 'Wilbarger',
        489 => 'Willacy',
        491 => 'Williamson',
        493 => 'Wilson',
        495 => 'Winkler',
        497 => 'Wise',
        499 => 'Wood',
        501 => 'Yoakum',
        503 => 'Young',
        505 => 'Zapata',
        507 => 'Zavala'
    );

    if ( $id != 0 ) {
        return $counties[$id];
    } else {
        return $counties;
    }

}

/**
 * Converts the federal county code into AG IT's new index
 *
 * @param  int $federalID The federal county code
 * @return int AG IT county code
 */
function get_IT_code( $federalID ) {
    // Translation for Federal County Code to AG IT's new index
    switch ( $federalID ) {
        case 1:
            return 1;
        case 3:
            return 2;
        case 5:
            return 3;
        case 7:
            return 4;
        case 9:
            return 5;
        case 11:
            return 6;
        case 13:
            return 7;
        case 15:
            return 8;
        case 17:
            return 9;
        case 19:
            return 10;
        case 21:
            return 11;
        case 23:
            return 12;
        case 25:
            return 13;
        case 27:
            return 14;
        case 29:
            return 15;
        case 31:
            return 16;
        case 33:
            return 17;
        case 35:
            return 18;
        case 37:
            return 19;
        case 39:
            return 20;
        case 41:
            return 21;
        case 43:
            return 22;
        case 45:
            return 23;
        case 47:
            return 24;
        case 49:
            return 25;
        case 51:
            return 26;
        case 53:
            return 27;
        case 55:
            return 28;
        case 57:
            return 29;
        case 59:
            return 30;
        case 61:
            return 31;
        case 63:
            return 32;
        case 65:
            return 33;
        case 67:
            return 34;
        case 69:
            return 35;
        case 71:
            return 36;
        case 73:
            return 37;
        case 75:
            return 38;
        case 77:
            return 39;
        case 79:
            return 40;
        case 81:
            return 41;
        case 83:
            return 42;
        case 85:
            return 43;
        case 87:
            return 44;
        case 89:
            return 45;
        case 91:
            return 46;
        case 93:
            return 47;
        case 95:
            return 48;
        case 97:
            return 49;
        case 99:
            return 50;
        case 101:
            return 51;
        case 103:
            return 52;
        case 105:
            return 53;
        case 107:
            return 54;
        case 109:
            return 55;
        case 111:
            return 56;
        case 113:
            return 57;
        case 115:
            return 58;
        case 117:
            return 59;
        case 119:
            return 79;
        case 121:
            return 60;
        case 123:
            return 61;
        case 125:
            return 62;
        case 127:
            return 63;
        case 129:
            return 64;
        case 131:
            return 65;
        case 133:
            return 66;
        case 135:
            return 67;
        case 137:
            return 68;
        case 139:
            return 69;
        case 141:
            return 70;
        case 143:
            return 71;
        case 145:
            return 72;
        case 147:
            return 73;
        case 149:
            return 74;
        case 151:
            return 75;
        case 153:
            return 76;
        case 155:
            return 77;
        case 157:
            return 78;
        case 159:
            return 79;
        case 161:
            return 80;
        case 163:
            return 81;
        case 165:
            return 82;
        case 167:
            return 83;
        case 169:
            return 84;
        case 171:
            return 85;
        case 173:
            return 86;
        case 175:
            return 87;
        case 177:
            return 88;
        case 179:
            return 89;
        case 181:
            return 90;
        case 183:
            return 91;
        case 185:
            return 92;
        case 187:
            return 93;
        case 189:
            return 94;
        case 191:
            return 95;
        case 193:
            return 96;
        case 195:
            return 97;
        case 197:
            return 98;
        case 199:
            return 99;
        case 201:
            return 100;
        case 203:
            return 101;
        case 207:
            return 102;
        case 209:
            return 103;
        case 211:
            return 104;
        case 213:
            return 105;
        case 215:
            return 106;
        case 217:
            return 107;
        case 219:
            return 108;
        case 221:
            return 109;
        case 223:
            return 110;
        case 225:
            return 111;
        case 227:
            return 112;
        case 229:
            return 113;
        case 231:
            return 114;
        case 233:
            return 115;
        case 235:
            return 116;
        case 237:
            return 117;
        case 239:
            return 118;
        case 241:
            return 119;
        case 245:
            return 120;
        case 247:
            return 121;
        case 249:
            return 122;
        case 251:
            return 123;
        case 253:
            return 124;
        case 255:
            return 125;
        case 257:
            return 126;
        case 259:
            return 127;
        case 263:
            return 128;
        case 265:
            return 129;
        case 267:
            return 130;
        case 269:
            return 131;
        case 271:
            return 132;
        case 273:
            return 133;
        case 275:
            return 134;
        case 277:
            return 135;
        case 279:
            return 136;
        case 281:
            return 137;
        case 283:
            return 138;
        case 285:
            return 139;
        case 287:
            return 140;
        case 289:
            return 141;
        case 291:
            return 142;
        case 293:
            return 143;
        case 295:
            return 144;
        case 297:
            return 145;
        case 299:
            return 146;
        case 303:
            return 147;
        case 305:
            return 148;
        case 307:
            return 149;
        case 309:
            return 150;
        case 311:
            return 151;
        case 313:
            return 152;
        case 315:
            return 153;
        case 317:
            return 154;
        case 319:
            return 155;
        case 321:
            return 156;
        case 323:
            return 157;
        case 325:
            return 158;
        case 327:
            return 159;
        case 329:
            return 160;
        case 331:
            return 161;
        case 333:
            return 162;
        case 335:
            return 163;
        case 337:
            return 164;
        case 339:
            return 165;
        case 341:
            return 166;
        case 343:
            return 167;
        case 345:
            return 168;
        case 347:
            return 169;
        case 349:
            return 170;
        case 351:
            return 171;
        case 353:
            return 172;
        case 355:
            return 173;
        case 357:
            return 174;
        case 359:
            return 175;
        case 361:
            return 176;
        case 363:
            return 177;
        case 365:
            return 178;
        case 367:
            return 179;
        case 369:
            return 180;
        case 371:
            return 181;
        case 373:
            return 182;
        case 375:
            return 183;
        case 377:
            return 184;
        case 379:
            return 185;
        case 381:
            return 186;
        case 383:
            return 187;
        case 385:
            return 188;
        case 387:
            return 189;
        case 389:
            return 190;
        case 391:
            return 191;
        case 393:
            return 192;
        case 395:
            return 193;
        case 397:
            return 194;
        case 399:
            return 195;
        case 401:
            return 196;
        case 403:
            return 197;
        case 405:
            return 198;
        case 407:
            return 199;
        case 409:
            return 200;
        case 411:
            return 201;
        case 413:
            return 202;
        case 415:
            return 203;
        case 417:
            return 204;
        case 419:
            return 205;
        case 421:
            return 206;
        case 423:
            return 207;
        case 425:
            return 208;
        case 427:
            return 209;
        case 429:
            return 210;
        case 431:
            return 211;
        case 433:
            return 212;
        case 435:
            return 213;
        case 437:
            return 214;
        case 439:
            return 215;
        case 441:
            return 216;
        case 443:
            return 217;
        case 445:
            return 218;
        case 447:
            return 219;
        case 449:
            return 220;
        case 451:
            return 221;
        case 453:
            return 222;
        case 455:
            return 223;
        case 457:
            return 224;
        case 459:
            return 225;
        case 461:
            return 226;
        case 463:
            return 227;
        case 465:
            return 228;
        case 467:
            return 229;
        case 469:
            return 230;
        case 471:
            return 231;
        case 473:
            return 232;
        case 475:
            return 233;
        case 477:
            return 234;
        case 479:
            return 235;
        case 481:
            return 236;
        case 483:
            return 237;
        case 485:
            return 238;
        case 487:
            return 239;
        case 489:
            return 240;
        case 491:
            return 241;
        case 493:
            return 242;
        case 495:
            return 243;
        case 497:
            return 244;
        case 499:
            return 245;
        case 501:
            return 246;
        case 503:
            return 247;
        case 505:
            return 248;
        case 507:
            return 249;
        case 509:
            return 250;
        case 511:
            return 251;
        case 513:
            return 252;
        case 556:
            return 253;
        case 601:
            return 254;
    }
}

// Call the webservice for units or people
function make_people_api_call( $method, $data ){

    $url = 'https://agrilifepeople.tamu.edu/api/';

    switch ($method){

        case "units" :
            $data = array_merge( array(
                'limit_to_active' =>  0,
                'entity_id' => null,
                'parent_unit_id' => null,
                'search_string' => null,
                'limited_units' => null,
                'exclude_units' => null,
            ), $data );
            break;

        case "people" :
            $data = array_merge( array(
                'person_active_status' => null,
                'restrict_to_public_only' => 1,
                'search_specializations' => null,
                'limited_units' => null,
                'limited_entity' => null,
                'limited_personnel' => null,
                'limited_roles' => null,
                'include_directory_profile' => 0,
                'include_specializations' => 1,
            ), $data );
            break;

        default: 
            exit("$function is not defined in the switch statement");
    }

    $url .= $method;

    if (!empty($data))
        $url = sprintf("%s?%s", $url, http_build_query($data));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);

        echo "<pre>Error occurred during curl exec.<br/>Additional info:<br/>";
        echo "Curl Response:<br/>";
        print_r($curl_response);
        echo "Info:<br/>";
        print_r($info);
        die('</pre>');
    }

    $response = array(
        'url' => $url,
        'json' => json_decode($curl_response, true),
        'raw' => $curl_response,
    );

    curl_close($curl);

    return $response;
}

/**
 * Grabs the county office info from AG IT's API and
 * echos it out.
 */
function county_office_info() {

    $options = of_get_option();
    $countycode = (int) $options['county-name'];
    $countycode = get_IT_code( $countycode );

    $applicationID = 3;
    $method = 'units';
    $data = array(
      'site_id' => $applicationID,
      'entity_id' => 2,
      'limited_units' => strval($countycode),
      'limit_to_active' => 0,
      'validation_key' => base64_encode( md5( $applicationID . AGRILIFE_API_KEY, true ) ),
    );

    $transientname = 'county_office';
    $transient = get_transient( $transientname );

    if(!$transient){
        set_transient( $transientname, make_people_api_call( $method, $data ), DAY_IN_SECONDS );
        $transient = get_transient( $transientname );
    }

    $results = $transient['json'];

    if( $results['status'] == 200 ){
        $dataObj = $results['units'];

        foreach ( $dataObj as $item ) {
            if( strlen( $item['physical_address_postal_code'] )>5 ) {
                $zip = str_split( $item['physical_address_postal_code'], 5 );
                if(strpos($zip[1], '-') === false && $zip[1]<>''){
                    $zip = $zip[0] . '-' . $zip[1];
                } else {
                    $zip = $zip[0] . $zip[1];
                }
            } else {
                $zip = $item['physical_address_postal_code'];
            }

            /* Show county contact info */
            echo '<div class="vcard">';
            echo '<p><a class="url fn org" href="' . $item['website'] . '">' . $item['unit_name'] . '</a></p>';

            if( $item['phone_number']<>'' ) {
                echo '<p class="tel">';
                echo '<span class="type">Office</span>: ';
                echo '<span class="value">' . preg_replace( "/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $item['phone_number'] ) . '</span>';
                echo '</p>';
            }
            if($item['fax_number']<>'') {
                echo '<p class="tel">';
                echo '<span class="type">Fax</span>: ';
                echo '<span class="value">' . preg_replace( "/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $item['fax_number'] ) . '</span>';
                echo '</p>';
            }

            echo "<div class=\"adr\">";
            echo "<p class=\"street-address\">" . $item['physical_address_1'] . '<br />';
            if($item['physical_address_2']<>'')
                echo '<span class="extended-address">' . $item['physical_address_2'] . '</span><br />';
            echo '<span class="locality">' . $item['physical_address_city'] . '</span>, ';
            echo '<span class="region">' . $item['physical_address_state'] . '</span> ';
            echo '<span class="postal-code">' . $zip . '</span>';
            echo '<br /><span class="country-name"> U.S.A.</span></p>';
            echo '</div>';

            if( $item[17] <> '' ) {
                $mzip = str_split( $item['mailing_address_postal_code'], 5);
                $mzip = $mzip[0] . '-' . $mzip[1];
                echo "<div class=\"mailing adr\">";
                echo "<p class=\"mailing-address\">" . $item['mailing_address_1'] . '<br />';
                if( $item['mailing_address_2'] <> '' )
                    echo '<span class="mailing-extended-address">' . $item['mailing_address_2'] . '</span><br />';
                echo '<span class="mailing-locality">' . $item['mailing_address_city'] . '</span>, ';
                echo '<span class="mailing-region">' . $item['mailing_address_state'] . '</span> ';
                echo '<span class="mailing-postal-code">' . $mzip . '</span>';
                echo '<br /><span class="mailing-country-name"> U.S.A.</span></p>';
                echo '</div>';
            }

            echo '<p><span class="email">' . obfuscate( $item['email_address'] ) . '</span></p>';
            echo '</div> <!-- .vcard -->';
        }
    } else {
        $return = '<h2>Error</h2><pre>' . $err . '</pre>';
    }
}

/**
 * Grabs county office employees from AG IT's API based on
 * the selected county ID and echos the result.
 */
function show_county_directory() {

    $options = of_get_option();
    $countycode = (int) $options['county-name'];
    $countycode = get_IT_code( $countycode );

    $applicationID = 3;
    $method = 'people';
    $data = array(
        'site_id' => $applicationID,
        'person_active_status' => '1',
        'restrict_to_public_only' => 1,
        'limited_units' => $countycode,
        'validation_key' => base64_encode( md5( $applicationID . AGRILIFE_API_KEY, true ) ),
    );
    $transientname = 'county_staff';
    
    $transient = get_transient( $transientname );

    try {
        if(!$transient){
            set_transient( $transientname, make_people_api_call( $method, $data ), DAY_IN_SECONDS );
            $transient = get_transient( $transientname );
        }
        $results = $transient['json'];

        if ($results['status'] == 200){
            $dataObj = $results['people'];
            $aResults = associateAPI($dataObj);

            // Format returned code.
            return $aResults;
        } else {
            return $results['status'];
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }

}


function associateAPI($aData) {

    $aReturn = array();
    $currentRow = 0;
    echo '<ul class="staff-listing-ul county-staff-list">';

    function compare_lastname($a, $b){
        return strnatcmp($a['last_name'], $b['last_name']);
    }
    usort($aData, 'compare_lastname');

    foreach ($aData as &$row){
        $aRow = array();
        echo '<li class="staff-listing-item">';
        echo '<div class="role staff-container">';
        echo '<hgroup class="staff-head">';
        echo '<h2 class="staff-title" title="' . $row['first_name'] . ' ' . $row['last_name'] . '">' . $row['first_name'] . " " . $row['last_name'] . "</h2>";  

        $jobsObj = $row['positions'];

        echo '<h3 class="staff-position">' . $jobsObj[0]['position_title'] . '</h3>';

        foreach ($jobsObj[0]['positions_roles'] as $key => $value){
            echo '<h4 class="staff-position">• ' . $value['position_role_name'] . '</h4>';
        }

        echo "</hgroup>";

        echo '<div class="staff-contact-details">';

        if( $row['phone_number'] <> '' )
            echo '<p class="staff-phone tel">' . preg_replace( "/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $row['phone_number'] ) . '</p>';
        if( $row['fax_number'] <> '' )
            echo '<p class="staff-phone fax">' . preg_replace( "/^(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $row['fax_number'] ) . ' (fax)</p>';
        if( $row['email_address'] <> '' )
            echo ' <p class="staff-email email"><a href="' . obfuscate( 'mailto:' ) . obfuscate( $row['email_address'] ) . '">' . obfuscate( $row['email_address'] ) . '</a></p>';
        echo "</div>";

        echo '</div>';
        echo '</li>';

        $aReturn[$currentRow] = $aRow;
        $currentRow++;
    }

    echo '</ul>';

    return $aReturn;
}