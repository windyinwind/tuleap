<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload3fa334d270ddce0c65041726c0e9b639($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'rest_exception_invalidtokenexception' => '/Exceptions/InvalidTokenException.class.php',
            'rest_token' => '/Token.class.php',
            'rest_tokendao' => '/TokenDao.class.php',
            'rest_tokenfactory' => '/TokenFactory.class.php',
            'rest_tokenmanager' => '/TokenManager.class.php',
            'tuleap\\rest\\basicauthentication' => '/BasicAuthentication.class.php',
            'tuleap\\rest\\resourcesinjector' => '/ResourcesInjector.class.php',
            'tuleap\\rest\\tokenauthentication' => '/TokenAuthentication.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload3fa334d270ddce0c65041726c0e9b639');
// @codeCoverageIgnoreEnd