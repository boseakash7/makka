<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;


$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. حج اتھارٹی کی رہائش گاہ کتنی اچھی طرح سے تیار ہے؟</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'pak'); ?></p>

    <h5>2. بورڈنگ پاس جاری کرنے اور ضروری دستاویزات کو مکمل کرنے کا طریقہ کار کتنا تیز  اور آسان ہے؟</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'pak'); ?></p>

    <h5>3. (روڈ ٹو مکہ)  ہال تک رسائی کس حد تک آسان ہے۔</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'pak'); ?></p>

    <h5>4.  (روڈ ٹو مکہ)   ہال میں داخل ہونے پر استقبال۔</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'pak'); ?></p>

    <h5>5. آگاہی ویڈیو  جو  آپ کو دکھائی گئی وہ کس حد تک آپ کے لئے مفید ہے؟</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'pak'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>