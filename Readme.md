Multi-System Hybrid Translator
===================================

This is a hybrid solution for acquiring the best translation out of multiple online MT engines 

The system is described in:
"[Multi-system machine translation using online APIs for English-Latvian](http://glicom.upf.edu/hytra2015/hytra2015_proceedings.pdf#page=18)",
Matīss Rikters, ACL-IJCNLP 2015

If you use this code in your research and would like to acknowledge it, please refer to that publication.

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
