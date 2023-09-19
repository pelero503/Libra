#ifndef PHP_EXTNAME_H
#define PHP_EXTNAME_H

#define PHP_EXTNAME_VERSION	"1.0"

extern zend_module_entry extname_module_entry;
#define phpext_extname_ptr &extname_module_entry

#ifdef PHP_WIN32
#	define PHP_EXTNAME_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_EXTNAME_API __attribute__ ((visibility("default")))
#else
#	define PHP_EXTNAME_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINIT_FUNCTION(extname);
PHP_MSHUTDOWN_FUNCTION(extname);
PHP_RINIT_FUNCTION(extname);
PHP_RSHUTDOWN_FUNCTION(extname);


#ifdef ZTS
#define EXTNAME_G(v) TSRMG(extname_globals_id, zend_extname_globals *, v)
#else
#define EXTNAME_G(v) (extname_globals.v)
#endif

#endif	/* PHP_EXTNAME_H */
