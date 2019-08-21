<?php

return array (
  0 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:9:"api/users";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:10:"/api/users";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";N;s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:4:{s:4:"POST";s:19:"App\\Api\\Users\\_POST";s:3:"GET";s:18:"App\\Api\\Users\\_GET";s:7:"OPTIONS";s:41:"Chevere\\Controllers\\Api\\OptionsController";s:4:"HEAD";s:38:"Chevere\\Controllers\\Api\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";N;s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:10:"/api/users";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";N;s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:6:{s:4:"file";s:35:"Chevereto-Chevere/src/Api/Maker.php";s:4:"line";i:91;s:8:"function";s:16:"processRoutesMap";s:5:"class";s:17:"Chevere\\Api\\Maker";s:4:"type";s:2:"->";s:4:"args";a:0:{}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:12:"^/api/users$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  1 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:16:"api/users/{user}";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:17:"/api/users/{user}";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:1:{s:4:"user";s:6:"[a-z]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:5:{s:6:"DELETE";s:20:"App\\Api\\Users\\DELETE";s:5:"PATCH";s:19:"App\\Api\\Users\\PATCH";s:3:"GET";s:17:"App\\Api\\Users\\GET";s:7:"OPTIONS";s:41:"Chevere\\Controllers\\Api\\OptionsController";s:4:"HEAD";s:38:"Chevere\\Controllers\\Api\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:1:{i:0;s:4:"user";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:14:"/api/users/{0}";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:0:{}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:6:{s:4:"file";s:35:"Chevereto-Chevere/src/Api/Maker.php";s:4:"line";i:91;s:8:"function";s:16:"processRoutesMap";s:5:"class";s:17:"Chevere\\Api\\Maker";s:4:"type";s:2:"->";s:4:"args";a:0:{}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:21:"^/api/users/([a-z]+)$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  2 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:24:"api/users/{user}/friends";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:25:"/api/users/{user}/friends";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:1:{s:4:"user";s:6:"[a-z]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:3:{s:3:"GET";s:26:"App\\Api\\Users\\Friends\\_GET";s:7:"OPTIONS";s:41:"Chevere\\Controllers\\Api\\OptionsController";s:4:"HEAD";s:38:"Chevere\\Controllers\\Api\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:1:{i:0;s:4:"user";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:22:"/api/users/{0}/friends";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:0:{}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:6:{s:4:"file";s:35:"Chevereto-Chevere/src/Api/Maker.php";s:4:"line";i:91;s:8:"function";s:16:"processRoutesMap";s:5:"class";s:17:"Chevere\\Api\\Maker";s:4:"type";s:2:"->";s:4:"args";a:0:{}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:29:"^/api/users/([a-z]+)/friends$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  3 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:38:"api/users/{user}/relationships/friends";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:39:"/api/users/{user}/relationships/friends";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:1:{s:4:"user";s:15:"[A-z0-9\\_\\-\\%]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:3:{s:3:"GET";s:34:"App\\Api\\Users\\Friends\\Relationship";s:7:"OPTIONS";s:41:"Chevere\\Controllers\\Api\\OptionsController";s:4:"HEAD";s:38:"Chevere\\Controllers\\Api\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:1:{i:0;s:4:"user";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:36:"/api/users/{0}/relationships/friends";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:0:{}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:6:{s:4:"file";s:35:"Chevereto-Chevere/src/Api/Maker.php";s:4:"line";i:91;s:8:"function";s:16:"processRoutesMap";s:5:"class";s:17:"Chevere\\Api\\Maker";s:4:"type";s:2:"->";s:4:"args";a:0:{}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:52:"^/api/users/([A-z0-9\\_\\-\\%]+)/relationships/friends$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  4 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:3:"api";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:4:"/api";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";N;s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:3:{s:4:"HEAD";s:38:"Chevere\\Controllers\\Api\\HeadController";s:7:"OPTIONS";s:41:"Chevere\\Controllers\\Api\\OptionsController";s:3:"GET";s:37:"Chevere\\Controllers\\Api\\GetController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";N;s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:4:"/api";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";N;s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:6:{s:4:"file";s:36:"Chevereto-Chevere/src/App/Loader.php";s:4:"line";i:282;s:8:"function";s:8:"register";s:5:"class";s:17:"Chevere\\Api\\Maker";s:4:"type";s:2:"->";s:4:"args";a:2:{i:0;O:23:"Chevere\\Path\\PathHandle":5:{s:35:"' . "\0" . 'Chevere\\Path\\PathHandle' . "\0" . 'identifier";s:8:"src/Api/";s:32:"' . "\0" . 'Chevere\\Path\\PathHandle' . "\0" . 'context";s:30:"/home/rodolfo/git/chevere/app/";s:29:"' . "\0" . 'Chevere\\Path\\PathHandle' . "\0" . 'path";s:38:"/home/rodolfo/git/chevere/app/src/Api/";s:33:"' . "\0" . 'Chevere\\Path\\PathHandle' . "\0" . 'filename";N;s:32:"' . "\0" . 'Chevere\\Path\\PathHandle' . "\0" . 'explode";N;}i:1;O:20:"Chevere\\Api\\Endpoint":2:{s:27:"' . "\0" . 'Chevere\\Api\\Endpoint' . "\0" . 'array";a:1:{s:7:"OPTIONS";a:3:{s:4:"HEAD";a:2:{s:11:"description";s:25:"GET without message-body.";s:10:"parameters";a:0:{}}s:7:"OPTIONS";a:2:{s:11:"description";s:26:"Retrieve endpoint OPTIONS.";s:10:"parameters";a:0:{}}s:3:"GET";a:2:{s:11:"description";s:18:"Retrieve endpoint.";s:10:"parameters";a:0:{}}}}s:29:"' . "\0" . 'Chevere\\Api\\Endpoint' . "\0" . 'methods";O:30:"Chevere\\HttpFoundation\\Methods":2:{s:39:"' . "\0" . 'Chevere\\HttpFoundation\\Methods' . "\0" . 'methods";a:3:{i:0;O:29:"Chevere\\HttpFoundation\\Method":2:{s:37:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'method";s:4:"HEAD";s:41:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'controller";s:38:"Chevere\\Controllers\\Api\\HeadController";}i:1;O:29:"Chevere\\HttpFoundation\\Method":2:{s:37:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'method";s:7:"OPTIONS";s:41:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'controller";s:41:"Chevere\\Controllers\\Api\\OptionsController";}i:2;O:29:"Chevere\\HttpFoundation\\Method":2:{s:37:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'method";s:3:"GET";s:41:"' . "\0" . 'Chevere\\HttpFoundation\\Method' . "\0" . 'controller";s:37:"Chevere\\Controllers\\Api\\GetController";}}s:37:"' . "\0" . 'Chevere\\HttpFoundation\\Methods' . "\0" . 'index";a:3:{s:4:"HEAD";i:0;s:7:"OPTIONS";i:1;s:3:"GET";i:2;}}}}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:6:"^/api$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  5 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:1:"0";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:18:"/dashboard/{algo?}";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:1:{s:4:"algo";s:15:"[A-z0-9\\_\\-\\%]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:2:{s:3:"GET";s:25:"App\\Controllers\\Dashboard";s:4:"HEAD";s:34:"Chevere\\Controllers\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:1:{i:0;s:4:"algo";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:14:"/dashboard/{0}";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:2:{s:10:"/dashboard";a:0:{}s:14:"/dashboard/{0}";a:1:{i:0;i:0;}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:4:{s:4:"file";s:47:"Chevereto-Chevere/src/FileReturn/FileReturn.php";s:4:"line";i:100;s:4:"args";a:1:{i:0;s:50:"/home/rodolfo/git/chevere/app/routes/dashboard.php";}s:8:"function";s:7:"include";}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:30:"^/dashboard/([A-z0-9\\_\\-\\%]+)$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  6 => 
  array (
    0 => 5,
    1 => '/dashboard',
  ),
  7 => 
  array (
    0 => 5,
    1 => '/dashboard/{0}',
  ),
  8 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:1:"1";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:23:"/dashboard/{algo}/{sub}";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";N;s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:2:{s:4:"algo";s:15:"[A-z0-9\\_\\-\\%]+";s:3:"sub";s:15:"[A-z0-9\\_\\-\\%]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:2:{s:3:"GET";s:25:"App\\Controllers\\Dashboard";s:4:"HEAD";s:34:"Chevere\\Controllers\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:2:{i:0;s:4:"algo";i:1;s:3:"sub";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:18:"/dashboard/{0}/{1}";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:0:{}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:4:{s:4:"file";s:47:"Chevereto-Chevere/src/FileReturn/FileReturn.php";s:4:"line";i:100;s:4:"args";a:1:{i:0;s:50:"/home/rodolfo/git/chevere/app/routes/dashboard.php";}s:8:"function";s:7:"include";}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:48:"^/dashboard/([A-z0-9\\_\\-\\%]+)/([A-z0-9\\_\\-\\%]+)$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  9 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:5:"index";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:1:"/";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";s:8:"homepage";s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";N;s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:2:{s:3:"GET";s:21:"App\\Controllers\\Index";s:4:"HEAD";s:34:"Chevere\\Controllers\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";a:2:{i:0;s:21:"middleware:RoleBanned";i:1;s:20:"middleware:RoleAdmin";}s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";N;s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:1:"/";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";N;s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:4:{s:4:"file";s:47:"Chevereto-Chevere/src/FileReturn/FileReturn.php";s:4:"line";i:100;s:4:"args";a:1:{i:0;s:44:"/home/rodolfo/git/chevere/app/routes/web.php";}s:8:"function";s:7:"include";}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:3:"^/$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  10 => 'O:19:"Chevere\\Route\\Route":12:{s:23:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'id";s:1:"0";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'path";s:30:"/cache/{llave?}-{cert}-{user?}";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'name";s:5:"cache";s:27:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wheres";a:3:{s:5:"llave";s:6:"[0-9]+";s:4:"cert";s:15:"[A-z0-9\\_\\-\\%]+";s:4:"user";s:15:"[A-z0-9\\_\\-\\%]+";}s:28:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'methods";a:3:{s:3:"GET";s:21:"App\\Controllers\\Cache";s:4:"POST";s:21:"App\\Controllers\\Cache";s:4:"HEAD";s:34:"Chevere\\Controllers\\HeadController";}s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'middlewares";N;s:30:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'wildcards";a:3:{i:0;s:5:"llave";i:1;s:4:"cert";i:2;s:4:"user";}s:24:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'key";s:18:"/cache/{0}-{1}-{2}";s:32:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'keyPowerSet";a:4:{s:12:"/cache/-{1}-";a:1:{i:0;i:1;}s:15:"/cache/{0}-{1}-";a:2:{i:0;i:0;i:1;i:1;}s:15:"/cache/-{1}-{2}";a:2:{i:0;i:1;i:1;i:2;}s:18:"/cache/{0}-{1}-{2}";a:3:{i:0;i:0;i:1;i:1;i:2;i:2;}}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'maker";a:4:{s:4:"file";s:47:"Chevereto-Chevere/src/FileReturn/FileReturn.php";s:4:"line";i:100;s:4:"args";a:1:{i:0;s:44:"/home/rodolfo/git/chevere/app/routes/web.php";}s:8:"function";s:7:"include";}s:26:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'regex";s:53:"^/cache/([0-9]+)-([A-z0-9\\_\\-\\%]+)-([A-z0-9\\_\\-\\%]+)$";s:25:"' . "\0" . 'Chevere\\Route\\Route' . "\0" . 'type";s:7:"dynamic";}',
  11 => 
  array (
    0 => 10,
    1 => '/cache/-{1}-',
  ),
  12 => 
  array (
    0 => 10,
    1 => '/cache/{0}-{1}-',
  ),
  13 => 
  array (
    0 => 10,
    1 => '/cache/-{1}-{2}',
  ),
  14 => 
  array (
    0 => 10,
    1 => '/cache/{0}-{1}-{2}',
  ),
);