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
    <div id="ad-sense" class="adsense x-hidden">
        <script type="text/javascript"><!--
            google_ad_client = "ca-pub-3619184054099014";
            /* ExtJs-IklanPanel */
            google_ad_slot = "1244975065";
            google_ad_width = 120;
            google_ad_height = 240;
            //-->
        </script>
        <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
</body>
</html>
<script type="text/javascript">
Ext.onReady(function(){
    var layout_west = new Ext.tree.TreePanel({
            region:'north',
            id:'treePanel',
            title: 'Menus',
            height:250,
            bodyStyle:'margin-bottom:6px;',
            autoScroll:true,
            rootVisible:false,
            lines:false,
            loader:new Ext.tree.TreeLoader({
                dataUrl:'../menu.json'
            }),
            root:new Ext.tree.AsyncTreeNode()
        })
        layout_west.on('click', function(n){
            var sn = this.selModel.selNode || {}
            if(n.id == "logout"){
                do_logout()
            }else if (n.leaf && n.id != sn.id){
                Ext.getCmp('content-panel').findById('tab_center').add(n.id+'-panel');
                tab_center.setActiveTab(n.id+'-panel');
            }
        })
        var layout_west2 = ({
            id:'adsense-panel',
            autoScroll: true,
            title:'Ad Sense',
            region:'center',
            autoScroll:true,
            bodyStyle:'padding:5px 5px 5px 5px;text-align:center;background:#eee;font-family:"Lucida Grande"',
            resizable:true,
            height:300,
            contentEl:'ad-sense'
        })
        
        var tab_center = new Ext.TabPanel({
            xtype:'tabpanel',
            id:'tab_center',
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
                    handler:do_logout,
                    icon: '<?php echo $config['base_path']?>/lib/ext/icons/door_out.png'
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
                    height:200,
                    border:false,
                    html:'<div id="header"><h2>Management Software - EXTJS</h2></div>',
                    margins:'0 5 5 5',
                    style:'border-bottom: 5px solid #4c72a4;'
                },{
                    region:'west',
                    baseCls:'x-plain',
                    xtype:'panel',
                    autoHeight:true,
                    width:190,
                    border:false,
                    split:true,
                    margins:'0 5 0 5',
                    items:[layout_west,layout_west2]
                },layout_center
            ]
        });
        
        var customer_panel = new Ext.Panel({
            id:'customer-panel',
            bodyStyle:'padding:10px',
            title:'Master Customer ',
            closable:true
        });
        
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
        
        layout_main.show();
    });
</script>