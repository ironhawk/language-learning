@ECHO OFF

echo ----------------------------------------------------------------------

echo Publish Language-Learning to Apache
echo csak a valtozasok masolasa...

echo ----------------------------------------------------------------------
xcopy d:\php_projects\language-learning\laravel-app\* d:\apache\htdocs\language-learning\laravel-app /E /F /H /R /K /Y /D /EXCLUDE:d:\php_projects\language-learning\publish_exclude.txt
echo ----------------------------------------------------------------------

pause