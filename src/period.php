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
        $factor = floor($days / 3);

        return $factor;
    }

    function estimateInfections ($factor, $currentlyInfected) {
        $infections = $currentlyInfected * (pow(2, $factor));

        return $infections;
    }

    function estimateSevereCases ($infections) {
        $severeCases = floor($infections * (15 / 100));

        return $severeCases;
    }

    function estimateHospitalBeds ($totalHospitalBeds, $severeCases) {
        $availableBeds = round($totalHospitalBeds * (35 / 100));

        $availableBedsForCases = $availableBeds - $severeCases;

        return $availableBedsForCases;
    }

    function estimateRequiredICUs ($infections) {
        $ICUs = floor($infections * (5 / 100));

        return $ICUs;
    }

    function estimateRequiredVentilators ($infections) {
        $Ventilators = floor($infections * (2 / 100));

        return $Ventilators;
    }

    function estimateDollarsInFlight ($infections, $avgIncome, $days) {
        $dailyLose = floor($infections * (65 / 100) * $avgIncome / $days);

        return $dailyLose;
    }

?>