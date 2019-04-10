<?php

require_once __DIR__ . '/../vendor/autoload.php';

$s1 = 'Jean';
$s2 = $s1; // (scalaires, tous les types non objets : int, string, array...)
// sur un scalaire la variable contient la valeur
// passage par valeur
$s2 = 'Eric';

echo $s1 . "\n"; // ????

$o1 = new \Surf\Entities\Contact();
$o1->setFirstName('Jean');

$o2 = $o1; // (objet)
// sur un objet, la variable contient l'adresse mémoire de l'objet
// passage par référence

$o2->setFirstName('Eric');
echo $o1->getFirstName() . "\n"; // ????