  'use strict';
let ajudeVovo = angular.module(
  'ajudeVovo',
  [
    'ngRoute',
    'ui.materialize'
  ]
);

ajudeVovo.config(['$routeProvider',
    function (
        $routeProvider
    ) {
          $routeProvider.
              when('/Home', {
                  templateUrl: '../Home',
                  controller: 'controllerHome'
              }).
              when('/Servico', {
                  templateUrl: '../Servico',
                  controller: 'controllerServico'
              }).
               otherwise({
                  redirectTo: '/Servico'
              });
}]);