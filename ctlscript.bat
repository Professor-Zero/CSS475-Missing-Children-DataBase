@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\server\hsql-sample-database\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\ingres\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\ingres\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\mysql\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\mysql\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\postgresql\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\openoffice\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache-tomcat\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache-tomcat\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\resin\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\resin\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jboss\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jboss\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jetty\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jetty\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\subversion\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\lucene\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\lucene\scripts\ctl.bat START)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\third_application\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\third_application\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\third_application\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\lucene\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\subversion\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\subversion\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jetty\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jetty\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jboss\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\jboss\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\resin\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\resin\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache-tomcat\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\openoffice\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\apache\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\ingres\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\ingres\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\mysql\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\mysql\scripts\ctl.bat STOP)
if exist C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\moabd\OneDrive\Desktop\MissingChildrenDB\postgresql\scripts\ctl.bat STOP)

:end

