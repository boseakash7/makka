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

            // For old data
            case 'Satisfactory':
            case 'সন্তুষ্ট':
            case 'Memuaskan':
            case 'Puas':
            case 'مطمئن':
            case 'راضي':
                $ans = $lang == 'arb' ? 'أوافق' : $ans;
                $ans = $lang == 'bng' ? 'হ্যাঁ' : $ans;
                $ans = $lang == 'en' ? 'Yes' : $ans;
                $ans = $lang == 'indo' ? 'Ya' : $ans;
                $ans = $lang == 'malay' ? 'Saya setuju' : $ans;
                $ans = $lang == 'pak' ? 'بہترین۔' : $ans;
                break;
            case 'Somewhat':

            // For old data
            case 'Unsatisfactory':            
            case 'ভালো':
            case 'Tidak Memuaskan':
            case 'Biasa':      
            case 'کچھ بھی نہیں':
            case 'نوعاً ما':
                $ans = $lang == 'arb' ? 'نوعاً ما' : $ans;
                $ans = $lang == 'bng' ? 'কিছুটা' : $ans;
                $ans = $lang == 'en' ? 'Somewhat' : $ans;
                $ans = $lang == 'indo' ? 'Agak' : $ans;
                $ans = $lang == 'malay' ? 'Semacam' : $ans;
                $ans = $lang == 'pak' ? 'مناسب۔' : $ans;
                break;
            case 'Not':

            // For old data
            case 'Less Satisfying':
            case 'অসন্তুষ্ট':
            case 'Kurang Memuaskan':
            case 'Tidak Puas':
            case 'غير مطمئن، نا پسندی':
            case 'غير راضي':
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