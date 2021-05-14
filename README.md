# simshare

Web프로그래밍(1) 기말고사 포트폴리오 프로젝트입니다.

## 개요

simshare는 파일 업로드 및 다운로드, 파일 공유가 가능한 웹앱입니다. 

2gb이하 용량의 파일을 simshare 서버에 업로드해두고 일주일 이내 언제든지 다운받을 수 있습니다. <br>
파일 업로드시 암호화 / 압축 옵션을 선택할 수 있습니다.

[simshare 메인] <a href = "https://simshare.xyz">https://simshare.xyz</a>

## 상세

### 시스템 환경

O/S: Ubuntu Server 16.04 LTS <br>
Host Loc: New Jersey (USA) by <a href = "https://www.vultr.com/">Vultr</a> Cloud Compute <br>
DNS: <a href = "https://www.cloudflare.com/">Cloudflare</a> <br>
Apache HTTP Server 2.4 / PHP 7.0 / MySQL 5.7 

### O/S 세팅

파일 업로드 및 다운로드를 위해 웹앱이 포함된 디렉터리의 퍼미션을 777로 변경해주세요.
```
chmod -R 777 simshare/
```
<br>

zip 압축 및 해제를 위해 서버에 zip 패키지가 필요합니다. 
<br>

[데비안 계열]
```
apt install zip unzip
```
[레드헷 계열]
```
yum install zip unzip
```

### Apache HTTP Server 2.4 세팅

Nginx 및 기타 웹서버에서 정상 작동을 보장하지 않습니다. <br>
가능하다면 Apache HTTP Server 2.4 (이하 "Apache") 사용을 권장합니다.

htaccess 파일을 사용하기 위해 Rewrite Module을 활성화해야합니다. <br> 
Rewrite Engine이 이미 활성화되었다면 별도의 설정이 필요하지 않습니다. <br>
```
sudo a2enmod rewrite
sudo systemctl restart apache2
```

/etc/apache2/apache2.conf 파일에 다음 내용을 추가해주세요.
```
<Directory /var/www/simshare>
    Options FollowSymLinks
    AllowOverride all
    Order allow,deny
    Allow from all
</Directory>
```
<br>
htaccess 파일의 라인 12, 13의 주석을 해제하면 https 리디렉션을 사용할 수 있습니다.

### PHP 7.0 세팅



### 브라우저 지원

예기치 못한 오류나 보안 위협을 방지하기 위해 Internet Explorer 접속을 차단하는 코드가 포함되어 있습니다. <br>
Chromium 기반 브라우저의 최신 버전 사용을 권장합니다.

## 라이선스

소스코드는 <a href = "https://github.com/antibiotics11/simshare/blob/main/LICENSE">MIT</a> 라이선스로 배포됩니다.
