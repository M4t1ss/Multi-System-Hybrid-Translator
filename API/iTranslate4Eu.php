<?php
require_once 'iTranslate.php';
global $iTranslateAPIkey;

$api = iTranslate::getInstance();
$api->setApiKey($iTranslateAPIkey);

function translateWithItranslate4eu($sourceLanguageCode, $targetLanguageCode, $textToTranslate) {
    global $apiSettings, $api;
	
    $availableRoutes = $api->getRoutes($sourceLanguageCode, $targetLanguageCode);
	
    // do we have any routes that we can use?
    if (empty($availableRoutes)) {
        throw new Exception("No translation routes have been found! Aborting translation");
    }
    
    // Step 3: do the translation vie the translate api call
    $tr = $api->translate($sourceLanguageCode, $targetLanguageCode, array($textToTranslate)//, // text segments to translate
    );

    // Step 4: return the the translated text or throw exception
    if ($tr->dat[0]->err == null) {
        return $tr->dat[0]->text[0];
    } else {
        throw new Exception("Remote server responded with an error: " . $tr->dat[0]->err);
    }
}
