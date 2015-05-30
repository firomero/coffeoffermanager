/**
 * Created by aioria on 26/05/2015.
 */

'use strict';
var $interact = angular.module('interactApp',[]);

$interact.controller('interactController',function($scope,$http){

            var url = Routing.generate('oferta_disponibles');
            $http.get(url).success(function(data){
                $scope.ofertas = data;
            });

            $scope.prefix = 'nana';
            $http.get(Routing.generate('oferta_mappings')).success(function(data){
                $scope.prefix = data.imageFile.uri_prefix;

            });

            $scope.asignar=function(object){

                console.log(object);
                $.post(Routing.generate('menu_ajax_asignar'),{'menu':$('.fmenu').html(),'oferta':$('#'+object).val()},function(data){console.log(data)},"json");


            };







});
