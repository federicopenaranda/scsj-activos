Ext.define('activos_scsj.view.layout.Menu', {
    extend: 'Ext.menu.Menu',
    alias: 'widget.layout.menu',
    floating: false,
    initComponent: function() {
        var me = this;
        
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        storePrivilegios.load();
        
        Ext.applyIf(me, {
            items: [
                {
                    text: 'Opciones',
                    itemId: 'opciones',
                    iconCls: 'icon_gear',
                    //hidden: me.privilegio('menu.opciones'),
                    menu: [
                        {
                            text: 'Adm. Unidad',
                            itemId: 'opciones/Unidad',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Área',
                            itemId: 'opciones/Area',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Departamento',
                            itemId: 'opciones/Departamento',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Cargo',
                            itemId: 'opciones/Cargo',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Estado de Activo',
                            itemId: 'opciones/ActivoEstado',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Revisión',
                            itemId: 'opciones/Revision',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Proveedor',
                            itemId: 'opciones/ActivoProveedor',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Tipo de Activo',
                            itemId: 'opciones/ActivoTipo',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Clasificación de Activo',
                            itemId: 'opciones/ActivoClasificacion',
                            iconCls: 'icon_gear'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.proyectos')
                },
                {
                    text: 'Usuarios',
                    itemId: 'usuario',
                    //hidden: me.privilegio('menu.usuarios'),
                    iconCls: 'icon_usuario',
                    menu: [
                        {
                            text: 'Adm. Usuarios',
                            itemId: 'usuario/Usuario',
                            iconCls: 'icon_usuario'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.entidades')
                },
                {
                    text: 'Reportes',
                    itemId: 'reportes',
                    //hidden: me.privilegio('menu.reportes'),
                    iconCls: 'icon_reporte',
                    menu: [
                        {

                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    text: 'Salir',
                    itemId: 'logout',
                    iconCls: 'icon_login'
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    xtype: 'menuseparator',
                    height : 30,
                    border: false,
                    disabled: true
                },
                {
                    xtype: 'label',
                    html: '<strong>Usuario:</strong> ' + activos_scsj.app.globals.globalNombreUsuario,
                    border: false
                },
                {
                    xtype: 'menuseparator',
                    border: false
                },
                {
                    xtype: 'label',
                    html: '<strong>Privilegio:</strong> ' + activos_scsj.app.globals.globalTipoUsuario,
                    border: false
                }
            ]
        });
        me.callParent(arguments);
    },


    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        
        return ( res !== null ) ? false : true;
    }
});