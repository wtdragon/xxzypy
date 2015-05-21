function passwordStrengthCheck(password1, password2, passwordsInfo)
{
  //Must contain 5 characters or more
  var WeakPass = /(?=.{6,}).*/;
  //Must contain lower case letters and at least one digit.
  var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
  //Must contain at least one upper case letter, one lower case letter and one digit.
  var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
  //Must contain at least one upper case letter, one lower case letter and one digit.
  var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/;

  $(password1).on('keyup', function(e) {
    if(VryStrongPass.test(password1.val()))
    {
      passwordsInfo.removeClass().addClass('vrystrongpass').html("非常安全! (请记住密码)");
    }
    else if(StrongPass.test(password1.val()))
    {
      passwordsInfo.removeClass().addClass('strongpass').html("安全! (加入特殊字符");
    }
    else if(MediumPass.test(password1.val()))
    {
      passwordsInfo.removeClass().addClass('goodpass').html("好! (加入大小写字符)");
    }
    else if(WeakPass.test(password1.val()))
    {
      passwordsInfo.removeClass().addClass('stillweakpass').html("安全度低! (输入数字以增加安全度)");
    }
    else
    {
      passwordsInfo.removeClass().addClass('weakpass').html("安全度低(必须超过6个字符)");
    }
  });

  $(password2).on('keyup', function(e) {

    if(password1.val() !== password2.val())
    {
      passwordsInfo.removeClass().addClass('weakpass').html("密码不匹配!");
    }else{
      passwordsInfo.removeClass().addClass('goodpass').html("密码匹配!");
    }

  });
}
