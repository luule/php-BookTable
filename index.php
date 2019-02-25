<?php
use IntrepidGroup\SampleApplication\Repository\StaticBookRepository;

require_once __DIR__.'/vendor/autoload.php';

// Fetch the collection of books
$bookRepository = new StaticBookRepository();
$books = $bookRepository->fetchAll();


// Function filter English book
function filter_english_book($book){
    return ($book->getLanguage() === 'English');
 }
$englishBook = array_filter($books, filter_english_book);


// Sort array by year of publication
usort($englishBook, function($a,$b) {
    if($a->getYear() === $b->getYear()) return 0;
    return ($a->getYear() > $b->getYear()) ? -1 : 1;
});


// Render the homepage
$twig = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__.'/src/templates'));
$twig->display('homepage.twig', array('books' => $englishBook));
