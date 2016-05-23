/**
 * Created by jsant on 23/05/2016.
 */
Ext.define('App.view.company.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.companyedit',

    title: 'Edit User',
    layout: 'fit',
    autoShow: true,
    items : [
        {
            xtype: 'form',
            defaultType : 'textfield',
            items : [
                {
                    fieldLabel : 'Id',
                    name : 'id',
                    dataIndex: 'id',
                    hideLabel : true,
                    hidden : true  
                },
                {
                    fieldLabel : 'Razón Social<b><span style="color: #d32f2f">*</span></b>',
                    name : 'businessName',
                    dataIndex: 'businessName',
                    emptyText : 'Razón Social',
                    allowBlank : false,
                    blankText : 'Este campo es obligatorio',
                    maxLength : 50,
                    maxLengthText : 'máximo de caracteres superado',
                },
                {
                    fieldLabel : 'Nit<b><span style="color: #d32f2f">*</span></b>',
                    name : 'nit',
                    emptyText : 'Nit',
                    allowBlank : false,
                    blankText : 'Este campo es obligatorio',
                    maxLength : 25,
                    maxLengthText : 'máximo de caracteres superado'
                },
                {
                    fieldLabel : 'Dirección',
                    name : 'address',
                    emptyText : 'Dirección',
                    maxLength : 50,
                    maxLengthText : 'máximo de caracteres superado'
                },
                {
                    fieldLabel : 'Ciudad',
                    name : 'city',
                    emptyText : 'Ciudad',
                    maxLength : 25,
                    maxLengthText : 'máximo de caracteres superado'
                },
                {
                    fieldLabel : 'Correo electrónico',
                    name : 'email',
                    emptyText : 'Correo electrónico',
                    maxLength : 50,
                    maxLengthText : 'máximo de caracteres superado',
                    regex : /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
                    invalidText : 'Digite una dirección de correo válida'
                },
                {
                    fieldLabel : 'Teléfono',
                    name : 'phone',
                    emptyText : 'Teléfono',
                    maskRe: /[0-9.]/,
                    regex: /^[0-9]+(?:\.[0-9]+)?$/,
                    invalidText : 'Digite un teléfono válido'
                },
                {
                    fieldLabel : 'Celular',
                    name : 'cellphone',
                    emptyText : 'Celular',
                    maskRe: /[0-9.]/,
                    regex: /^[0-9]+(?:\.[0-9]+)?$/,
                    invalidText : 'Digite un celular válido'
                }
            ],
        }
    ],

    buttons : [
        {
            text: 'actualizar',
            action: 'update'
        },
        {
            text: 'cancelar',
            action: 'cancel'
        }
    ]
    
});