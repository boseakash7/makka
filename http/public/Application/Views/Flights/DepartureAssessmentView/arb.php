<?php

use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. تعامل الموظفين ؟?</h5>
    <p><?php echo $arrivalInfo['arr']['employment_interaction'] ?></p>

    <h5>2. وضوح الاجراءات والمسارات ؟</h5>
    <p><?php echo $departureInfo['arr']['clarity_procedure'] ?></p>

    <h5>3. الخدمة المقدمة ؟</h5>
    <p><?php echo $departureInfo['arr']['service_provided'] ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>