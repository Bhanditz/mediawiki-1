<?php
/** Ido (Ido)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Albonio
 * @author Artomo
 * @author Lakaoso
 * @author Malafaya
 * @author Remember the dot
 * @author Wyvernoid
 * @author לערי ריינהארט
 */

$namespaceNames = array(
	NS_MEDIA          => 'Media',
	NS_SPECIAL        => 'Specala',
	NS_MAIN           => '',
	NS_TALK           => 'Debato',
	NS_USER           => 'Uzanto',
	NS_USER_TALK      => 'Uzanto_Debato',
	# NS_PROJECT set by \$wgMetaNamespace
	NS_PROJECT_TALK   => '$1_Debato',
	NS_IMAGE          => 'Imajo',
	NS_IMAGE_TALK     => 'Imajo_Debato',
	NS_MEDIAWIKI      => 'MediaWiki',
	NS_MEDIAWIKI_TALK => 'MediaWiki_Debato',
	NS_TEMPLATE       => 'Shablono',
	NS_TEMPLATE_TALK  => 'Shablono_Debato',
	NS_HELP           => 'Helpo',
	NS_HELP_TALK      => 'Helpo_Debato',
	NS_CATEGORY       => 'Kategorio',
	NS_CATEGORY_TALK  => 'Kategorio_Debato',
);

