<?php

use Application\Models\User;
use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
/**
 * @var User
 */
$userM = Model::get(User::class);
$userInfo = $userM->getInfo();

?>

<div class="form-group">
    <label for="check_in"><?php echo $lang('check_in') ?></label>
    <input type="datetime-local" required value="<?php echo date('Y-m-d', $passengerInfo['check_in_time']) ?>T<?php echo date('H:m', $passengerInfo['check_in_time']) ?>" name="check_in" id="check_in" class="form-control">
</div>

<div class="form-group">
    <label for="check_out"><?php echo $lang('check_out') ?></label>
    <input type="datetime-local" required value="<?php echo date('Y-m-d', $passengerInfo['check_out_time']) ?>T<?php echo date('H:m', $passengerInfo['check_out_time']) ?>" name="check_out" id="check_out" class="form-control">
</div>
<input type="hidden" name="passenger_id" id="passenger_id" value="<?php echo $passengerInfo['id'] ?>">
<button type="submit" class="btn btn-primary">Update</button>
