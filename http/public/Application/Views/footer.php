<?php

use System\Helpers\URL;

?>
<footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy;</p>
                    </div>
                    <!-- <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> -->
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>    
    <script src="<?php echo URL::asset('Application/Assets/js/app.js'); ?>"></script>    
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <call footer_js/>

</body>

</html>