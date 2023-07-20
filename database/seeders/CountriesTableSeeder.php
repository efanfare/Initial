<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'name'       => 'Afghanistan',
                'short_code' => 'af',
            ],
            [
                'name'       => 'Albania',
                'short_code' => 'al',
            ],
            [
                'name'       => 'Algeria',
                'short_code' => 'dz',
            ],
            [
                'name'       => 'American Samoa',
                'short_code' => 'as',
            ],
            [
                'name'       => 'Andorra',
                'short_code' => 'ad',
            ],
            [
                'name'       => 'Angola',
                'short_code' => 'ao',
            ],
            [
                'name'       => 'Anguilla',
                'short_code' => 'ai',
            ],
            [
                'name'       => 'Antarctica',
                'short_code' => 'aq',
            ],
            [
                'name'       => 'Antigua and Barbuda',
                'short_code' => 'ag',
            ],
            [
                'name'       => 'Argentina',
                'short_code' => 'ar',
            ],
            [
                'name'       => 'Armenia',
                'short_code' => 'am',
            ],
            [
                'name'       => 'Aruba',
                'short_code' => 'aw',
            ],
            [
                'name'       => 'Australia',
                'short_code' => 'au',
            ],
            [
                'name'       => 'Austria',
                'short_code' => 'at',
            ],
            [
                'name'       => 'Azerbaijan',
                'short_code' => 'az',
            ],
            [
                'name'       => 'Bahamas',
                'short_code' => 'bs',
            ],
            [
                'name'       => 'Bahrain',
                'short_code' => 'bh',
            ],
            [
                'name'       => 'Bangladesh',
                'short_code' => 'bd',
            ],
            [
                'name'       => 'Barbados',
                'short_code' => 'bb',
            ],
            [
                'name'       => 'Belarus',
                'short_code' => 'by',
            ],
            [
                'name'       => 'Belgium',
                'short_code' => 'be',
            ],
            [
                'name'       => 'Belize',
                'short_code' => 'bz',
            ],
            [
                'name'       => 'Benin',
                'short_code' => 'bj',
            ],
            [
                'name'       => 'Bermuda',
                'short_code' => 'bm',
            ],
            [
                'name'       => 'Bhutan',
                'short_code' => 'bt',
            ],
            [
                'name'       => 'Bolivia',
                'short_code' => 'bo',
            ],
            [
                'name'       => 'Bosnia and Herzegovina',
                'short_code' => 'ba',
            ],
            [
                'name'       => 'Botswana',
                'short_code' => 'bw',
            ],
            [
                'name'       => 'Brazil',
                'short_code' => 'br',
            ],
            [
                'name'       => 'British Indian Ocean Territory',
                'short_code' => 'io',
            ],
            [
                'name'       => 'British Virgin Islands',
                'short_code' => 'vg',
            ],
            [
                'name'       => 'Brunei',
                'short_code' => 'bn',
            ],
            [
                'name'       => 'Bulgaria',
                'short_code' => 'bg',
            ],
            [
                'name'       => 'Burkina Faso',
                'short_code' => 'bf',
            ],
            [
                'name'       => 'Burundi',
                'short_code' => 'bi',
            ],
            [
                'name'       => 'Cambodia',
                'short_code' => 'kh',
            ],
            [
                'name'       => 'Cameroon',
                'short_code' => 'cm',
            ],
            [
                'name'       => 'Canada',
                'short_code' => 'ca',
            ],
            [
                'name'       => 'Cape Verde',
                'short_code' => 'cv',
            ],
            [
                'name'       => 'Cayman Islands',
                'short_code' => 'ky',
            ],
            [
                'name'       => 'Central African Republic',
                'short_code' => 'cf',
            ],
            [
                'name'       => 'Chad',
                'short_code' => 'td',
            ],
            [
                'name'       => 'Chile',
                'short_code' => 'cl',
            ],
            [
                'name'       => 'China',
                'short_code' => 'cn',
            ],
            [
                'name'       => 'Christmas Island',
                'short_code' => 'cx',
            ],
            [
                'name'       => 'Cocos Islands',
                'short_code' => 'cc',
            ],
            [
                'name'       => 'Colombia',
                'short_code' => 'co',
            ],
            [
                'name'       => 'Comoros',
                'short_code' => 'km',
            ],
            [
                'name'       => 'Cook Islands',
                'short_code' => 'ck',
            ],
            [
                'name'       => 'Costa Rica',
                'short_code' => 'cr',
            ],
            [
                'name'       => 'Croatia',
                'short_code' => 'hr',
            ],
            [
                'name'       => 'Cuba',
                'short_code' => 'cu',
            ],
            [
                'name'       => 'Curacao',
                'short_code' => 'cw',
            ],
            [
                'name'       => 'Cyprus',
                'short_code' => 'cy',
            ],
            [
                'name'       => 'Czech Republic',
                'short_code' => 'cz',
            ],
            [
                'name'       => 'Democratic Republic of the Congo',
                'short_code' => 'cd',
            ],
            [
                'name'       => 'Denmark',
                'short_code' => 'dk',
            ],
            [
                'name'       => 'Djibouti',
                'short_code' => 'dj',
            ],
            [
                'name'       => 'Dominica',
                'short_code' => 'dm',
            ],
            [
                'name'       => 'Dominican Republic',
                'short_code' => 'do',
            ],
            [
                'name'       => 'East Timor',
                'short_code' => 'tl',
            ],
            [
                'name'       => 'Ecuador',
                'short_code' => 'ec',
            ],
            [
                'name'       => 'Egypt',
                'short_code' => 'eg',
            ],
            [
                'name'       => 'El Salvador',
                'short_code' => 'sv',
            ],
            [
                'name'       => 'Equatorial Guinea',
                'short_code' => 'gq',
            ],
            [
                'name'       => 'Eritrea',
                'short_code' => 'er',
            ],
            [
                'name'       => 'Estonia',
                'short_code' => 'ee',
            ],
            [
                'name'       => 'Ethiopia',
                'short_code' => 'et',
            ],
            [
                'name'       => 'Falkland Islands',
                'short_code' => 'fk',
            ],
            [
                'name'       => 'Faroe Islands',
                'short_code' => 'fo',
            ],
            [
                'name'       => 'Fiji',
                'short_code' => 'fj',
            ],
            [
                'name'       => 'Finland',
                'short_code' => 'fi',
            ],
            [
                'name'       => 'France',
                'short_code' => 'fr',
            ],
            [
                'name'       => 'French Polynesia',
                'short_code' => 'pf',
            ],
            [
                'name'       => 'Gabon',
                'short_code' => 'ga',
            ],
            [
                'name'       => 'Gambia',
                'short_code' => 'gm',
            ],
            [
                'name'       => 'Georgia',
                'short_code' => 'ge',
            ],
            [
                'name'       => 'Germany',
                'short_code' => 'de',
            ],
            [
                'name'       => 'Ghana',
                'short_code' => 'gh',
            ],
            [
                'name'       => 'Gibraltar',
                'short_code' => 'gi',
            ],
            [
                'name'       => 'Greece',
                'short_code' => 'gr',
            ],
            [
                'name'       => 'Greenland',
                'short_code' => 'gl',
            ],
            [
                'name'       => 'Grenada',
                'short_code' => 'gd',
            ],
            [
                'name'       => 'Guam',
                'short_code' => 'gu',
            ],
            [
                'name'       => 'Guatemala',
                'short_code' => 'gt',
            ],
            [
                'name'       => 'Guernsey',
                'short_code' => 'gg',
            ],
            [
                'name'       => 'Guinea',
                'short_code' => 'gn',
            ],
            [
                'name'       => 'Guinea-Bissau',
                'short_code' => 'gw',
            ],
            [
                'name'       => 'Guyana',
                'short_code' => 'gy',
            ],
            [
                'name'       => 'Haiti',
                'short_code' => 'ht',
            ],
            [
                'name'       => 'Honduras',
                'short_code' => 'hn',
            ],
            [
                'name'       => 'Hong Kong',
                'short_code' => 'hk',
            ],
            [
                'name'       => 'Hungary',
                'short_code' => 'hu',
            ],
            [
                'name'       => 'Iceland',
                'short_code' => 'is',
            ],
            [
                'name'       => 'India',
                'short_code' => 'in',
            ],
            [
                'name'       => 'Indonesia',
                'short_code' => 'id',
            ],
            [
                'name'       => 'Iran',
                'short_code' => 'ir',
            ],
            [
                'name'       => 'Iraq',
                'short_code' => 'iq',
            ],
            [
                'name'       => 'Ireland',
                'short_code' => 'ie',
            ],
            [
                'name'       => 'Isle of Man',
                'short_code' => 'im',
            ],
            [
                'name'       => 'Israel',
                'short_code' => 'il',
            ],
            [
                'name'       => 'Italy',
                'short_code' => 'it',
            ],
            [
                'name'       => 'Ivory Coast',
                'short_code' => 'ci',
            ],
            [
                'name'       => 'Jamaica',
                'short_code' => 'jm',
            ],
            [
                'name'       => 'Japan',
                'short_code' => 'jp',
            ],
            [
                'name'       => 'Jersey',
                'short_code' => 'je',
            ],
            [
                'name'       => 'Jordan',
                'short_code' => 'jo',
            ],
            [
                'name'       => 'Kazakhstan',
                'short_code' => 'kz',
            ],
            [
                'name'       => 'Kenya',
                'short_code' => 'ke',
            ],
            [
                'name'       => 'Kiribati',
                'short_code' => 'ki',
            ],
            [
                'name'       => 'Kosovo',
                'short_code' => 'xk',
            ],
            [
                'name'       => 'Kuwait',
                'short_code' => 'kw',
            ],
            [
                'name'       => 'Kyrgyzstan',
                'short_code' => 'kg',
            ],
            [
                'name'       => 'Laos',
                'short_code' => 'la',
            ],
            [
                'name'       => 'Latvia',
                'short_code' => 'lv',
            ],
            [
                'name'       => 'Lebanon',
                'short_code' => 'lb',
            ],
            [
                'name'       => 'Lesotho',
                'short_code' => 'ls',
            ],
            [
                'name'       => 'Liberia',
                'short_code' => 'lr',
            ],
            [
                'name'       => 'Libya',
                'short_code' => 'ly',
            ],
            [
                'name'       => 'Liechtenstein',
                'short_code' => 'li',
            ],
            [
                'name'       => 'Lithuania',
                'short_code' => 'lt',
            ],
            [
                'name'       => 'Luxembourg',
                'short_code' => 'lu',
            ],
            [
                'name'       => 'Macau',
                'short_code' => 'mo',
            ],
            [
                'name'       => 'Macedonia',
                'short_code' => 'mk',
            ],
            [
                'name'       => 'Madagascar',
                'short_code' => 'mg',
            ],
            [
                'name'       => 'Malawi',
                'short_code' => 'mw',
            ],
            [
                'name'       => 'Malaysia',
                'short_code' => 'my',
            ],
            [
                'name'       => 'Maldives',
                'short_code' => 'mv',
            ],
            [
                'name'       => 'Mali',
                'short_code' => 'ml',
            ],
            [
                'name'       => 'Malta',
                'short_code' => 'mt',
            ],
            [
                'name'       => 'Marshall Islands',
                'short_code' => 'mh',
            ],
            [
                'name'       => 'Mauritania',
                'short_code' => 'mr',
            ],
            [
                'name'       => 'Mauritius',
                'short_code' => 'mu',
            ],
            [
                'name'       => 'Mayotte',
                'short_code' => 'yt',
            ],
            [
                'name'       => 'Mexico',
                'short_code' => 'mx',
            ],
            [
                'name'       => 'Micronesia',
                'short_code' => 'fm',
            ],
            [
                'name'       => 'Moldova',
                'short_code' => 'md',
            ],
            [
                'name'       => 'Monaco',
                'short_code' => 'mc',
            ],
            [
                'name'       => 'Mongolia',
                'short_code' => 'mn',
            ],
            [
                'name'       => 'Montenegro',
                'short_code' => 'me',
            ],
            [
                'name'       => 'Montserrat',
                'short_code' => 'ms',
            ],
            [
                'name'       => 'Morocco',
                'short_code' => 'ma',
            ],
            [
                'name'       => 'Mozambique',
                'short_code' => 'mz',
            ],
            [
                'name'       => 'Myanmar',
                'short_code' => 'mm',
            ],
            [
                'name'       => 'Namibia',
                'short_code' => 'na',
            ],
            [
                'name'       => 'Nauru',
                'short_code' => 'nr',
            ],
            [
                'name'       => 'Nepal',
                'short_code' => 'np',
            ],
            [
                'name'       => 'Netherlands',
                'short_code' => 'nl',
            ],
            [
                'name'       => 'Netherlands Antilles',
                'short_code' => 'an',
            ],
            [
                'name'       => 'New Caledonia',
                'short_code' => 'nc',
            ],
            [
                'name'       => 'New Zealand',
                'short_code' => 'nz',
            ],
            [
                'name'       => 'Nicaragua',
                'short_code' => 'ni',
            ],
            [
                'name'       => 'Niger',
                'short_code' => 'ne',
            ],
            [
                'name'       => 'Nigeria',
                'short_code' => 'ng',
            ],
            [
                'name'       => 'Niue',
                'short_code' => 'nu',
            ],
            [
                'name'       => 'North Korea',
                'short_code' => 'kp',
            ],
            [
                'name'       => 'Northern Mariana Islands',
                'short_code' => 'mp',
            ],
            [
                'name'       => 'Norway',
                'short_code' => 'no',
            ],
            [
                'name'       => 'Oman',
                'short_code' => 'om',
            ],
            [
                'name'       => 'Pakistan',
                'short_code' => 'pk',
            ],
            [
                'name'       => 'Palau',
                'short_code' => 'pw',
            ],
            [
                'name'       => 'Palestine',
                'short_code' => 'ps',
            ],
            [
                'name'       => 'Panama',
                'short_code' => 'pa',
            ],
            [
                'name'       => 'Papua New Guinea',
                'short_code' => 'pg',
            ],
            [
                'name'       => 'Paraguay',
                'short_code' => 'py',
            ],
            [
                'name'       => 'Peru',
                'short_code' => 'pe',
            ],
            [
                'name'       => 'Philippines',
                'short_code' => 'ph',
            ],
            [
                'name'       => 'Pitcairn',
                'short_code' => 'pn',
            ],
            [
                'name'       => 'Poland',
                'short_code' => 'pl',
            ],
            [
                'name'       => 'Portugal',
                'short_code' => 'pt',
            ],
            [
                'name'       => 'Puerto Rico',
                'short_code' => 'pr',
            ],
            [
                'name'       => 'Qatar',
                'short_code' => 'qa',
            ],
            [
                'name'       => 'Republic of the Congo',
                'short_code' => 'cg',
            ],
            [
                'name'       => 'Reunion',
                'short_code' => 're',
            ],
            [
                'name'       => 'Romania',
                'short_code' => 'ro',
            ],
            [
                'name'       => 'Russia',
                'short_code' => 'ru',
            ],
            [
                'name'       => 'Rwanda',
                'short_code' => 'rw',
            ],
            [
                'name'       => 'Saint Barthelemy',
                'short_code' => 'bl',
            ],
            [
                'name'       => 'Saint Helena',
                'short_code' => 'sh',
            ],
            [
                'name'       => 'Saint Kitts and Nevis',
                'short_code' => 'kn',
            ],
            [
                'name'       => 'Saint Lucia',
                'short_code' => 'lc',
            ],
            [
                'name'       => 'Saint Martin',
                'short_code' => 'mf',
            ],
            [
                'name'       => 'Saint Pierre and Miquelon',
                'short_code' => 'pm',
            ],
            [
                'name'       => 'Saint Vincent and the Grenadines',
                'short_code' => 'vc',
            ],
            [
                'name'       => 'Samoa',
                'short_code' => 'ws',
            ],
            [
                'name'       => 'San Marino',
                'short_code' => 'sm',
            ],
            [
                'name'       => 'Sao Tome and Principe',
                'short_code' => 'st',
            ],
            [
                'name'       => 'Saudi Arabia',
                'short_code' => 'sa',
            ],
            [
                'name'       => 'Senegal',
                'short_code' => 'sn',
            ],
            [
                'name'       => 'Serbia',
                'short_code' => 'rs',
            ],
            [
                'name'       => 'Seychelles',
                'short_code' => 'sc',
            ],
            [
                'name'       => 'Sierra Leone',
                'short_code' => 'sl',
            ],
            [
                'name'       => 'Singapore',
                'short_code' => 'sg',
            ],
            [
                'name'       => 'Sint Maarten',
                'short_code' => 'sx',
            ],
            [
                'name'       => 'Slovakia',
                'short_code' => 'sk',
            ],
            [
                'name'       => 'Slovenia',
                'short_code' => 'si',
            ],
            [
                'name'       => 'Solomon Islands',
                'short_code' => 'sb',
            ],
            [
                'name'       => 'Somalia',
                'short_code' => 'so',
            ],
            [
                'name'       => 'South Africa',
                'short_code' => 'za',
            ],
            [
                'name'       => 'South Korea',
                'short_code' => 'kr',
            ],
            [
                'name'       => 'South Sudan',
                'short_code' => 'ss',
            ],
            [
                'name'       => 'Spain',
                'short_code' => 'es',
            ],
            [
                'name'       => 'Sri Lanka',
                'short_code' => 'lk',
            ],
            [
                'name'       => 'Sudan',
                'short_code' => 'sd',
            ],
            [
                'name'       => 'Suriname',
                'short_code' => 'sr',
            ],
            [
                'name'       => 'Svalbard and Jan Mayen',
                'short_code' => 'sj',
            ],
            [
                'name'       => 'Swaziland',
                'short_code' => 'sz',
            ],
            [
                'name'       => 'Sweden',
                'short_code' => 'se',
            ],
            [
                'name'       => 'Switzerland',
                'short_code' => 'ch',
            ],
            [
                'name'       => 'Syria',
                'short_code' => 'sy',
            ],
            [
                'name'       => 'Taiwan',
                'short_code' => 'tw',
            ],
            [
                'name'       => 'Tajikistan',
                'short_code' => 'tj',
            ],
            [
                'name'       => 'Tanzania',
                'short_code' => 'tz',
            ],
            [
                'name'       => 'Thailand',
                'short_code' => 'th',
            ],
            [
                'name'       => 'Togo',
                'short_code' => 'tg',
            ],
            [
                'name'       => 'Tokelau',
                'short_code' => 'tk',
            ],
            [
                'name'       => 'Tonga',
                'short_code' => 'to',
            ],
            [
                'name'       => 'Trinidad and Tobago',
                'short_code' => 'tt',
            ],
            [
                'name'       => 'Tunisia',
                'short_code' => 'tn',
            ],
            [
                'name'       => 'Turkey',
                'short_code' => 'tr',
            ],
            [
                'name'       => 'Turkmenistan',
                'short_code' => 'tm',
            ],
            [
                'name'       => 'Turks and Caicos Islands',
                'short_code' => 'tc',
            ],
            [
                'name'       => 'Tuvalu',
                'short_code' => 'tv',
            ],
            [
                'name'       => 'U.S. Virgin Islands',
                'short_code' => 'vi',
            ],
            [
                'name'       => 'Uganda',
                'short_code' => 'ug',
            ],
            [
                'name'       => 'Ukraine',
                'short_code' => 'ua',
            ],
            [
                'name'       => 'United Arab Emirates',
                'short_code' => 'ae',
            ],
            [
                'name'       => 'United Kingdom',
                'short_code' => 'gb',
            ],
            [
                'name'       => 'United States',
                'short_code' => 'us',
            ],
            [
                'name'       => 'Uruguay',
                'short_code' => 'uy',
            ],
            [
                'name'       => 'Uzbekistan',
                'short_code' => 'uz',
            ],
            [
                'name'       => 'Vanuatu',
                'short_code' => 'vu',
            ],
            [
                'name'       => 'Vatican',
                'short_code' => 'va',
            ],
            [
                'name'       => 'Venezuela',
                'short_code' => 've',
            ],
            [
                'name'       => 'Vietnam',
                'short_code' => 'vn',
            ],
            [
                'name'       => 'Wallis and Futuna',
                'short_code' => 'wf',
            ],
            [
                'name'       => 'Western Sahara',
                'short_code' => 'eh',
            ],
            [
                'name'       => 'Yemen',
                'short_code' => 'ye',
            ],
            [
                'name'       => 'Zambia',
                'short_code' => 'zm',
            ],
            [
                'name'       => 'Zimbabwe',
                'short_code' => 'zw',
            ],
        ];

        Country::insert($countries);
    }
}