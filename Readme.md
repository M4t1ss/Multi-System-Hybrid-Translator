Multi-System Hybrid Translator
===================================

This is a hybrid solution for acquiring the best translation out of multiple online MT engines 

Requirements
---------

* PHP with curl

* KenLM compatible language model (preferrably binarized)

* Access to at least two APIs

  * Google Translate - https://cloud.google.com/translate/
  * Bing Translator - http://www.bing.com/dev/en-us/translator
  * LetsMT - https://www.letsmt.eu
  * Yandex Translator - https://tech.yandex.com/translate/
  * iTranslate - http://itranslate4.eu/en/api/settings

* Tokenized input sentances

Supported APIs
-----------

* Google Translate
* Bing Translator
* LetsMT
* Yandex Translator
* iTranslate

Usage
-----------

```
php MSHT.php languageModel.binary inputSentances.txt
```

The output generates six files:

* output.google.txt
* output.bing.txt
* output.letsmt.txt
* output.yandex.txt
* output.itranslate.txt
* output.hybrid.txt

Publications
---------

If you use this tool, please cite the following paper:

Matīss Rikters (2015). "[Multi-system machine translation using online APIs for English-Latvian.](http://glicom.upf.edu/hytra2015/hytra2015_proceedings.pdf#page=18)" In Proceedings of the Fourth Workshop on Hybrid Approaches to Translation (HyTra)(2015).

```
@inproceedings{Rikters2015,
	author = {Rikters, Matīss},
	booktitle = {Proceedings of the Fourth Workshop on Hybrid Approaches to Translation (HyTra)},
	pages = {6--10},
	title = {{Multi-system machine translation using online APIs for English-Latvian}},
	url = {http://www.aclweb.org/anthology/W15-4102},
	year = {2015}
}
```