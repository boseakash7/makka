<?php

use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;
use Application\Helpers\AssessmentHelper;

$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. مقر سكن هيئة الحج مهيأ ومناسب</h5>    
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'arb') ?></p>

    <h5>2. لعمل على اجراءات إصدار بطاقة صعود الطائره واستكمال المستندات الالزمه كانت سريعه وميسره..</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'arb') ?></p>

    <h5>3. سهولة الدخول لصالة طريق مكه ..</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'arb') ?></p>

    <h5>4. تم االستقبال والترحيب عند الدخول لصالة طريق مكه</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'arb') ?></p>

    <h5>5. استفدت من الفيديو التوعوي الذي تم عرضه</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'arb') ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>