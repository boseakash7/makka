<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($arrivalInfo['arr'])) : ?>
    <h5>1. Employment Interaction?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['employment_interaction'], 'en') ?></p>

    <h5>2. Clarity of work procedures and lines?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['clarity_procedure'], 'en') ?></p>

    <h5>3. Services Provided?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['service_provided'], 'en') ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>