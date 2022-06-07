<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;


$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. Apakah tempat tinggal Otoritas Haji nyaman?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'indo'); ?></p>

    <h5>2. Prosedur penerbitan boarding pass dan kelengkapan dokumen yang diperlukan cepat dan mudah?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'indo'); ?></p>

    <h5>3. Apakah mudah untuk memasuki aula Road to Makkah?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'indo'); ?></p>

    <h5>4. Apakah Anda disambut ketika Anda memasuki Jalan Menuju Balai Mekah?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'indo'); ?></p>

    <h5>5. Apakah Anda mendapat manfaat dari video kesadaran yang ditampilkan?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'indo'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>