<?php

//configuration
$sourceLanguage		= "en";
$targetLanguage		= "lv";
$GoogleTranslateKey	= "YOUR_GOOGLE_TRANSLATE_API_KEY";
$BingClientID		= "YOUR_BING_CLIENT_ID";
$BingClientSecret	= "YOUR_BING_CLIENT_SECRET";

if(!isset($argv[1]) || !isset($argv[2]) || $argv[1]=="" || $argv[2]==""){
	echo "Please provide file names language model and input sentences!\n";
}

$languageModel 	= $argv[1];
$in = fopen($argv[2], "r") or die("Can't open input file!"); 					//input sentences
$outg = fopen("output.google.txt", "a") or die("Can't create output file!"); 	//Google output
$outb = fopen("output.bing.txt", "a") or die("Can't create output file!"); 		//Bing output
$outh = fopen("output.hybrid.txt", "a") or die("Can't create output file!"); 	//Hybrid output

include 'API/googleTranslate.php';
include 'API/bingTranslator.php';

//process input file by line
if ($in) {
    while (($sourceSentence = fgets($in)) !== false) {
		$sourceSentence = str_replace(array("\r", "\n"), '', $sourceSentence);
		
		// echo "SOURCE - ".$sourceSentence."\n";
		
		$sentenceOne = translateWithGoogle($sourceLanguage, $targetLanguage, $sourceSentence);
		// echo "GOOGLE - ".$sentenceOne."\n";
		$sentenceTwo = translateWithBing($sourceLanguage, $targetLanguage, $sourceSentence);
		// echo "BING - ".$sentenceTwo."\n";
		
		fwrite($outg, $sentenceOne."\n");
		fwrite($outb, $sentenceTwo."\n");
		
		unset($sentences);
		unset($perplexities);
		
		$sentences[] = $sentenceOne;
		$sentences[] = $sentenceTwo;

		//Get the perplexities of the translations
		$perplexities[] = shell_exec('./exp.sh '.$languageModel.' "'.$sentenceOne.'"');
		$perplexities[] = shell_exec('./exp.sh '.$languageModel.' "'.$sentenceTwo.'"');

		fwrite($outh, $sentences[array_keys($perplexities, min($perplexities))[0]]."\n");
		// echo "Sentence done!\n";
	}
    fclose($in);
	fclose($outg);
	fclose($outb);
	fclose($outh);
	// echo "\nFiles closed, all done!\n";
}
