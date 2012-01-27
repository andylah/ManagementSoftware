<?php
session_start();
if (!isset($_SESSION['session_id'])) {
    header('Location: ../index.php');
}
$config = parse_ini_file("config.ini");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link rel="stylesheet" type="text/css" href="../lib/ext/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext/resources/style.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext/resources/css/icons.css" />

<link rel="shortcut icon" href="../lib/ext/resources/favicon.ico" type="image/x-icon"/>

<script language="javascript1.2" src="../lib/ext/adapter/ext/ext-base.js"></script>
<script language="javascript1.2" src="../lib/ext/ext-all.js"></script>

<title><?php echo $config['host_title'] ?></title>
</head>
<body>

   
</body>
</html>
<script type="text/javascript">
Ext.onReady(function(){
    var layout_west = new Ext.tree.TreePanel({
            region:'north',
            title: 'Menus',
            height:250,
            bodyStyle:'margin-bottom:6px;',
            autoScroll:true,
            enableDD:false,
            rootVisible:false,
            id:'treePanel',
            root: {
                text: 'Menu',
                expanded:true,
                nodeType:'async',
                children:[
                    {
                        text:'Menu1',
                        expanded:true,
                        children:[
                            {
                                text:'Menu1.1',
                                leaf:true
                            }
                        ]
                    },{
                        text:'Menu2',
                        expanded:true,
                        children:[
                            {
                                text:'Menu2.1',
                                leaf:true
                            }
                        ]
                    },{
                        text:'Logout',
                        id:'logout',
                        leaf:true
                    }
                ]
            },
            listeners:{
                click:function(n){
                    switch (n.id) {
                        case 'logout':
                            do_logout()
                            break;
                    }
                }
            }
        })
        
        var layout_west2 = new Ext.Panel({
            region:'center',
            marhin:'10 0 0 0',
            autoScroll:true,
            bodyStyle:'padding:10px;background:#eee;font-family:"Lucida Grande"'
        })
        
        var tab_center = new Ext.TabPanel({
            xtype:'tabpanel',
            resizeTabs:false,
            minTabWidth:115,
            tabWidth:135,
            enableTabScroll:true,
            layoutOnTabChange:true,
            border:false,
            activeItem:'tab_welcome',
            autoDestroy:false,
            items:[
                {
                    xtype:'panel',
                    id:'tab_welcome',
                    bodyStyle:'padding:10px',
                    title:'Welcome'
                }
            ]
        });
        var tb_center = new Ext.Toolbar({
            items:['->',
                {
                    text:'logout',
                    handler:do_logout
                }
            ]
        })
        var layout_center = new Ext.Panel({
            id:'content-panel',
            region:'center',
            layout:'card',
            margins:'0 5 5 0',
            activeItem:0,
            border:true,
            tbar:tb_center,
            items:[tab_center]
        })
        
        var layout_main = new Ext.Viewport({
            layout:'border',
            renderTo:Ext.getBody(),
            items:[
                {
                    region:'north',
                    autoHeight:true,
                    height:100,
                    border:false,
                    html:'<div id="header"><span style="font-size:12px;">Extjs - Tutorial - Simple Login Screen</span></div>',
                    margins:'0 0 5 0',
                    style:'border-bottom: 4px solid #4c72a4;'
                },{
                    region:'west',
                    baseCls:'x-plain',
                    xtype:'panel',
                    autoHeight:true,
                    width:180,
                    border:false,
                    split:true,
                    margins:'0 0 0 5',
                    items:[layout_west,layout_west2]
                },layout_center
            ]
        })
        
        function do_logout(){
            Ext.Ajax.request({
                url:'login.php',
                method:'POST',
                params:{task:'logout_member'},
                waitMsg: 'Logout process ...',
                waitTitle:'Logout',
                success:function(){
                    window.location = '../index.php';
                }
            });
        }
        
        layout_main.show()
    });
</script>