$(document).ready(function(){
  rules.init();
  
  $('#save-as').click(function(){
    $.prompt({
      state0: {
        html: '<label for="filename-prompt">Save As :</label> <input type="text" id="filename-prompt" value=".htaccess"/>',
        focus: 1,
        buttons: {Save: true, Cancel: false},
        submit: function(value) {
          if (value == true) {
            var val = $('#filename-prompt').val();
            if (val == '') {
              $('#filename-prompt').css("border","solid #ff0000 1px");
              return false;
            }
            window.location = 'download.php?filename='+encodeURI(val);
            return true;
          }
        }
      }
    },{
      show: 'fadeIn',
      opacity: '0.7',
      loaded: function() {
        $('#filename-prompt').keydown(function(event){
          switch (event.keyCode) {
            case 13:
              $('#jqi_state0_buttonSave').click();
              break;
            case 27:
              jQuery.prompt.close();
              break;
          }
        }).focus();
      }
    });

    return false;
  });
  
  $('#delete').click(function(){
    return confirm('Delete Rules? This will also delete our saved copy (if any)');
  });
  
  $('#save').click(function(){
    $.post($(this).attr('href'), {}, function(){
      rules.reloadRules();
    });
    return false;
  });
  
  $('#field-rule-select').change(function(){
    var val = $(this).val();
    if (val == '')
      return;
    $('#form-add-rule').submit();
    $(this).val('');
  });
  
});
var ajaxes_running = 0;
function do_ajax(method, params, callback)
{
  ajaxes_running++;
  $('#loading').show();
  $.ajax('ajax.php?action='+method,{
    cache : false,
    data : params,
    type : 'post',
    success : callback,
    complete : function(){
      ajaxes_running--;
      if (ajaxes_running == 0)
        $('#loading').hide();
    }
  });
}
