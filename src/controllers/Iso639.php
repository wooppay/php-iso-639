<?php


namespace Wooppay\iso639\controllers;

use OutOfBoundsException;
use Yii;
use yii2lab\extension\store\Store;

/**
 * @property  currentLanguge
 */
class Iso639
{
	/**
	 * ISO standard names
	 */
	const SUB_FORMAT_639_1 = '639-1';
	const SUB_FORMAT_639_2t = '639-2/t';
	const SUB_FORMAT_639_2b = '639-2/b';
	const SUB_FORMAT_639_3 = '639-3';

	const NATIVE = 'native_name_(endonym)';
	const ISO = 'iso_language_name';

	const RES_PATH = '@vendor/wooppay/php-iso-639-converter/src/res';

	const MAIN_ISO_FAIL_NAME = '639';

	private $format = 'php';
	private $languages;
	private $currentLang;
	private $store;

	private $fileName;

	private $exceptionMessage = 'No data for language ';

	public function __construct()
	{
		$this->getStore();
		$this->getFileName();
		$this->updateLanguages();
	}



	public function convert(string $codeOrName, string $to = self::SUB_FORMAT_639_1): string
	{
		$this->defineLang($codeOrName);
		return $this->currentLang[$to];
	}

	/**
	 * @param int $index
	 * @return array
	 *
	 */
	private function getArrayWithRequiredKeys(int $index): array
	{
		if (!isset($this->languages[$index]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$result = array_column($this->languages, null, $index);

		return $result;
	}


	private function getStore()
	{
		if (!isset($this->store)) {
			$this->store = new Store($this->format);
		}
		return $this->store;
	}

	private function getFileName()
	{
		$this->fileName = Yii::getAlias(self::RES_PATH) . DS . self::MAIN_ISO_FAIL_NAME . DOT . $this->format;
	}

	public function updateLanguages()
	{
		$store = $this->getStore();
		$this->languages = $store->load($this->fileName);
	}

	/**
	 * @return mixed
	 */
	public function getLanguages()
	{
		return $this->languages;
	}

	private function defineLang(string $codeOrName)
	{
		foreach ($this->languages as $language) {
			if (in_array($codeOrName, $language)){
				$this->currentLang = $language;
				return;
			}
		}
		throw new OutOfBoundsException($this->exceptionMessage);
	}

	public function defineFormat(string $codeOrName)
	{
		if(empty($this->currentLang))
			$this->defineLang();
		foreach ($this->currentLang as $key => $languageItem)
			if ($languageItem == $codeOrName)
				return $key;
	}

}
