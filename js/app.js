"use strict"

angular.module('moduloServices', ['ngResource']);
angular.module('moduloControllers', ['ngResource', 'ui.bootstrap', 'moduloServices']);
angular.module('riassuntoControllers', ['ngResource', 'ui.bootstrap', 'ngGrid', 'moduloServices']);
angular.module('lendinara', ['moduloControllers']);
angular.module('tesserati', ['riassuntoControllers']);
