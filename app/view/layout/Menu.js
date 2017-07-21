Ext.define('activos_scsj.view.layout.Menu', {
    extend: 'Ext.menu.Menu',
    alias: 'widget.layout.menu',
    floating: false,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    text: 'Opciones',
                    itemId: 'opciones',
                    iconCls: 'icon_gear',
                    hidden: me.privilegio('menu.Opciones'),
                    menu: [
                        {
                            text: 'Adm. Clasificación de Activo',
                            itemId: 'opciones/ActivoClasificacion',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.ActivoClasificacion')
                        },
                        {
                            text: 'Adm. Proveedor',
                            itemId: 'opciones/ActivoProveedor',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.ActivoProveedor')
                        },
                        {
                            text: 'Adm. Áreas',
                            itemId: 'opciones/Area',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Area')
                        },
                        {
                            text: 'Adm. Cargos',
                            itemId: 'opciones/Cargo',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Cargo')
                        },
                        {
                            text: 'Adm. Departamentos',
                            itemId: 'opciones/Departamento',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Departamento')
                        },
                        {
                            text: 'Adm. Unidades',
                            itemId: 'opciones/Unidad',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Unidad')
                        },
                        {
                            text: 'Adm. Ubicaciones',
                            itemId: 'opciones/Ubicacion',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Ubicacion')
                        },
                        {
                            text: 'Adm. Privilegio de Usuarios',
                            itemId: 'opciones/UsuarioPrivilegio',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.UsuarioPrivilegio')
                        },
                        {
                            text: 'Adm. Utilitarios',
                            itemId: 'opciones/Utilitario',
                            iconCls: 'icon_gear',
                            hidden: me.privilegio('menu.opciones.Utilitario')
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    text: 'Activos',
                    itemId: 'activo',
                    hidden: me.privilegio('menu.Activos'),
                    iconCls: 'icon_feature',
                    menu: [
                        {
                            text: 'Adm. Activos',
                            itemId: 'activo/Activo',
                            iconCls: 'icon_feature'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    text: 'Revisiones',
                    itemId: 'revision',
                    iconCls: 'icon_revision',
                    hidden: me.privilegio('menu.Revisiones'),
                    menu: [
                        {
                            text: 'Adm. Revisiones',
                            itemId: 'revision/Revision',
                            iconCls: 'icon_revision'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    text: 'Usuarios',
                    itemId: 'usuario',
                    hidden: me.privilegio('menu.Usuarios'),
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
                },
                {
                    text: 'Reportes',
                    itemId: 'reportes',
                    hidden: me.privilegio('menu.Reportes'),
                    iconCls: 'icon_reporte',
                    menu: [
                        {
                            text: 'Adm. Reportes',
                            itemId: 'reporte/Reporte',
                            iconCls: 'icon_reporte'
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
                    itemId: 'menu_nombre_usuario',
                    border: false
                },
                {
                    xtype: 'menuseparator',
                    border: false
                },
                {
                    xtype: 'label',
                    itemId: 'menu_tipo_usuario',
                    border: false
                }
            ]
        });
        me.callParent(arguments);
    },


    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio'),
                res = storePrivilegios.findRecord('nombre_privilegio_usuario_privilegio', opcion);
        return ( res !== null ) ? false : true;
    }
});