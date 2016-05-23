/**
 * Created by jsant on 19/05/2016.
 */
Ext.define('App.view.company.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.companylist',

    title: 'Compañia',
    store: 'Company',

    /*store : {
        fields: ['name', 'email'],
        data  : [
            {name: 'Ed',    email: 'ed@sencha.com'},
            {name: 'Tommy', email: 'tommy@sencha.com'}
        ]
    },*/
    
    columns : [
        {header: 'Id',  dataIndex: 'id',  flex: 1},
        {header: 'Razón social',  dataIndex: 'businessName',  flex: 1},
        {header: 'Nit', dataIndex: 'nit', flex: 1},
        {header: 'Dirección', dataIndex: 'addrress', flex: 1},
        {header: 'Ciudad', dataIndex: 'city', flex: 1},
        {header: 'Correo', dataIndex: 'email', flex: 1},
        {header: 'Teléfono', dataIndex: 'phone', flex: 1},
        {header: 'Celular', dataIndex: 'cellphone', flex: 1},
        /*{
            header: '',
            width: 85,
            sortable: false,
            renderer: function (val) {
                return '<input type="button" value="Editar" id="'+val+'" class="btnEdit"/> <input type="button" value="Borrar" id="'+val+'" class="btnEdit"/>';
            },
            dataIndex: 'nit'
        }*/
        {
            xtype : 'actioncolumn',
            header : '',
            width : 50,
            align : 'left',
            items : [
                {
                    icon:'some_icon.png',
                    tooltip : 'editar',
                    handler : function (grid, rowIndex, colIndex, item, e, record) {
                        var form = Ext.getCmp('form');
                        this.up('grid').fireEvent('editRecord', this, record, form);
                    }
                },
                {
                    icon:'some_icon.png',
                    tooltip : 'Borrar',
                    handler : function (grid, rowIndex, colIndex, item, e, record) {
                        this.up('grid').fireEvent('deleteRecord', this, record, rowIndex);
                    }
                }
            ]
        }
    ],
});