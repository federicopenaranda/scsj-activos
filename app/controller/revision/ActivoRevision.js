Ext.define('activos_scsj.controller.revision.ActivoRevision', {
    extend: 'activos_scsj.controller.Base',
    boolListaCargada: false,
    stores: [
        'revision.ActivoRevision'
    ],
    views: [
        'revision.ActivoRevision.Lista',
        'revision.ActivoRevision.edit.Form',
        'revision.ActivoRevision.edit.Window',
        'revision.ActivoRevision.ActivoLista'
    ],
    refs: [
        {
            ref: 'RevisionLista',
            selector: '[xtype=revision.revision.lista]'
        },
        {
            ref: 'ActivoRevisionWindow',
            selector: '[xtype=revision.activorevision.edit.window]'
        },
        {
            ref: 'ActivoRevisionWindowActivoRevision',
            selector: '[xtype=revision.activorevision.edit.activorevisionwindow]'
        },
        {
            ref: 'ActivoRevisionLista',
            selector: '[xtype=revision.activorevision.activolista]'
        },
        {
            ref: 'ActivosTab',
            selector: '[xtype=revision.ativorevision.edit.tab.activos]'
        },
        {
            ref: 'UnidadField',
            selector: '[xtype=revision.activorevision.edit.form] combo#fk_id_unidad'
        },
        {
            ref: 'UbicacionField',
            selector: '[xtype=revision.activorevision.edit.form] combo#fk_id_ubicacion'
        },
        {
            ref: 'AreaField',
            selector: '[xtype=revision.activorevision.edit.form] combo#fk_id_area'
        },
        {
            ref: 'DepartamentoField',
            selector: '[xtype=revision.activorevision.edit.form] combo#fk_id_departamento'
        },
        {
            ref: 'UsuarioField',
            selector: '[xtype=revision.activorevision.edit.form] combo#fk_id_usuario_recibio'
        },
        {
            ref: 'BusquedaRevisionField',
            selector: '[xtype=revision.activorevision.activolista] textfield#busqueda_revision'
        },
        {
            ref: 'PendientesRevisionField',
            selector: '[xtype=revision.activorevision.activolista] checkboxfield#pendientes'
        }
    ],
    init: function () {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=revision.revision.lista] button#revisar': {
                    click: this.add
                },
                'grid[xtype=revision.activorevision.activolista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editActivoRevision,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones,
                    itemdeletebuttonclick: this.setActivoRevision
                },
                'grid[xtype=revision.activorevision.activolista] button#add': {
                    click: this.addActivoRevision
                },
                'grid[xtype=revision.activorevision.activolista] button#edit': {
                    click: this.editActivoRevision
                },
                'window[xtype=revision.activorevision.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=revision.activorevision.edit.window] button#cancel': {
                    click: this.close
                },
                'window[xtype=revision.activorevision.edit.activorevisionwindow] button#save': {
                    click: this.saveActivoRevision
                },
                'window[xtype=revision.activorevision.edit.activorevisionwindow] button#cancel': {
                    click: this.close
                },
                '[xtype=revision.activorevision.edit.form] combo#fk_id_unidad': {
                    select: this.filtraUbicacion
                },
                '[xtype=revision.activorevision.activolista] textfield#busqueda_revision': {
                    keyup: this.buscaActivo
                },
                '[xtype=revision.activorevision.edit.form] combo': {
                    select: this.revisaFiltros
                },
                '[xtype=revision.activorevision.activolista] checkbox#pendientes': {
                    change: this.filtraPendientes
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    setActivoRevision: function ( grid, rowIndex, colIndex ) {
        var store = grid.getStore(),
                record = store.getAt(rowIndex),
                today = new Date();
        
        record.set('estado_activo_revision', 'revisado');
        record.set('fecha_activo_revision', today);
    },


    filtraPendientes: function ( checkbox, newValue, oldValue, eOpts ) {
        var me = this,
                grid = me.getActivoRevisionLista(),
                store = grid.getStore(),
                filters = [];
        
        filters.push({
            id: 'filtersId',
            property: 'estado_activo_revision',
            value: 'pendiente'
        });
        
        if (newValue)
        {
            store.filter(filters);
        }
        else
        {
            store.removeFilter('filtersId');
        }
    },
    
    
    buscaActivo: function( combo, records, eOpts ) {
        var me = this,
                grid = me.getActivoRevisionLista(),
                text = me.getBusquedaRevisionField(),
                store = grid.getStore(),
                filter=[];

        filter.push(
            {
                property: 'codigo_activo',
                value: text.getValue(),
                anyMatch: true
            }
        );
        
        store.clearFilter(true);
        store.filter(filter);
    },
    
    
    /*cargaActivos: function( combo, records, eOpts ) {
        var me = this,
                grid = me.getActivoRevisionLista(),
                unidad = me.getUnidadField().getValue(),
                area = me.getAreaField().getValue(),
                depto = me.getDepartamentoField().getValue(),
                ubica = me.getUbicacionField().getValue(),
                store = grid.getStore(),
                filters=[];
        
        if ( me.boolListaCargada === false )
        {
            filters.push(
                { property: 'fk_id_unidad', value: unidad },
                { property: 'fk_id_area', value: area },
                { property: 'fk_id_departamento', value: depto },
                { property: 'fk_id_ubicacion', value: ubica }
            );

            //store.clearFilter( true );
            //store.filter(filters);
            //store.load();
            
            
            Ext.data.JsonP.request ({
                url: activos_scsj.app.globals.globalServerPath + 'ActivoRevisionEspecial',
                params: {
                    page: 1,
                    start: 0,
                    limit: 100,
                    filter: Ext.encode(filters)
                },
                success: function( response, options ) {
                    console.log(response);
                    store.loadData( response.registros );
                },
                failure: function( response, options ) {
                    Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                }
            });
        }
    },*/
    
    
    loadRecords: function (grid, eOpts) {
        var me = this,
                store = grid.getStore(),
                editRevision = me.getController('revision.Revision').boolRevisionEdit,
                unidad = me.getUnidadField().getValue(),
                area = me.getAreaField().getValue(),
                depto = me.getDepartamentoField().getValue(),
                ubica = me.getUbicacionField().getValue(),
                grid2 = me.getRevisionLista(),
                record, data, filters=[];

        store.clearFilter(true);

        filters.push(
            { property: 'fk_id_unidad', value: unidad },
            { property: 'fk_id_area', value: area },
            { property: 'fk_id_departamento', value: depto },
            { property: 'fk_id_ubicacion', value: ubica }
        );


        if ( editRevision === 1 )
        {
            record = grid2.getSelectionModel().getSelection()[0];
            data = record.getData();
            
            filters.push(
                { property: 'fk_id_revision', value: data['id_revision'] }
            );
    
            Ext.getBody().mask('Cargando Activos, por favor espere ...');
    
            Ext.data.JsonP.request ({
                url: activos_scsj.app.globals.globalServerPath + 'ActivoRevisionEspecial',
                params: {
                    page: 1,
                    start: 0,
                    limit: 100,
                    filter: Ext.encode(filters)
                },
                success: function( response, options ) {
                    var registros = response.registros;

                    Ext.each (registros, function (activo, value, myself) {
                        var recordAR = Ext.create('activos_scsj.model.revision.ActivoRevision');
                        recordAR.set(activo);
                        store.add(recordAR);
                    });
                    
                    Ext.getBody().unmask();
                },
                failure: function( response, options ) {
                    Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                }
            });
            
            //store.filter(filters);
        }
        else
        {
            Ext.getBody().mask('Cargando Activos, por favor espere ...');
            
            Ext.data.JsonP.request ({
                url: activos_scsj.app.globals.globalServerPath + 'ActivoRevisionEspecial',
                params: {
                    page: 1,
                    start: 0,
                    limit: 100,
                    filter: Ext.encode(filters)
                },
                success: function( response, options ) {
                    var registros = response.registros;

                    Ext.each (registros, function (activo, value, myself) {
                        var recordAR = Ext.create('activos_scsj.model.revision.ActivoRevision');
                        recordAR.set(activo);
                        store.add(recordAR);
                    });
                    
                    Ext.getBody().unmask();
                },
                failure: function( response, options ) {
                    Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                }
            });
            
            //store.filter(filters);
        }
        
        store.remoteFilter = false;
        store.remoteSort = false;
        store.remoteGroup = false;
        store.autoDestroy = true;

    },
    
    
    revisaFiltros: function( combo, records, eOpts ) {
        var me = this,
                unidad = me.getUnidadField(),
                area = me.getAreaField(),
                departamento = me.getDepartamentoField(),
                ubicacion = me.getUbicacionField(),
                tabActivos = me.getActivosTab();
        
        if ( unidad.value !== null && area.value !== null && departamento.value !== null && ubicacion.value !== null )
        {
            tabActivos.setDisabled(false);
        }
    },
    
    
    filtraUbicacion: function( combo, records, eOpts ) {
        var me = this,
                ubicacion = me.getUbicacionField(),
                ubicacionStore = ubicacion.store;
        
        ubicacionStore.load();
        ubicacionStore.clearFilter(true);
        ubicacionStore.filter("fk_id_unidad", combo.getValue());
        ubicacion.setDisabled(false);
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

        var grid = me.getRevisionLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },
    
    
    addActivoRevision: function (button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.revision.ActivoRevision');
        
        // show window
        me.showEditWindowActivoRevision(record);
    },
    
    
    manejaBotones: function (record, index, eOpts) {
        var me = this;
        var grid = me.getActivoRevisionLista();
        var records = grid.getSelectionModel().getSelection();
        
        //me.boolListaCargada = true;

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");

        if (records.length > 0)
        {
            botonEdit.enable();
        }
        else
        {
            botonEdit.disable();
        }
    },


    saveActivoRevision: function (button, e, eOpts) {
        var me = this, 
                win = button.up('window'),
                grid = me.getRevisionLista(),
                revision = grid.getSelectionModel().getSelection()[0],
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                usuario = me.getUsuarioField().getValue();
        
        record.set(values);
        record.set('estado_activo_revision', 'revisado');
        record.set('fk_id_revision', revision.get('id_revision'));

        if ( usuario )
        {
            record.set('fk_id_usuario_recibio', usuario);
        }

        if (!record.dirty) {
            win.close();
            return;
        }

        form.updateRecord(record);
        win.close();
        //store.sync(callbacks);
    },
    
    
    save: function (button, e, eOpts) {
        var me = this,
                grid = me.getActivoRevisionLista(),
                store = grid.getStore(),
                win = button.up('window'),
                callbacks;

        callbacks = {
            success: function (records, operation) {
                //store.reload();
                win.close();
            },
            failure: function (records, operation) {
                store.rejectChanges();
            }
        };

        Ext.getBody().mask('Guardando Revisión ...');

        store.sync(callbacks);
    },
    
    
    close: function (button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },
    
    
    showEditWindow: function (record) {
        var me = this,
                win = me.getActivoRevisionWindow(),
                data = record.getData();

        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('revision.activorevision.edit.window', {
                title: 'Revisión'
            });
        }
        // show window
        win.show();
        
        var fieldUbicacion = me.getUbicacionField(),
            tabActivos = me.getActivosTab();

        fieldUbicacion.setDisabled(true);
        tabActivos.setDisabled(true);
    },
    
    
    showEditWindowActivoRevision: function (record) {
        var me = this,
                win = me.getActivoRevisionWindowActivoRevision(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('revision.activorevision.edit.activorevisionwindow', {
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