<?php


namespace Wooppay\ISO639;

use \OutOfBoundsException;

class ISO639
{
	/**
	 * ISO standard names
	 */
	const NAME_OF_639_1 = '639-1';
	const NAME_OF_639_2t = '639-2/t';
	const NAME_OF_639_2b = '639-2/b';
	const NAME_OF_639_3 = '639-3';

	const NATIVE_NAME = 'Native';
	const ISO_NAME = 'ISO';


	/**
	 * @var array [
	 * ['639-1', '639-2/t', '639-2/b', '639-3', 'ISO language name', 'Native name (endonym)']
	 * ]
	 */
	private $languages = [
		['ab', 'abk', 'abk', 'abk', 'Abkhaz', 'аҧсуа бызшәа, аҧсшәа'],
		['aa', 'aar', 'aar', 'aar', 'Afar', 'Afaraf'],
		['af', 'afr', 'afr', 'afr', 'Afrikaans', 'Afrikaans'],
		['ak', 'aka', 'aka', 'aka', 'Akan', 'Akan'],
		['sq', 'sqi', 'alb', 'sqi', 'Albanian', 'Shqip'],
		['am', 'amh', 'amh', 'amh', 'Amharic', 'አማርኛ'],
		['ar', 'ara', 'ara', 'ara', 'Arabic', 'العربية'],
		['an', 'arg', 'arg', 'arg', 'Aragonese', 'aragonés'],
		['hy', 'hye', 'arm', 'hye', 'Armenian', 'Հայերեն'],
		['as', 'asm', 'asm', 'asm', 'Assamese', 'অসমীয়া'],
		['av', 'ava', 'ava', 'ava', 'Avaric', 'авар мацӀ, магӀарул мацӀ'],
		['ae', 'ave', 'ave', 'ave', 'Avestan', 'avesta'],
		['ay', 'aym', 'aym', 'aym', 'Aymara', 'aymar aru'],
		['az', 'aze', 'aze', 'aze', 'Azerbaijani', 'azərbaycan dili'],
		['bm', 'bam', 'bam', 'bam', 'Bambara', 'bamanankan'],
		['ba', 'bak', 'bak', 'bak', 'Bashkir', 'башҡорт теле'],
		['eu', 'eus', 'baq', 'eus', 'Basque', 'euskara, euskera'],
		['be', 'bel', 'bel', 'bel', 'Belarusian', 'беларуская мова'],
		['bn', 'ben', 'ben', 'ben', 'Bengali, Bangla', 'বাংলা'],
		['bh', 'bih', 'bih', '', 'Bihari', 'भोजपुरी'],
		['bi', 'bis', 'bis', 'bis', 'Bislama', 'Bislama'],
		['bs', 'bos', 'bos', 'bos', 'Bosnian', 'bosanski jezik'],
		['br', 'bre', 'bre', 'bre', 'Breton', 'brezhoneg'],
		['bg', 'bul', 'bul', 'bul', 'Bulgarian', 'български език'],
		['my', 'mya', 'bur', 'mya', 'Burmese', 'ဗမာစာ'],
		['ca', 'cat', 'cat', 'cat', 'Catalan', 'català'],
		['ch', 'cha', 'cha', 'cha', 'Chamorro', 'Chamoru'],
		['ce', 'che', 'che', 'che', 'Chechen', 'нохчийн мотт'],
		['ny', 'nya', 'nya', 'nya', 'Chichewa, Chewa, Nyanja', 'chiCheŵa, chinyanja'],
		['zh', 'zho', 'chi', 'zho', 'Chinese', '中文 (Zhōngwén), 汉语, 漢語'],
		['cv', 'chv', 'chv', 'chv', 'Chuvash', 'чӑваш чӗлхи'],
		['kw', 'cor', 'cor', 'cor', 'Cornish', 'Kernewek'],
		['co', 'cos', 'cos', 'cos', 'Corsican', 'corsu, lingua corsa'],
		['cr', 'cre', 'cre', 'cre', 'Cree', 'ᓀᐦᐃᔭᐍᐏᐣ'],
		['hr', 'hrv', 'hrv', 'hrv', 'Croatian', 'hrvatski jezik'],
		['cs', 'ces', 'cze', 'ces', 'Czech', 'čeština, český jazyk'],
		['da', 'dan', 'dan', 'dan', 'Danish', 'dansk'],
		['dv', 'div', 'div', 'div', 'Divehi, Dhivehi, Maldivian', 'ދިވެހި'],
		['nl', 'nld', 'dut', 'nld', 'Dutch', 'Nederlands, Vlaams'],
		['dz', 'dzo', 'dzo', 'dzo', 'Dzongkha', 'རྫོང་ཁ'],
		['en', 'eng', 'eng', 'eng', 'English', 'English'],
		['eo', 'epo', 'epo', 'epo', 'Esperanto', 'Esperanto'],
		['et', 'est', 'est', 'est', 'Estonian', 'eesti, eesti keel'],
		['ee', 'ewe', 'ewe', 'ewe', 'Ewe', 'Eʋegbe'],
		['fo', 'fao', 'fao', 'fao', 'Faroese', 'føroyskt'],
		['fj', 'fij', 'fij', 'fij', 'Fijian', 'vosa Vakaviti'],
		['fi', 'fin', 'fin', 'fin', 'Finnish', 'suomi, suomen kieli'],
		['fr', 'fra', 'fre', 'fra', 'French', 'français, langue française'],
		['ff', 'ful', 'ful', 'ful', 'Fula, Fulah, Pulaar, Pular', 'Fulfulde, Pulaar, Pular'],
		['gl', 'glg', 'glg', 'glg', 'Galician', 'galego'],
		['ka', 'kat', 'geo', 'kat', 'Georgian', 'ქართული'],
		['de', 'deu', 'ger', 'deu', 'German', 'Deutsch'],
		['el', 'ell', 'gre', 'ell', 'Greek (modern)', 'ελληνικά'],
		['gn', 'grn', 'grn', 'grn', 'Guaraní', 'Avañe\'ẽ'],
		['gu', 'guj', 'guj', 'guj', 'Gujarati', 'ગુજરાતી'],
		['ht', 'hat', 'hat', 'hat', 'Haitian, Haitian Creole', 'Kreyòl ayisyen'],
		['ha', 'hau', 'hau', 'hau', 'Hausa', '(Hausa) هَوُسَ'],
		['he', 'heb', 'heb', 'heb', 'Hebrew (modern)', 'עברית'],
		['hz', 'her', 'her', 'her', 'Herero', 'Otjiherero'],
		['hi', 'hin', 'hin', 'hin', 'Hindi', 'हिन्दी, हिंदी'],
		['ho', 'hmo', 'hmo', 'hmo', 'Hiri Motu', 'Hiri Motu'],
		['hu', 'hun', 'hun', 'hun', 'Hungarian', 'magyar'],
		['ia', 'ina', 'ina', 'ina', 'Interlingua', 'Interlingua'],
		['id', 'ind', 'ind', 'ind', 'Indonesian', 'Bahasa Indonesia'],
		['ie', 'ile', 'ile', 'ile', 'Interlingue', 'Originally called Occidental; then Interlingue after WWII'],
		['ga', 'gle', 'gle', 'gle', 'Irish', 'Gaeilge'],
		['ig', 'ibo', 'ibo', 'ibo', 'Igbo', 'Asụsụ Igbo'],
		['ik', 'ipk', 'ipk', 'ipk', 'Inupiaq', 'Iñupiaq, Iñupiatun'],
		['io', 'ido', 'ido', 'ido', 'Ido', 'Ido'],
		['is', 'isl', 'ice', 'isl', 'Icelandic', 'Íslenska'],
		['it', 'ita', 'ita', 'ita', 'Italian', 'italiano'],
		['iu', 'iku', 'iku', 'iku', 'Inuktitut', 'ᐃᓄᒃᑎᑐᑦ'],
		['ja', 'jpn', 'jpn', 'jpn', 'Japanese', '日本語 (にほんご)'],
		['jv', 'jav', 'jav', 'jav', 'Javanese', 'basa Jawa'],
		['kl', 'kal', 'kal', 'kal', 'Kalaallisut, Greenlandic', 'kalaallisut, kalaallit oqaasii'],
		['kn', 'kan', 'kan', 'kan', 'Kannada', 'ಕನ್ನಡ'],
		['kr', 'kau', 'kau', 'kau', 'Kanuri', 'Kanuri'],
		['ks', 'kas', 'kas', 'kas', 'Kashmiri', 'कश्मीरी, كشميري‎'],
		['kk', 'kaz', 'kaz', 'kaz', 'Kazakh', 'қазақ тілі'],
		['kz', 'kaz', 'kaz', 'kaz', 'Kazakh', 'қазақ тілі'],
		['km', 'khm', 'khm', 'khm', 'Khmer', 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ'],
		['ki', 'kik', 'kik', 'kik', 'Kikuyu, Gikuyu', 'Gĩkũyũ'],
		['rw', 'kin', 'kin', 'kin', 'Kinyarwanda', 'Ikinyarwanda'],
		['ky', 'kir', 'kir', 'kir', 'Kyrgyz', 'Кыргызча, Кыргыз тили'],
		['kv', 'kom', 'kom', 'kom', 'Komi', 'коми кыв'],
		['kg', 'kon', 'kon', 'kon', 'Kongo', 'Kikongo'],
		['ko', 'kor', 'kor', 'kor', 'Korean', '한국어, 조선어'],
		['ku', 'kur', 'kur', 'kur', 'Kurdish', 'Kurdî, كوردی‎'],
		['kj', 'kua', 'kua', 'kua', 'Kwanyama, Kuanyama', 'Kuanyama'],
		['la', 'lat', 'lat', 'lat', 'Latin', 'latine, lingua latina'],
		['', '', '', 'lld', 'Ladin', 'ladin, lingua ladina'],
		['lb', 'ltz', 'ltz', 'ltz', 'Luxembourgish, Letzeburgesch', 'Lëtzebuergesch'],
		['lg', 'lug', 'lug', 'lug', 'Ganda', 'Luganda'],
		['li', 'lim', 'lim', 'lim', 'Limburgish, Limburgan, Limburger', 'Limburgs'],
		['ln', 'lin', 'lin', 'lin', 'Lingala', 'Lingála'],
		['lo', 'lao', 'lao', 'lao', 'Lao', 'ພາສາລາວ'],
		['lt', 'lit', 'lit', 'lit', 'Lithuanian', 'lietuvių kalba'],
		['lu', 'lub', 'lub', 'lub', 'Luba-Katanga', 'Tshiluba'],
		['lv', 'lav', 'lav', 'lav', 'Latvian', 'latviešu valoda'],
		['gv', 'glv', 'glv', 'glv', 'Manx', 'Gaelg, Gailck'],
		['mk', 'mkd', 'mac', 'mkd', 'Macedonian', 'македонски јазик'],
		['mg', 'mlg', 'mlg', 'mlg', 'Malagasy', 'fiteny malagasy'],
		['ms', 'msa', 'may', 'msa', 'Malay', 'bahasa Melayu, بهاس ملايو‎'],
		['ml', 'mal', 'mal', 'mal', 'Malayalam', 'മലയാളം'],
		['mt', 'mlt', 'mlt', 'mlt', 'Maltese', 'Malti'],
		['mi', 'mri', 'mao', 'mri', 'Māori', 'te reo Māori'],
		['mr', 'mar', 'mar', 'mar', 'Marathi (Marāṭhī)', 'मराठी'],
		['mh', 'mah', 'mah', 'mah', 'Marshallese', 'Kajin M̧ajeļ'],
		['mn', 'mon', 'mon', 'mon', 'Mongolian', 'монгол'],
		['na', 'nau', 'nau', 'nau', 'Nauru', 'Ekakairũ Naoero'],
		['nv', 'nav', 'nav', 'nav', 'Navajo, Navaho', 'Diné bizaad'],
		['nd', 'nde', 'nde', 'nde', 'Northern Ndebele', 'isiNdebele'],
		['ne', 'nep', 'nep', 'nep', 'Nepali', 'नेपाली'],
		['ng', 'ndo', 'ndo', 'ndo', 'Ndonga', 'Owambo'],
		['nb', 'nob', 'nob', 'nob', 'Norwegian Bokmål', 'Norsk bokmål'],
		['nn', 'nno', 'nno', 'nno', 'Norwegian Nynorsk', 'Norsk nynorsk'],
		['no', 'nor', 'nor', 'nor', 'Norwegian', 'Norsk'],
		['ii', 'iii', 'iii', 'iii', 'Nuosu', 'ꆈꌠ꒿ Nuosuhxop'],
		['nr', 'nbl', 'nbl', 'nbl', 'Southern Ndebele', 'isiNdebele'],
		['oc', 'oci', 'oci', 'oci', 'Occitan', 'occitan, lenga d\'òc'],
		['oj', 'oji', 'oji', 'oji', 'Ojibwe, Ojibwa', 'ᐊᓂᔑᓈᐯᒧᐎᓐ'],
		['cu', 'chu', 'chu', 'chu', 'Old Church Slavonic, Church Slavonic, Old Bulgarian', 'ѩзыкъ словѣньскъ'],
		['om', 'orm', 'orm', 'orm', 'Oromo', 'Afaan Oromoo'],
		['or', 'ori', 'ori', 'ori', 'Oriya', 'ଓଡ଼ିଆ'],
		['os', 'oss', 'oss', 'oss', 'Ossetian, Ossetic', 'ирон æвзаг'],
		['pa', 'pan', 'pan', 'pan', 'Panjabi, Punjabi', 'ਪੰਜਾਬੀ, پنجابی‎'],
		['pi', 'pli', 'pli', 'pli', 'Pāli', 'पाऴि'],
		['fa', 'fas', 'per', 'fas', 'Persian (Farsi)', 'فارسی'],
		['pl', 'pol', 'pol', 'pol', 'Polish', 'język polski, polszczyzna'],
		['ps', 'pus', 'pus', 'pus', 'Pashto, Pushto', 'پښتو'],
		['pt', 'por', 'por', 'por', 'Portuguese', 'português'],
		['qu', 'que', 'que', 'que', 'Quechua', 'Runa Simi, Kichwa'],
		['rm', 'roh', 'roh', 'roh', 'Romansh', 'rumantsch grischun'],
		['rn', 'run', 'run', 'run', 'Kirundi', 'Ikirundi'],
		['ro', 'ron', 'rum', 'ron', 'Romanian', 'limba română'],
		['ru', 'rus', 'rus', 'rus', 'Russian', 'Русский'],
		['sa', 'san', 'san', 'san', 'Sanskrit (Saṁskṛta)', 'संस्कृतम्'],
		['sc', 'srd', 'srd', 'srd', 'Sardinian', 'sardu'],
		['sd', 'snd', 'snd', 'snd', 'Sindhi', 'सिन्धी, سنڌي، سندھی‎'],
		['se', 'sme', 'sme', 'sme', 'Northern Sami', 'Davvisámegiella'],
		['sm', 'smo', 'smo', 'smo', 'Samoan', 'gagana fa\'a Samoa'],
		['sg', 'sag', 'sag', 'sag', 'Sango', 'yângâ tî sängö'],
		['sr', 'srp', 'srp', 'srp', 'Serbian', 'српски језик'],
		['gd', 'gla', 'gla', 'gla', 'Scottish Gaelic, Gaelic', 'Gàidhlig'],
		['sn', 'sna', 'sna', 'sna', 'Shona', 'chiShona'],
		['si', 'sin', 'sin', 'sin', 'Sinhala, Sinhalese', 'සිංහල'],
		['sk', 'slk', 'slo', 'slk', 'Slovak', 'slovenčina, slovenský jazyk'],
		['sl', 'slv', 'slv', 'slv', 'Slovene', 'slovenski jezik, slovenščina'],
		['so', 'som', 'som', 'som', 'Somali', 'Soomaaliga, af Soomaali'],
		['st', 'sot', 'sot', 'sot', 'Southern Sotho', 'Sesotho'],
		['es', 'spa', 'spa', 'spa', 'Spanish', 'español'],
		['su', 'sun', 'sun', 'sun', 'Sundanese', 'Basa Sunda'],
		['sw', 'swa', 'swa', 'swa', 'Swahili', 'Kiswahili'],
		['ss', 'ssw', 'ssw', 'ssw', 'Swati', 'SiSwati'],
		['sv', 'swe', 'swe', 'swe', 'Swedish', 'svenska'],
		['ta', 'tam', 'tam', 'tam', 'Tamil', 'தமிழ்'],
		['te', 'tel', 'tel', 'tel', 'Telugu', 'తెలుగు'],
		['tg', 'tgk', 'tgk', 'tgk', 'Tajik', 'тоҷикӣ, toçikī, تاجیکی‎'],
		['th', 'tha', 'tha', 'tha', 'Thai', 'ไทย'],
		['ti', 'tir', 'tir', 'tir', 'Tigrinya', 'ትግርኛ'],
		['bo', 'bod', 'tib', 'bod', 'Tibetan Standard, Tibetan, Central', 'བོད་ཡིག'],
		['tk', 'tuk', 'tuk', 'tuk', 'Turkmen', 'Türkmen, Түркмен'],
		['tl', 'tgl', 'tgl', 'tgl', 'Tagalog', 'Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔'],
		['tn', 'tsn', 'tsn', 'tsn', 'Tswana', 'Setswana'],
		['to', 'ton', 'ton', 'ton', 'Tonga (Tonga Islands)', 'faka Tonga'],
		['tr', 'tur', 'tur', 'tur', 'Turkish', 'Türkçe'],
		['ts', 'tso', 'tso', 'tso', 'Tsonga', 'Xitsonga'],
		['tt', 'tat', 'tat', 'tat', 'Tatar', 'татар теле, tatar tele'],
		['tw', 'twi', 'twi', 'twi', 'Twi', 'Twi'],
		['ty', 'tah', 'tah', 'tah', 'Tahitian', 'Reo Tahiti'],
		['ug', 'uig', 'uig', 'uig', 'Uyghur', 'ئۇيغۇرچە‎, Uyghurche'],
		['uk', 'ukr', 'ukr', 'ukr', 'Ukrainian', 'українська мова'],
		['ur', 'urd', 'urd', 'urd', 'Urdu', 'اردو'],
		['uz', 'uzb', 'uzb', 'uzb', 'Uzbek', 'Oʻzbek, Ўзбек, أۇزبېك‎'],
		['ve', 'ven', 'ven', 'ven', 'Venda', 'Tshivenḓa'],
		['vi', 'vie', 'vie', 'vie', 'Vietnamese', 'Việt Nam'],
		['vo', 'vol', 'vol', 'vol', 'Volapük', 'Volapük'],
		['wa', 'wln', 'wln', 'wln', 'Walloon', 'walon'],
		['cy', 'cym', 'wel', 'cym', 'Welsh', 'Cymraeg'],
		['wo', 'wol', 'wol', 'wol', 'Wolof', 'Wollof'],
		['fy', 'fry', 'fry', 'fry', 'Western Frisian', 'Frysk'],
		['xh', 'xho', 'xho', 'xho', 'Xhosa', 'isiXhosa'],
		['yi', 'yid', 'yid', 'yid', 'Yiddish', 'ייִדיש'],
		['yo', 'yor', 'yor', 'yor', 'Yoruba', 'Yorùbá'],
		['za', 'zha', 'zha', 'zha', 'Zhuang, Chuang', 'Saɯ cueŋƅ, Saw cuengh'],
		['zu', 'zul', 'zul', 'zul', 'Zulu', 'isiZulu'],
	];

	/**
	 * Array keys
	 */
	private const KEY_OF_639_1 = 0;
	private const KEY_OF_639_2t = 1;
	private const KEY_OF_639_2b = 2;
	private const KEY_OF_639_3 = 3;
	private const KEY_OF_ISO_NAME = 4;
	private const KEY_OF_NATIVE_NAME = 5;

	private $assocArray = [
		self::NAME_OF_639_1 => self::KEY_OF_639_1,
		self::NAME_OF_639_2t => self::KEY_OF_639_2t,
		self::NAME_OF_639_2b => self::KEY_OF_639_2b,
		self::NAME_OF_639_3 => self::KEY_OF_639_3,
		self::ISO_NAME => self::KEY_OF_ISO_NAME,
		self::NATIVE_NAME => self::KEY_OF_NATIVE_NAME
	];

	private $exceptionMessage = 'No data for this language';

	/**
	 * @param string $from - name of input standard name (see useful consts of this class)
	 * @param string $to - name of output standard name (see useful consts of this class)
	 * @param string $codeOrName - standard code, native or ISO language name
	 * @return mixed
	 */
	public function convertCode(string $from, string $to, string $codeOrName):string {
		if(!isset($this->assocArray[$from]) || !isset($this->assocArray[$to]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$arrayWithKeys = $this->getArrayWithRequiredKeys($this->assocArray[$from]);

		if(!isset($arrayWithKeys[$codeOrName]) || !isset($arrayWithKeys[$codeOrName][$this->assocArray[$to]]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$result = $arrayWithKeys[$codeOrName][$this->assocArray[$to]];

		return $result;


	}

	/**
	 * @param int $index
	 * @return array
	 *
	 */
	private function getArrayWithRequiredKeys(int $index):array {
		if(!isset($this->languages[$index]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$result = array_column($this->languages, null, $index);

		return $result;
	}

}
