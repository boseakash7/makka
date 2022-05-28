<?php

use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. আপনার সাথে কর্মচারীবৃন্দ কেমন আচরণ করেন?</h5>
    <p><?php echo $departureInfo['arr']['employment_interaction'] ?></p>

    <h5>2. লাইনে দাঁড়ানোর প্রক্রিয়া কি আপনি সঠিক ভাবে বুঝতে পেরেছেন ?</h5>
    <p><?php echo $departureInfo['arr']['clarity_procedure'] ?></p>

    <h5>3. আপনি এখানে কেমন সেবা পাচ্ছেন?</h5>
    <p><?php echo $departureInfo['arr']['service_provided'] ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>