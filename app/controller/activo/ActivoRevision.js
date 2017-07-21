Ext.define('activos_scsj.controller.activo.ActivoRevision', {
    extend: 'activos_scsj.controller.Base',
    stores: [
        'activo.ActivoRevision'
    ],
    views: [
        'activo.ActivoRevision.Lista',
        'activo.ActivoRevision.edit.Form',
        'activo.ActivoRevision.edit.Window'
    ],
    refs: [
        {
            ref: 'ActivoLista',
            selector: '[xtype=activo.activo.lista]'
        },
        {
            ref: 'ActivoRevisionWindow',
            selector: '[xtype=activo.activorevision.edit.window]'
        },
        {
            ref: 'ActivoRevisionWindowActivoRevision',
            selector: '[xtype=activo.activorevision.edit.activorevisionwindow]'
        },
        {
            ref: 'ActivoRevisionLista',
            selector: '[xtype=activo.activorevision.lista]'
        }
    ],
    init: function () {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=activo.activo.lista] button#revision': {
                    click: this.add
                },
                'grid[xtype=activo.activorevision.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editActivoRevision,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=activo.activorevision.lista] button#add': {
                    click: this.addActivoRevision
                },
                'grid[xtype=activo.activorevision.lista] button#edit': {
                    click: this.editActivoRevision
                },
                'grid[xtype=activo.activorevision.lista] button#delete': {
                    click: this.deleteActivoRevision
                },
                'window[xtype=activo.activorevision.edit.activorevisionwindow] button#save': {
                    click: this.save
                },
                'window[xtype=activo.activorevision.edit.activorevisionwindow] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    loadRecords: function (grid, eOpts) {
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
    
    editActivoRevision: function (view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getActivoRevisionLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindowActivoRevision(record);
    },
    
    add: function (view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getActivoLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },
    
    addActivoRevision: function (button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.activo.ActivoRevision');
        
        // show window
        me.showEditWindowActivoRevision(record);
    },
    
    manejaBotones: function (record, index, eOpts) {
        var me = this;
        var grid = me.getActivoRevisionLista();
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
    
    
    save: function (button, e, eOpts) {
        var me = this,
                grid = me.getActivoRevisionLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridActivo = me.getActivoLista();
        var recordActivo = gridActivo.getSelectionModel().getSelection()[0];
        var dataActivo = recordActivo.getData();

        values['fk_id_activo'] = dataActivo['id_activo'];

        record.set(values);

        if (!record.dirty) {
            win.close();
            return;
        }

        callbacks = {
            success: function (records, operation) {
                store.reload();
                win.close();
            },
            failure: function (records, operation) {
                store.rejectChanges();
            }
        };

        Ext.getBody().mask('Guardando Revisión ...');

        if (record.phantom) {
            store.rejectChanges();
            store.add(record);
        }

        store.sync(callbacks);
    },
    
    
    close: function (button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },
    
    
    deleteActivoRevision: function () {
        var me = this;

        var grid = me.getActivoRevisionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];

        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Revisión?. Esta acción no puede ser deshecha.', function (buttonId, text, opt) {
            if (buttonId === 'yes') {
                store.remove(record);
                store.sync({
                    failure: function (records, operation) {
                        store.rejectChanges();
                    }
                });
            }
        });
    },
    
    
    showEditWindow: function (record) {
        var me = this,
                win = me.getActivoRevisionWindow(),
                data = record.getData();

        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('activo.activorevision.edit.window', {
                title: 'Revisión' + ' - Activo:  ' + data.descripcion_activo
            });
        }
        // show window
        win.show();
    },
    
    
    showEditWindowActivoRevision: function (record) {
        var me = this,
                win = me.getActivoRevisionWindowActivoRevision(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('activo.activorevision.edit.activorevisionwindow', {
                title: isNew ? 'Añadir Revisión' : 'Editar Revisión'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});