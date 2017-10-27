<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function pearsonScore(array $reviews, string $person1, string $person2): float {
    $commonItems = array();
    foreach ($reviews[$person1] as $restaurant1 => $rating) {
        foreach ($reviews[$person2] as $restaurant2 => $rating) {
            if ($restaurant1 == $restaurant2) {
                $commonItems[$restaurant1] = 1;
            }
        }
    }

    $n = count($commonItems);

    if ($n == 0)
        return 0.0;

    $sum1 = 0;
    $sum2 = 0;
    $sqrSum1 = 0;
    $sqrSum2 = 0;
    $pSum = 0;
    foreach ($commonItems as $restaurant => $common) {
        $sum1 += $reviews[$person1][$restaurant];
        $sum2 += $reviews[$person2][$restaurant];
        $sqrSum1 += $reviews[$person1][$restaurant] ** 2;
        $sqrSum2 += $reviews[$person2][$restaurant] ** 2;
        $pSum += $reviews[$person1][$restaurant] * $reviews[$person2][$restaurant];
    }

    $num = $pSum - (($sum1 * $sum2) / $n);
    $den = sqrt(($sqrSum1 - (($sum1 ** 2) / $n)) * ($sqrSum2 - (($sum2 ** 2) / $n)));

    if ($den == 0) {
        $pearsonCorrelation = 0;
    } else {
        $pearsonCorrelation = $num / $den;
    }

    return (float) $pearsonCorrelation;
}

function similarReviewers(array $reviews, string $person, int $n): array {
    $scoresArray = [];
    foreach ($reviews as $reviewer => $restaurants) {
        if ($person != $reviewer) {
            $scoresArray[$reviewer] = pearsonScore($reviews, $person, $reviewer);
        }
    }
    arsort($scoresArray);
    return array_slice($scoresArray, 0, $n);
}

function getRecommendations(array $reviews, string $person): array {
    $calculation = [];
    foreach ($reviews as $reviewer => $restaurants) {
        $similarityScore = pearsonScore($reviews, $person, $reviewer);
        if ($person == $reviewer || $similarityScore <= 0) {
            continue;
        }

        foreach ($restaurants as $restaurant => $rating) {
            if (!array_key_exists($restaurant, $reviews[$person])) {
                if (!array_key_exists($restaurant, $calculation)) {
                    $calculation[$restaurant] = [];
                    $calculation[$restaurant]['Total'] = 0;
                    $calculation[$restaurant]['SimilarityTotal'] = 0;
                }

                $calculation[$restaurant]['Total'] += $similarityScore * $rating;
                $calculation[$restaurant]['SimilarityTotal'] += $similarityScore;
            }
        }
    }
    $recommendations = [];
    foreach ($calculation as $restaurant => $values) {
        $recommendations[$restaurant] = $calculation[$restaurant]['Total'] / $calculation[$restaurant]['SimilarityTotal'];
    }

    arsort($recommendations);
    return $recommendations;
}

$reviews = [];
$reviews['Adiyan'] = ["McDonalds" => 5, "KFC" => 5, "Pizza Hut" => 4.5, "Burger King" => 4.7, "American Burger" => 3.5, "Pizza Roma" => 2.5];
$reviews['Mikhael'] = ["McDonalds" => 3, "KFC" => 4, "Pizza Hut" => 3.5, "Burger King" => 4, "American Burger" => 4, "Jafran" => 4];
$reviews['Zayeed'] = ["McDonalds" => 5, "KFC" => 4, "Pizza Hut" => 2.5, "Burger King" => 4.5, "American Burger" => 3.5, "Sbarro" => 2];
$reviews['Arush'] = ["KFC" => 4.5, "Pizza Hut" => 3, "Burger King" => 4, "American Burger" => 3, "Jafran" => 2.5, "FFC" => 3.5];
$reviews['Tajwar'] = ["Burger King" => 3, "American Burger" => 2, "KFC" => 2.5, "Pizza Hut" => 3, "Pizza Roma" => 2.5, "FFC" => 3];
$reviews['Aayan'] = ["KFC" => 5, "Pizza Hut" => 4, "Pizza Roma" => 4.5, "FFC" => 4];

$person1 = 'Adiyan';
$person2 = 'Arush';
$person3 = 'Mikhael';

echo 'The similarity score calculated with the Pearson Correlation between ' . $person1 . ' and ' . $person2 . ' is: ' . pearsonScore($reviews, $person1, $person2) . '\n';
echo 'The similarity score calculated with the Pearson Correlation between ' . $person2 . ' and ' . $person3 . ' is: ' . pearsonScore($reviews, $person2, $person3) . '\n';


$person = 'Arush';
echo 'Restaurant recommendations for  ' . $person . "\n";
$recommendations = getRecommendations($reviews, $person);
foreach ($recommendations as $restaturant => $score) {
    echo $restaturant . " \n";
}
echo '<br /><br />';
