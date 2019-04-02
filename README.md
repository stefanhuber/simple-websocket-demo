# Simple WebSocket Chat

## Installation

 - `composer install` for installing php dependencies
 - add config for two hosts to local host file, `chat.local` and `socket.chat.local` should point to `127.0.0.1`
 - add the nginx config to your ngxin instance and change the root path accordingly, see `$project_folder`
 - start the websocket service with `composer socket` command, which starts the service on `localhost:9080`
 - open `http://chat.local` in various browser tabs to test the chat application

## hosts config file

```
127.0.0.1   chat.local
127.0.0.1   socket.chat.local
```
 
## nginx config

```nginx
http {
    server {
		listen 80;
		server_name chat.local;
		root /$project_folder/public;
	}
	
	server {
		listen 80;
		server_name socket.chat.local;
	
		location / {
			proxy_pass http://localhost:9080;
			proxy_http_version 1.1;
			proxy_set_header Upgrade $http_upgrade;
			proxy_set_header Connection "upgrade";
		}	
	}
}
```
 