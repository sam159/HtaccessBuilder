HtaccessBuilder
===============
No database required, PHP >= 5.3.

The base href in the config may need altering if you are installing to a subdirectory.

Docker Support
===============

Support is included via the included Dockerfile. The service is exposed on port 80.

The following mounts are available

- /srv/app/Saved - Saved rules
- /srv/app/src/config.local.php - Additional config
- /srv/app/src/html/head-custom.php - Inject html into &lt;head&gt;
- /srv/app/srv/html/bottom-custom.php - Inject html into footer

Environmental Variables
-----------------------

- HTACCESS_DEBUG=true - enable debug mode
- HTACCESS_BASE_PATH=http://example.com/ - Set the base path (include trailing slash)