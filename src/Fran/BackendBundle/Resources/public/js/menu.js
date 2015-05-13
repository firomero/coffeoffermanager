/**
 * Created by firomero on 11/05/2015.
 */
'use strict';
var $menuObject = {};
$(function(){
    $(document).ready(function() {


       var oTable =    $('#tabla').DataTable(
            {
                            "oLanguage":$language,
//                        "bJQueryUI": true,
                "aLengthMenu": [5, 10, 15],
               aoColumns:[
                   null,
                   {"bSortable":false},

               ]
            }
        );

        $menuObject.table = oTable;

    } );

    //ADD MENU
    $('.btn.btn-primary.acept').click(function(){
        $menuObject.addMenu();
    });

    //EDIT MENU
    $('.btn.btn-mini.edit').click(function(){

        var $btnEdit = $(this);
        var $saveBtn =  $('.btn.btn-primary.acept');

        $saveBtn.off('click');
        $saveBtn.click(function(){
            $menuObject.editMenu($btnEdit);
        });
        var $modalView =  $('#myModalAdd');

        $modalView.on('hidden',function(){
            $saveBtn.off('click');
            $saveBtn.click(function(){
                $menuObject.addMenu();
            });
        });

        $modalView.modal('show');


    });




})

/*CUSTOM EVENTS*/
$menuObject.addMenu = function(){
    var name = $('#menuText').val();
    var $modalView =  $('#myModalAdd');
    if (name!='') {

        $.post(
            Routing.generate('menu_ajax_add'),
            {
                menuName:name
            },
            function(data,text,response)
            {
                if (response.status==200) {

                    $modalView.modal('hide');
                    location.reload();


                }



            },
            "json"
        ).fail(function(){
                $menuObject.insertError();
            });
    }
    else{

        $menuObject.insertError();
    }
};


$menuObject.editMenu = function(object){
    var name = $('#menuText').val();
    var id = $(object).data('id');
    if (name!=null) {
        $.post(
            Routing.generate('menu_ajax_edit'),
            {
                menuName:name,
                id:id
            },
            function(data,text,response)
            {
                if (response.status==206) {

                    $('#myModalAdd').modal('hide');
                    location.reload();
                }
                if (response.status==200) {

                    $('#myModalAdd').modal('hide');
                    location.reload();
                }

            },
            "json"
        ).fail(function(){
                $menuObject.insertError();
            });
    }
};

$menuObject.deleteMenu = function(object)
{
    var id = $(object).data('id');
    $.delete(
        Routing.generate('menu_ajax_delete'),
        {
            id:id
        },
        function(data,  text, response)
        {
            if (response.status==204) {

                $('#myModalAdd').modal('hide');
                location.reload();
            }
        },
        "json"
    ).fail(function(){
            $menuObject.insertError();
        });
}

$menuObject.insertError=function(){
    var $modalView =  $('#myModalAdd');
    $modalView.find('.alert.alert-danger').remove();
    var $error = $('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"></button>Por favor, verifique sus datos.<strong class="icon-remove close"></strong> </div>');
    $modalView.find('.modal-body').append($error);
    $modalView.find('.close').click(function(){
        $(this).closest('.alert.alert-danger').remove();
    });

}


/*ANGULAR BINDINGS*/
var $menuApp = angular.module('MenuApp',[]);
//Launching Modal

$menuApp.controller('modalController',function($scope){
  $scope.launchCustom = function(){

      $('#myModalAdd').modal('show');
  }
});
