<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($arrivalInfo['arr'])) : ?>
    <h5>1. Interaksi Karyawan ?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['employment_interaction'], 'indo'); ?></p>

    <h5>2. Kejelasan prosedur dan antrian ?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['clarity_procedure'], 'indo'); ?></p>

    <h5>3. Pelayanan yang disediakan ?</h5>
    <p><?php echo AssessmentHelper::getAnswer($arrivalInfo['arr']['service_provided'], 'indo'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>