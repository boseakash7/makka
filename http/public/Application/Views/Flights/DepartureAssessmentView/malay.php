<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. Kediaman Jemaah Haji dilengkapi dan Sesuai</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'malay'); ?></p>

    <h5>2. Prosedur Dokumentasi</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'malay'); ?></p>

    <h5>3. Akses mudah ke Pintu Makkah Road</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'malay'); ?></p>

    <h5>4. Disambut dan disapa apabila masuk ke Pintu Jalan Makkah<</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'malay'); ?></p>

    <h5>5. Saya mendapat manfaat daripada video yang ditayangkan</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'malay'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>