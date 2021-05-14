# simshare

Web프로그래밍(1) 기말고사 포트폴리오 프로젝트입니다.

## 개요

simshare는 파일 업로드 및 다운로드, 파일 공유가 가능한 웹앱입니다. 

200mb이하 용량의 파일을 simshare 서버에 업로드해두고 일주일 이내 언제든지 다운받을 수 있습니다. <br>
파일 업로드시 암호화 / 압축 옵션을 선택할 수 있습니다.

<a href = "https://simshare.xyz">https://simshare.xyz</a>

## 상세

### 시스템 정보

O/S: Ubuntu Server 16.04 LTS <br>
Host: New Jersey (USA) by <a href = "https://www.vultr.com/">Vultr Cloud Compute</a> <br>
DNS: <a href = "https://www.cloudflare.com/">Cloudflare</a> <br>
Apache HTTP Server 2.4 / PHP 7.0 / MySQL 5.7 
<br><br>

### O/S 설정

파일 업로드 및 다운로드를 위해 웹앱이 포함된 디렉터리의 퍼미션을 777로 변경합니다.
```
chmod -R 777 simshare/
```
<br>

zip 압축 및 해제를 위해 서버에 zip 패키지를 설치해야합니다. 
<br>

[데비안 계열]
```
apt install zip unzip
```
[레드헷 계열]
```
yum install zip unzip
```
<br>

### Apache HTTP Server 2.4 설정

Nginx 및 기타 웹서버에서 정상 작동을 보장하지 않습니다. <br>
Apache HTTP Server 2.4 사용을 권장합니다.

htaccess 파일을 사용하기 위해 Rewrite Module을 활성화해야합니다. <br> 
Rewrite Engine이 이미 활성화되었다면 별도의 설정이 필요하지 않습니다. <br>
```
sudo a2enmod rewrite
sudo systemctl restart apache2
```

/etc/apache2/apache2.conf 파일에 다음 내용을 추가합니다.
```
<Directory /var/www/simshare>
    Options FollowSymLinks
    AllowOverride all
    Order allow,deny
    Allow from all
</Directory>
```
<br>

https 리디렉션을 사용하지 않을 경우, htaccess 파일의 12, 13 라인을 주석 처리하면 됩니다.
<br><br>
### PHP 7.0 설정 

/etc/php/7.0/apache2/php.ini 파일을 수정해야 합니다.

200mb 파일을 업로드하기 위해 라인 656, 809를 수정해 post_max_size와 upload_max_filesize를 각각 220M, 200M으로 수정합니다.
```
; Maximum size of POST data that PHP will accept.
; Its value may be 0 to disable the limit. It is ignored if POST data reading
; is disabled through enable_post_data_reading.
; http://php.net/post-max-size
post_max_size = 8M
```

```
; Maximum allowed size for uploaded files.
; http://php.net/upload-max-filesize
upload_max_filesize = 200M
```

시간 초과로 인한 실행종료를 방지하기 위해 라인 368, 378을 수정해 max_execution_time과 max_input_time을 각각 600(또는 그 이상)으로 수정합니다.

```
; Maximum execution time of each script, in seconds
; http://php.net/max-execution-time
; Note: This directive is hardcoded to 0 for the CLI SAPI
max_execution_time = 600

; Maximum amount of time each script may spend parsing request data. It's a good
; idea to limit this time on productions servers in order to eliminate unexpectedly
; long running scripts.
; Note: This directive is hardcoded to -1 for the CLI SAPI
; Default Value: -1 (Unlimited)
; Development Value: 60 (60 seconds)
; Production Value: 60 (60 seconds)
; http://php.net/max-input-time
max_input_time = 600
```
<br><br>

### 브라우저 지원

예기치 못한 오류나 보안 위협을 방지하기 위해 Internet Explorer 접속을 차단하는 코드가 포함되어 있습니다. <br>
Chromium 기반 브라우저의 최신 버전 사용을 권장합니다.

## 라이선스

소스코드는 <a href = "https://github.com/antibiotics11/simshare/blob/main/LICENSE">MIT</a> 라이선스로 배포됩니다.
