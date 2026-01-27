<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1769431758,
	'meta' => array (
  'cacheVersion' => 'v12-linesToIgnore',
  'phpstanVersion' => '2.1.36',
  'fnsr' => false,
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80416,
  'projectConfig' => '{parameters: {level: 5, paths: [C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app, C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public], excludePaths: {analyseAndScan: [vendor], analyse: []}, tmpDir: C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\tmp}}',
  'analysedPaths' => 
  array (
    0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app',
    1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public',
  ),
  'scannedFiles' => 
  array (
  ),
  'composerLocks' => 
  array (
    'C:/wamp64/www/CERTIFICADO_DIGITAL/composer.lock' => '5e44bee57102e915a67a28ea7ee779db11034a31b92fd2bdcd805d110aee86d3',
  ),
  'composerInstalled' => 
  array (
    'C:/wamp64/www/CERTIFICADO_DIGITAL/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'phpstan/phpstan' => 
        array (
          'pretty_version' => '2.1.36',
          'version' => '2.1.36.0',
          'reference' => '2132e5e2361d11d40af4c17faa16f043269a4cf3',
          'type' => 'library',
          'install_path' => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\composer/../phpstan/phpstan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'tecnickcom/tcpdf' => 
        array (
          'pretty_version' => '6.10.1',
          'version' => '6.10.1.0',
          'reference' => '7a2701251e5d52fc3d508fd71704683eb54f5939',
          'type' => 'library',
          'install_path' => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\composer/../tecnickcom/tcpdf',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
      ),
    ),
  ),
  'executedFilesHashes' => 
  array (
    'phar://C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\Attribute85.php' => 'cb8b31e82c61ce197871c9e8a6f122256751f2ab606dd2be90846d4fa5f8933e',
    'phar://C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionAttribute.php' => 'b2bdc83dac3ac930a2b5387546b2da05f7f5135340549604e06d3d0fd4bc4205',
    'phar://C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionIntersectionType.php' => '65fe0a8bc6fe285d8ddc8798ab5b9299920af70db5ad74596bc08df823e7c5d9',
    'phar://C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionUnionType.php' => '1e2fe940e4ba4e00d9ee6adb2af3ee1bf333e6f8afe61c61deb038886d293427',
  ),
  'phpExtensions' => 
  array (
    0 => 'Core',
    1 => 'PDO',
    2 => 'Phar',
    3 => 'Reflection',
    4 => 'SPL',
    5 => 'SimpleXML',
    6 => 'Zend OPcache',
    7 => 'bcmath',
    8 => 'calendar',
    9 => 'com_dotnet',
    10 => 'ctype',
    11 => 'curl',
    12 => 'date',
    13 => 'dom',
    14 => 'exif',
    15 => 'fileinfo',
    16 => 'filter',
    17 => 'gd',
    18 => 'gettext',
    19 => 'gmp',
    20 => 'hash',
    21 => 'iconv',
    22 => 'intl',
    23 => 'json',
    24 => 'ldap',
    25 => 'libxml',
    26 => 'mbstring',
    27 => 'mysqli',
    28 => 'mysqlnd',
    29 => 'openssl',
    30 => 'pcre',
    31 => 'pdo_mysql',
    32 => 'pdo_sqlite',
    33 => 'random',
    34 => 'readline',
    35 => 'session',
    36 => 'soap',
    37 => 'sockets',
    38 => 'sodium',
    39 => 'sqlite3',
    40 => 'standard',
    41 => 'tokenizer',
    42 => 'xml',
    43 => 'xmlreader',
    44 => 'xmlwriter',
    45 => 'xsl',
    46 => 'zip',
    47 => 'zlib',
  ),
  'stubFiles' => 
  array (
  ),
  'level' => '5',
),
	'projectExtensionFiles' => array (
),
	'errorsCallback' => static function (): array { return array (
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Strict comparison using === between \'development\' and \'development\' will always evaluate to true.',
       'file' => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php',
       'line' => 21,
       'canBeIgnored' => true,
       'filePath' => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 21,
       'nodeType' => 'PhpParser\\Node\\Expr\\BinaryOp\\Identical',
       'identifier' => 'identical.alwaysTrue',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
); },
	'linesToIgnore' => array (
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
  array (
    'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
    array (
      21 => NULL,
    ),
  ),
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Config\\App',
        1 => 'isDebug',
        2 => 'App\\Config\\App',
      ),
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Core\\View.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'extract',
        1 => 20,
      ),
      1 => 
      array (
        0 => 'http_response_code',
        1 => 49,
      ),
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'session_start',
        1 => 16,
      ),
      1 => 
      array (
        0 => 'session_start',
        1 => 72,
      ),
      2 => 
      array (
        0 => 'session_start',
        1 => 121,
      ),
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\DTO\\UserDto.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Modules\\Auth\\DTO\\UserDto',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\PdfService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'setCreator',
        2 => 17,
      ),
      1 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'setAuthor',
        2 => 18,
      ),
      2 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'setTitle',
        2 => 19,
      ),
      3 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'setPrintHeader',
        2 => 22,
      ),
      4 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'setPrintFooter',
        2 => 23,
      ),
      5 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'AddPage',
        2 => 26,
      ),
      6 => 
      array (
        0 => 
        array (
          0 => 'TCPDF',
        ),
        1 => 'writeHTML',
        2 => 45,
      ),
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'session_start',
        1 => 15,
      ),
      1 => 
      array (
        0 => 'session_start',
        1 => 40,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'App\\Modules\\Documents\\DocumentService',
        ),
        1 => 'saveSignedDocument',
        2 => 63,
      ),
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'ini_set',
        1 => 12,
      ),
      1 => 
      array (
        0 => 'ini_set',
        1 => 13,
      ),
      2 => 
      array (
        0 => 'ini_set',
        1 => 17,
      ),
      3 => 
      array (
        0 => 'ini_set',
        1 => 18,
      ),
      4 => 
      array (
        0 => 'error_reporting',
        1 => 19,
      ),
      5 => 
      array (
        0 => 'ini_set',
        1 => 21,
      ),
      6 => 
      array (
        0 => 'error_reporting',
        1 => 22,
      ),
      7 => 
      array (
        0 => 'http_response_code',
        1 => 84,
      ),
      8 => 
      array (
        0 => 'http_response_code',
        1 => 92,
      ),
    ),
  ),
); },
	'dependencies' => array (
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
  array (
    'fileHash' => '1c0bd7dc299cd5cfa4a8737bceab32ddbcc07ee4464275acaadf7fa5e8d2d09c',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Core\\View.php',
      1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\AutoFirmaService.php',
      2 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\Database.php' => 
  array (
    'fileHash' => '428b241bb145270976faf237134c2bf9e6642ceecc5b91c0a72da1171fd116f4',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthService.php',
      1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentService.php',
      2 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentsController.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Core\\View.php' => 
  array (
    'fileHash' => '53b16b37e11de0fd1ac75d7a253f7dc6d71f0280ba97f0259a09eae29c5bf4cd',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php',
      1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentsController.php',
      2 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php',
      3 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php' => 
  array (
    'fileHash' => 'a72fbbf07bbe6c0456a430b5e7b22700476b1d71e86412254b37af70a98c30a9',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthService.php' => 
  array (
    'fileHash' => '2da36fbcba59da325740e8d7ba93138e9d8f33ac6d6f96cc8d0c8edabe546656',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\DTO\\UserDto.php' => 
  array (
    'fileHash' => '973b00b7a2b50e59f785b82fe2c5ee0750e6af781ffc59e0dbe4a1169b638249',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php',
      1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthService.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\Views\\dashboard.php' => 
  array (
    'fileHash' => '071d8e607621f060f4489380e07dbbebeb7b4c90e6724a21b5f24ac84d4df5d0',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\Views\\error.php' => 
  array (
    'fileHash' => 'accbefca2b7ee1c0249d077a7646b960df218c8b4ce689482e4551b1c9714aea',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\Views\\login.php' => 
  array (
    'fileHash' => '188096af32213acc9c6307819c13005ce953a92b27a602fffbae57bca327d49b',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentService.php' => 
  array (
    'fileHash' => 'cd65d369ddee797d0be253fde1b5a7a985970dd4bf0b2fa1c2e96caa02921eee',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentsController.php' => 
  array (
    'fileHash' => '87bdbb715d898610d53255c510b91e25ab6d0cc4cf6eab1a044e22a9d371ab8b',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\PdfService.php' => 
  array (
    'fileHash' => '3315068e07a493ff44e5328530335c862d8c73a03a37a34d411458598bf3a57c',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentsController.php',
      1 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\Views\\verify.php' => 
  array (
    'fileHash' => '908f975bd3644c3ec230b473071cd792b000f0452e4b0d60da8cbde04de31fc2',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\AutoFirmaService.php' => 
  array (
    'fileHash' => '72623681586513bc14acd3ae9d6b432588a75fd0e221aa341c457d7149c89065',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php' => 
  array (
    'fileHash' => '7abf3d4ce3fd12b44a1190e43ece21b81e08b61bdfe4a3c01c2d4fa8359a867d',
    'dependentFiles' => 
    array (
      0 => 'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php',
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\Views\\test.php' => 
  array (
    'fileHash' => '09c9497773f5f1265c1ad1a736637ec082fea9569dfe276af8f715c9e3ca147f',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\public\\index.php' => 
  array (
    'fileHash' => 'd4d89db92cf82e63f124c62a96f9bf932d9cb754b1044a0e70831a310ddce20c',
    'dependentFiles' => 
    array (
    ),
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\App.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Config\\App',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'APP_NAME',
               'value' => '\'Certificado Digital POC\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'APP_URL',
               'value' => '\'https://certificado.local\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'ENV',
               'value' => '\'development\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'ROOT_DIR',
               'value' => '__DIR__ . \'/../../\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'VIEW_DIR',
               'value' => 'self::ROOT_DIR . \'app/templates/\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'LOG_DIR',
               'value' => 'self::ROOT_DIR . \'logs/\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isDebug',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Config\\Database.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Config\\Database',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getConnection',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'PDO',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Core\\View.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Core\\View',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Renderiza una vista/plantilla.
     * 
     * @param string $viewPath Ruta relativa desde app/templates/ o app/Modules/
     * @param array $data Datos a pasar a la vista
     */',
             'namespace' => 'App\\Core',
             'uses' => 
            array (
              'app' => 'App\\Config\\App',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'viewPath',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'json',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Auth\\AuthController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'loginWithCertificate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'dashboard',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\AuthService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Auth\\AuthService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'findOrCreateUser',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Busca un usuario por su número de serie de certificado.
     * Si no existe, lo crea.
     */',
             'namespace' => 'App\\Modules\\Auth',
             'uses' => 
            array (
              'database' => 'App\\Config\\Database',
              'userdto' => 'App\\Modules\\Auth\\DTO\\UserDto',
              'pdo' => 'PDO',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Modules\\Auth\\DTO\\UserDto',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'serialNumber',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'commonName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'dniNie',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Auth\\DTO\\UserDto.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Auth\\DTO\\UserDto',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'serialNumber',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'dniNie',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'nombreCompleto',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'email',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromArray',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Documents\\DocumentService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saveSignedDocument',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Guarda un documento firmado en la base de datos.
     */',
             'namespace' => 'App\\Modules\\Documents',
             'uses' => 
            array (
              'database' => 'App\\Config\\Database',
              'pdo' => 'PDO',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'usuarioId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tipoTramite',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'contenidoXml',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'firmaB64',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'csv',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\DocumentsController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Documents\\DocumentsController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'verify',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Página de verificación de CSV.
     */',
             'namespace' => 'App\\Modules\\Documents',
             'uses' => 
            array (
              'view' => 'App\\Core\\View',
              'database' => 'App\\Config\\Database',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'downloadOriginal',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Descargar el PDF original desde la verificación.
     */',
             'namespace' => 'App\\Modules\\Documents',
             'uses' => 
            array (
              'view' => 'App\\Core\\View',
              'database' => 'App\\Config\\Database',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Documents\\PdfService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Documents\\PdfService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateReceipt',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'content',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'signature',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'csv',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\AutoFirmaService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Signature\\AutoFirmaService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'prepareDocument',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Prepara el documento para ser firmado.
     * En este POC, convertimos un texto simple a Base64.
     * En real, esto generaría el hash o el XML completo.
     */',
             'namespace' => 'App\\Modules\\Signature',
             'uses' => 
            array (
              'app' => 'App\\Config\\App',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'content',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'validateSignature',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Valida una firma electrónica (PKCS#7 / CAdES).
     * @param string $signatureB64 Firma en Base64 devuelta por AutoFirma.
     * @param string $originalData Datos originales que fueron firmados.
     * @return bool
     */',
             'namespace' => 'App\\Modules\\Signature',
             'uses' => 
            array (
              'app' => 'App\\Config\\App',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'signatureB64',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'originalData',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateCSV',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Genera un identificador único (CSV - Código Seguro de Verificación)
     */',
             'namespace' => 'App\\Modules\\Signature',
             'uses' => 
            array (
              'app' => 'App\\Config\\App',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\wamp64\\www\\CERTIFICADO_DIGITAL\\app\\Modules\\Signature\\SignatureController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Modules\\Signature\\SignatureController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'process',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
