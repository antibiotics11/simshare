# simshare

Web프로그래밍(1) 기말고사 포트폴리오 프로젝트입니다. 
<br><br>
본 Readme 파일은 간략한 개요와 웹앱 설치에 필요한 서버 환경 구축에 대한 가이드입니다.
<br><br>

## 개요 
### Korean

simshare는 군산대학교 컴퓨터정보통신공학부 학생이 웹개발 과제로 개발한 웹앱입니다.
<br>
200mb이하 용량의 파일을 simshare 서버에 업로드해두고 일주일 이내 언제든지 다운받을 수 있습니다. 
<br>
파일 업로드시 암호화 / 압축 옵션을 선택할 수 있습니다.
<br><br>

## 상세

### 시스템 정보

도메인: <a href = "https://old.simshare.xyz">old.simshare.xyz</a>
<br><br>
O/S: Ubuntu Server 20.04 LTS <br>
Host: South Korea, <a href = "https://iwinv.kr/">iwinv</a> <br>
LAMP: Apache HTTP Server 2.4 / PHP 7.4 / MySQL 8.0 
<br><br>

### O/S 설정

사용자가 root권한을 보유한 리눅스 서버 환경을 권장합니다.
<br><br>
파일 업로드 및 다운로드를 위해 웹앱이 포함된 디렉터리의 퍼미션을 777로 변경합니다.
```
$ chmod -R 777 simshare/
```
<br>

zip 압축 및 해제를 위해 서버에 zip 패키지를 설치해야합니다. 
<br>

[데비안 계열]
```
$ sudo apt-get install zip unzip
```
[레드헷 계열]
```
$ sudo yum install zip unzip
```
<br>

### Apache HTTP Server 2.4 설정

Nginx 및 기타 웹서버 환경은 보증하지 않습니다. <br>
Apache HTTP Server 2.4 사용을 권장합니다.

htaccess 파일을 사용하기 위해 Rewrite Module을 활성화해야합니다. <br> 
Rewrite Engine이 이미 활성화되었다면 별도의 설정이 필요하지 않습니다. <br>
```
$ sudo a2enmod rewrite
$ sudo systemctl restart apache2
```

apache2.conf 파일에 다음 내용을 추가합니다.
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
### PHP 7.4 설정 

php.ini 파일을 수정해야 합니다.

200mb 파일을 업로드하기 위해 라인 694, 846를 수정해 post_max_size와 upload_max_filesize를 각각 220M, 200M으로 수정합니다.
```
post_max_size = 220M
```

```
upload_max_filesize = 200M
```

시간 초과로 인한 실행종료를 방지하기 위해, 라인 388, 398의 max_execution_time과 max_input_time을 각각 600(또는 그 이상)으로 수정합니다.

```
max_execution_time = 600
```
```
max_input_time = 600
```
<br>
memory_limit의 경우, ini_set() 함수로 필요한 스크립트마다 메모리 값을 정의해두었습니다. 
<br>
서버 자원 사용률에 따라 이 부분을 수정할 수 있습니다.
<br><br>

### 브라우저 지원

예기치 못한 오류나 보안 위협을 방지하기 위해 Internet Explorer 접속을 차단하는 코드가 포함되어 있습니다. <br>
Chromium 기반 브라우저의 최신 버전 사용을 권장합니다.
<br><br>

## 스크린샷

![main1](https://user-images.githubusercontent.com/75349747/118394785-be9e1680-b681-11eb-887d-9122e6334169.PNG)
![main2](https://user-images.githubusercontent.com/75349747/118394786-bf36ad00-b681-11eb-801c-27af3ac9274e.PNG)
![main3](https://user-images.githubusercontent.com/75349747/118394787-bfcf4380-b681-11eb-8659-cc8a9f936505.PNG)
![main4](https://user-images.githubusercontent.com/75349747/118394788-c067da00-b681-11eb-83c6-faf130de6479.PNG)
