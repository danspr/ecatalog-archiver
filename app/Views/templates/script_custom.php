<script src="<?= base_url() ?>assets/js/libs/jquery-3.7.1.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/libs/toastr.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/libs/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/vue/smarteoq.constants.js" type="text/javascript"></script>

<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Vue JS -->
<?php if(ENVIRONMENT === 'development'): ?>
    <script src="<?= base_url() ?>assets/js/libs/vue.global.js"></script>
<?php else: ?>
    <script src="<?= base_url() ?>assets/js/libs/vue.global.prod.js"></script>  
<?php endif; ?>
<!-- Axios JS -->
<script src="<?= base_url() ?>assets/js/libs/axios.min.js"></script>

<script type="text/javascript">
  var baseURL = '<?= base_url() ?>';
  var customParam = <?= isset($customParam) ? json_encode($customParam) : json_encode(array()) ?>;
  var axiosHeader = {
      'Content-Type': 'application/x-www-form-urlencoded',
      "X-Requested-With": "XMLHttpRequest"
  }

  var axiosJsonHeader = {
      'Content-Type': 'application/json',
      "X-Requested-With": "XMLHttpRequest"
  }

  function redirect(url) {
    window.location.href = url;
  }

  function showAlert(type, msg) {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      if (type == "info") {
        toastr.info(msg, 'Info!');
      } else if (type == "success") {
        toastr.success(msg, 'Success!');
      } else if (type == "warning") {
        toastr.warning(msg, 'Warning!');
      } else if (type == "error") {
        toastr.error(msg, 'Error!');
      }
  }

  function axiosErrorUnAuthorization(error) {
    if (error.response.status == 401) {
      return window.location.reload();
    }
  }

  function axiosErrorCallback(error){
    if (error.response) {
        axiosErrorUnAuthorization(error);
        if (error.response.status == 401) {
          return window.location.reload();
        }
        let messages= error.response.data.messages;
        let errorMessage = '';
        Object.keys(messages).forEach(key => {
            errorMessage += messages[key] + '<br/>';
        });
        showAlert('error', errorMessage);
    } else if (error.request) {
        showAlert('error', getMessage('error.server_timeout'));
    } else {
        showAlert('error', getMessage('error.generic'));
    }
  }

  function showLoadingButton(id){
      $(`#${id}`).prop("disabled", true);
      $(`#${id}`).find('.spinner-border').show();
      $(`#${id}`).find('.btn-text').html("Loading...");
  }
  
  function hideLoadingButton(id, btnText){
      $(`#${id}`).prop("disabled", false);
      $(`#${id}`).find('.spinner-border').hide();
      $(`#${id}`).find('.btn-text').html(btnText);
  }
</script>