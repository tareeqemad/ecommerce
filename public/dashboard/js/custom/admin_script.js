$(document).ready(function () {

  $('#current_pwd').keyup(function () {
    var current_pwd = $('#current_pwd').val();

    $.ajax({
        type:'post',
        url: '/admin/check-current-pwd',
        data: {current_pwd:current_pwd},
        success:function (res) {
         if (res == "false"){
             $('#chkCurretPwd').html("<font color=red>كلمة المرور غير صحيحة</font>")
         }else if (res == "true"){
             $('#chkCurretPwd').html("<font color=green>كلمة المرور صحيحة</font>")
         }
        },error:function () {
            alert('Error')
        }
    });
  });
});
