# nps/npc client for QNAP

## 介绍
因原项目不再更新维护，换新的维护源：https://github.com/yisier/nps

nps是一款轻量级、高性能、功能强大的**内网穿透**代理服务器。目前支持**tcp、udp流量转发**，可支持任何**tcp、udp**上层协议（访问内网网站、本地支付接口调试、ssh访问、远程桌面，内网dns解析等等……），此外还**支持内网http代理、内网socks5代理**、**p2p等**，并带有功能强大的web管理端。

## 此插件为npc客户端
- [x] 密码登录验证，默认123456
- [x] 命令行模式启动
- [x] 自定义配置文件启动
- [x] 更多高级用法见[完整文档](https://ehang-io.github.io/nps/)

## 如何使用
在QNAP系统，通过App Center手动安装 ***.qpkg*** 后辍程序。

* 支持 x86_64 构架的QNAP存储设备
* 支持 ARM 构架的QNAP存储设备
* 支持 aach64 构架的QNAP存储设备


## 配置示意图 
![配置图示1](https://raw.githubusercontent.com/iranee/qnap-nps/main/readme/npc-ico.jpg)
 
![配置图示2](https://raw.githubusercontent.com/iranee/qnap-nps/main/readme/login.jpg)

![配置图示3](https://raw.githubusercontent.com/iranee/qnap-nps/main/readme/command.jpg)

![配置图示4](https://raw.githubusercontent.com/iranee/qnap-nps/main/readme/edit-conf.jpg)
 
 
## 注意事项
- 建议安装前，去威联通的管理页面打开web服务，位置在：控制台→应用程序→web服务器
- 在配置页面修改内容后，10-30秒后配置文件才能生效。
