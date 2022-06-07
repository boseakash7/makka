<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;


$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. Was the residence of the Hajj Authority comfortable?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'en'); ?></p>

    <h5>2. Procedures for issuing a boarding pass and completing the necessary documents was quick and easy?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'en'); ?></p>

    <h5>3. Was it easy to enter the Road to Makkah hall?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'en'); ?></p>

    <h5>4. Are you welcomed when you enter the Road to Makkah Hall?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'en'); ?></p>

    <h5>5. Did you benefit from the awareness video that was shown?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'en'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>