Ext.define('activos_scsj.controller.opciones.ActivoTipo',{
    extend:'activos_scsj.controller.Base',
    stores: [
        'opciones.ActivoTipo'
    ],
    views: [
        'opciones.ActivoTipo.Lista'
    ],
    refs: [
    {
            ref: 'ActivoTipoLista',
            selector:'[xtype=opciones.activotipo.lista]'
    }
    ],
    init:function(){
        this.listen({
            controller:{},
            component:{
                'grid[xtype=opciones.activotipo.lista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=opciones.activotipo.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=opciones.activotipo.lista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=opciones.activotipo.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=opciones.activotipo.lista] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActivoTipoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.getActivoTipoLista(),
                plugin = grid.editingPlugin;
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getActivoTipoLista(),
                plugin = grid.editingPlugin,
                record = grid.getSelectionModel().getSelection()[0];

        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
                grid = me.getActivoTipoLista(),
                plugin = grid.editingPlugin,
                store = grid.getStore();

        if (plugin.editing) {
            Ext.Msg.alert('Atención', 'Por favor termine de editar antes de ingresar un nuevo registro.');
            return false;
        }
                
        store.insert(0, {});
    },


    save: function(editor, context, eOpts) {
        var store = context.record.store,
                callbacks;

        callbacks = {
            success: function(records, operation) {
                store.reload();
            },
            failure: function(records, operation) {
                store.rejectChanges();
            }
        };
        
        // save
        store.sync(callbacks);
    },


    remove: function() {
        var me = this;

        var grid = me.getActivoTipoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta ActivoTipo?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    });
                    store.reload();
                }
            }
        });
    }
});






   