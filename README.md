# travel 说明文档

**1.** **网站主页URL：**

http://myweb/TP/travel/public/index/index.html

**2.** **数据库说明：**

数据库名称：travel

**一、****用户表**（用户id、用户名username、用户密码password、状态status、邮箱email）

表3-1 用户表

| 类型名   | 类型             | 是否可为空 | 是否为主键 | 是否为外键 | 默认 |
| -------- | ---------------- | ---------- | ---------- | ---------- | ---- |
| id       | Int(250)unsigned | 否         | 是         | 否         | 无   |
| username | varchar(32)      | 是         | 否         | 是         | NULL |
| password | char(32)         | 是         | 否         | 是         | NULL |
| status   | varchar(11)      | 是         | 否         | 是         | NULL |
| email    | varchar(20)      | 否         | 否         | 是         | NULL |

**二、****文章表**（文章id、标记文章作者c_id、文章标题title、内容content、图片picture、作者writer）

表3-2 旅游攻略表

| 类型名  | 类型           | 是否可为空 | 是否为主键 | 是否为外键 | 默认 |
| ------- | -------------- | ---------- | ---------- | ---------- | ---- |
| id      | int(250)       | 否         | 是         | 否         | 无   |
| c_id    | varchar(250)   | 是         | 否         | 是         | NULL |
| title   | varchar(250)   | 是         | 否         | 是         | NULL |
| content | varchar(10000) | 是         | 否         | 是         | NULL |
| picture | varchar(255)   | 是         | 否         | 是         | NULL |
| writer  | varchar(100)   | 是         | 否         | 是         | NULL |

**三、****管理员表**（管理员id、管理员名username、管理员密码password、状态status）

表3-3 管理员表

| 类型名   | 类型        | 是否可为空 | 是否为主键 | 是否为外键 | 默认 |
| -------- | ----------- | ---------- | ---------- | ---------- | ---- |
| id       | int(250)    | 否         | 是         | 否         | 无   |
| username | varchar(32) | 是         | 否         | 是         | NULL |
| password | char(32)    | 是         | 否         | 是         | NULL |
| status   | int(32)     | 是         | 否         | 是         | NULL |

 

**3.** **用户名及密码：**

**3.1****前台登录：**

邮箱：111222@qq.com

密码：123666

**3.2****后台管理员登录：**

用户名：admin

密码：123456

**4.**   **开发环境**

**5.1****使用软件：**

**Wampserver64**![img](file:///C:/Users/hx/AppData/Local/Temp/msohtmlclip1/01/clip_image002.jpg)**、****Visual Studio Code**![img](file:///C:/Users/hx/AppData/Local/Temp/msohtmlclip1/01/clip_image004.jpg)

 

**5.2****使用框架及语言：**

**A.**   **前端：**

a)   框架：JQuery、Bootstrap

b)   语言：JavaScript、css

**B.**   **后端：**

a)   框架：Thinkphp5.1

b)   语言：PHP

 
