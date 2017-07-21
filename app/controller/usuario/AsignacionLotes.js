Ext.define('activos_scsj.controller.usuario.AsignacionLotes', {
    extend: 'activos_scsj.controller.Base',
    stores: [
        'activo.ActivoEntrega'
    ],
    views: [
        'usuario.AsignacionLotes.Lista',
        'usuario.AsignacionLotes.edit.Form',
        'usuario.AsignacionLotes.edit.Window'
    ],
    refs: [
        {
            ref: 'UsuarioLista',
            selector: '[xtype=usuario.usuario.lista]'
        },
        {
            ref: 'AsignacionLotesWindow',
            selector: '[xtype=usuario.asignacionlotes.edit.window]'
        },
        {
            ref: 'AsignacionLotesWindowAsignacionLotes',
            selector: '[xtype=usuario.asignacionlotes.edit.asignacionloteswindow]'
        },
        {
            ref: 'AsignacionLotesLista',
            selector: '[xtype=usuario.asignacionlotes.lista]'
        }
    ],
    init: function () {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=usuario.usuario.lista] button#asignacion_lotes': {
                    click: this.add
                },
                'grid[xtype=usuario.asignacionlotes.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editActivoRevision,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=usuario.asignacionlotes.lista] button#add': {
                    click: this.addAsignacionLotes
                },
                'grid[xtype=usuario.asignacionlotes.lista] button#edit': {
                    click: this.editAsignacionLotes
                },
                'grid[xtype=usuario.asignacionlotes.lista] button#delete': {
                    click: this.deleteAsignacionLotes
                },
                'window[xtype=usuario.asignacionlotes.edit.activorevisionwindow] button#save': {
                    click: this.save
                },
                'window[xtype=usuario.asignacionlotes.edit.activorevisionwindow] button#cancel': {
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
                store = grid.getStore();

        store.clearFilter(true);

        var grid2 = me.getUsuarioLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();

        store.filter('fk_id_usuario_recibio', data['id_usuario']);
    },
    
    editAsignacionLotes: function (view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getAsignacionLotesLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindowAsignacionLotes(record);
    },
    
    add: function (view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getActivoLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },
    
    addAsignacionLotes: function (button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.activo.AsignacionLotes');

        // show window
        me.showEditWindowActivoRevision(record);
    },
    
    manejaBotones: function (record, index, eOpts) {
        var me = this;
        var grid = me.getAsignacionLotesLista();
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
                grid = me.getAsignacionLotesLista(),
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
    
    
    deleteAsignacionLotes: function () {
        var me = this;

        var grid = me.getAsignacionLotesLista();
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
                win = me.getAsignacionLotesWindow(),
                data = record.getData();

        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('usuario.asignacionlotes.edit.window', {
                title: 'Revisión' + ' - Activo:  ' + data.descripcion_activo
            });
        }
        // show window
        win.show();
    },
    
    
    showEditWindowAsignacionLotes: function (record) {
        var me = this,
                win = me.getAsignacionLotesWindowAsignacionLotes(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('usuario.asignacionlotes.edit.asignacionloteswindow', {
                title: isNew ? 'Añadir Asignación' : 'Editar Asignación'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});