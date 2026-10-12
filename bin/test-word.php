<?php

declare(strict_types=1);

use Bamooz\Simplified\Entity\Translation;
use Bamooz\Simplified\Entity\Word;
use Bamooz\Simplified\Entity\PartOfSpeeches\Noun;
use Bamooz\Simplified\Entity\PartOfSpeeches\Verb;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\NounGender;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\NounAnimacy;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\VerbComposition;

$em = require dirname(__DIR__) . '/config/doctrine.php';

$expectedSpelling = 'book';
$expectedPronunciation = 'bʊk';

$word = new Word(
    spelling: $expectedSpelling,
    pronunciation: $expectedPronunciation,
);

$firstTranslation = new Translation(
    word: $word,
    text: 'A written work',
    position: 1,
    partOfSpeech: new Noun(
        gender: NounGender::Neuter,
        animacy: NounAnimacy::Inanimate,
    ),
);

$secondTranslation = new Translation(
    word: $word,
    text: 'To reserve',
    position: 2,
    partOfSpeech: new Verb(
        composition: VerbComposition::Simple,
        pastForm: 'booked',
        presentForm: 'book',
    ),
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
    $savedTranslations[0]->getText() !== 'A written work'
    || $savedTranslations[0]->getPosition() !== 1
    || $savedTranslations[1]->getText() !== 'To reserve'
    || $savedTranslations[1]->getPosition() !== 2
) {
    throw new RuntimeException('The translations were not loaded in position order.');
}

$savedNoun = $savedTranslations[0]->getPartOfSpeech();
$savedVerb = $savedTranslations[1]->getPartOfSpeech();

if (
    !$savedNoun instanceof Noun
    || $savedNoun->getGender() !== NounGender::Neuter
    || $savedNoun->getAnimacy() !== NounAnimacy::Inanimate
) {
    throw new RuntimeException('The noun subclass or its enum values were not restored correctly.');
}

if (
    !$savedVerb instanceof Verb
    || $savedVerb->getComposition() !== VerbComposition::Simple
    || $savedVerb->getPastForm() !== 'booked'
    || $savedVerb->getPresentForm() !== 'book'
) {
    throw new RuntimeException('The verb subclass or its properties were not restored correctly.');
}

echo "Word {$id}, its translations, and their noun and verb details were saved and loaded successfully.\n";
