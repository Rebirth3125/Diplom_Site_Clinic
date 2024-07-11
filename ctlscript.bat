@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist C:\xamppp\hypersonic\scripts\ctl.bat (start /MIN /B C:\xamppp\server\hsql-sample-database\scripts\ctl.bat START)
if exist C:\xamppp\ingres\scripts\ctl.bat (start /MIN /B C:\xamppp\ingres\scripts\ctl.bat START)
if exist C:\xamppp\mysql\scripts\ctl.bat (start /MIN /B C:\xamppp\mysql\scripts\ctl.bat START)
if exist C:\xamppp\postgresql\scripts\ctl.bat (start /MIN /B C:\xamppp\postgresql\scripts\ctl.bat START)
if exist C:\xamppp\apache\scripts\ctl.bat (start /MIN /B C:\xamppp\apache\scripts\ctl.bat START)
if exist C:\xamppp\openoffice\scripts\ctl.bat (start /MIN /B C:\xamppp\openoffice\scripts\ctl.bat START)
if exist C:\xamppp\apache-tomcat\scripts\ctl.bat (start /MIN /B C:\xamppp\apache-tomcat\scripts\ctl.bat START)
if exist C:\xamppp\resin\scripts\ctl.bat (start /MIN /B C:\xamppp\resin\scripts\ctl.bat START)
if exist C:\xamppp\jetty\scripts\ctl.bat (start /MIN /B C:\xamppp\jetty\scripts\ctl.bat START)
if exist C:\xamppp\subversion\scripts\ctl.bat (start /MIN /B C:\xamppp\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist C:\xamppp\lucene\scripts\ctl.bat (start /MIN /B C:\xamppp\lucene\scripts\ctl.bat START)
if exist C:\xamppp\third_application\scripts\ctl.bat (start /MIN /B C:\xamppp\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist C:\xamppp\third_application\scripts\ctl.bat (start /MIN /B C:\xamppp\third_application\scripts\ctl.bat STOP)
if exist C:\xamppp\lucene\scripts\ctl.bat (start /MIN /B C:\xamppp\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist C:\xamppp\subversion\scripts\ctl.bat (start /MIN /B C:\xamppp\subversion\scripts\ctl.bat STOP)
if exist C:\xamppp\jetty\scripts\ctl.bat (start /MIN /B C:\xamppp\jetty\scripts\ctl.bat STOP)
if exist C:\xamppp\hypersonic\scripts\ctl.bat (start /MIN /B C:\xamppp\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist C:\xamppp\resin\scripts\ctl.bat (start /MIN /B C:\xamppp\resin\scripts\ctl.bat STOP)
if exist C:\xamppp\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT C:\xamppp\apache-tomcat\scripts\ctl.bat STOP)
if exist C:\xamppp\openoffice\scripts\ctl.bat (start /MIN /B C:\xamppp\openoffice\scripts\ctl.bat STOP)
if exist C:\xamppp\apache\scripts\ctl.bat (start /MIN /B C:\xamppp\apache\scripts\ctl.bat STOP)
if exist C:\xamppp\ingres\scripts\ctl.bat (start /MIN /B C:\xamppp\ingres\scripts\ctl.bat STOP)
if exist C:\xamppp\mysql\scripts\ctl.bat (start /MIN /B C:\xamppp\mysql\scripts\ctl.bat STOP)
if exist C:\xamppp\postgresql\scripts\ctl.bat (start /MIN /B C:\xamppp\postgresql\scripts\ctl.bat STOP)

:end