$messages = array(
# User preference toggles
'tog-underline'               => 'Sub-strekizez ligili:',
'tog-highlightbroken'         => 'Formatigez ruptita ligili <a href="" class="new">tale</a> (alternativo: tale<a href="" class="internal">?</a>)',
'tog-justify'                 => 'Adjustigez paragrafi',
'tog-hideminor'               => 'Celez mikra redaktaji de recenta chanji',
'tog-extendwatchlist'         => 'Expansez surveyo-listo por montrar omna chanji, vice nur la maxim recenta',
'tog-usenewrc'                => 'Usez augmentita Recenta chanji (JavaScript bezonesas)',
'tog-numberheadings'          => 'Autonumerez tituli',
'tog-showtoolbar'             => 'Montrez redaktilo (JavaScript bezonesas)',
'tog-editondblclick'          => 'Redaktez pagini kande on klikus dufoye (JavaScript bezonesas)',
'tog-editsection'             => 'Kapabligez redakto di secioni per [redaktar]-ligamini',
'tog-editsectiononrightclick' => 'Kapabligez redakto di secioni kande on dextra-klikus tituli di secioni (JavaScript bezonesas)',
'tog-showtoc'                 => 'Montrez indexo (por pagini havanta plu multa kam 3 tituli)',
'tog-rememberpassword'        => 'Memorez mea pasovorto en ica komputoro',
'tog-editwidth'               => 'Larjigez la redakto-buxo por ke ol okupas la tota skreno',
'tog-watchcreations'          => 'Adjuntez pagini kreota da me ad mea surveyaji',
'tog-watchdefault'            => 'Adjuntez pagini redaktota da me ad mea surveyaji',
'tog-watchmoves'              => 'Adjuntez pagini movota da me ad mea surveyaji',
'tog-watchdeletion'           => 'Adjuntez pagini efacota da me ad mea surveyaji',
'tog-minordefault'            => 'Markizez kustume omna redaktajo kom mikra',
'tog-previewontop'            => 'Montrez prevido avan la redakto-buxo',
'tog-previewonfirst'          => 'Montrez prevido pos la unesma redakto',
'tog-nocache'                 => 'Nekapableskez cache-ar pagini',
'tog-enotifwatchlistpages'    => 'Sendez e-posto a me kande pagino quan me surveyas chanjesas',
'tog-enotifusertalkpages'     => 'Sendez e-posto a me kande mea diskuto-pagino chanjesas',
'tog-enotifminoredits'        => 'Sendez e-posto a me mem por mikra chanji',
'tog-enotifrevealaddr'        => 'Montrez mea e-posto adreso en notifiko e-posti',
'tog-shownumberswatching'     => 'Montrez nombro di surveyanta uzanti',
'tog-fancysig'                => 'Traktez signaturo kom wikikodo (sen automata ligilo)',
'tog-externaleditor'          => 'Uzez extera redaktanto nespecigite (nur por experti, bezonas specala moderi ye vua komputoro)',
'tog-forceeditsummary'        => 'Notifikez me kande skribanta vakua redakto-rezumo',
'tog-watchlisthideown'        => 'Celez mea redaktaji de la surveyaji',
'tog-watchlisthidebots'       => 'Celez redaktaji da roboti de la surveyaji',
'tog-watchlisthideminor'      => 'Celez mikra redaktaji de la surveyaji',
'tog-ccmeonemails'            => 'Sendez a me exemplero di e-posti quin me sendos ad altra uzanti',
'tog-diffonly'                => 'Ne montrez pagino kontenajo sub diferi',
'tog-showhiddencats'          => 'Montrar celita kategorii',

'underline-always' => 'Sempre',
'underline-never'  => 'Nulatempe',

'skinpreview' => '(Pre-videz)',

# Dates
'sunday'        => 'sundio',
'monday'        => 'lundio',
'tuesday'       => 'mardio',
'wednesday'     => 'merkurdio',
'thursday'      => 'jovdio',
'friday'        => 'venerdio',
'saturday'      => 'saturdio',
'sun'           => 'sun',
'mon'           => 'lun',
'tue'           => 'mar',
'wed'           => 'mer',
'thu'           => 'jov',
'fri'           => 'ven',
'sat'           => 'sat',
'january'       => 'januaro',
'february'      => 'februaro',
'march'         => 'marto',
'april'         => 'aprilo',
'may_long'      => 'mayo',
'june'          => 'junio',
'july'          => 'julio',
'august'        => 'agosto',
'september'     => 'septembro',
'october'       => 'oktobro',
'november'      => 'novembro',
'december'      => 'decembro',
'january-gen'   => 'di januaro',
'february-gen'  => 'di februaro',
'march-gen'     => 'di marto',
'april-gen'     => 'di aprilo',
'may-gen'       => 'di mayo',
'june-gen'      => 'di junio',
'july-gen'      => 'di julio',
'august-gen'    => 'di agosto',
'september-gen' => 'di septembro',
'october-gen'   => 'di oktobro',
'november-gen'  => 'di novembro',
'december-gen'  => 'di decembro',
'jan'           => 'jan',
'feb'           => 'feb',
'mar'           => 'mar',
'apr'           => 'apr',
'may'           => 'may',
'jun'           => 'jun',
'jul'           => 'jul',
'aug'           => 'ago',
'sep'           => 'sep',
'oct'           => 'okt',
'nov'           => 'nov',
'dec'           => 'dec',

# Categories related messages
'pagecategories'                 => '{{PLURAL:$1|Kategorio|Kategorii}}',
'category_header'                => 'Artikli en kategorio "$1"',
'subcategories'                  => 'Subkategorii',
'category-empty'                 => "''Nuntempe existas nula pagini en ita kategorio.''",
'hidden-categories'              => '{{PLURAL:$1|Celita kategorio|Celita kategorii}}',
'hidden-category-category'       => 'Celita kategorii', # Name of the category where hidden categories will be listed
'category-subcat-count'          => 'Ica kategorio havas {{PLURAL:$2|nur la sequanta subkategorio.|la sequanta {{PLURAL:$1|subkategorio|$1 subkategorii}}, ek $2.}}',
'category-subcat-count-limited'  => 'Ica kategorio havas la sequanta {{PLURAL:$1|subkategorio|$1 subkategorii}}.',
'category-article-count'         => '{{PLURAL:$2|Ica kategorio havas nur la sequanta pagino.|La sequanta {{PLURAL:$1|pagino|$1 pagini}} es en ica kategorio, ek $2.}}',
'category-article-count-limited' => 'La sequanta {{PLURAL:$1|pagino|$1 pagini}} es en la aktuala kategorio.',
'category-file-count'            => '{{PLURAL:$2|Ica kategorio havas nur la sequanta arkivo.|La sequanta {{PLURAL:$1|arkivo|$1 arkivi}} es en ica kategorio, ek $2.}}',
'category-file-count-limited'    => 'La sequanta {{PLURAL:$1|arkivo|$1 arkivi}} es en la aktuala kategorio.',
'listingcontinuesabbrev'         => 'seq.',

'mainpagetext'      => "<big>'''MediaWiki instalesis sucese.'''</big>",
'mainpagedocfooter' => "Videz la [http://meta.wikimedia.org/wiki/Help:Contents Guidilo por Uzanti] por informo pri uzar la wiki programo.

== Komencar ==
* [http://www.mediawiki.org/wiki/Manual:Configuration_settings Listo di ''Configuration setting'']
* [http://www.mediawiki.org/wiki/Manual:FAQ MediaWiki OQQ]
* [https://lists.wikimedia.org/mailman/listinfo/mediawiki-announce MediaWiki nova versioni posto-listo]",

'about'          => 'Pri',
'article'        => 'artiklo',
'newwindow'      => '(aparos en nova panelo)',
'cancel'         => 'Anular',
'qbfind'         => 'Trovez',
'qbedit'         => 'Editar',
'qbpageoptions'  => 'Ica pagino',
'qbpageinfo'     => 'Kuntexto',
'qbmyoptions'    => 'Mea pagini',
'qbspecialpages' => 'Specala pagini',
'moredotdotdot'  => 'Plus...',
'mypage'         => 'Mea pagino',
'mytalk'         => 'Mea diskuti',
'anontalk'       => 'Diskuto relatant ad ica IP',
'navigation'     => 'Navigado',
'and'            => 'ed',

# Metadata in edit box
'metadata_help' => 'Metadonaji:',

'errorpagetitle'    => 'Eroro',
'returnto'          => 'Retrovenar a $1.',
'tagline'           => 'De {{SITENAME}}',
'help'              => 'Helpo',
'search'            => 'Sercho',
'searchbutton'      => 'Serchez',
'go'                => 'Irar',
'searcharticle'     => 'Irez',
'history'           => 'Paginala historio',
'history_short'     => 'Versionaro',
'updatedmarker'     => 'aktualigita pos mea lasta vizito',
'info_short'        => 'Informajo',
'printableversion'  => 'Imprimebla versiono',
'permalink'         => 'Permananta ligilo',
'print'             => 'Imprimar',
'edit'              => 'Redaktar',
'create'            => 'Krear',
'editthispage'      => 'Redaktar ca pagino',
'create-this-page'  => 'Kreez ca pagino',
'delete'            => 'Efacar',
'deletethispage'    => 'Efacar ica pagino',
'undelete_short'    => 'Restaurar {{PLURAL:$1|1 redakto|$1 redakti}}',
'protect'           => 'Protektar',
'protect_change'    => 'chanjar',
'protectthispage'   => 'Protektar ica pagino',
'unprotect'         => 'Desprotektar',
'unprotectthispage' => 'Desprotektar ica pagino',
'newpage'           => 'Nova pagino',
'talkpage'          => 'Debatar pri ca pagino',
'talkpagelinktext'  => 'Diskutez',
'specialpage'       => 'Specala pagino',
'personaltools'     => 'Personala utensili',
'postcomment'       => 'Nova seciono',
'articlepage'       => 'Regardar artiklo',
'talk'              => 'Diskuto',
'views'             => 'Apari',
'toolbox'           => 'Utensili',
'userpage'          => 'Vidar uzanto-pagino',
'projectpage'       => 'Vidar projeto-pagino',
'imagepage'         => 'Vidar arkivo-pagino',
'mediawikipage'     => 'Vidar mesajo-pagino',
'templatepage'      => 'Vidar shablono-pagino',
'viewhelppage'      => 'Vidar helpo-pagino',
'categorypage'      => 'Vidar kategorio-pagino',
'viewtalkpage'      => 'Vidar debatado',
'otherlanguages'    => 'En altra lingui',
'redirectedfrom'    => '(Ridirektita de $1)',
'redirectpagesub'   => 'Ridirektanta pagino',
'lastmodifiedat'    => 'Ica pagino modifikesis ye $2, $1.', # $1 date, $2 time
'viewcount'         => 'Ica pagino acesesis {{PLURAL:$1|1 foyo|$1 foyi}}.',
'protectedpage'     => 'Protektita pagino',
'jumpto'            => 'Irez ad:',
'jumptonavigation'  => 'pilotado',
'jumptosearch'      => 'serchez',

# All link text and link target definitions of links into project namespace that get used by other message strings, with the exception of user group pages (see grouppage) and the disambiguation template definition (see disambiguations).
'aboutsite'            => 'Pri {{SITENAME}}',
'aboutpage'            => 'Project:Pri {{SITENAME}}',
'bugreports'           => 'Informajo pri erori',
'bugreportspage'       => 'Project:Informajo pri erori',
'copyright'            => 'La kontenajo esas disponebla sub $1.',
'copyrightpagename'    => '{{SITENAME}} kopiyuro',
'currentevents'        => 'Aktualaji',
'currentevents-url'    => 'Project:Aktualaji',
'disclaimers'          => 'Legala averto',
'disclaimerpage'       => 'Project:Generala des-agnosko',
'edithelp'             => 'Helpo pri redaktado',
'edithelppage'         => 'Help:Redaktado',
'helppage'             => 'Help:Helpo',
'mainpage'             => 'Frontispico',
'mainpage-description' => 'Frontispico',
'policy-url'           => 'Project:Sistemo di agado',
'portal'               => 'Komuneso-portalo',
'portal-url'           => 'Project:Komuneso-portalo',
'privacy'              => 'Sistemo di agado pri privateso',
'privacypage'          => 'Project:Sistemo di agado pri privateso',

'badaccess'        => 'Eroro permisal',
'badaccess-group0' => 'Vu ne permisesas agar quale vu demandas.',
'badaccess-group1' => "L' ago quan vu demandabas es limitizita al uzeri en grupo $1.",
'badaccess-group2' => "L' ago quan vu demandabas es limitizita al uzeri en un ek la grupi $1.",
'badaccess-groups' => "L' ago quan vu demandabas es limitizita al uzeri en un ek la grupi $1.",

'versionrequired'     => 'Versiono $1 di MediaWiki bezonata',
'versionrequiredtext' => 'Versiono $1 di MediaWiki bezonesas por uzar ca pagino.
Videz [[Special:Version|versiono-pagino]].',

'ok'                      => 'O.K.',
'retrievedfrom'           => 'Obtenita de "$1"',
'youhavenewmessages'      => 'Vu havas $1 ($2).',
'newmessageslink'         => 'nova mesaji',
'newmessagesdifflink'     => 'lasta chanjo',
'youhavenewmessagesmulti' => 'Vu havas nova mesaji ye $1',
'editsection'             => 'redaktar',
'editold'                 => 'redaktar',
'viewsourceold'           => 'vidar fonto',
'editsectionhint'         => 'Redaktar seciono: $1',
'toc'                     => 'Indexo',
'showtoc'                 => 'montrar',
'hidetoc'                 => 'celar',
'thisisdeleted'           => 'Ka vidar o restaurar $1?',
'viewdeleted'             => 'Vidar $1?',
'restorelink'             => '{{PLURAL:$1|1 redakto efacita|$1 redakti efacita}}',
'site-rss-feed'           => '$1 RSS Provizajo',
'site-atom-feed'          => '$1 Atom Provizajo',
'page-rss-feed'           => '"$1" RSS Provizajo',
'page-atom-feed'          => '"$1" Atom Provizajo',
'red-link-title'          => '$1 (pagino ne existas)',

# Short words for each namespace, by default used in the namespace tab in monobook
'nstab-main'      => 'Pagino',
'nstab-user'      => 'Uzanto-pagino',
'nstab-special'   => 'Specala pagino',
'nstab-project'   => 'Projeto pagino',
'nstab-image'     => 'Failo',
'nstab-mediawiki' => 'Mesajo',
'nstab-template'  => 'Modelo',
'nstab-help'      => 'Helpo',
'nstab-category'  => 'Kategorio',

# Main script and global functions
'nosuchaction'      => 'Ne esas tala ago',
'nosuchspecialpage' => 'Ne existas tala specala pagino',
'nospecialpagetext' => "<big>'''Vu demandis specala pagino qua ne existas.'''</big>

On povas trovar listo di valida specala pagini en [[Special:SpecialPages|{{int:specialpages}}]].",

# General errors
'error'               => 'Eroro',
'databaseerror'       => 'Datumarala eroro',
'noconnect'           => 'Pardonez! La wiki havas ula teknikala desfacilaji ed ne povas konektar kun la datumaro.<br />
$1',
'nodb'                => 'Onu ne povas selektar datumaro $1',
'cachederror'         => "Co esas kopiuro registragita ye la ''cache'' di la solicitita pagino, ed ol povus ne esar aktuala.",
'readonly'            => 'Datumaro esas blokusita',
'enterlockreason'     => 'Explikez la motivo por la blokuso, inkluzante 
evaluo pri kande eventos la desblokuso',
'missingarticle-rev'  => '(versiono#: $1)',
'missingarticle-diff' => '(Difero: $1, $2)',
'internalerror'       => 'Interna eroro',
'internalerror_info'  => 'Interna eroro: $1',
'filecopyerror'       => 'Ne povis kopiar l\'arkivo "$1" a "$2".',
'filerenameerror'     => 'Ne povas rinomizar l\'arkivo "$1" ad "$2".',
'filedeleteerror'     => 'Onu ne povis efacar l\'arkivo "$1".',
'filenotfound'        => 'Onu ne povas trovar la arkivo "$1".',
'unexpected'          => 'Nevartita valoro: "$1"="$2".',
'formerror'           => 'Eroro: Onu ne povis sendar la kontenajo di la formularo',
'badarticleerror'     => 'Ica ago ne povas facesar en ca pagino.',
'cannotdelete'        => 'Ne es posibla efacar la pagino od arkivo. (Forsan, ulu ja efacis ol.)',
'badtitle'            => 'Nekorekta titulo',
'badtitletext'        => 'La solicitita pagino esas nevalida, vakua od esas
nekorekta interlinguale od interwikale ligilo.',
'perfdisabled'        => 'Pardonez! Ica traito desaktivigesis temporale pro olu lentigas la datumaro til facar {{SITENAME}} neuzebla.',
'perfcached'          => 'La sequanta datumi esas kashizita* e li povus ne aktualigesar nuntempe.',
'viewsource'          => 'Vidar font-kodo',
'viewsourcefor'       => 'de $1',
'protectedpagetext'   => 'Ica pagino esis protektita por preventar redaktar.',
'viewsourcetext'      => 'Vu povas vidar ed kopiar la fonto-kodexo di ta pagino:',
'ns-specialprotected' => 'On ne povas redaktar speciala pagini.',

# Login and logout pages
'logouttitle'                => 'Ekiro',
'logouttext'                 => "'''Vu nun esas nun ek {{SITENAME}}.'''

Vu povas durar uzante {{SITENAME}} anonimale, o vu povas [[Special:UserLogin|enirar itere]] kom la sama o diferenta uzanto.
Atencez ke kelka pagini posible duras montresar semblante ke vu ne ekirus, til vu vakuigas la tempala-magazino di vua navigilo.",
'welcomecreation'            => '<h2>Bonveno, $1!</h2><p>Vua konto kreesis.
Voluntez, ne obliviez chanjor vua preferaji.',
'loginpagetitle'             => 'Registragar / Enirar',
'yourname'                   => 'Vua uzantonomo:',
'yourpassword'               => 'Pasovorto:',
'yourpasswordagain'          => 'Riskribez la pasovorto:',
'remembermypassword'         => 'Memorez mea pasovorto inter sesioni en ca komputoro',
'yourdomainname'             => 'Vua domano:',
'loginproblem'               => '<b>Esis problemo kun vua eniro.</b><br />Probez altrafoye!',
'login'                      => 'Enirar',
'nav-login-createaccount'    => 'Enirar',
'loginprompt'                => "Vu mustas permisar ''cookies'' por enirar a {{SITENAME}}.",
'userlogin'                  => 'Enirar',
'logout'                     => 'Ekirar',
'userlogout'                 => 'Ekirar',
'notloggedin'                => 'Sesiono ne esas iniciata',
'nologin'                    => 'Ka vu ne havas konto? $1.',
'nologinlink'                => 'Kreez konto',
'createaccount'              => 'Krear nova konto',
'gotaccount'                 => 'Ka vu ja havas konto? $1.',
'gotaccountlink'             => 'Enirar',
'createaccountmail'          => 'per e-posto',
'badretype'                  => 'La pasovorti vu donis ne esas sama.',
'userexists'                 => 'La uzantonomo, quan vu skribis, ja selektesis antee.
Voluntez, elektez ula diferanta uzantonomo.',
'youremail'                  => 'Vua e-adreso:',
'username'                   => 'Uzantonomo:',
'uid'                        => 'ID dil uzanto:',
'prefs-memberingroups'       => 'Membro di la {{PLURAL:$1|grupo|grupi}}:',
'yourrealname'               => 'Reala nomo:',
'yourlanguage'               => 'Linguo:',
'yournick'                   => 'Signaturo:',
'badsiglength'               => 'Vua signaturo es tro longa.
Ol mustas ne havar plu kam $1 {{PLURAL:$1|litero|literi}}.',
'email'                      => 'Elek-posto',
'loginerror'                 => 'Eroro enirante',
'prefs-help-email-required'  => 'E-postala adreso es bezonata.',
'nocookieslogin'             => "{{SITENAME}} uzas ''cookies'' por la registrago dil uzanti. Vu havas la ''cookies'' desaktivigita. Voluntez aktivigar oli e probez altrafoye.",
'noname'                     => 'Vu ne donis valida uzantonomo.',
'loginsuccesstitle'          => 'Eniro sucesoza',
'loginsuccess'               => "'''Vu eniris a {{SITENAME}} kom \"\$1\".'''",
'nosuchuser'                 => 'Ne existas uzero "$1".
Uzanto-nomi esas mayu/minuskulo-distingenda.
Kontrolez vua espelado, o [[Special:UserLogin/signup|krear nova konto]].',
'nosuchusershort'            => 'Esas nula uzero "<nowiki>$1</nowiki>". Kontrolez la espelado.',
'nouserspecified'            => 'Vu mustas specigar uzantonomo.',
'wrongpassword'              => 'La skribita pasovorto esis nekorekta. Voluntez probar itere.',
'wrongpasswordempty'         => 'Vu ne skribis pasovorto. Probez nove.',
'passwordtooshort'           => 'Vua pasovorto es ne-valida o tro kurta.
Ol mustas kontenar adminime {{PLURAL:$1|1 signo|$1 signi}} ed mustas esar diferanta kam vua uzantonomo.',
'mailmypassword'             => 'Sendez nova pasovorto per e-posto',
'passwordremindertitle'      => 'Nova provizora pasovorto por {{SITENAME}}',
'noemail'                    => 'Ne esas e-adreso konservita por la uzanto "$1".',
'passwordsent'               => 'Nova pasovorto sendesis a la e-adreso registragita por "$1".
Voluntez enirar altrafoye pos recevar ol.',
'mailerror'                  => 'Eroro sendante posto: $1',
'acct_creation_throttle_hit' => 'Vu ja kreis $1 konti. Vu ne plus povas facar.',
'emailconfirmlink'           => 'Konfirmez vua adreso di e-posto',
'accountcreated'             => 'Konto kreesis',
'accountcreatedtext'         => 'La uzantokonto por $1 kreatesis.',
'createaccount-title'        => 'Kreo di konto en {{SITENAME}}',
'loginlanguagelabel'         => 'Linguo: $1',

# Password reset dialog
'resetpass_header'  => 'Chanjar pasovorto di konto',
'resetpass_submit'  => 'Establisez pasovoro ed enirez',
'resetpass_success' => 'Vua chanjo di pasovorto sucesis! Nun, vu eniras...',

# Edit page toolbar
'bold_sample'     => 'Dika literi',
'bold_tip'        => 'Dika literi',
'italic_sample'   => 'Kursiva literi',
'italic_tip'      => 'Kursiva literi',
'link_sample'     => 'Titulo dil ligilo',
'link_tip'        => 'Interna ligilo',
'extlink_sample'  => 'http://www.example.com Titulo dil ligilo',
'extlink_tip'     => 'Extera ligilo (memorez adjuntar la prefixo "http://")',
'headline_sample' => 'Texto dil titulo',
'headline_tip'    => 'Titulo di duesma nivelo',
'math_sample'     => 'Insertez formulo hike',
'math_tip'        => 'Formulo matematika (LaTeX)',
'nowiki_sample'   => 'Insertar senformizita texto hike',
'nowiki_tip'      => 'Ignorez formatigo wikial',
'image_sample'    => 'Exemplo.jpg',
'image_tip'       => 'Imajo enkorpigita',
'media_sample'    => 'Exemplo.ogg',
'media_tip'       => 'Ligilo di arkivo',
'sig_tip'         => "Vua signaturo kun 'timestamp'",
'hr_tip'          => 'Horizontala lineo (ne trouzez ol)',

# Edit pages
'summary'                          => 'Rezumo',
'subject'                          => 'Temo / Titulo',
'minoredit'                        => 'Ico esas mikra redaktajo',
'watchthis'                        => 'Surveyar ica pagino',
'savearticle'                      => 'Registragar pagino',
'preview'                          => 'Previdar',
'showpreview'                      => 'Previdar',
'showdiff'                         => 'Montrez chanji',
'anoneditwarning'                  => "'''Averto:''' Vu ne eniris.
Vua IP-adreso registragesos en la versionaro di ca pagino.",
'missingcommenttext'               => 'Voluntez, skribez komento sube.',
'blockedtitle'                     => 'La uzanto esas blokusita',
'blockednoreason'                  => 'nula motivo donesis',
'blockedoriginalsource'            => "La fonto di '''$1''' montresas infre:",
'blockededitsource'                => "La texto di '''vua redaktaji''' di '''$1''' es montrata infre:",
'whitelistedittitle'               => 'On mustas enskribar por redaktar',
'whitelistedittext'                => 'Vu mustas $1 por redaktar pagini.',
'confirmedittitle'                 => 'Konfirmado de vua e-posto es bezonata por redaktar',
'nosuchsectiontitle'               => 'Ica seciono ne existas',
'loginreqtitle'                    => 'Eniro esas postulata',
'loginreqlink'                     => 'enirar',
'loginreqpagetext'                 => 'Vu mustas $1 por vidar altra pagini.',
'accmailtitle'                     => 'Pasovorto sendita.',
'accmailtext'                      => 'La kontrolajo por "$1" sendesis a $2.',
'newarticle'                       => '(nova)',
'newarticletext'                   => 'Vu sequis ligilo a pagino qua ne existas ankore.
Por krear ica pagino, voluntez startar skribar en la infra buxo.
(regardez la [[{{MediaWiki:Helppage}}|helpo]] por plusa informo).
Se vu esas hike erore, kliktez sur la butono por retrovenar en vua navigilo.',
'noarticletext'                    => 'Prezente, ne esas texto en ica pagino.
Vu povas [[Special:Search/{{PAGENAME}}|serchar ica titulo]] en altra pagini,
<span class="plainlinks">[{{fullurl:Special:Log|page={{urlencode:{{FULLPAGENAME}}}}}} serchar en la relata registri],
o [{{fullurl:{{FULLPAGENAME}}|action=edit}} redaktar ica pagino]</span>.',
'clearyourcache'                   => "'''Atencez: Pos registragar, vu probable mustas renovigar la tempala-magazino di vua navigilo por vidar la chanji.'''
'''Mozilla / Firefox / Safari:''' tenez ''Shift'' kliktante ''Reload'', o presez sive  ''Ctrl-F5'' sive ''Ctrl-R'' (''Command-R'' ye Macintosh);
'''Konqueror''': kliktez ''Reload'' o presez ''F5'';
'''Opera:''' vakuigez la tempala-magazino en ''Tools → Preferences'';
'''Internet Explorer:''' tenez ''Ctrl'' kliktante ''Refresh,'' o presez ''Ctrl-F5''.",
'usercsspreview'                   => "'''Memorez ke vu nur previdas vua uzanto-CSS.'''
'''Ol ne registragesis ankore!'''",
'userjspreview'                    => "'''Memorez ke vu nur previdas vua javascript di uzanto. Ol ne registragesis ankore!'''",
'updated'                          => '(Aktualigita)',
'note'                             => "'''Noto:'''",
'previewnote'                      => "'''Atencez ke ico esas nur prevido ed ol ne registragesis ankore!'''",
'session_fail_preview'             => "'''Pardonez! Ni ne povis traktar vua redakto pro perdo di sesiono donaji.'''
Voluntez probar itere.
Se ol ankore nefuncionas, probez [[Special:UserLogout|ekirar]] e pose enirar.",
'editing'                          => 'Vu redaktas $1',
'editingsection'                   => 'Vu redaktas $1 (seciono)',
'editingcomment'                   => 'Vu redaktas $1 (nova seciono)',
'editconflict'                     => 'Redakto-konflikto: $1',
'explainconflict'                  => 'Ulu chanjis ica pagino depos vu editeskis ol. La supra texto-areo kontenas la texto dil pagino quale ol existas aktuale. Vua chanji montresas en la infra texto-areo. Vu devas atachar vua chanji en la existanta texto. <b>Nur</b> la texto en la supra texto-areo registragesos kande vu presez sur "Registragar".',
'yourtext'                         => 'Vua texto',
'storedversion'                    => 'Gardita versiono',
'nonunicodebrowser'                => "'''EGARDEZ: Vua navigilo esas ne obediema ad ''unicode''.'''
Solvo esas funcionanta qua posibligas redaktar pagini sekure por vu: ne-ASCII signi konvertesos en la redakto-buxo kom dekesisala kodi.",
'editingold'                       => "'''EGARDEZ: Vu redaktas anciena versiono di ca pagino.
Se vu gardus ol, la chanji facita pos ita revizo perdesos.'''",
'yourdiff'                         => 'Diferi',
'copyrightwarning'                 => "Voluntez memorar ke omna kontributi a {{SITENAME}} esas sub la $2 (Videz $1 por detali).
Se vu ne deziras ke altri modifikez vua artikli od oli distributesez libere, lore voluntez ne skribar oli hike.<br />
Publikigante vua skribajo hike, vu asertas ke olu skribesis da vu ipsa o kopiesis de libera fonto.
'''NE SENDEZ ARTIKLI KUN ''COPYRIGHT'' SEN PERMISO!'''",
'longpagewarning'                  => "'''EGARDEZ''': Ica pagino esas $1 kilobicoki longa;
Ula navigili posible havas problemi redaktante pagini proximeskanta o plu longa kam 32kb.
Voluntez konsideras separar la pagino aden plu mikra secioni.",
'protectedpagewarning'             => "'''AVERTO: Ica pagino esas blokusita, do nur ''sysop''-i povas redaktar olu.'''",
'templatesused'                    => 'Shabloni uzata en ica pagino:',
'templatesusedpreview'             => 'Shabloni uzata en ica prevido:',
'templatesusedsection'             => 'Shabloni uzata en ica seciono:',
'template-protected'               => '(protektita)',
'template-semiprotected'           => '(mi-protektita)',
'hiddencategories'                 => 'Ca pagino esas membro di {{PLURAL:$1|1 celita kategorio|$1 celita kategorii}}:',
'nocreatetitle'                    => 'Kreado di pagini limitita',
'permissionserrorstext-withaction' => 'Vu ne darfas $2, pro la {{PLURAL:$1|kauzo|kauzi}} sequanta:',

# History pages
'viewpagelogs'        => 'Videz registrari por ca pagino',
'nohistory'           => 'Ne esas redakto-historio por ica pagino.',
'revnotfound'         => 'Versiono ne trovita',
'revnotfoundtext'     => "L' anciena versiono di la pagino, quan vu demandis, ne povis trovesar.
Voluntez kontrolar la URL quan vu uzis por acesar a ca pagino.",
'currentrev'          => 'Aktuala versiono',
'revisionasof'        => 'Versiono ye $1',
'revision-info'       => 'Versiono en $1 per $2',
'previousrevision'    => '←Plu anciena versiono',
'nextrevision'        => 'Plu recenta versiono→',
'currentrevisionlink' => 'Aktuala versiono',
'cur'                 => 'nuna',
'next'                => 'sequanta',
'last'                => 'lasta',
'page_first'          => 'unesma',
'page_last'           => 'finala',
'histlegend'          => "Selektado por diferi: markizez la versioni por komparar e lore presez 'Enter' o la butono infre.<br /> 
Surskriburo: '''({{int:cur}})''' = diferi kun l'aktuala versiono, 
'''({{int:last}})''' = diferi kun l'antea versiono, 
'''{{int:minoreditletter}}''' = mikra redakto.",
'deletedrev'          => '[efacita]',
'histfirst'           => 'Maxim anciena',
'histlast'            => 'Maxim nova',
'historysize'         => '({{PLURAL:$1|1 bicoko|$1 bicoki}})',
'historyempty'        => '(vakua)',

# Revision feed
'history-feed-item-nocomment' => '$1 ye $2', # user at time

# Revision deletion
'rev-deleted-comment'    => '(komento forigita)',
'rev-deleted-user'       => '(uzantonomo forigita)',
'rev-delundel'           => 'montrar/celar',
'revdelete-hide-comment' => 'Celar komento pri redakto',
'revdelete-hide-user'    => 'Celar uzantonomo od IP di redaktanto',
'revdelete-hide-image'   => 'Celar kontenajo dil arkivo',
'revdel-restore'         => 'chanjar videbleso',
'pagehist'               => 'Pagino-versionaro',
'deletedhist'            => 'Efacita versionaro',
'revdelete-content'      => 'kontenajo',
'revdelete-summary'      => 'redakto-rezumo',
'revdelete-uname'        => 'uzantonomo',
'revdelete-hid'          => 'celis $1',
'revdelete-unhid'        => 'revelis $1',
'logdelete-log-message'  => '$1 por $2 {{PLURAL:$2|evento|eventi}}',

# Merge log
'revertmerge' => 'Desmixar',

# Diffs
'history-title'           => 'Versionaro di "$1"',
'difference'              => '(Diferi inter versioni)',
'lineno'                  => 'Lineo $1:',
'compareselectedversions' => 'Komparar selektita versioni',
'editundo'                => 'des-facez',

# Search results
'searchresults'             => 'Rezultaji dil sercho',
'searchresulttext'          => 'Por plusa informo pri quale serchar en {{SITENAME}}, videz [[{{MediaWiki:Helppage}}|help]].',
'searchsubtitle'            => "Vu serchis '''[[:$1]]'''",
'searchsubtitleinvalid'     => "Vu serchis '''$1'''",
'noexactmatch'              => "'''Es nula pagino titulizita \"\$1\".''' Vu darfas [[:\$1|krear ica pagino]].",
'noexactmatch-nocreate'     => "'''Es nula pagino havanta la titulo \"\$1\".'''",
'titlematches'              => 'Koincidi de titulo di artiklo',
'notitlematches'            => 'No esas koincidi en la tituli dil artikli',
'textmatches'               => 'Koincidi de texto di artiklo',
'notextmatches'             => 'Nula paginala texto fitas',
'prevn'                     => 'antea $1',
'nextn'                     => 'sequanta $1',
'viewprevnext'              => 'Vidar ($1) ($2) ($3).',
'search-result-size'        => '$1 ({{PLURAL:$2|1 vorto|$2 vorti}})',
'search-result-score'       => 'Importo: $1%',
'search-redirect'           => '(ridirektilo $1)',
'search-section'            => '(seciono $1)',
'search-suggest'            => 'Ka vu volis dicar: $1',
'search-interwiki-default'  => 'Rezultaji di $1:',
'search-interwiki-more'     => '(plusa)',
'search-mwsuggest-enabled'  => 'kun sugestaji',
'search-mwsuggest-disabled' => 'sen sugestaji',
'searchall'                 => 'omna',
'showingresults'            => "Montrante infre {{PLURAL:$1|'''1''' rezulto|'''$1''' rezulti}}, qui komencas kun numero #'''$2'''.",
'showingresultsnum'         => "Montrante infre {{PLURAL:$3|'''1''' rezulto|'''$3''' rezulti}}, qui komencas kun numero #'''$2'''.",
'nonefound'                 => "'''Atencez''': Nespecigite, nur ula nomari esas serchata.
Probez prefixizar vua demando kun ''all:'' por serchar omna kontenajo (inkluzanta debato-pagini, shabloni, edc.), od uzar la dezirata nomaro kom prefixo.",
'powersearch'               => 'Avancita sercho',
'powersearch-legend'        => 'Avancita sercho',
'powersearch-ns'            => 'Serchez en nomari:',
'powersearch-redir'         => 'Listar ridirekti',
'powersearch-field'         => 'Serchar',
'search-external'           => 'Extera sercho',
'searchdisabled'            => 'La sercho en la kompleta texto desaktivigesis temporale pro superkargo dil servanto. Ni esperas riaktivigar ol pos facar ula proxima aktualigi. Dum ica tempo, vu povas serchar per Google.',

# Preferences page
'preferences'          => 'Preferaji',
'mypreferences'        => 'Mea preferaji',
'prefs-edits'          => 'Nombro di redaktaji:',
'prefsnologin'         => 'Vu ne eniris',
'prefsnologintext'     => 'Vu mustas <span class="plainlinks">[{{fullurl:Special:UserLogin|returnto=$1}} enirir] por establisar la preferaji.',
'prefsreset'           => 'La preferaji riestablisesis da la depozeyo.',
'qbsettings'           => 'Preferaji pri "Quickbar"',
'qbsettings-none'      => 'Nula',
'changepassword'       => 'Chanjar pasovorto',
'skin'                 => 'Pelo',
'math'                 => 'Quale montrar la formuli',
'dateformat'           => 'Formo di dato',
'datedefault'          => 'Sen prefero',
'datetime'             => 'Dato e tempo',
'math_unknown_error'   => 'nekonocata eroro',
'math_bad_tmpdir'      => 'Onu ne povas skribar o krear la tempala matematikala arkivaro',
'math_bad_output'      => 'Onu ne povas skribar o krear la arkivaro por la matematiko',
'prefs-personal'       => 'Personala informo',
'prefs-rc'             => 'Recenta chanji',
'prefs-watchlist'      => 'Surveyo-listo',
'prefs-watchlist-days' => 'Dii montrata en surveyaji:',
'prefs-misc'           => 'Mixaji',
'saveprefs'            => 'Registragar',
'resetprefs'           => 'Riestablisar preferaji',
'oldpassword'          => 'Anciena pasovorto:',
'newpassword'          => 'Nova pasovorto:',
'retypenew'            => 'Riskribez la nova pasovorto:',
'textboxsize'          => 'Grandeso dil areo por texto',
'rows'                 => 'Linei:',
'columns'              => 'Kolumni:',
'searchresultshead'    => 'Preferaji di la rezultaji dil sercho',
'resultsperpage'       => 'Trovaji po pagino:',
'contextlines'         => 'Linei por montrar singlarezulte:',
'contextchars'         => 'Tipi di kuntexto ye singla lineo:',
'recentchangescount'   => 'Quanto de redakti montrota kustume en la recenta chanji, pagino-versionari e registri:',
'savedprefs'           => 'Vua preferaji registragesis.',
'timezonelegend'       => 'Tempala zono:',
'timezonetext'         => 'Vua lokala tempo diferas de tempo dil servanto (UTC).',
'localtime'            => 'Lokala tempo',
'timezoneoffset'       => 'Difero',
'servertime'           => 'La kloko en la servanto esas',
'guesstimezone'        => 'Obtenar la kloko dil "browser"',
'allowemail'           => 'Permisez e-posti de altra uzanti',
'prefs-namespaces'     => 'Nomari',
'defaultns'            => 'Serchar en la spaco-nomi omise:',
'files'                => 'Arkivi',

# User rights
'userrights-user-editname' => 'Skribez uzantonomo:',
'userrights-groupsmember'  => 'Membro di:',

# Groups
'group'            => 'Grupo:',
'group-user'       => 'Uzanti',
'group-bot'        => 'Roboti',
'group-sysop'      => 'Administranti',
'group-bureaucrat' => 'Burokrati',
'group-all'        => '(omna)',

'group-user-member'       => 'Uzanto',
'group-bot-member'        => 'Roboto',
'group-sysop-member'      => 'Administranto',
'group-bureaucrat-member' => 'Burokrato',

'grouppage-user'       => '{{ns:project}}:Uzanti',
'grouppage-bot'        => '{{ns:project}}:Roboti',
'grouppage-sysop'      => '{{ns:project}}:Administranti',
'grouppage-bureaucrat' => '{{ns:project}}:Burokrati',

# Rights
'right-read'          => 'Lektar pagini',
'right-edit'          => 'Redaktar pagini',
'right-move'          => 'Movar pagini',
'right-delete'        => 'Efacar pagini',
'right-browsearchive' => 'Serchar pagini efacita',
'right-rollback'      => 'Rapide retrorulez la redakti da la lasta uzanto qua redaktis specigita pagino',

# User rights log
'rightsnone' => '(nula)',

# Recent changes
'nchanges'          => '$1 {{PLURAL:$1|chanjo|chanji}}',
'recentchanges'     => 'Recenta chanji',
'recentchangestext' => 'Regardez la maxim recenta chanji en Wiki per ica pagino.',
'rcnote'            => "Infre esas la lasta {{PLURAL:$1|'''1''' chanjo|'''$1''' chanji}} dum la lasta {{PLURAL:$2|dio|'''$2''' dii}} ye $5, $4.",
'rcnotefrom'        => "Infre esas la lasta chanji depos '''$2''' (montrita til '''$1''').",
'rclistfrom'        => 'Montrar nova chanji startante de $1',
'rcshowhideminor'   => '$1 mikra redakti',
'rcshowhidebots'    => '$1 roboti',
'rcshowhideliu'     => '$1 enirinta uzanti',
'rcshowhideanons'   => '$1 anonima uzanti',
'rcshowhidemine'    => '$1 mea redakti',
'rclinks'           => 'Montrar la lasta $1 chanji dum la lasta $2 dii<br />$3',
'diff'              => 'dif',
'hist'              => 'vers',
'hide'              => 'Celar',
'show'              => 'Montrar',
'minoreditletter'   => 'm',
'newpageletter'     => 'N',
'boteditletter'     => 'r',
'rc_categories_any' => 'Ula',
'newsectionsummary' => '/* $1 */ nova seciono',

# Recent changes linked
'recentchangeslinked'         => 'Relatanta chanji',
'recentchangeslinked-title'   => 'Chanji pri "$1"',
'recentchangeslinked-summary' => "Co esas listo di recenta chanji ad pagini ligita da specigita pagino, od pagini en specigita kategorio.
Pagini en [[Special:Watchlist|vua surveryo-listo]] esas '''dika'''.",
'recentchangeslinked-page'    => 'Nomo dil pagino:',
'recentchangeslinked-to'      => 'Montrez chanji a pagini ligita a la specigita pagino vice',

# Upload
'upload'            => 'Adkargar arkivo',
'uploadbtn'         => 'Adkargar arkivo',
'reupload'          => 'Ri-adkargar',
'reuploaddesc'      => 'Retrovenar al adkargo-formularo.',
'uploadnologin'     => 'Vu ne eniris',
'uploadnologintext' => 'Vu mustas [[Special:UserLogin|enirir]] por adkargar arkivi.',
'uploaderror'       => 'Eroro dum adkargo',
'uploadlog'         => 'Adkargo-log',
'uploadlogpage'     => 'Adkargar-registraro',
'uploadlogpagetext' => 'Infre esas listo di la plu recenta adkargaji.',
'filename'          => 'Arkivo-nomo',
'filedesc'          => 'Titulo',
'fileuploadsummary' => 'Rezumo:',
'filestatus'        => 'Stando di kopiyuro:',
'filesource'        => 'Fonto:',
'uploadedfiles'     => 'Adkargita arkivi',
'ignorewarning'     => 'Ignorar la averto e gardar la arkivo irgakaze.',
'badfilename'       => 'La imajo-nomo chanjesis a "$1".',
'fileexists'        => "Arkivo kun ica nomo ja existas. Volutez kontrolar '''<tt>$1</tt>''' se vu ne esas certa pri chanjar olu.",
'successfulupload'  => 'Adcharjo sucesoza',
'uploadwarning'     => 'Averto pri la adkargo di arkivo',
'savefile'          => 'Registragar arkivo',
'uploadedimage'     => 'adkargita "[[$1]]"',
'uploaddisabled'    => 'Pardonez, la adkargo esas desaktiva.',
'watchthisupload'   => 'Surveyar ica arkivo',

# Special:ImageList
'imgfile'        => 'arkivo',
'imagelist'      => 'Listo di imaji',
'imagelist_date' => 'Dato',
'imagelist_name' => 'Nomo',
'imagelist_user' => 'Uzanto',

# Image description page
'filehist'                       => 'Historio dil arkivo',
'filehist-help'                  => 'Kliktez sur la dato/horo por vidar arkivo quale ol aparis ye ta tempo.',
'filehist-current'               => 'aktuala',
'filehist-datetime'              => 'Dato/Horo',
'filehist-user'                  => 'Uzanto',
'filehist-dimensions'            => 'Dimensioni',
'filehist-filesize'              => 'Grandeso dil arkivo',
'filehist-comment'               => 'Komento',
'imagelinks'                     => 'Ligili al arkivo',
'linkstoimage'                   => 'La {{PLURAL:$1|pagino|$1 pagini}} infre ligas a ca arkivo:',
'nolinkstoimage'                 => 'Nula pagino ligas a ca pagino.',
'shareduploadduplicate-linktext' => 'altra arkivo',
'shareduploadconflict-linktext'  => 'altra arkivo',
'uploadnewversion-linktext'      => 'Adkargez nova versiono dil arkivo',

# File reversion
'filerevert-comment' => 'Komento:',

# File deletion
'filedelete'                  => 'Efacar $1',
'filedelete-legend'           => 'Efacar arkivo',
'filedelete-intro'            => "Vu efacas '''[[Media:$1|$1]]''' kun olua tota versionaro.",
'filedelete-submit'           => 'Efacar',
'filedelete-otherreason'      => 'Altra/suplementala motivo:',
'filedelete-reason-otherlist' => 'Altra motivo',

# Unwatched pages
'unwatchedpages' => 'Nesurveyata pagini',

# Unused templates
'unusedtemplates'    => 'Neuzata shabloni',
'unusedtemplateswlh' => 'altra ligili',

# Random page
'randompage' => 'Hazarda pagino',

# Random redirect
'randomredirect' => 'Hazarda ridirektilo',

# Statistics
'statistics'             => 'Statistiko',
'sitestats'              => 'Statistiki di {{SITENAME}}',
'userstats'              => 'Statistiki di uzanto',
'statistics-mostpopular' => 'Maxim ofte vizitita pagini',

'disambiguations' => 'Pagini di desambiguizo',

'doubleredirects' => 'Duopla ridirektili',

'brokenredirects'        => 'Ridirektili nekorekta',
'brokenredirectstext'    => 'La sequanta ridirektili ligas a ne-existanta pagini:',
'brokenredirects-edit'   => '(redaktar)',
'brokenredirects-delete' => '(efacar)',

'withoutinterwiki'        => 'Pagini sen linguo-ligili',
'withoutinterwiki-legend' => 'Prefixo',
'withoutinterwiki-submit' => 'Montrar',

# Miscellaneous special pages
'nbytes'                  => '$1 {{PLURAL:$1|bicoko|bicoki}}',
'ncategories'             => '$1 {{PLURAL:$1|kategorio|kategorii}}',
'nlinks'                  => '$1 {{PLURAL:$1|ligilo|ligili}}',
'nmembers'                => '$1 {{PLURAL:$1|membro|membri}}',
'nviews'                  => '$1 {{PLURAL:$1|vizito|viziti}}',
'lonelypages'             => 'Pagini sen ligili',
'uncategorizedpages'      => 'Nekategorizita pagini',
'uncategorizedcategories' => 'Nekategorizita kategorii',
'uncategorizedimages'     => 'Nekategorizita arkivi',
'uncategorizedtemplates'  => 'Nekategorizita shabloni',
'unusedcategories'        => 'Neuzata kategorii',
'unusedimages'            => 'Neuzata imaji',
'popularpages'            => 'Populara pagini',
'wantedcategories'        => 'Dezirata kategorii',
'wantedpages'             => 'Dezirata pagini',
'prefixindex'             => 'Omna pagini kun prefixo',
'shortpages'              => 'Kurta pagini',
'longpages'               => 'Longa pagini',
'deadendpages'            => 'Pagini sen ekiraji',
'protectedpages'          => 'Protektita pagini',
'protectedtitles'         => 'Protektita tituli',
'listusers'               => 'Uzanto-listo',
'newpages'                => 'Nova pagini',
'newpages-username'       => 'Uzantonomo:',
'ancientpages'            => 'Maxim anciena artikli',
'move'                    => 'Movar',
'movethispage'            => 'Rinomizar ica pagino',
'unusedimagestext'        => 'Voluntez egardez ke altra ret-situi povus ligar a arkivo per direta URL, e do ol povus esar enlistizita hike malgre olu havas aktiva uzo.',
'notargettitle'           => 'Ne esas vakua pagino',
'notargettext'            => 'Vu ne definis en qua pagino agar ica funciono.',
'pager-newer-n'           => '{{PLURAL:$1|plu nova 1|plu nova $1}}',
'pager-older-n'           => '{{PLURAL:$1|plu anciena 1|plu anciena $1}}',

# Book sources
'booksources'    => 'Fonti di libri',
'booksources-go' => 'Irar',

# Special:Log
'specialloguserlabel'  => 'Uzero:',
'speciallogtitlelabel' => 'Titulo:',
'log'                  => 'Registrari',
'log-search-submit'    => 'Irar',

# Special:AllPages
'allpages'          => 'Omna pagini',
'alphaindexline'    => '$1 til $2',
'nextpage'          => 'Sequanta pagino ($1)',
'prevpage'          => 'Antea pagino ($1)',
'allpagesfrom'      => 'Montrez pagini de:',
'allarticles'       => 'Omna pagini',
'allinnamespace'    => 'Omna pagini (nomaro $1)',
'allnotinnamespace' => 'Omna pagini (ne in nomaro $1)',
'allpagesprev'      => 'Antea',
'allpagesnext'      => 'Sequanta',
'allpagessubmit'    => 'Irez',
'allpages-bad-ns'   => '{{SITENAME}} ne havas nomaro "$1".',

# Special:Categories
'categories' => 'Kategorii',

# Special:ListUsers
'listusers-submit' => 'Montrez',

# Special:ListGroupRights
'listgrouprights-group'   => 'Grupo',
'listgrouprights-members' => '(listo di membri)',

# E-mail user
'mailnologin'     => 'Ne sendar adreso',
'mailnologintext' => 'Vu mustas [[Special:UserLogin|enirir]] e havar valida e-adreso en vua [[Special:Preferences|preferaji]] por sendar e-posto ad altra uzanti.',
'emailuser'       => 'Sendar e-posto a ca uzanto',
'emailpage'       => 'E-posto ad uzanto',
'defemailsubject' => 'E-posto di {{SITENAME}}',
'noemailtitle'    => 'Ne esas e-adreso',
'emailfrom'       => 'De:',
'emailto'         => 'Ad:',
'emailsubject'    => 'Temo:',
'emailmessage'    => 'Sendajo:',
'emailsend'       => 'Sendar',
'emailsent'       => 'E-posto sendita',
'emailsenttext'   => 'Vua e-posto sendesis.',

# Watchlist
'watchlist'            => 'Mea surveyaji',
'mywatchlist'          => 'Mea surveyaji',
'watchlistfor'         => "(por '''$1''')",
'nowatchlist'          => 'Vu ne havas objekti en vua listo di surveyaji.',
'watchnologin'         => 'Vu ne startis sesiono',
'watchnologintext'     => 'Vu mustas [[Special:UserLogin|enirir]] por modifikar vua surveyaji.',
'addedwatch'           => 'Adjuntita a la listo de surveyaji',
'addedwatchtext'       => "La pagino \"<nowiki>\$1</nowiki>\" atachesis a vua [[Special:Watchlist|listo de surveyaji]]. Futura chanji di ica pagino ed olua relatanta debato-pagini montresos ibe, ed la pagino aparos per '''dika literi''' en la [[Special:RecentChanges|listo de recenta chanji]] por faciligar sua trovebleso.

<p> Se vu volas efacar la pagino de vua listo de surveyaji pose, presez \"Ne plus surveyar\" en la selektaro.",
'removedwatch'         => 'Efacita de surveyo-listo',
'watch'                => 'Surveyar',
'watchthispage'        => 'Surveyar ica pagino',
'unwatch'              => 'Ne plus surveyar',
'unwatchthispage'      => 'Ne plus surveyar',
'notanarticle'         => 'Ne esas artiklo',
'watchnochange'        => 'Nula artikli ek vua listo di surveyaji redaktesis dum la tempo montrata.',
'watchmethod-recent'   => 'serchante recenta chanji en la listo di surveyaji',
'watchmethod-list'     => 'serchante recenta redakti en la listo di surveyaji',
'watchlistcontains'    => 'Vua listo di surveyaji kontenas $1 {{PLURAL:$1|pagino|pagini}}.',
'iteminvalidname'      => "Problemo en la artiklo '$1', nevalida nomo...",
'wlnote'               => "Infre esas la lasta {{PLURAL:$1|chanjo|'''$1''' chanji}} dum la lasta {{PLURAL:$2|horo|'''$2''' hori}}.",
'wlshowlast'           => 'Montrar la lasta $1 hori $2 dii $3',
'watchlist-hide-own'   => 'Celez chanji da me',
'watchlist-hide-minor' => 'Celez mikra chanji',

# Displayed when you click the "watch" button and it is in the process of watching
'watching'   => 'Surveyanta…',
'unwatching' => 'Cesanta surveyar…',

'enotif_newpagetext'           => 'Ico esas nula pagino.',
'enotif_impersonal_salutation' => 'Uzanto di {{SITENAME}}',
'enotif_anon_editor'           => 'anonima uzanto $1',

# Delete/protect/revert
'deletepage'            => 'Efacar pagino',
'confirm'               => 'Konfirmar',
'excontent'             => "La kontenajo esis: '$1'",
'exbeforeblank'         => "La kontenajo ante efaco esis: '$1'",
'exblank'               => 'La pagino esis vakua',
'delete-confirm'        => 'Efacar "$1"',
'delete-legend'         => 'Efacar',
'historywarning'        => 'Egardez: La pagino, quan vu efaceskas, havas versionaro:',
'actioncomplete'        => 'Ago kompletigita',
'deletedtext'           => '"<nowiki>$1</nowiki>" efacesis.
Videz $2 por obtenar registro di recenta efaci.',
'deletedarticle'        => 'efacis "[[$1]]"',
'dellogpage'            => 'Efaco-registraro',
'dellogpagetext'        => 'Infre esas listo di la plu recenta efaci.',
'deletionlog'           => 'registro di efaciti',
'reverted'              => 'Rekuperita ad antea versiono',
'deletecomment'         => "Motivo por l'efaco:",
'deleteotherreason'     => 'Altra/suplementala motivo:',
'deletereasonotherlist' => 'Altra motivo',
'deletereason-dropdown' => '*Ordinara motivi por efaco
** Demandita da autoro
** Kopiyuro Violaco
** Korupto',
'rollback'              => 'Retrorulez redakti',
'rollback_short'        => 'Retrorular',
'rollbacklink'          => 'retrorulez',
'rollbackfailed'        => 'Retrorular ne sucesis',
'cantrollback'          => 'Ne esas posibla retrorular. La lasta kontributanto esas la nura autoro di ica pagino.',
'alreadyrolled'         => 'Onu ne povas desfacar la lasta chanjo di [[$1]]
da [[User:$2|$2]] ([[User talk:$2|Talk]]); ulu pluse ja editis o desfacis ica pagino.

Lasta edito esis da [[User:$3|$3]] ([[User talk:$3|Talk]]).',
'editcomment'           => "La rezumo di la redakto esis: \"''\$1''\".", # only shown if there is an edit comment
'revertpage'            => 'Desfacita redakti da [[Special:Contributions/$2|$2]] ([[User talk:$2|Debato]]) e rekuperita la lasta redakto da [[User:$1|$1]]', # Additional available: $3: revid of the revision reverted to, $4: timestamp of the revision reverted to, $5: revid of the revision reverted from, $6: timestamp of the revision reverted from
'rollback-success'      => 'Desfacis redakti da $1;
restauris ad lasta versiono da $2.',
'protectlogpage'        => 'Protekto-registraro',
'protectedarticle'      => 'protektita "[[$1]]"',
'unprotectedarticle'    => 'desprotektita [[$1]]',
'protect-title'         => 'Protektante "$1"',
'protect-legend'        => 'Konfirmar protekto',
'protectcomment'        => 'Komento:',
'protect-level-sysop'   => 'Nur administranti',
'restriction-type'      => 'Permiso:',
'pagesize'              => '(bicoki)',

# Restrictions (nouns)
'restriction-edit' => 'Redaktar',

# Undelete
'undelete'                  => 'Vidar efacita pagini',
'undeletepage'              => 'Vidar e restaurar efacita pagini',
'undeletepagetext'          => 'La sequanta pagini efacesis ma li ankore esas en la arkivo ed esas restaurebla. La arkivo povas netigesar periodale.',
'undeleterevisions'         => '$1 {{PLURAL:$1|revizo|revizi}} konservita',
'undeletebtn'               => 'Restaurar',
'undeletelink'              => 'vidar/restaurar',
'undeletecomment'           => 'Komento:',
'undeletedarticle'          => 'restaurita "[[$1]]"',
'undelete-search-box'       => 'Serchez efacita pagini',
'undelete-search-submit'    => 'Serchar',
'undelete-show-file-submit' => 'Yes',

# Namespace form on various pages
'namespace'      => 'Nomaro:',
'invert'         => 'Inversigar selektajo',
'blanknamespace' => '(Chefa)',

# Contributions
'contributions' => 'Kontributadi dil uzanto',
'mycontris'     => 'Mea kontributadi',
'contribsub2'   => 'Pro $1 ($2)',
'nocontribs'    => 'Ne trovesis chanji qui fitez ita kriterii.',
'uctop'         => ' (lasta modifiko)',
'month'         => 'De monato (e plu frue):',
'year'          => 'De yaro (e plu frue):',

'sp-contributions-newbies'     => 'Montrez nur kontributadi di nova konti',
'sp-contributions-newbies-sub' => 'Di nova konti',
'sp-contributions-blocklog'    => 'blokusar-registraro',
'sp-contributions-search'      => 'Serchar kontributadi',
'sp-contributions-username'    => 'IP-adreso od uzantonomo:',
'sp-contributions-submit'      => 'Serchez',

# What links here
'whatlinkshere'            => 'Quo ligas hike',
'whatlinkshere-title'      => 'Pagini qui ligas ad "$1"',
'whatlinkshere-page'       => 'Pagino:',
'linklistsub'              => '(Listo di ligili)',
'linkshere'                => "Ca pagini esas ligilizita ad '''[[:$1]]''':",
'nolinkshere'              => "Nula pagino ligas ad '''[[:$1]]'''.",
'isredirect'               => 'ridirektanta pagino',
'istemplate'               => 'inkluzo',
'isimage'                  => 'imajo-ligilo',
'whatlinkshere-prev'       => '{{PLURAL:$1|antea|antea $1}}',
'whatlinkshere-next'       => '{{PLURAL:$1|sequanta|sequanta $1}}',
'whatlinkshere-links'      => '← ligili',
'whatlinkshere-hideredirs' => '$1 ridirektili',
'whatlinkshere-hidelinks'  => '$1 ligili',
'whatlinkshere-hideimages' => '$1 ligili di imaji',
'whatlinkshere-filters'    => 'Filtrili',

# Block/unblock
'blockip'            => 'Blokusado di IP-adresi',
'blockip-legend'     => 'Blokusar uzanto',
'ipaddress'          => 'IP-adreso:',
'ipadressorusername' => 'IP-adreso od uzantonomo:',
'ipbexpiry'          => 'Expiro:',
'ipbreason'          => 'Motivo:',
'ipbreasonotherlist' => 'Altra motivo',
'ipbreason-dropdown' => '*Ordinara motivi por blokuso
** Insertar nevera informi
** Efacar kontenajo de pagini
** Insertadar ligili ad extera reti
** Insertar radoto aden pagini
** Timidiganta ago
** Trouzar multa konti
** Neaceptebla uzanto-nomo',
'ipbanononly'        => 'Blokusez nur anonimala uzanti',
'ipbcreateaccount'   => 'Preventez kreo di konti',
'ipbsubmit'          => 'Blokusar ica uzanto',
'ipbother'           => 'Altra tempo:',
'ipboptions'         => '2 horo:2 hours,1 dio:1 day,3 dii:3 days,1 semano:1 week,2 semani:2 weeks,1 monato:1 month,3 monati:3 months,6 monati:6 months,1 yaro:1 year,infinita:infinite', # display1:time1,display2:time2,...
'ipbotheroption'     => 'altra',
'ipbotherreason'     => 'Altra/suplementala motivo:',
'badipaddress'       => 'IP-adreso ne esas valida',
'blockipsuccesssub'  => 'Blokusado sucesis',
'blockipsuccesstext' => '[[Special:Contributions/$1|$1]] blokusesis.<br />
Videz [[Special:IPBlockList|IP-blokuslisto]] por revizor blokusadi.',
'ipb-edit-dropdown'  => 'Redaktar blokuso-motivi',
'unblockip'          => 'Desblokusar uzanto',
'unblockiptext'      => 'Uzez la sequanta formularo por restaurar la skribo-aceso ad IP-adreso qua blokusesis antee.',
'ipusubmit'          => 'Desblokusar',
'ipblocklist'        => 'Blokusita IP-adresi ed uzantonomi',
'ipblocklist-submit' => 'Serchar',
'blocklistline'      => '$1, $2 blokusas $3 (expiras $4)',
'blocklink'          => 'blokusar',
'unblocklink'        => 'desblokusar',
'contribslink'       => 'kontrib',
'autoblocker'        => 'Autoblokusita nam vu havas la sama IP-adreso kam "[[User:$1|$1]]". Motivo: "$2"',
'blocklogpage'       => 'Blokusar-registraro',
'blocklogentry'      => 'blokusis [[$1]] dum periodo de $2 $3',
'unblocklogentry'    => 'desblokusis "$1"',
'ipb_expiry_invalid' => 'Nevalida expiro-tempo.',
'ip_range_invalid'   => 'Nevalida IP-rango.',
'proxyblocksuccess'  => 'Facita.',

# Developer tools
'lockdb'              => 'Blokusar datumaro',
'unlockdb'            => 'Desblokusar datumaro',
'lockconfirm'         => 'Yes, me reale volas blokusar la datumaro.',
'unlockconfirm'       => 'Yes, me volas blokusar la datumaro.',
'lockbtn'             => 'Blokusar datumaro',
'unlockbtn'           => 'Desblokusar datumaro',
'locknoconfirm'       => 'Vu ne pulsis la buxeto por konfirmo.',
'lockdbsuccesssub'    => 'Datumaro blokusita sucese',
'unlockdbsuccesssub'  => 'La desblokuso facesis sucese',
'lockdbsuccesstext'   => 'La datumaro blokusesis.<br />
Memorez [[Special:UnlockDB|efacar la blokuso]] kande vua mantenado finos.',
'unlockdbsuccesstext' => 'La datumaro desblokusesis.',

# Move page
'move-page'               => 'Movar $1',
'move-page-legend'        => 'Rinomizar pagino',
'movepagetext'            => "Uzante ica formularo onu povas rinomizar pagino, movante olua omna versionaro ad la nova titulo.
La antea titulo konvertesos a ridirektilo a la nova titulo.
La ligili a la antea titulo dil pagino ne chanjesos.
Voluntez certigar ke ne esas [[Special:DoubleRedirects|duopla]] o [[Special:BrokenRedirects|ruptota ridirektili]].
Vu responsas ke la ligili duros direktante a la pagino korespondanta.

Memorez ke la pagino '''ne''' rinomizesos se ja existus pagino kun la nova titulo, eceptuante ke la pagino esas vakua o ridirektilo sen versionaro.
Ico signifikas ke vu povos rinomizar pagino a olua originala titulo se eroras skribante la nova titulo, ma ne povos riskribar existanta pagino.

'''EGARDEZ!'''
Ica povas esar drastika chanjo e ne-esperinda por populara pagino;
voluntez certigar ke vu komprenas la konsequi qui eventos ante durar adavane.",
'movearticle'             => 'Movez pagino:',
'newtitle'                => 'A nova titulo:',
'move-watch'              => 'Surveyar ca pagino',
'movepagebtn'             => 'Movar pagino',
'pagemovedsub'            => 'Rinomizita sucese',
'movepage-moved'          => '<big>\'\'\'"$1" esas movata ad "$2"\'\'\'</big>', # The two titles are passed in plain text as $3 and $4 to allow additional goodies in the message.
'articleexists'           => 'Pagino kun sama nomo ja existas od la nomo
qua vu selektis ne esas valida.
Voluntez selektar altra nomo.',
'movedto'                 => 'rinomizita ad',
'movetalk'                => 'Rinomizar la debato-pagino se to esas aplikebla.',
'1movedto2'               => '[[$1]] movita a [[$2]]',
'1movedto2_redir'         => '[[$1]] movita a [[$2]] tra ridirektilo',
'movelogpage'             => 'Movo-registraro',
'movereason'              => 'Motivo:',
'revertmove'              => 'rekuperar',
'delete_and_move_confirm' => 'Yes, efacez la pagino',

# Export
'export'            => 'Exportacar pagini',
'exportcuronly'     => 'On inkluzas nur la nuna revizo, ne la kompleta versionaro',
'export-addcattext' => 'Adjuntar pagini ek kategorio:',
'export-addcat'     => 'Adjuntar',

# Namespace 8 related
'allmessages'     => 'Omna sistemo-mesaji',
'allmessagesname' => 'Nomo',
'allmessagestext' => 'Ico esas listo di omna sistemo-mesaji disponebla en la MediaWiki nomaro.
Voluntez vizitar [http://www.mediawiki.org/wiki/Localisation MediaWiki Lokizado] e [http://translatewiki.net translatewiki.net] se vu volus kontributar ad generala MediaWiki lokizado.',

# Thumbnails
'thumbnail-more'  => 'Grandigar',
'thumbnail_error' => 'Ne sucesas krear thumbnail: $1',

# Special:Import
'import'                => 'Importacar pagini',
'importtext'            => 'Voluntez exportacar l\' arkivo de la fonto-wiki uzante la utensilo "Special:Export", registragar ol a vua disko ed adkargar ol hike.',
'importfailed'          => 'La importaco faliis: $1',
'importnotext'          => 'Vakua o sentexta',
'importsuccess'         => 'Importaco sucesoza!',
'importhistoryconflict' => 'Existas versionaro konfliktiva (Ica pagino povus importacesir antee)',

# Tooltip help for the actions
'tooltip-pt-userpage'             => 'Vua uzanto-pagino',
'tooltip-pt-mytalk'               => 'Vua diskuto-pagino',
'tooltip-pt-preferences'          => 'Mea preferaji',
'tooltip-pt-watchlist'            => 'Listo di pagini quin vu kontrolas',
'tooltip-pt-mycontris'            => 'Listo di vua kontributaji',
'tooltip-pt-login'                => 'Vu darfas enirar uzante vua pas-vorto, ma lo ne esas preskriptata.',
'tooltip-pt-logout'               => 'Ekirar',
'tooltip-ca-talk'                 => 'Diskuto pri la pagino di kontenajo',
'tooltip-ca-edit'                 => 'Vu darfas chanjar ta pagino. Voluntez pre-vidar chanji ante registragar oli.',
'tooltip-ca-addsection'           => 'Komencar nova seciono',
'tooltip-ca-viewsource'           => 'Ca pagino esas protektita. Vu povas vidar olua fonto-kodo',
'tooltip-ca-history'              => 'Pasinta versioni di ca pagino',
'tooltip-ca-protect'              => 'Protektez ica pagino',
'tooltip-ca-delete'               => 'Efacez ica pagino',
'tooltip-ca-move'                 => 'Movez pagino',
'tooltip-ca-watch'                => 'Adjuntez ca pagino a vua surveyaji',
'tooltip-ca-unwatch'              => 'Efacar ca pagino de vua surveyo-listo',
'tooltip-search'                  => 'Serchez en {{SITENAME}}',
'tooltip-search-go'               => 'Irez a pagino havanta ta exakta nomo, se existus',
'tooltip-search-fulltext'         => 'Serchez ca texto en la pagini',
'tooltip-p-logo'                  => 'Frontispico',
'tooltip-n-mainpage'              => 'Vizitez la Frontispico',
'tooltip-n-portal'                => 'Pri la projeto, quon vu facus, ube trovus utilaji',
'tooltip-n-currentevents'         => 'Trovez informeco pri aktuala eventi',
'tooltip-n-recentchanges'         => 'Listo di recenta chanji en la wiki.',
'tooltip-n-randompage'            => 'Vizitez hazarda pagino',
'tooltip-n-help'                  => 'La loko por trovar ulo.',
'tooltip-t-whatlinkshere'         => 'Montrez omna wiki pagini qui ligas ad hike',
'tooltip-t-recentchangeslinked'   => 'Recenta chanji di pagini ligita de ca pagino',
'tooltip-feed-rss'                => 'RSS provizero por ica pagino',
'tooltip-feed-atom'               => 'Atom provizero por ica pagino',
'tooltip-t-contributions'         => 'Videz kontributaji di ta uzanto',
'tooltip-t-emailuser'             => 'Sendez mesajo al uzanto',
'tooltip-t-upload'                => 'Adkargez arkivi',
'tooltip-t-specialpages'          => 'Montrez listo di omna specala pagini',
'tooltip-t-print'                 => 'Imprimebla versiono di ca pagino',
'tooltip-t-permalink'             => 'Permananta ligilo vers ita versiono di ta pagino',
'tooltip-ca-nstab-main'           => 'Vidar la kontenajo di ca pagino',
'tooltip-ca-nstab-user'           => 'Videz la pagino dil uzanto',
'tooltip-ca-nstab-special'        => 'Ito esas specala pagino, vu ne povas redaktar la pagino ipsa',
'tooltip-ca-nstab-project'        => 'Vidar la projekto-pagino',
'tooltip-ca-nstab-image'          => 'Videz la pagino dil arkivo',
'tooltip-ca-nstab-template'       => 'Vidar la shablono',
'tooltip-ca-nstab-help'           => 'Vidar la helpo-pagino',
'tooltip-ca-nstab-category'       => 'Videz la pagino dil kategorio',
'tooltip-minoredit'               => 'Markizar ica redaktajo kom mikra',
'tooltip-save'                    => 'Registrigez chanji',
'tooltip-preview'                 => 'Previdar vua chanji. Voluntez uzor ico ante registragar!',
'tooltip-diff'                    => 'Montrez la chanji a la texto quin vu facis',
'tooltip-compareselectedversions' => 'Vidar la diferaji inter la du selektita versioni di ca pagino.',
'tooltip-watch'                   => 'Adjuntar ica pagino a vua listo di surveyaji',
'tooltip-recreate'                => 'Rekrear pagino malgre ol efacesis',
'tooltip-upload'                  => 'Adkargar imaji od altra arkivi',

# Metadata
'notacceptable' => 'La servanto di {{SITENAME}} ne povas provizar datumi en formato quan vua kliento povas komprenar.',

# Attribution
'anonymous'        => 'Anonima uzanti di {{SITENAME}}',
'siteuser'         => 'Uzanto che {{SITENAME}} $1',
'lastmodifiedatby' => 'Ica pagino modifikesis ye $2, $1 da $3.', # $1 date, $2 time, $3 user
'othercontribs'    => 'Bazizita en la laboro da $1.',
'others'           => 'altra',
'siteusers'        => 'Uzanti che {{SITENAME}} $1',

# Spam protection
'spamprotectiontitle' => 'Filtrilo kontre spamo',

# Info page
'numedits'    => 'Quanto di redakti (pagino): $1',
'numwatchers' => 'Quanto di vizitanti: $1',
'numauthors'  => 'Quanto di aparta autori (pagino): $1',

# Patrol log
'patrol-log-auto' => '(automata)',

# Browsing diffs
'previousdiff' => '← Plu anciena versiono',
'nextdiff'     => 'Plu recenta versiono →',

# Media information
'widthheightpage'      => '$1×$2, $3 {{PLURAL:$3|pagino|pagini}}',
'show-big-image-thumb' => '<small>Dimensioni di ca previdajo: $1 × $2 pixel-i</small>',

# Special:NewImages
'newimages'     => 'Galerio di nova arkivi',
'imagelisttext' => "Infre esas listo di '''$1''' {{PLURAL:$1|arkivo|arkivi}} rangizita $2.",
'showhidebots'  => '($1 roboti)',
'ilsubmit'      => 'Serchar',
'bydate'        => 'per dato',

# Metadata
'metadata' => 'Metadonaji',

# EXIF tags
'exif-imagewidth'          => 'Larjeso',
'exif-imagelength'         => 'Alteso',
'exif-artist'              => 'Autoro',
'exif-exposuretime-format' => '$1 sek ($2)',
'exif-gpslatitude'         => 'Latitudo',
'exif-gpslongitude'        => 'Longitudo',
'exif-gpsaltitude'         => 'Altitudo',

'exif-unknowndate' => 'Nesavata dato',

'exif-orientation-1' => 'Normala', # 0th row: top; 0th column: left

'exif-exposureprogram-1' => 'Manuala',

'exif-subjectdistance-value' => '$1 metri',

'exif-meteringmode-0'   => 'Nekonocata',
'exif-meteringmode-1'   => 'Mez-valoro',
'exif-meteringmode-255' => 'Altra',

'exif-sensingmethod-1' => 'Nedefinita',

'exif-gaincontrol-0' => 'Nula',

'exif-contrast-0' => 'Normala',

'exif-saturation-0' => 'Normala',

'exif-sharpness-0' => 'Normala',

# Pseudotags used for GPSSpeedRef and GPSDestDistanceRef
'exif-gpsspeed-k' => 'Kilometri per horo',
'exif-gpsspeed-m' => 'Milii per horo',

# 'all' in various places, this might be different for inflected languages
'recentchangesall' => 'omna',
'imagelistall'     => 'omna',
'watchlistall2'    => 'omna',
'namespacesall'    => 'omna',
'monthsall'        => 'omna',

# E-mail address confirmation
'confirmemail_needlogin' => 'Vu mustas $1 pro konfirmar vua adreso di e-posto.',

# Delete conflict
'deletedwhileediting' => "'''Averto''': Ta pagino efacesis pos ke vu redakteskis!",
'recreate'            => 'Rikrear',

# HTML dump
'redirectingto' => 'Ridirektante ad [[:$1]]...',

# action=purge
'confirm_purge_button' => 'O.K.',

# AJAX search
'articletitles' => "Pagini komencanta per ''$1''",

# Multipage image navigation
'imgmultipageprev' => '← antea pagino',
'imgmultipagenext' => 'sequanta pagino →',
'imgmultigo'       => 'Irez!',
'imgmultigoto'     => 'Irez a pagino $1',

# Table pager
'ascending_abbrev'         => 'aces',
'descending_abbrev'        => 'decen',
'table_pager_next'         => 'Sequanta pagino',
'table_pager_prev'         => 'Antea pagino',
'table_pager_first'        => 'Unesma pagino',
'table_pager_last'         => 'Lasta pagino',
'table_pager_limit_submit' => 'Irar',
'table_pager_empty'        => 'Nula rezultajo',

# Auto-summaries
'autosumm-blank'   => 'Pagino vakuigesis',
'autosumm-replace' => "Kontenajo remplasigesis kun '$1'",
'autoredircomment' => 'Ridirektas a [[$1]]',
'autosumm-new'     => "Pagino kreesis kun '$1'",

# Live preview
'livepreview-loading' => 'Ol kargesas…',
'livepreview-ready'   => 'Ol kargesas… Pronta!',

# Watchlist editor
'watchlistedit-raw-title'  => 'Redaktar texto di surveyo-listo',
'watchlistedit-raw-legend' => 'Redaktar texto di surveyo-listo',
'watchlistedit-raw-titles' => 'Tituli:',

# Watchlist editing tools
'watchlisttools-view' => 'Vidar relatanta chanji',
'watchlisttools-edit' => 'Vidar e redaktar surveyo-listo',
'watchlisttools-raw'  => 'Redaktar texto di surveyo-listo',

# Special:Version
'version'                  => 'Versiono', # Not used as normal message but as header for the special page itself
'version-specialpages'     => 'Specala pagini',
'version-other'            => 'Altra',
'version-version'          => 'Versiono',
'version-license'          => 'Licenco',
'version-software-product' => 'Produkturo',
'version-software-version' => 'Versiono',

# Special:FilePath
'filepath-page' => 'Arkivo:',

# Special:FileDuplicateSearch
'fileduplicatesearch-submit' => 'Serchar',

# Special:SpecialPages
'specialpages'                 => 'Specala pagini',
'specialpages-group-other'     => 'Altra specala pagini',
'specialpages-group-login'     => 'Enirar / krear konto',
'specialpages-group-changes'   => 'Recenta chanji e registri',
'specialpages-group-users'     => 'Uzanti e yuri',
'specialpages-group-pages'     => 'Listi di pagini',
'specialpages-group-pagetools' => 'Paginala utensili',
'specialpages-group-redirects' => 'Specala pagini di ridirektili',

# Special:BlankPage
'blankpage' => 'Pagino sen-skribura',

);
