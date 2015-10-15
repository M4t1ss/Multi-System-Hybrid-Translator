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

* Tokenized input sentances

Supported APIs
-----------

* Google Translate
* Bing Translator
* LetsMT

Usage
-----------

```
php MSHT.php languageModel.binary inputSentances.txt
```

The output generates four files:

* output.google.txt
* output.bing.txt
* output.letsmt.txt
* output.hybrid.txt
