<?php

use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<?php if (!empty($arrivalInfo['arr'])) : ?>
    <h5>1. Interaksi Perkerja ?</h5>
    <p><?php echo $arrivalInfo['arr']['employment_interaction'] ?></p>

    <h5>2. Kejelasan Prosidur Kerja dan Barisan ?</h5>
    <p><?php echo $arrivalInfo['arr']['clarity_procedure'] ?></p>

    <h5>3. Perkhidmatan yang Disediakan ?</h5>
    <p><?php echo $arrivalInfo['arr']['service_provided'] ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>