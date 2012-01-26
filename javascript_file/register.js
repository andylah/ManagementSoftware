Ext.ns('App');

App.registerForm = {
     openForm:function(){
         
         var username_txt = new Ext.form.TextField({
               id:'username_txt',
               name:'username_txt',
               width:150,
               fieldLabel:'Username ',
               vtype: 'username',
               labelWidth: 150,
               allowBlank: false
         });

         var password_txt = new Ext.form.TextField({
               id:'password_txt',
               name:'password_txt',
               width:150,
               fieldLabel:'Password ',
               inputType:'password',
               labelWidth: 150,
               vtype:'password',
               allowBlank: false
         })

         var passwordR_txt = new Ext.form.TextField({
               id:'passwordR_txt',
               name:'passwordR_txt',
               width:150,
               fieldLabel:'Repeat Again ',
               inputType:'password',
               labelWidth: 150,
               vtype:'passwordR',
               allowBlank: false,
               initialPasswordField: 'password_txt'
         })
         
         var fname_txt = new Ext.form.TextField({
               id:'fname_txt',
               name:'fname_txt',
               width:150,
               fieldLabel:'First Name ',
               vtype:'name',
               labelWidth: 150,
               allowBlank: false
         })

         var lname_txt = new Ext.form.TextField({
               id:'lname_txt',
               name:'lname_txt',
               width:150,
               fieldLabel:'Last Name ',
               labelWidth: 150,
               allowBlank: true
         })
         
         var email_txt = new Ext.form.TextField({
               id:'email_txt',
               name:'email_txt',
               width:150,
               fieldLabel:'Email ',
               labelWidth: 150,
               vtype: 'email',
               allowBlank: false
         })
         var boxCaptcha = new Ext.BoxComponent({
	       autoEl: {
			tag:'img',
                        id: 'activateCodeImg',
			title : 'Click to refresh code',
                        style:'padding:10px 100px 10px;',
			src:'captcha/CaptchaSecurityImages.php?width=160&height=80&characters=4&t='+new Date().getTime()
               },
	       listeners : {
		  'click' : function () {
			alert('test');
		  }
               }
         });
         var security_txt = new Ext.form.TextField({
               id:'security_txt',
               name:'security_txt',
               width:150,
               fieldLabel:'Security ',
               labelWidth: 150,
               allowBlank: false
         })
         var registerForm = new Ext.FormPanel({
            id:'registerForm',
            layout:'form',
            bodyStyle:'padding:10px 30px;',
            frame:false,
            autoheight:true,
            autowidth:true,
            items:[username_txt, password_txt, passwordR_txt, fname_txt, lname_txt, email_txt, boxCaptcha, security_txt],
            buttons:[
                {text:'Register', iconCls:'icon-save',handler:function(){
                     if (registerForm.getForm().isValid()){
                         registerForm.getForm().submit({
                                url: 'php_file/register.php',
                                params: {task:'register_member'},
                                waitMsg:'Please wait ...',
                                waitTitle: 'Process',
                                failure:function(response, action){
                                     Ext.MessageBox.alert('Error', action.result.errorInfo);
                                     captchaReload();
                                },
                                success:function(response, action){
                                     registerForm.getForm().reset();
                                     win.hide();
                                }
                         })
                     }
                }},
                {text:'Reset', iconCls:'icon-reset',handler:function(){
                     registerForm.getForm().reset();
                     captchaReload();
                }}
            ]
        })
          
        var win = new Ext.Window({
           title: 'Registration Form',
           width: 350,
           layout: 'fit',
           draggable: false,
           height: 400,
           modal: true,
           items:[registerForm]
        })
        win.show();

     function captchaReload(){
         var captchaURL = "captcha/CaptchaSecurityImages.php?width=160&height=80&characters=4&t=";
         var curr = Ext.get('activateCodeImg');
         curr.slideOut('b', {callback:function(){
                               curr.dom.src = captchaURL+new Date().getTime();
                               curr.slideIn('t');
         }});
     }
     }
}
