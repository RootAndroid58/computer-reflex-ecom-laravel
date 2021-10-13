<?php

    function productImage($data)
    {
        if (!$data) {
            $output = asset('img/svg/images.svg');
        } else {
            $output = asset('storage/images/products/'.$data->image);
        }
        return $output;
    }

    function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

    function productOrderBy($orderBy)
    {
        if ($orderBy == 'A to Z') {
            $output = [
                'col'   => 'product_name',
                'order' => 'asc',
            ];
        }
        if ($orderBy == 'Z to A') {
            $output = [
                'col'   => 'product_name',
                'order' => 'desc',
            ];
        }
        if ($orderBy == 'Price Low to High') {
            $output = [
                'col'   => 'product_price',
                'order' => 'asc',
            ];
        }
        if ($orderBy == 'Price High to Low') {
            $output = [
                'col'   => 'product_price',
                'order' => 'desc',
            ];
        }

        return $output ?? false;
    }

    function floorToFraction($number, $denominator = 1)
    {
        $x = $number * $denominator;
        $x = floor($x);
        $x = $x / $denominator;
        return $x;
    }
    
    function bannerAspectRatio($type)
    {
        $output = null;
        if ($type == 'three_col_banner') {
            $output = 8/5;
        }
        return $output;
    }

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


    function isMobile()
    {
        $Agent = new Jenssegers\Agent\Agent();
        if ($Agent->isMobile()) {
            return true;
        }
    }
    
    
    function FirstWord($s)
    {
        $arr1 = explode(' ',trim($s));
        return $arr1[0];
    }

    function WordLimit($inputstring, $count)
    {
        $pieces = explode(" ", $inputstring);
        $first_part = implode(" ", array_splice($pieces, 0, $count));
        return $first_part;
    }

    
    function WordLimitBypass($inputstring, $count)
    {
        $pieces = explode(" ", $inputstring);
        $first_part = implode(" ", array_splice($pieces, $count));
        return $first_part;
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

    function GreetUser()
    {
        $Hour = date('G');
        if ( $Hour >= 5 && $Hour <= 11 ) {
            return '<span style="color: rgb(210 184 146);"><i class="fad fa-sun-cloud"></i> Good Morning</span>';
        } else if ( $Hour >= 12 && $Hour <= 18 ) {
            return '<span style="color: yellow;"><i class="fad fa-sun-cloud"></i> Good Afternoon</span>';
        } else if ( $Hour >= 19 || $Hour <= 4 ) {
            return '<span style="color: rgb(122 127 189);"><i class="fad fa-sun-cloud"></i> Good Evening</span>';
        }
    }

    function CalcPerc($perc, $total)
    {
        $output = (($perc/100)*$total);
        return $output;
    }

    function TenDaysFuture($oldDate)
    {
        $dt = new DateTime($oldDate);
        $dt = $dt->modify( '+10 days' );
        return $dt;
    }

    function newVoucherCode()
    {
        return Str::upper(Str::random(5)).'-'.Str::upper(Str::random(5)).'-'.Str::upper(Str::random(5)).'-'.Str::upper(Str::random(5));
    }
    

?>