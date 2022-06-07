<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($arrivalInfo['arr'])) : ?>
    <h5>1. عملے کا برتاؤ</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['employment_interaction'], 'pak'); ?></p>

    <h5>2. طریقہ کار اور راستے کی آگاہی</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['clarity_procedure'], 'pak'); ?></p>

    <h5>3. سروس فراہم کی</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['service_provided'], 'pak'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>