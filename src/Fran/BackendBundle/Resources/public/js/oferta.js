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
var $ofertaObject = {};
$(function () {
    $(document).ready(function () {


        var oTable = $('#tabla').DataTable(
            {
                "oLanguage": $language,

                "aLength": [5, 10, 15],
                aoColumns: [
                    null,
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false}


                ]
            }
        );

        $ofertaObject.table = oTable;

        //$('#ofertaImagen').uploadFile({
        //    url:Routing.generate('ajax_oferta_add'),
        //    fileName: "myFileName"
        //
        //});

    });

    ////ADD oferta
    $('.btn.btn-primary.acept').click(function () {
        $('.se-pre-con').removeClass('hidden');
        $('form').submit();
    });


    //DELETE
    $('.btn.btn-mini.delete').click(function(){
        var object = $(this);
        var $deleteModal = $('#myModalDelete');
        $deleteModal.find('.delete').click(function(){
            $ofertaObject.deleteoferta(object);
        });

        $deleteModal.modal('show');
    });


})

/*CUSTOM EVENTS*/
$ofertaObject.addoferta = function () {
    var name = $('#ofertaName').val();
    var text = $('#ofertaText').val();
    var imagefile = $('#ofertaImagen').get(0).files;
    var price = $('#ofertaPrecio').val();

    var $modalView = $('#myModalAdd');
    if (name != '') {
        $('.se-pre-con').removeClass('hidden');
        $.post(
            Routing.generate('oferta_ajax_add'),
            {
                ofertaName: name,
                ofertaText: text,
                ofertaImagen: imagefile,
                ofertaPrecio: price
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
                $ofertaObject.insertError();
            });
    }
    else {

        $ofertaObject.insertError();
    }
};


$ofertaObject.editoferta = function (object) {
    var name = $('#ofertaText').val();
    var id = $(object).data('id');
    if (name != null) {
        $('.se-pre-con').removeClass('hidden');
        $.post(
            Routing.generate('oferta_ajax_edit'),
            {
                ofertaName: name,
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
                $ofertaObject.insertError();
            });
    }
};

$ofertaObject.deleteoferta = function (object) {
    var id = $(object).data('id');
    $('.se-pre-con').removeClass('hidden');
    $.post(
        Routing.generate('oferta_ajax_delete'),
        {
            id: id
        },
        function (data, text, response) {
            if (response.status == 204) {

                $('.se-pre-con').addClass('hidden');
                $('#myModalDelete').modal('hide');
                location.reload();
            }
        },
        "json"
    ).fail(function () {
            $ofertaObject.insertError();
        });
}

$ofertaObject.insertError = function () {
    var $modalView = $('#myModalAdd');
    $modalView.find('.alert.alert-danger').remove();
    var $error = $('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"></button>Por favor, verifique sus datos.<strong class="icon-remove close"></strong> </div>');
    $modalView.find('.modal-body').append($error);
    $modalView.find('.close').click(function () {
        $(this).closest('.alert.alert-danger').remove();
    });

}


/*ANGULAR BINDINGS*/
var $ofertaApp = angular.module('ofertaApp', []);
//Launching Modal

$ofertaApp.controller('modalController', function ($scope) {
    $scope.launchCustom = function () {

        $('#myModalAdd').modal('show');
    }
});
