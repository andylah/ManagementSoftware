Ext.chart.Chart.CHART_URL = 'lib/ext/resources/charts.swf';

Ext.onReady(function(){
    
    Ext.QuickTips.init();

    var usertxt = new Ext.form.TextField({
	id:'usertxt_id',
	name:'usertxt',
	allowBlank:false,
	width:150,
	fieldLabel:'Username '
    })
    
    var passtxt = new Ext.form.TextField({
	id:'passtxt_id',
	name:'passtxt',
	allowBlank:false,
        inputType:'password',
	width:150,
	fieldLabel:'Password '
    })

    var formLogin = new Ext.FormPanel({
        id: 'formLogin',
        bodyStyle: "background-image:url('/images/logon.jpeg')",
        labelWidth: 80,
        trackResetOnLoad:true,
        height: 150,
        frame:true,
        items:[usertxt, passtxt,
               new Ext.Panel({
                   bodySytle:'text-decoration:none; padding-top:2em;',
                   html:'<a href="#" onclick="App.registerForm.openForm()">Register</a>'
               })
        ],
        buttons: [
                 {text: 'Login', iconCls: 'icon-run', handler: function(){
                      if(formLogin.getForm().isValid()){
                          formLogin.getForm().submit({
                              url:'php_file/login.php',
                              params:{task:'login_member'},
                              waitMsg: 'Login process ...',
                              waitTitle:'Login',
                              failure:function(formLogin, action){
                                  Ext.MessageBox.alert('Error', action.result.errorInfo)
                              },
                              success:function(formLogin, action){
                                  window.location = MEMBER_URL;
                              }
                          });
                      }
                 }}
        ]
    })

    var win = new Ext.Window({
        layout: 'fit',
        draggable: false,
        closable: false,
        resizable: false,
        width: 350,
        title:'Login Page',
        height:165,
        plain: true,
        border: false,
        items: [formLogin],
        bbar:[{
             xtype: 'tbtext',
             text: '@ 2012 | Andylah Software'
        },'->',{
             xtype: 'tbtext',
             text: 'www.bebikyu.co.cc'
        }]
    })
    win.show();
});