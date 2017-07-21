Ext.define('activos_scsj.controller.activo.ActivoUbicacion',{
    extend:'activos_scsj.controller.Base',
    stores: [
        'activo.ActivoUbicacion'
    ],
    views: [
        'activo.Activo.ActivoUbicacionLista'
    ],
    refs: [
	{
            ref: 'ActivoUbicacionLista',
            selector:'[xtype=activo.activo.activoubicacionlista]'
	},
        {
            ref: 'ActivoLista',
            selector:'[xtype=activo.activo.lista]'
	}
    ],
    init:function(){
        this.listen({
            controller:{},
            component:{
                'grid[xtype=activo.activo.activoubicacionlista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=activo.activo.activoubicacionlista] button#add': {
                    click: this.add
                },
                'grid[xtype=activo.activo.activoubicacionlista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=activo.activo.activoubicacionlista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=activo.activo.activoubicacionlista] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore(),
                editActivo = me.getController('activo.Activo').boolActivoEdit,
                grid2 = me.getActivoLista(),
                record, data;

        store.clearFilter(true);

        if (editActivo === 1)
        {
            record = grid2.getSelectionModel().getSelection()[0];
            data = record.getData();
            store.filter('fk_id_activo', data['id_activo']);
        }
        else
        {
            store.filter('fk_id_activo', -1);
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this,
                grid = me.getActivoUbicacionLista(),
                records = grid.getSelectionModel().getSelection();

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
                grid = me.getActivoUbicacionLista(),
                plugin = grid.editingPlugin;
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getActivoUbicacionLista(),
                plugin = grid.editingPlugin,
                record = grid.getSelectionModel().getSelection()[0];

        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
                grid = me.getActivoUbicacionLista(),
                editActivo = me.getController('activo.Activo').boolActivoEdit,
                grid2 = me.getActivoLista(),
                plugin = grid.editingPlugin,
                store = grid.getStore(),
                record = Ext.create('activos_scsj.model.activo.ActivoUbicacion'),
                record2, data2;

        if (editActivo === 1)
        {
            record2 = grid2.getSelectionModel().getSelection()[0];
            data2 = record2.getData();
            record.set('fk_id_activo', data2['id_activo']);
        }

        if (plugin.editing) {
            Ext.Msg.alert('Atención', 'Por favor termine de editar antes de ingresar un nuevo registro.');
            return false;
        }
                
        store.insert(0, record);
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
        //store.sync(callbacks);
    },


    remove: function() {
        var me = this;

        var grid = me.getActivoUbicacionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta Ubicación?. Esta acción no puede ser deshecha.',
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
    },


    sincronizar: function() {
        var me = this,
                grid = me.getActivoUbicacionLista(),
                store = grid.getStore();
        
        store.sync();
    }
});