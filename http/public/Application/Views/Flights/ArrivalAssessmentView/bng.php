<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;


$lang = Model::get(Language::class);
?>

<?php if (!empty($arrivalInfo['arr'])) : ?>
    <h5>1. আপনার সাথে কর্মচারীবৃন্দ কেমন আচরণ করেন?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['employment_interaction'], 'bng') ?></p>

    <h5>2. লাইনে দাঁড়ানোর প্রক্রিয়া কি আপনি সঠিক ভাবে বুঝতে পেরেছেন ?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['clarity_procedure'], 'bng') ?></p>

    <h5>3. আপনি এখানে কেমন সেবা পাচ্ছেন?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['service_provided'], 'bng') ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>