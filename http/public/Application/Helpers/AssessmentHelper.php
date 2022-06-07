<?php

namespace Application\Helpers;

class AssessmentHelper 
{
    public static function getAnswer( $answer, $lang )
    {
        $ans = $answer;
        switch( $answer )
        {
            case 'Yes':
            case 'Quick':
            case 'Easy':
            case 'Comfortable':
                $ans = $lang == 'arb' ? 'أوافق' : $ans;
                $ans = $lang == 'bng' ? 'হ্যাঁ' : $ans;
                $ans = $lang == 'en' ? 'Yes' : $ans;
                $ans = $lang == 'indo' ? 'Ya' : $ans;
                $ans = $lang == 'malay' ? 'Saya setuju' : $ans;
                $ans = $lang == 'pak' ? 'بہترین۔' : $ans;
                break;
            case 'Somewhat':
                $ans = $lang == 'arb' ? 'نوعاً ما' : $ans;
                $ans = $lang == 'bng' ? 'কিছুটা' : $ans;
                $ans = $lang == 'en' ? 'Somewhat' : $ans;
                $ans = $lang == 'indo' ? 'Agak' : $ans;
                $ans = $lang == 'malay' ? 'Semacam' : $ans;
                $ans = $lang == 'pak' ? 'مناسب۔' : $ans;
                break;
            case 'Not':
                $ans = $lang == 'arb' ? 'الأوافق' : $ans;
                $ans = $lang == 'bng' ? 'না' : $ans;
                $ans = $lang == 'en' ? 'Not' : $ans;
                $ans = $lang == 'indo' ? 'Bukan' : $ans;
                $ans = $lang == 'malay' ? 'Saya tidak setuju' : $ans;
                $ans = $lang == 'pak' ? 'غیر مناسب۔' : $ans;
                break;
        }

        return $ans;
    }
}