<?php

use Application\Models\Flights;
use Application\Models\User;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;

$lang = Model::get(Language::class);

$userM = Model::get(User::class);
?>
<define title>
    <?php echo $lang('logs_for', [ 'flight' => $flight['number'] ]) ?>
</define>
<section class="section">
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <h1><?php echo $lang('flight_num', ['num' => $flight['number']]) ?></h1>
                        <div class="other-info clearfix">
                            <p class="float-start me-3"><strong><?php echo $lang('airlines'); ?>:</strong> <?php echo $flight['number'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('take_off_date'); ?>:</strong> <?php echo $flight['tdate'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('take_off_time'); ?>:</strong> <?php echo $flight['ttime'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('number_of_passengers'); ?>:</strong> <?php echo $flight['passengers'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('source_airport'); ?>:</strong> <?php echo $flight['sairport'][$lang->current() . '_name'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">
                    <?php if ( !empty($passengers) ): ?>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo $lang('check_in') ?></th>
                                    <th><?php echo $lang('check_out') ?></th>
                                    <?php if( $userM->isSupAdmin() ): ?>
                                        <th><?php echo $lang('action') ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $passengers as $passenger ): ?>
                                <tr>
                                    <td><?php echo $passenger['info']; ?></td>
                                    <td class="check-in-td-<?php echo $passenger['id'] ?>"><?php echo $passenger['check_in_time'] != null ? date('Y-m-d H:i:s', $passenger['check_in_time']) : '-'; ?></td>
                                    <td class="check-out-td-<?php echo $passenger['id'] ?>"><?php echo $passenger['check_out_time'] != null ? date('Y-m-d H:i:s', $passenger['check_out_time']) : '-'; ?></td>
                                    <?php if( $userM->isSupAdmin() ): ?>
                                        <td>
                                            <a class="btn btn-primary edit-check" data-id="<?php echo $passenger['id'] ?>" href="#!"><?php echo $lang('edit') ?></a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            
                            <?php endforeach; ?>
                            </tbody>                            
                        </table>                        
                    <?php else: ?>
                        <?php echo $lang('no_data') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </div>    
</section>

<div class="modal" tabindex="-1" role="dialog" id="log-edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#!" method="post" id="log-update-form">
        </form>
      </div>
    </div>
  </div>
</div>

<define footer_js>
    <script>
        $("#log-update-form").on('submit', function(e) {
            e.preventDefault();

            var check_in = $("#check_in").val();
            var check_out = $("#check_out").val();
            var id = $("#passenger_id").val();

            $.ajax({
                url: '<?php echo URL::full('ajax/flight/log/update') ?>',
                type: 'POST',
                accepts: 'JSON',
                dataType: 'JSON',
                data: {
                    check_in: check_in,
                    check_out: check_out,
                    id: id
                },
                beforeSend: function() {

                },
                success: function(data) {
                    $(".check-in-td-" + id).html(data.check_in);
                    $(".check-out-td-" + id).html(data.check_out);

                    $("#log-edit-modal").modal('hide');

                    toastr.success('<?php echo $lang('success_update') ?>');
                }
            });
        })

        $(".edit-check").on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $.ajax({
                url: '<?php echo URL::full('ajax/flight/log/modal') ?>',
                type: 'POST',
                accepts: 'JSON',
                dataType: 'JSON',
                data: {
                    id: id,
                },
                beforeSend: function() {

                },
                success: function(data) {
                    $("#log-edit-modal").modal('show');
                    $("#log-update-form").html(data.payload);
                    console.log(data);
                }
            });
        })

        <?php if( $flight['status'] != Flights::STATUS_COMPLETE ): ?>
            // setTimeout(function() {
            //     window.location.reload();
            // }, 3000);
        <?php endif; ?>

    </script>
</define>