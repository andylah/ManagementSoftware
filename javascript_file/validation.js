var usernameErrLength = 'Username length must be 5 characters';
var usernameErrUnique = 'Username already in use';


function resetUsernameValidator(is_error){
    Ext.apply(Ext.form.VTypes, {
       username:function(val){
           if (val.length < 5){
               Ext.apply(Ext.form.VTypes,{
                   usernameText:usernameErrLength
               });
               return false;
           }else{
               Ext.Ajax.request({
                   url:'php_file/register.php',
                   method:'POST',
                   params: {task:'cek_username',username_txt:val},
                   success:function(o){
                       if(o.responseText == 0){
                           resetUsernameValidator(false)
                       }else{
                           resetUsernameValidator(true)
                       }
                   }
               });
               return is_error;
           }
       } 
    });
}

Ext.apply(Ext.form.VTypes, {
     usernameMask : /[a-z0-9_\.\-@\+]/i,
     username: function(val){
           if (val.length < 5) {
                Ext.apply(Ext.form.VTypes, {
                     usernameText:usernameErrLength
                });
                return false;
           }else{
                Ext.Ajax.request({
                   url: 'php_file/register.php',
                   method: 'POST',
                   params: {task:'cek_username',username_txt:val},
                   success:function(o){
                       if(o.responseText == 0){
                           resetUsernameValidator(false);
                           Ext.apply(Ext.form.VTypes, {
                               usernameText:usernameErrUnique
                           });
                           return false;
                       }else{
                           resetUsernameValidator(true);
                       }
                   }
                });
                return true;
           }
     },
     usernameText:usernameErrUnique 
})

Ext.form.VTypes["passwordVal1"] = /^.{5,30}$/;
Ext.form.VTypes["passwordVal2"] = /[^a-zA-Z].*[^a-zA-Z]/;

Ext.form.VTypes["password"]=function(v){
 if(!Ext.form.VTypes["passwordVal1"].test(v)){
  Ext.form.VTypes["passwordText"]="Password length must be 5 to 30 characters long";
  return false;
 }
 Ext.form.VTypes["passwordText"]="Password must include atleast 2 numbers or symbols";
 return Ext.form.VTypes["passwordVal2"].test(v);
}
Ext.form.VTypes["passwordText"]="Invalid Password"
Ext.form.VTypes["passwordMask"]=/./;

Ext.form.VTypes["passwordR"]=function(value, field) {
	if (!(field.initialPasswordField instanceof Ext.form.Field)) {
	    field.initialPasswordField = Ext.getCmp(field.initialPasswordField);
	}
	return (value == field.initialPasswordField.getValue());
}
Ext.form.VTypes["passwordRText"] = "Password do not match";

Ext.form.VTypes['nameVal']=/^[a-zA-Z][-_.a-zA-Z0-9]{2,30}$/;
Ext.form.VTypes["name"]=function(v){
      return Ext.form.VTypes["nameVal"].test(v);
}
Ext.form.VTypes['nameText']="Name must begin with latter and length must be 3 to 30 characters"


