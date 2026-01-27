<?php declare(strict_types = 1);

// odsl-C:\wamp64\www\CERTIFICADO DIGITAL\app\Modules\Signature\AutoFirmaService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Signature\AutoFirmaService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.4-c183cde1582fd8e9906583b53f89955e128eb1d3a5a217fcc72e0eced94f7a1b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Signature\\AutoFirmaService',
        'filename' => 'C:/wamp64/www/CERTIFICADO DIGITAL/app/Modules/Signature/AutoFirmaService.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Signature',
    'name' => 'App\\Modules\\Signature\\AutoFirmaService',
    'shortName' => 'AutoFirmaService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 43,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'prepareDocument' => 
      array (
        'name' => 'prepareDocument',
        'parameters' => 
        array (
          'content' => 
          array (
            'name' => 'content',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 16,
            'endLine' => 16,
            'startColumn' => 37,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Prepara el documento para ser firmado.
 * En este POC, convertimos un texto simple a Base64.
 * En real, esto generaría el hash o el XML completo.
 */',
        'startLine' => 16,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Signature',
        'declaringClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'implementingClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'currentClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'aliasName' => NULL,
      ),
      'validateSignature' => 
      array (
        'name' => 'validateSignature',
        'parameters' => 
        array (
          'signatureB64' => 
          array (
            'name' => 'signatureB64',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 26,
            'endLine' => 26,
            'startColumn' => 39,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'originalData' => 
          array (
            'name' => 'originalData',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 26,
            'endLine' => 26,
            'startColumn' => 61,
            'endColumn' => 80,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Valida una firma electrónica (Simulación/Placeholder).
 * En producción: Usar openssl_pkcs7_verify o llamar a un servicio de validación (Valide, @firma).
 */',
        'startLine' => 26,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Signature',
        'declaringClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'implementingClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'currentClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'aliasName' => NULL,
      ),
      'generateCSV' => 
      array (
        'name' => 'generateCSV',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Genera un identificador único (CSV - Código Seguro de Verificación)
 */',
        'startLine' => 39,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Signature',
        'declaringClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'implementingClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'currentClassName' => 'App\\Modules\\Signature\\AutoFirmaService',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));