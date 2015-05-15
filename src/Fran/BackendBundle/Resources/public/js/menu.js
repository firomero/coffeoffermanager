/**
 * Created by aiorian on 11/05/2015.
 */
'use strict';

/*
 * show.bs.modal
 * shown.bs.modal
 * hide.bs.modal
 * hidden.bs.modal
 *
 * */
var $menuObject = {};
$(function () {
    $(document).ready(function () {


        var oTable = $('#tabla').DataTable(
            {
                "oLanguage": $language,

                "aLengthMenu": [5, 10, 15],
                aoColumns: [
                    null,
                    {"bSortable": false},

                ]
            }
        );

        $menuObject.table = oTable;

    });

    //ADD MENU
    $('.btn.btn-primary.acept').click(function () {
        $menuObject.addMenu();
    });

    //EDIT MENU
    $('.btn.btn-mini.edit').click(function () {

        var $btnEdit = $(this);
        var $saveBtn = $('.btn.btn-primary.acept');

        $saveBtn.off('click');
        $saveBtn.click(function () {
            $menuObject.editMenu($btnEdit);
        });
        var $modalView = $('#myModalAdd');
        $modalView.modal();
        $modalView.find('#myModalLabel').text('Editar Menu');
        $modalView.find('#menuText').val($btnEdit.data('name'));
        $modalView.on('hide.bs.modal', function () {
            $saveBtn.off('click');
            $saveBtn.click(function () {
                $menuObject.addMenu();
            });
            $modalView.find('#myModalLabel').text('Adicionar Menu');
        });
        $modalView.modal('show');
    });


})

/*CUSTOM EVENTS*/
$menuObject.addMenu = function () {
    var name = $('#menuText').val();
    var $modalView = $('#myModalAdd');
    if (name != '') {
        $('.se-pre-con').removeClass('hidden');
        $.post(
            Routing.generate('menu_ajax_add'),
            {
                menuName: name
            },
            function (data, text, response) {
                if (response.status == 200) {

                    $('.se-pre-con').addClass('hidden');
                    $modalView.modal('hide');
                    location.reload();


                }
            },
            "json"
        ).fail(function () {
                $menuObject.insertError();
            });
    }
    else {

        $menuObject.insertError();
    }
};


$menuObject.editMenu = function (object) {
    var name = $('#menuText').val();
    var id = $(object).data('id');
    if (name != null) {
        $('.se-pre-con').removeClass('hidden');
        $.post(
            Routing.generate('menu_ajax_edit'),
            {
                menuName: name,
                id: id
            },
            function (data, text, response) {
                if (response.status == 206) {
                    $('.se-pre-con').addClass('hidden');

                    $('#myModalAdd').modal('hide');
                    location.reload();
                }
                if (response.status == 200) {
                    $('.se-pre-con').addClass('hidden');

                    $('#myModalAdd').modal('hide');
                    location.reload();
                }

            },
            "json"
        ).fail(function () {
                $menuObject.insertError();
            });
    }
};

$menuObject.deleteMenu = function (object) {
    var id = $(object).data('id');
    $.delete(
        Routing.generate('menu_ajax_delete'),
        {
            id: id
        },
        function (data, text, response) {
            if (response.status == 204) {

                $('#myModalAdd').modal('hide');
                location.reload();
            }
        },
        "json"
    ).fail(function () {
            $menuObject.insertError();
        });
}

$menuObject.insertError = function () {
    var $modalView = $('#myModalAdd');
    $modalView.find('.alert.alert-danger').remove();
    var $error = $('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"></button>Por favor, verifique sus datos.<strong class="icon-remove close"></strong> </div>');
    $modalView.find('.modal-body').append($error);
    $modalView.find('.close').click(function () {
        $(this).closest('.alert.alert-danger').remove();
    });

}


/*ANGULAR BINDINGS*/
var $menuApp = angular.module('MenuApp', []);
//Launching Modal

$menuApp.controller('modalController', function ($scope) {
    $scope.launchCustom = function () {

        $('#myModalAdd').modal('show');
    }
});
