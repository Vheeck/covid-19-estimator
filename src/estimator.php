<?php

require 'period.php';

function covid19ImpactEstimator($data)
{
  // DESTRUCTURING

  $region = $data["region"];
  $periodType = $data["periodType"];
  $timeToElapse = $data["timeToElapse"];
  $reportedCases = $data["reportedCases"];
  $population = $data["population"];
  $totalHospitalBeds = $data["totalHospitalBeds"];

  // ESTIMATIONS
  
  // Challenge 1
  
  // Part 1
  
  $impact["currentlyInfected"] = $reportedCases * 10;
  
  // Part 2
  
  $severeImpact['currentlyInfected'] = $reportedCases * 50;
  
  // Part 3
  
  $days = toDays($periodType, $timeToElapse);

  $factor = factor($days);

  $impact["infectionsByRequestedTime"] = estimateInfections($factor, $impact["currentlyInfected"]);

  $severeImpact["infectionsByRequestedTime"] = estimateInfections($factor, $severeImpact["currentlyInfected"]);
  
  // Challenge 2

  // Part 1

  $impact["severeCasesByRequestedTime"] = estimateSevereCases($impact["infectionsByRequestedTime"]);

  $severeImpact["severeCasesByRequestedTime"] = estimateSevereCases($severeImpact["infectionsByRequestedTime"]);
  
  // Part 2

  $impact["hospitalBedsByRequestedTime"] = estimateHospitalBeds($totalHospitalBeds, $impact["severeCasesByRequestedTime"]);

  $severeImpact["hospitalBedsByRequestedTime"] = estimateHospitalBeds($totalHospitalBeds, $severeImpact["severeCasesByRequestedTime"]);
  
  // Challenge 3

  // Part 1

  $impact["casesForICUByRequestedTime"] = estimateRequiredICUs($impact["infectionsByRequestedTime"]);

  $severeImpact["casesForICUByRequestedTime"] = estimateRequiredICUs($severeImpact["infectionsByRequestedTime"]);
  
  // Part 2

  $impact["casesForVentilatorsByRequestedTime"] = estimateRequiredVentilators($impact["infectionsByRequestedTime"]);

  $severeImpact["casesForVentilatorsByRequestedTime"] = estimateRequiredVentilators($severeImpact["infectionsByRequestedTime"]);
  
  // Part 3

  $impact["dollarsInFlight"] = estimateDollarsInFlight($impact["infectionsByRequestedTime"], $region["avgDailyIncomeInUSD"], $days);

  $severeImpact["dollarsInFlight"] = estimateDollarsInFlight($severeImpact["infectionsByRequestedTime"], $region["avgDailyIncomeInUSD"], $days);

  return [
    "data" => $data,
    "impact" => $impact,
    "severeImpact" => $severeImpact,
  ];
}