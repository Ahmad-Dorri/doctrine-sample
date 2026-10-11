<?php

declare(strict_types=1);

use Bamooz\Simplified\Entity\Word;

$em = require dirname(__DIR__) . '/config/doctrine.php';

$expectedSpelling = 'Hello';
$expectedPronunciation = 'h3llo';

$word = new Word(
    spelling: $expectedSpelling,
    pronunciation: $expectedPronunciation,
);

$em->persist($word);
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

echo "Word {$id} was saved and loaded successfully.\n";
