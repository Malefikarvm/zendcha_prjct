/**
 * Created by jsant on 16/05/2016.
 */
Ext.application({
    //requieres : ['Ext.container.Viewport'],
    name : 'Crud',
    appFolder : 'app',

    controllers : [
        'User'
    ],

    models : [
        'User'
    ],

    views : [
        'user.form'
    ],

    launch: function () {
        //Ext.create('Crud.view.user.form').show();
        /*Ext.create('Ext.container.Viewport', {
            items : {
                html : 'Hola mundo!'
            }
        });*/
    }
});