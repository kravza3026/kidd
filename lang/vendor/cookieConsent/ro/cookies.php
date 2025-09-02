<?php

return [
    'title' => 'Folosim fișiere cookie',
    'intro' => 'Acestă pagină web folosește cookies pentru a îmbunătăți experiența utilizatorului.',
    'link' => 'Accesează <a href=":url">Politica Cookie</a> pentru mai multe detalii.',

    'essentials' => 'Doar esențiale',
    'all' => 'Acceptă toate',
    'customize' => 'Modifică',
    'manage' => 'Modifică cookies',
    'details' => [
        'more' => 'Mai multe detalii',
        'less' => 'Mai puține detalii',
    ],
    'save' => 'Salvează setări',
    'cookie' => 'Cookie',
    'purpose' => 'Scop',
    'duration' => 'Durata',
    'year' => 'An|Ani',
    'day' => 'Zi|Zile',
    'hour' => 'Oră|Ore',
    'minute' => 'Minută|Minute',

    'categories' => [
        'essentials' => [
            'title' => 'Cookies Esențiale',
            'description' => 'Există câteva cookie-uri pe care trebuie să le includem pentru ca anumite pagini web să funcționeze. Din acest motiv, acestea nu necesită consimțământul dumneavoastră.',
        ],
        'analytics' => [
            'title' => 'Cookies Analitică',
            'description' => 'Le folosim pentru cercetări interne cu privire la modul în care putem îmbunătăți serviciul pe care îl oferim pentru toți utilizatorii noștri. Aceste cookie-uri evaluează modul în care interacționați cu site-ul nostru web.',
        ],
        'optional' => [
            'title' => 'Cookies opționale',
            'description' => 'Aceste cookie-uri permit funcții care ar putea îmbunătăți experiența utilizatorului dvs., dar absența lor nu va afecta capacitatea dvs. de a naviga pe site-ul nostru.',
        ],
    ],

    'defaults' => [
        'consent' => 'Folosit pentru a stoca preferințele de consimțământ de cookie ale utilizatorului.',
        'session' => 'Folosit pentru a identifica sesiunea de navigare a utilizatorului.',
        'csrf' => 'Folosit pentru a asigura atât utilizatorul, cât și site-ul nostru web împotriva atacurilor de falsificare a solicitării.',
        '_ga' => 'Cookie-ul principal folosit de Google Analytics, permite serviciu serviciului să distingă un vizitator de altul.',
        '_ga_ID' => 'Folosit de Google Analytics pentru a persista starea sesiunii.',
        '_gid' => 'Utilizat de Google Analytics pentru identificarea utilizatorului.',
        '_gat' => 'Folosit de Google Analytics pentru a limita rata de solicitare.',
    ],
];
