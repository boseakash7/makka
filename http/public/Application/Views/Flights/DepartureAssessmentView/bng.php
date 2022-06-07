<?php

use Application\Helpers\AssessmentHelper;
use System\Core\Model;
use System\Libs\FormValidator;
use System\Models\Language;


$lang = Model::get(Language::class);
?>

<?php if (!empty($departureInfo['arr'])) : ?>
    <h5>1. হজ কর্তৃপক্ষের বাসস্থান কি আরামদায়ক ছিল?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['employment_interaction'], 'bng'); ?></p>

    <h5>2. একটি বোর্ডিং পাস প্রদান এবং প্রয়োজনীয় নথি পূরণ করার পদ্ধতি দ্রুত এবং সহজ ছিল?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['clarity_procedure'], 'bng'); ?></p>

    <h5>3. রোড টু মক্কা হলে প্রবেশ করা কি সহজ ছিল?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['service_provided'], 'bng'); ?></p>

    <h5>4. রোড টু মক্কা হলে প্রবেশ করলে কি আপনাকে স্বাগত জানানো হয়?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['makkah_hall'], 'bng'); ?></p>

    <h5>5. যে সচেতনতামূলক ভিডিওটি দেখানো হয়েছিল তা থেকে আপনি কি উপকৃত হয়েছেন?</h5>
    <p><?php echo AssessmentHelper::getAnswer($departureInfo['arr']['awareness'], 'bng'); ?></p>
<?php else : ?>
    <p><?php echo $lang('no_data_found') ?></p>
<?php endif; ?>