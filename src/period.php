<?php
    function toDays ($type, $time) {
        switch ($type) {
            case 'days':
                return $time;
                break;
            
            case 'weeks':
                return $time * 7;
                break;
            
            case 'months':
                return $time * 30;
                break;
            
            default:
                # code...
                break;
        }
    }

    function factor ($days) {
        $factor = $days / 3;

        return floor($factor);
    }

    function estimateInfections ($factor, $currentlyInfected) {
        $infections = $currentlyInfected * (pow(2, $factor));

        return $infections;
    }

    function estimateSevereCases ($infections) {
        $severeCases = $infections * (15 / 100);

        return floor($severeCases);
    }

    function estimateHospitalBeds ($totalHospitalBeds, $severeCases) {
        $availableBeds = $totalHospitalBeds * (35 / 100);

        $availableBedsForCases = $availableBeds - $severeCases;

        return floor($availableBedsForCases);
    }

    function estimateRequiredICUs ($infections) {
        $ICUs = $infections * (5 / 100);

        return floor($ICUs);
    }

    function estimateRequiredVentilators ($infections) {
        $ventilators = $infections * (2 / 100);

        return floor($ventilators);
    }

    function estimateDollarsInFlight ($infections, $avgIncome, $days) {
        $dailyLose = $infections * (65 / 100) * $avgIncome / $days;

        return floor($dailyLose);
    }

?>