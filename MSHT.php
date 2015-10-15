<?php

//configuration
include 'config.php';

if(!isset($argv[1]) || !isset($argv[2]) || $argv[1]=="" || $argv[2]==""){
	echo "Please provide file names language model and input sentences!\n";
}

$languageModel 	= $argv[1];
$in = fopen($argv[2], "r") or die("Can't open input file!"); 					//input sentences
$outg = fopen("output.google.txt", "a") or die("Can't create output file!"); 	//Google output
$outb = fopen("output.bing.txt", "a") or die("Can't create output file!"); 		//Bing output
$outl = fopen("output.letsmt.txt", "a") or die("Can't create output file!"); 	//LetsMT output
$outh = fopen("output.hybrid.txt", "a") or die("Can't create output file!"); 	//Hybrid output

include 'API/googleTranslate.php';
include 'API/bingTranslator.php';
include 'API/LetsMT.php';

//process input file by line
if ($in) {
    while (($sourceSentence = fgets($in)) !== false) {
		$sourceSentence = str_replace(array("\r", "\n"), '', $sourceSentence);
		
		$sentenceOne = translateWithGoogle($sourceLanguage, $targetLanguage, $sourceSentence);
		$sentenceTwo = translateWithBing($sourceLanguage, $targetLanguage, $sourceSentence);
		$sentenceThree = translateWithLetsMT($sourceSentence);
		
		fwrite($outg, $sentenceOne."\n");
		fwrite($outb, $sentenceTwo."\n");
		fwrite($outl, $sentenceThree."\n");
		
		unset($sentences);
		unset($perplexities);
		
		$sentences[] = $sentenceOne;
		$sentences[] = $sentenceTwo;
		$sentences[] = $sentenceThree;

		//Get the perplexities of the translations
		$perplexities[] = shell_exec('./exp.sh '.$languageModel.' "'.$sentenceOne.'"');
		$perplexities[] = shell_exec('./exp.sh '.$languageModel.' "'.$sentenceTwo.'"');
		$perplexities[] = shell_exec('./exp.sh '.$languageModel.' "'.$sentenceThree.'"');

		fwrite($outh, $sentences[array_keys($perplexities, min($perplexities))[0]]."\n");
	}
    fclose($in);
	fclose($outg);
	fclose($outb);
	fclose($outl);
	fclose($outh);
}
