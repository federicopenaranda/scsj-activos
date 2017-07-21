Ext.define('activos_scsj.view.usuario.UsuarioPrivilegio.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuario.usuarioprivilegio.lista',
    title: 'Administrar UsuarioPrivilegio',
    iconCls: 'icon_user',
    store: 'UsuarioPrivilegio',
    minHeight: 250,
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                	flex: .2
                },
                items: [
					{
                        text: 'Nombre Privilegio Usuario Privilegio',
                        dataIndex: 'nombre_privilegio_usuario_privilegio'
                    },
					{
                        text: 'Accion Usuario Privilegio',
                        dataIndex: 'accion_usuario_privilegio'
                    },
					{
                        text: 'Opciones Usuario Privilegio',
                        dataIndex: 'opciones_usuario_privilegio'
                    },
					{
                        text: 'Funcion Usuario Privilegio',
                        dataIndex: 'funcion_usuario_privilegio'
                    },
					{
                        text: 'Descripcion Usuario Privilegio',
                        dataIndex: 'descripcion_usuario_privilegio'
                    }
				 ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            hidden: me.privilegio('usuarioprivilegio.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('usuarioprivilegio.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('usuarioprivilegio.delete'),
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        }
                    ]
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore()
                }
            ]
        });
        me.callParent(arguments);
    },
    
    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        return ( res !== null ) ? false : true;
    }
});
                
                

