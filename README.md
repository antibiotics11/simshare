# simshare

Web프로그래밍(1) 기말고사 포트폴리오 프로젝트입니다.

## 개요

simshare는 파일 업로드 및 다운로드, 파일 공유가 가능한 웹앱입니다. 

사용자는 2gb이하 용량의 파일을 simshare 서버에 업로드할 수 있습니다. <br>
파일 업로드시 암호화 / 압축 옵션을 선택할 수 있으며, 업로드된 파일을 1주일 이내 언제든지 다시 내려받을 수 있습니다.

<a href = "simshare.abx.pe.kr"> https://simshare.abx.pe.kr </a>

## 상세

### 시스템 환경

Ubuntu 16.04 LTS <br>
Apache HTTP Server 2.4 <br>
PHP 7.0 <br>
MySQL 5.7 <br>

### O/S 세팅

파일 업로드 및 다운로드를 위해 웹앱이 포함된 디렉터리의 퍼미션을 777로 변경해주세요.

[예시]
<pre>
<code>
chmod -R 777 simshare/
</code>
</pre>

### Apache HTTP Server 2.4 세팅

Nginx 및 기타 웹서버에서 테스트를 거치지 않았습니다. <br>
가능하면 Apache HTTP Server 2.4 (이하 "Apache") 사용을 권장합니다.

htaccess 파일 활성화를 위해 Rewrite Module이 필요합니다.

[Rewrite Engine 활성화 예시]
```
sudo a2enmod rewrite
sudo systemctl restart apache2
```
[000-default.conf 파일 예시]
```
<IfModule mod_rewrite.c>
  rewriteEngine On
</IfModule>
```
[apache2.conf 파일 예시]
```
<Directory /var/www/simshare>
  Options FollowSymLinks
  AllowOverride all
  Order allow,deny
  Allow from all
</Directory>
```

Rewrite Engine이 이미 활성화되었다면 별도의 설정이 필요하지 않습니다.

htaccess 파일의 라인 12, 13의 주석을 해제하면 https 리디렉션을 사용할 수 있습니다.

### PHP 7.0 세팅

파일 암호화를 위해 PHP openssl 모듈을 사용하고 있습니다.

### 브라우저 지원

예기치 못한 오류나 보안 위협을 방지하기 위해 Internet Explorer 접속을 차단하는 코드가 포함되어 있습니다. <br>
Chromium 기반 브라우저의 최신 버전 사용을 권장합니다.

## 라이선스

소스코드는 <a href = "https://github.com/antibiotics11/simshare/blob/main/LICENSE">MIT</a> 라이선스로 배포됩니다.
