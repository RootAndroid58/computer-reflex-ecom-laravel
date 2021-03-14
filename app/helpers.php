<?php

    function moneyFormatIndia($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }
    
    
    function FirstWord($s)
    {
        $arr1 = explode(' ',trim($s));
        return $arr1[0];
    }

    function HowMuchOldDate($date, $type)
    {
        $hours_in_day   = 24;
        $minutes_in_hour= 60;
        $seconds_in_mins= 60;

        $birth_date     = new DateTime($date);
        $current_date   = new DateTime();

        $diff           = $birth_date->diff($current_date);

        if ($type == 'years') {
            return $years     = $diff->y . " years " . $diff->m . " months " . $diff->d . " day(s)";
        }
        if ($type == 'months') {
            return $months    = ($diff->y * 12) + $diff->m . " months " . $diff->d . " day(s)"; 
        }
        if ($type == 'weeks') {
            return $weeks     = floor($diff->days/7) . " weeks " . $diff->d%7 . " day(s)"; 
        }
        if ($type == 'days') {
            return $days      = $diff->days . " days"; 
        }
        if ($type == 'hours') {
            return $hours     = $diff->h + ($diff->days * $hours_in_day) . " hours"; 
        }
        if ($type == 'mins') {
            return $mins      = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour) . " minutest"; 
        }
        if ($type == 'seconds') {
            return $seconds   = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour * $seconds_in_mins) . " seconds"; 
        }
        
    
    }

?>