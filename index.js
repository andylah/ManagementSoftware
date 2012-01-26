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
                   html:'<a href="#" onclick="App.registerForm.openForm()">Register</a>',
                   listeners: {
                    'click' : function(){
                        alert("Link Clicked")
                     }
                   }
               })
        ],
        buttons: [
                 {text: 'Login', iconCls: 'icon-run', handler: function(){
                      if(formLogin.getForm().isValid()){
                          alert('Welcome '+Ext.get('usertxt_id').dom.value);
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