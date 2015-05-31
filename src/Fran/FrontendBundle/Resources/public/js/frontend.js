/**
 * Created by aioria on 30/05/2015.
 */
'use strict';
var sliderApp = angular.module('sliderApp',['angular-carousel']);

sliderApp.controller('screenController',function($scope,$http){


    $scope.prefix = 'nana';
    $http.get(Routing.generate('frontend_mappings')).success(function(data){
        $scope.prefix = data.imageFile.uri_prefix;

    });

    var ofertas = [];

    $http.get(Routing.generate('frontend_ofertas')).success(function(data){
        ofertas = data;
        console.log(ofertas);
        $scope.slides = ofertas;

    });

    $scope.colors = ["#fc0003", "#f70008", "#f2000d", "#ed0012", "#e80017", "#e3001c", "#de0021", "#d90026", "#d4002b", "#cf0030", "#c90036", "#c4003b", "#bf0040", "#ba0045", "#b5004a", "#b0004f", "#ab0054", "#a60059", "#a1005e", "#9c0063", "#960069", "#91006e", "#8c0073", "#870078", "#82007d", "#7d0082", "#780087", "#73008c", "#6e0091", "#690096", "#63009c", "#5e00a1", "#5900a6", "#5400ab", "#4f00b0", "#4a00b5", "#4500ba", "#4000bf", "#3b00c4", "#3600c9", "#3000cf", "#2b00d4", "#2600d9", "#2100de", "#1c00e3", "#1700e8", "#1200ed", "#0d00f2", "#0800f7", "#0300fc"];


    $scope.carouselIndex2 = 0;
    $scope.carouselIndex22 = 1;



});
