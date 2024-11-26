<?php

class RALHelper{

    protected $ral_colours = [
        '1000' => array(
            'rgb'	=> '190,189,127',
            'name'	=> 'Green Beige',
            'text'	=> '000,000,000'
        ),
        '1001' => array(
            'rgb'	=> '194,176,120',
            'name'	=> 'Beige',
            'text'	=> '000,000,000'
        ),
        '1002' => array(
            'rgb'	=> '198,166,100',
            'name'	=> 'Sand Yellow',
            'text'	=> '000,000,000'
        ),
        '1003' => array(
            'rgb'	=> '229,190,001',
            'name'	=> 'Signal Yellow',
            'text'	=> '000,000,000'
        ),
        '1004' => array(
            'rgb'	=> '205,164,052',
            'name'	=> 'Golden Yellow',
            'text'	=> '000,000,000'
        ),
        '1005' => array(
            'rgb'	=> '169,131,007',
            'name'	=> 'Honey Yellow',
            'text'	=> '000,000,000'
        ),
        '1006' => array(
            'rgb'	=> '228,160,016',
            'name'	=> 'Maize Yellow',
            'text'	=> '000,000,000'
        ),
        '1007' => array(
            'rgb'	=> '220,156,000',
            'name'	=> 'Daffodil Yellow',
            'text'	=> '000,000,000'
        ),
        '1011' => array(
            'rgb'	=> '138,102,066',
            'name'	=> 'Brown Beige',
            'text'	=> '255,255,255'
        ),
        '1012' => array(
            'rgb'	=> '199,180,070',
            'name'	=> 'Lemon Yellow',
            'text'	=> '000,000,000'
        ),
        '1013' => array(
            'rgb'	=> '234,230,202',
            'name'	=> 'Oyster White',
            'text'	=> '000,000,000'
        ),
        '1014' => array(
            'rgb'	=> '225,204,079',
            'name'	=> 'Ivory',
            'text'	=> '000,000,000'
        ),
        '1015' => array(
            'rgb'	=> '230,214,144 ',
            'name'	=> 'Light ivory',
            'text'	=> '000,000,000'
        ),
        '1016' => array(
            'rgb'	=> '237,255,033',
            'name'	=> 'Sulfur Yellow',
            'text'	=> '000,000,000'
        ),
        '1017' => array(
            'rgb'	=> '245,208,051',
            'name'	=> 'Saffron Yellow',
            'text'	=> '000,000,000'
        ),
        '1018' => array(
            'rgb'	=> '248,243,053',
            'name'	=> 'Zinc Yellow',
            'text'	=> '000,000,000'
        ),
        '1019' => array(
            'rgb'	=> '158,151,100',
            'name'	=> 'Grey Beige',
            'text'	=> '000,000,000'
        ),
        '1020' => array(
            'rgb'	=> '153,153,080',
            'name'	=> 'Olive Yellow',
            'text'	=> '000,000,000'
        ),
        '1021' => array(
            'rgb'	=> '243,218,011',
            'name'	=> 'Rape Yellow',
            'text'	=> '000,000,000'
        ),
        '1023' => array(
            'rgb'	=> '250,210,001',
            'name'	=> 'Traffic Yellow',
            'text'	=> '000,000,000'
        ),
        '1024' => array(
            'rgb'	=> '174,160,075',
            'name'	=> 'Ochre Yellow',
            'text'	=> '000,000,000'
        ),
        '1026' => array(
            'rgb'	=> '255,255,000',
            'name'	=> 'Luminous Yellow',
            'text'	=> '000,000,000'
        ),
        '1027' => array(
            'rgb'	=> '157,145,001',
            'name'	=> 'Curry',
            'text'	=> '000,000,000'
        ),
        '1028' => array(
            'rgb'	=> '244,169,000',
            'name'	=> 'Melon Yellow',
            'text'	=> '000,000,000'
        ),
        '1032' => array(
            'rgb'	=> '214,174,001',
            'name'	=> 'Broom Yellow',
            'text'	=> '000,000,000'
        ),
        '1033' => array(
            'rgb'	=> '243,165,005',
            'name'	=> 'Dahlia Yellow',
            'text'	=> '000,000,000'
        ),
        '1034' => array(
            'rgb'	=> '239,169,074',
            'name'	=> 'Pastel Yellow',
            'text'	=> '000,000,000'
        ),
        '1035' => array(
            'rgb'	=> '106,093,077',
            'name'	=> 'Pearl Beige',
            'text'	=> '255,255,255'
        ),
        '1036' => array(
            'rgb'	=> '112,083,053',
            'name'	=> 'Pearl gold',
            'text'	=> '255,255,255'
        ),
        '1037' => array(
            'rgb'	=> '243,159,024',
            'name'	=> 'Sun Yellow',
            'text'	=> '000,000,000'
        ),
        '2000' => array(
            'rgb'	=> '237,118,014',
            'name'	=> 'Yellow Orange',
            'text'	=> '000,000,000'
        ),
        '2001' => array(
            'rgb'	=> '201,060,032',
            'name'	=> 'Red Orange',
            'text'	=> '255,255,255'
        ),
        '2002' => array(
            'rgb'	=> '203,040,033',
            'name'	=> 'Vermilion',
            'text'	=> '255,255,255'
        ),
        '2003' => array(
            'rgb'	=> '255,117,020',
            'name'	=> 'Pastel Orange',
            'text'	=> '000,000,000'
        ),
        '2004' => array(
            'rgb'	=> '244,070,017',
            'name'	=> 'Pure Orange',
            'text'	=> '000,000,000'
        ),
        '2005' => array(
            'rgb'	=> '255,035,001',
            'name'	=> 'Luminous Orange',
            'text'	=> '000,000,000'
        ),
        '2007' => array(
            'rgb'	=> '255,164,032',
            'name'	=> 'Luminous Bright Orange',
            'text'	=> '000,000,000'
        ),
        '2008' => array(
            'rgb'	=> '247,094,037',
            'name'	=> 'Bright Red Orange',
            'text'	=> '000,000,000'
        ),
        '2009' => array(
            'rgb'	=> '245,064,033',
            'name'	=> 'Traffic Orange',
            'text'	=> '000,000,000'
        ),
        '2010' => array(
            'rgb'	=> '216,075,032',
            'name'	=> 'Signal Orange',
            'text'	=> '000,000,000'
        ),
        '2011' => array(
            'rgb'	=> '236,124,038',
            'name'	=> 'Deep Orange',
            'text'	=> '000,000,000'
        ),
        '2012' => array(
            'rgb'	=> '235,106,014',
            'name'	=> 'Salmon Orange',
            'text'	=> '000,000,000'
        ),
        '2013' => array(
            'rgb'	=> '195,088,049',
            'name'	=> 'Pearl Orange',
            'text'	=> '255,255,255'
        ),
        '3000' => array(
            'rgb'	=> '175,043,030',
            'name'	=> 'Flame Red',
            'text'	=> '255,255,255'
        ),
        '3001' => array(
            'rgb'	=> '165,032,025',
            'name'	=> 'Signal Red',
            'text'	=> '255,255,255'
        ),
        '3002' => array(
            'rgb'	=> '162,035,029',
            'name'	=> 'Carmine Red',
            'text'	=> '255,255,255'
        ),
        '3003' => array(
            'rgb'	=> '155,017,030',
            'name'	=> 'Ruby Red',
            'text'	=> '255,255,255'
        ),
        '3004' => array(
            'rgb'	=> '117,021,030',
            'name'	=> 'Purple Red',
            'text'	=> '255,255,255'
        ),
        '3005' => array(
            'rgb'	=> '094,033,041',
            'name'	=> 'Wine Red',
            'text'	=> '255,255,255'
        ),
        '3007' => array(
            'rgb'	=> '065,034,039',
            'name'	=> 'Black Red',
            'text'	=> '255,255,255'
        ),
        '3009' => array(
            'rgb'	=> '100,036,036',
            'name'	=> 'Oxide Red',
            'text'	=> '255,255,255'
        ),
        '3011' => array(
            'rgb'	=> '120,031,025',
            'name'	=> 'Brown Red',
            'text'	=> '255,255,255'
        ),
        '3012' => array(
            'rgb'	=> '193,135,107',
            'name'	=> 'Beige Red',
            'text'	=> '000,000,000'
        ),
        '3013' => array(
            'rgb'	=> '161,035,018',
            'name'	=> 'Tomato Red',
            'text'	=> '255,255,255'
        ),
        '3014' => array(
            'rgb'	=> '211,110,112',
            'name'	=> 'Antique Pink',
            'text'	=> '000,000,000'
        ),
        '3015' => array(
            'rgb'	=> '234,137,154',
            'name'	=> 'Light Pink',
            'text'	=> '000,000,000'
        ),
        '3016' => array(
            'rgb'	=> '179,040,033',
            'name'	=> 'CoRed',
            'text'	=> '255,255,255'
        ),
        '3017' => array(
            'rgb'	=> '230,050,068',
            'name'	=> 'Rose',
            'text'	=> '000,000,000'
        ),
        '3018' => array(
            'rgb'	=> '213,48,50',
            'name'	=> 'Strawberry Red',
            'text'	=> '255,255,255'
        ),
        '3020' => array(
            'rgb'	=> '204,006,005',
            'name'	=> 'Traffic Red',
            'text'	=> '255,255,255'
        ),
        '3022' => array(
            'rgb'	=> '217,080,048',
            'name'	=> 'Salmon Pink',
            'text'	=> '000,000,000'
        ),
        '3024' => array(
            'rgb'	=> '248,000,000',
            'name'	=> 'Luminous Red',
            'text'	=> '000,000,000'
        ),
        '3026' => array(
            'rgb'	=> '254,000,000',
            'name'	=> 'Luminous Bright Red',
            'text'	=> '000,000,000'
        ),
        '3027' => array(
            'rgb'	=> '197,029,052',
            'name'	=> 'Raspberry Red',
            'text'	=> '255,255,255'
        ),
        '3028' => array(
            'rgb'	=> '203,050,052',
            'name'	=> 'Pure Red',
            'text'	=> '255,255,255'
        ),
        '3031' => array(
            'rgb'	=> '179,036,040',
            'name'	=> 'Orient Red',
            'text'	=> '255,255,255'
        ),
        '3032' => array(
            'rgb'	=> '114,020,034',
            'name'	=> 'Pearl Ruby Red',
            'text'	=> '255,255,255'
        ),
        '3033' => array(
            'rgb'	=> '180,076,067',
            'name'	=> 'Pearl Pink',
            'text'	=> '255,255,255'
        ),
        '4001' => array(
            'rgb'	=> '222,076,138',
            'name'	=> 'Red Lilac',
            'text'	=> '000,000,000'
        ),
        '4002' => array(
            'rgb'	=> '146,043,062',
            'name'	=> 'Red Violet',
            'text'	=> '255,255,255'
        ),
        '4003' => array(
            'rgb'	=> '222,076,138',
            'name'	=> 'Heather Violet',
            'text'	=> '000,000,000'
        ),
        '4004' => array(
            'rgb'	=> '110,028,052',
            'name'	=> 'Claret Violet',
            'text'	=> '255,255,255'
        ),
        '4005' => array(
            'rgb'	=> '108,070,117',
            'name'	=> 'Blue Lilac',
            'text'	=> '255,255,255'
        ),
        '4006' => array(
            'rgb'	=> '160,052,114',
            'name'	=> 'Traffic Purple',
            'text'	=> '255,255,255'
        ),
        '4007' => array(
            'rgb'	=> '074,025,044',
            'name'	=> 'Purple Violet',
            'text'	=> '255,255,255'
        ),
        '4008' => array(
            'rgb'	=> '146,078,125',
            'name'	=> 'Signal Violet',
            'text'	=> '255,255,255'
        ),
        '4009' => array(
            'rgb'	=> '164,125,144',
            'name'	=> 'Pastel Violet',
            'text'	=> '000,000,000'
        ),
        '4010' => array(
            'rgb'	=> '215,045,109',
            'name'	=> 'Telemagenta',
            'text'	=> '255,255,255'
        ),
        '4011' => array(
            'rgb'	=> '134,115,161',
            'name'	=> 'Pearl Violet',
            'text'	=> '255,255,255'
        ),
        '4012' => array(
            'rgb'	=> '108,104,129',
            'name'	=> 'Pearl Black berry',
            'text'	=> '255,255,255'
        ),
        '5000' => array(
            'rgb'	=> '042,046,075',
            'name'	=> 'Violet Blue',
            'text'	=> '255,255,255'
        ),
        '5001' => array(
            'rgb'	=> '031,052,056',
            'name'	=> 'Green Blue',
            'text'	=> '255,255,255'
        ),
        '5002' => array(
            'rgb'	=> '032,033,079',
            'name'	=> 'Ultramarine Blue',
            'text'	=> '255,255,255'
        ),
        '5003' => array(
            'rgb'	=> '029,030,051',
            'name'	=> 'Saphire Blue',
            'text'	=> '255,255,255'
        ),
        '5004' => array(
            'rgb'	=> '032,033,079',
            'name'	=> 'Black Blue',
            'text'	=> '255,255,255'
        ),
        '5005' => array(
            'rgb'	=> '030,045,110',
            'name'	=> 'Signal Blue',
            'text'	=> '255,255,255'
        ),
        '5007' => array(
            'rgb'	=> '062,095,138',
            'name'	=> 'Brillant Blue',
            'text'	=> '255,255,255'
        ),
        '5008' => array(
            'rgb'	=> '038,037,045',
            'name'	=> 'Grey Blue',
            'text'	=> '255,255,255'
        ),
        '5009' => array(
            'rgb'	=> '002,086,105',
            'name'	=> 'Azure Blue',
            'text'	=> '255,255,255'
        ),
        '5010' => array(
            'rgb'	=> '014,041,075',
            'name'	=> 'Gentian Blue',
            'text'	=> '255,255,255'
        ),
        '5011' => array(
            'rgb'	=> '035,026,036',
            'name'	=> 'Steel Blue',
            'text'	=> '255,255,255'
        ),
        '5012' => array(
            'rgb'	=> '059,131,189',
            'name'	=> 'Light Blue',
            'text'	=> '255,255,255'
        ),
        '5013' => array(
            'rgb'	=> '037,041,074',
            'name'	=> 'Cobalt Blue',
            'text'	=> '255,255,255'
        ),
        '5014' => array(
            'rgb'	=> '096,111,140',
            'name'	=> 'Pigeon Blue',
            'text'	=> '255,255,255'
        ),
        '5015' => array(
            'rgb'	=> '034,113,179',
            'name'	=> 'Sky Blue',
            'text'	=> '255,255,255'
        ),
        '5017' => array(
            'rgb'	=> '006,057,113',
            'name'	=> 'Traffic Blue',
            'text'	=> '255,255,255'
        ),
        '5018' => array(
            'rgb'	=> '063,136,143',
            'name'	=> 'Turquoise Blue',
            'text'	=> '255,255,255'
        ),
        '5019' => array(
            'rgb'	=> '027,085,131',
            'name'	=> 'Capri Blue',
            'text'	=> '255,255,255'
        ),
        '5020' => array(
            'rgb'	=> '029,051,074',
            'name'	=> 'Ocean Blue',
            'text'	=> '255,255,255'
        ),
        '5021' => array(
            'rgb'	=> '037,109,123',
            'name'	=> 'Water Blue',
            'text'	=> '255,255,255'
        ),
        '5022' => array(
            'rgb'	=> '037,040,080',
            'name'	=> 'Night Blue',
            'text'	=> '255,255,255'
        ),
        '5023' => array(
            'rgb'	=> '073,103,141',
            'name'	=> 'Distant Blue',
            'text'	=> '255,255,255'
        ),
        '5024' => array(
            'rgb'	=> '093,155,155',
            'name'	=> 'Pastel Blue',
            'text'	=> '000,000,000'
        ),
        '5025' => array(
            'rgb'	=> '042,100,120',
            'name'	=> 'Pearl Gentian Blue',
            'text'	=> '255,255,255'
        ),
        '5026' => array(
            'rgb'	=> '016,044,084',
            'name'	=> 'Pearl night Blue',
            'text'	=> '255,255,255'
        ),
        '6000' => array(
            'rgb'	=> '049,102,080',
            'name'	=> 'Patina Green',
            'text'	=> '255,255,255'
        ),
        '6001' => array(
            'rgb'	=> '040,114,051',
            'name'	=> 'Emerald Green',
            'text'	=> '255,255,255'
        ),
        '6002' => array(
            'rgb'	=> '045,087,044',
            'name'	=> 'Leaf Green',
            'text'	=> '255,255,255'
        ),
        '6003' => array(
            'rgb'	=> '066,070,050',
            'name'	=> 'Olive Green',
            'text'	=> '255,255,255'
        ),
        '6004' => array(
            'rgb'	=> '031,058,061',
            'name'	=> 'Blue Green',
            'text'	=> '255,255,255'
        ),
        '6005' => array(
            'rgb'	=> '047,069,056',
            'name'	=> 'Moss Green',
            'text'	=> '255,255,255'
        ),
        '6006' => array(
            'rgb'	=> '062,059,050',
            'name'	=> 'Grey Olive',
            'text'	=> '255,255,255'
        ),
        '6007' => array(
            'rgb'	=> '052,059,041',
            'name'	=> 'Bottle Green',
            'text'	=> '255,255,255'
        ),
        '6008' => array(
            'rgb'	=> '057,053,042',
            'name'	=> 'Brown Green',
            'text'	=> '255,255,255'
        ),
        '6009' => array(
            'rgb'	=> '049,055,043',
            'name'	=> 'Fir Green',
            'text'	=> '255,255,255'
        ),
        '6010' => array(
            'rgb'	=> '053,104,045',
            'name'	=> 'Grass Green',
            'text'	=> '255,255,255'
        ),
        '6011' => array(
            'rgb'	=> '088,114,070',
            'name'	=> 'Reseda Green',
            'text'	=> '255,255,255'
        ),
        '6012' => array(
            'rgb'	=> '052,062,064',
            'name'	=> 'Black Green',
            'text'	=> '255,255,255'
        ),
        '6013' => array(
            'rgb'	=> '108,113,086',
            'name'	=> 'Reed Green',
            'text'	=> '255,255,255'
        ),
        '6014' => array(
            'rgb'	=> '071,064,046',
            'name'	=> 'Yellow Olive',
            'text'	=> '255,255,255'
        ),
        '6015' => array(
            'rgb'	=> '059,060,054',
            'name'	=> 'Black Olive',
            'text'	=> '255,255,255'
        ),
        '6016' => array(
            'rgb'	=> '030,089,069',
            'name'	=> 'Turquoise Green',
            'text'	=> '255,255,255'
        ),
        '6017' => array(
            'rgb'	=> '076,145,065',
            'name'	=> 'May Green',
            'text'	=> '255,255,255'
        ),
        '6018' => array(
            'rgb'	=> '087,166,057',
            'name'	=> 'Yellow Green',
            'text'	=> '000,000,000'
        ),
        '6019' => array(
            'rgb'	=> '189,236,182',
            'name'	=> 'Pastel Green',
            'text'	=> '000,000,000'
        ),
        '6020' => array(
            'rgb'	=> '046,058,035',
            'name'	=> 'Chrome Green',
            'text'	=> '255,255,255'
        ),
        '6021' => array(
            'rgb'	=> '137,172,118',
            'name'	=> 'Pale Green',
            'text'	=> '000,000,000'
        ),
        '6022' => array(
            'rgb'	=> '037,034,027',
            'name'	=> 'Olive Drab',
            'text'	=> '255,255,255'
        ),
        '6024' => array(
            'rgb'	=> '048,132,070',
            'name'	=> 'Traffic Green',
            'text'	=> '255,255,255'
        ),
        '6025' => array(
            'rgb'	=> '061,100,045',
            'name'	=> 'Fern Green',
            'text'	=> '255,255,255'
        ),
        '6026' => array(
            'rgb'	=> '001,093,082',
            'name'	=> 'Opal Green',
            'text'	=> '255,255,255'
        ),
        '6027' => array(
            'rgb'	=> '132,195,190',
            'name'	=> 'Light Green',
            'text'	=> '000,000,000'
        ),
        '6028' => array(
            'rgb'	=> '044,085,069',
            'name'	=> 'Pine Green',
            'text'	=> '255,255,255'
        ),
        '6029' => array(
            'rgb'	=> '032,096,061',
            'name'	=> 'Mint Green',
            'text'	=> '255,255,255'
        ),
        '6032' => array(
            'rgb'	=> '049,127,067',
            'name'	=> 'Signal Green',
            'text'	=> '255,255,255'
        ),
        '6033' => array(
            'rgb'	=> '073,126,118',
            'name'	=> 'Mint Turquoise',
            'text'	=> '255,255,255'
        ),
        '6034' => array(
            'rgb'	=> '127,181,181',
            'name'	=> 'Pastel Turquoise',
            'text'	=> '000,000,000'
        ),
        '6035' => array(
            'rgb'	=> '028,084,045',
            'name'	=> 'Pearl Green',
            'text'	=> '255,255,255'
        ),
        '6036' => array(
            'rgb'	=> '022,053,055',
            'name'	=> 'Pearl Opal Green',
            'text'	=> '255,255,255'
        ),
        '6037' => array(
            'rgb'	=> '000,143,057',
            'name'	=> 'Pure Green',
            'text'	=> '255,255,255'
        ),
        '6038' => array(
            'rgb'	=> '000,187,045',
            'name'	=> 'Luminous Green',
            'text'	=> '000,000,000'
        ),
        '7000' => array(
            'rgb'	=> '120,133,139',
            'name'	=> 'Squirrel Grey',
            'text'	=> '255,255,255'
        ),
        '7001' => array(
            'rgb'	=> '138,149,151',
            'name'	=> 'Silver Grey',
            'text'	=> '000,000,000'
        ),
        '7002' => array(
            'rgb'	=> '126,123,082',
            'name'	=> 'Olive Grey',
            'text'	=> '255,255,255'
        ),
        '7003' => array(
            'rgb'	=> '108,112,089',
            'name'	=> 'Moss Grey',
            'text'	=> '255,255,255'
        ),
        '7004' => array(
            'rgb'	=> '150,153,146',
            'name'	=> 'Signal Grey',
            'text'	=> '000,000,000'
        ),
        '7005' => array(
            'rgb'	=> '100,107,099',
            'name'	=> 'Mouse Grey',
            'text'	=> '255,255,255'
        ),
        '7006' => array(
            'rgb'	=> '109,101,082',
            'name'	=> 'Beige Grey',
            'text'	=> '255,255,255'
        ),
        '7008' => array(
            'rgb'	=> '106,095,049',
            'name'	=> 'Khaki Grey',
            'text'	=> '255,255,255'
        ),
        '7009' => array(
            'rgb'	=> '077,086,069',
            'name'	=> 'Green Grey',
            'text'	=> '255,255,255'
        ),
        '7010' => array(
            'rgb'	=> '076,081,074',
            'name'	=> 'Tarpaulin Grey',
            'text'	=> '255,255,255'
        ),
        '7011' => array(
            'rgb'	=> '067,075,077',
            'name'	=> 'Iron Grey',
            'text'	=> '255,255,255'
        ),
        '7012' => array(
            'rgb'	=> '078,087,084',
            'name'	=> 'Basalt Grey',
            'text'	=> '255,255,255'
        ),
        '7013' => array(
            'rgb'	=> '070,069,049',
            'name'	=> 'Brown Grey',
            'text'	=> '255,255,255'
        ),
        '7015' => array(
            'rgb'	=> '067,071,080',
            'name'	=> 'Slate Grey',
            'text'	=> '255,255,255'
        ),
        '7016' => array(
            'rgb'	=> '041,049,051',
            'name'	=> 'Anthracite Grey',
            'text'	=> '255,255,255'
        ),
        '7021' => array(
            'rgb'	=> '035,040,043',
            'name'	=> 'Black Grey',
            'text'	=> '255,255,255'
        ),
        '7022' => array(
            'rgb'	=> '051,047,044',
            'name'	=> 'Umbra Grey',
            'text'	=> '255,255,255'
        ),
        '7023' => array(
            'rgb'	=> '104,108,094',
            'name'	=> 'Concrete Grey',
            'text'	=> '255,255,255'
        ),
        '7024' => array(
            'rgb'	=> '071,074,081',
            'name'	=> 'Graphite Grey',
            'text'	=> '255,255,255'
        ),
        '7026' => array(
            'rgb'	=> '047,053,059',
            'name'	=> 'Granite Grey',
            'text'	=> '255,255,255'
        ),
        '7030' => array(
            'rgb'	=> '139,140,122',
            'name'	=> 'Stone Grey',
            'text'	=> '000,000,000'
        ),
        '7031' => array(
            'rgb'	=> '071,075,078',
            'name'	=> 'Blue Grey',
            'text'	=> '255,255,255'
        ),
        '7032' => array(
            'rgb'	=> '184,183,153',
            'name'	=> 'Pebble Grey',
            'text'	=> '000,000,000'
        ),
        '7033' => array(
            'rgb'	=> '125,132,113',
            'name'	=> 'Cement Grey',
            'text'	=> '255,255,255'
        ),
        '7034' => array(
            'rgb'	=> '143,139,102',
            'name'	=> 'Yellow Grey',
            'text'	=> '000,000,000'
        ),
        '7035' => array(
            'rgb'	=> '215,215,215',
            'name'	=> 'Light Grey',
            'text'	=> '000,000,000'
        ),
        '7036' => array(
            'rgb'	=> '127,118,121',
            'name'	=> 'Platinum Grey',
            'text'	=> '255,255,255'
        ),
        '7037' => array(
            'rgb'	=> '125,127,120',
            'name'	=> 'Dusty Grey',
            'text'	=> '255,255,255'
        ),
        '7038' => array(
            'rgb'	=> '195,195,195',
            'name'	=> 'Agate Grey',
            'text'	=> '000,000,000'
        ),
        '7039' => array(
            'rgb'	=> '108,105,096',
            'name'	=> 'Quartz Grey',
            'text'	=> '255,255,255'
        ),
        '7040' => array(
            'rgb'	=> '157,161,170',
            'name'	=> 'Window Grey',
            'text'	=> '000,000,000'
        ),
        '7042' => array(
            'rgb'	=> '141,148,141',
            'name'	=> 'Traffic Grey A',
            'text'	=> '000,000,000'
        ),
        '7043' => array(
            'rgb'	=> '078,084,082',
            'name'	=> 'Traffic Grey B',
            'text'	=> '255,255,255'
        ),
        '7044' => array(
            'rgb'	=> '202,196,176',
            'name'	=> 'Silk Grey',
            'text'	=> '000,000,000'
        ),
        '7045' => array(
            'rgb'	=> '144,144,144',
            'name'	=> 'TeleGrey 1',
            'text'	=> '000,000,000'
        ),
        '7046' => array(
            'rgb'	=> '130,137,143',
            'name'	=> 'TeleGrey 2',
            'text'	=> '000,000,000'
        ),
        '7047' => array(
            'rgb'	=> '208,208,208',
            'name'	=> 'TeleGrey 4',
            'text'	=> '000,000,000'
        ),
        '7048' => array(
            'rgb'	=> '137,129,118',
            'name'	=> 'Pearl mouse Grey',
            'text'	=> '000,000,000'
        ),
        '8000' => array(
            'rgb'	=> '130,108,052',
            'name'	=> 'Green Brown',
            'text'	=> '255,255,255'
        ),
        '8001' => array(
            'rgb'	=> '149,095,032',
            'name'	=> 'Ochre Brown',
            'text'	=> '255,255,255'
        ),
        '8002' => array(
            'rgb'	=> '108,059,042',
            'name'	=> 'Signal Brown',
            'text'	=> '255,255,255'
        ),
        '8003' => array(
            'rgb'	=> '115,066,034',
            'name'	=> 'Clay Brown',
            'text'	=> '255,255,255'
        ),
        '8004' => array(
            'rgb'	=> '142,064,042',
            'name'	=> 'Copper Brown',
            'text'	=> '255,255,255'
        ),
        '8007' => array(
            'rgb'	=> '089,053,031',
            'name'	=> 'Fawn Brown',
            'text'	=> '255,255,255'
        ),
        '8008' => array(
            'rgb'	=> '111,079,040',
            'name'	=> 'Olive Brown',
            'text'	=> '255,255,255'
        ),
        '8011' => array(
            'rgb'	=> '091,058,041',
            'name'	=> 'Nut Brown',
            'text'	=> '255,255,255'
        ),
        '8012' => array(
            'rgb'	=> '089,035,033',
            'name'	=> 'Red Brown',
            'text'	=> '255,255,255'
        ),
        '8014' => array(
            'rgb'	=> '056,044,030',
            'name'	=> 'Sepia Brown',
            'text'	=> '255,255,255'
        ),
        '8015' => array(
            'rgb'	=> '099,058,052',
            'name'	=> 'Chestnut Brown',
            'text'	=> '255,255,255'
        ),
        '8016' => array(
            'rgb'	=> '076,047,039',
            'name'	=> 'Mahogany Brown',
            'text'	=> '255,255,255'
        ),
        '8017' => array(
            'rgb'	=> '069,050,046',
            'name'	=> 'Chocolate Brown',
            'text'	=> '255,255,255'
        ),
        '8019' => array(
            'rgb'	=> '064,058,058',
            'name'	=> 'Grey Brown',
            'text'	=> '255,255,255'
        ),
        '8022' => array(
            'rgb'	=> '033,033,033',
            'name'	=> 'Black Brown',
            'text'	=> '255,255,255'
        ),
        '8023' => array(
            'rgb'	=> '166,094,046',
            'name'	=> 'Orange Brown',
            'text'	=> '255,255,255'
        ),
        '8024' => array(
            'rgb'	=> '121,085,061',
            'name'	=> 'Beige Brown',
            'text'	=> '255,255,255'
        ),
        '8025' => array(
            'rgb'	=> '117,092,072',
            'name'	=> 'Pale Brown',
            'text'	=> '255,255,255'
        ),
        '8028' => array(
            'rgb'	=> '078,059,049',
            'name'	=> 'Terra Brown',
            'text'	=> '255,255,255'
        ),
        '8029' => array(
            'rgb'	=> '118,060,040',
            'name'	=> 'Pearl Copper',
            'text'	=> '255,255,255'
        ),
        '9001' => array(
            'rgb'	=> '250,244,227',
            'name'	=> 'Cream',
            'text'	=> '000,000,000'
        ),
        '9002' => array(
            'rgb'	=> '231,235,218',
            'name'	=> 'Grey White',
            'text'	=> '000,000,000'
        ),
        '9003' => array(
            'rgb'	=> '244,244,244',
            'name'	=> 'Signal White',
            'text'	=> '000,000,000'
        ),
        '9004' => array(
            'rgb'	=> '040,040,040',
            'name'	=> 'Signal Black',
            'text'	=> '255,255,255'
        ),
        '9005' => array(
            'rgb'	=> '010,010,010',
            'name'	=> 'Jet Black',
            'text'	=> '255,255,255'
        ),
        '9006' => array(
            'rgb'	=> '165,165,165',
            'name'	=> 'White Aluminium',
            'text'	=> '000,000,000'
        ),
        '9007' => array(
            'rgb'	=> '143,143,143',
            'name'	=> 'Grey Aluminium',
            'text'	=> '000,000,000'
        ),
        '9010' => array(
            'rgb'	=> '255,255,255',
            'name'	=> 'Pure White',
            'text'	=> '000,000,000'
        ),
        '9011' => array(
            'rgb'	=> '028,028,028',
            'name'	=> 'Graphite Black',
            'text'	=> '255,255,255'
        ),
        '9016' => array(
            'rgb'	=> '246,246,246',
            'name'	=> 'Traffic White',
            'text'	=> '000,000,000'
        ),
        '9017' => array(
            'rgb'	=> '030,030,030',
            'name'	=> 'Traffic Black',
            'text'	=> '255,255,255'
        ),
        '9018' => array(
            'rgb'	=> '215,215,215',
            'name'	=> 'Papyrus White',
            'text'	=> '000,000,000'
        ),
        '9022' => array(
            'rgb'	=> '156,156,156',
            'name'	=> 'Pearl Light Grey',
            'text'	=> '000,000,000'
        ),
        '9023' => array(
            'rgb'	=> '130,130,130',
            'name'	=> 'Pearl Dark Grey',
            'text'	=> '000,000,000'
        )
    ];

    
    public function getRGB($ral){
        return $this->ral_colours[$ral]['rgb'] ?? '';
    }

    }
