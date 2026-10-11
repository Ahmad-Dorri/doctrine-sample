<?php

declare(strict_types=1);

use Bamooz\Simplified\Entity\Translation;
use Bamooz\Simplified\Entity\Word;

$em = require dirname(__DIR__) . '/config/doctrine.php';

$expectedSpelling = 'Hello';
$expectedPronunciation = 'h3llo';

$word = new Word(
    spelling: $expectedSpelling,
    pronunciation: $expectedPronunciation,
);

$firstTranslation = new Translation(
    word: $word,
    text: 'Hi',
    position: 1,
);

$secondTranslation = new Translation(
    word: $word,
    text: 'Greeting',
    position: 2,
);

$word->addTranslation($firstTranslation);
$word->addTranslation($secondTranslation);

$em->persist($word);
$em->persist($firstTranslation);
$em->persist($secondTranslation);
$em->flush();

$id = $word->getId();

if ($id === null) {
    throw new RuntimeException('Doctrine did not generate an ID for the word.');
}

$em->clear();

$savedWord = $em->find(Word::class, $id);

if (!$savedWord instanceof Word) {
    throw new RuntimeException('The word could not be loaded from the database.');
}

if (
    $savedWord->getSpelling() !== $expectedSpelling
    || $savedWord->getPronunciation() !== $expectedPronunciation
) {
    throw new RuntimeException('The saved word does not match the original values.');
}

$savedTranslations = array_values($savedWord->getTranslations()->toArray());

if (count($savedTranslations) !== 2) {
    throw new RuntimeException('The word does not have two translations.');
}

if (
    $savedTranslations[0]->getText() !== 'Hi'
    || $savedTranslations[0]->getPosition() !== 1
    || $savedTranslations[1]->getText() !== 'Greeting'
    || $savedTranslations[1]->getPosition() !== 2
) {
    throw new RuntimeException('The translations were not loaded in position order.');
}

echo "Word {$id} and its two translations were saved and loaded successfully.\n";
