#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "extname.h"

const zend_function_entry extname_functions[] = {
	/* function entries here */
	PHP_FE_END	/* Must be the last line in extname_functions[] */
};

zend_module_entry extname_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
	STANDARD_MODULE_HEADER,
#endif
	"extname",
	extname_functions,
	PHP_MINIT(extname),
	PHP_MSHUTDOWN(extname),
	PHP_RINIT(extname),
	PHP_RSHUTDOWN(extname),
	NULL,
#if ZEND_MODULE_API_NO >= 20010901
	PHP_EXTNAME_VERSION,
#endif
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_EXTNAME
ZEND_GET_MODULE(extname)
#endif


PHP_MINIT_FUNCTION(extname)
{
	/* If you have INI entries, uncomment these lines 
	REGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}

PHP_MSHUTDOWN_FUNCTION(extname)
{
	/* uncomment this line if you have INI entries
	UNREGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}

PHP_RINIT_FUNCTION(extname)
{
	return SUCCESS;
}

PHP_RSHUTDOWN_FUNCTION(extname)
{
	return SUCCESS;
}

