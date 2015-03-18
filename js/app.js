"use strict"

angular.module('moduloServices', ['ngResource']);
angular.module('moduloControllers', ['ngResource', 'ui.bootstrap', 'moduloServices']);
angular.module('lendinara', ['moduloControllers']);