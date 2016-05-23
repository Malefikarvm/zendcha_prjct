/**
 * Created by jsant on 20/05/2016.
 */
Ext.define('App.model.Company', {
    extend: 'Ext.data.Model',
    fields: ['id', 'businessName', 'nit', 'address', 'city', 'email', 'phone', 'cellphone']
});