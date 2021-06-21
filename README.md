<p align="center">
    <h1 align="center">EasyBaidu Composer Plugin</h1>
</p>

<p align="center">
    <a href="https://travis-ci.org/larvatech/easybaidu-composer"><img src="https://travis-ci.org/larva/easybaidu-composer.svg" alt="Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/larvatech/easybaidu-composer/?branch=master"><img src="https://scrutinizer-ci.com/g/larva/easybaidu-composer/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"></a>
    <a href="https://packagist.org/packages/larva/easybaidu-composer"><img src="https://poser.pugx.org/larva/easybaidu-composer/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/larva/easybaidu-composer"><img src="https://poser.pugx.org/larva/easybaidu-composer/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/larva/easybaidu-composer"><img src="https://poser.pugx.org/larva/easybaidu-composer/license.svg" alt="License"></a>
</p>

Usage
---

Set the `type` to be `easybaidu-extension` in your package composer.json file:

```json
{
    "name": "your/package",
    "type": "easybaidu-extension"
}
```

Specify server observer classes in the extra section:

```json
{
    "name": "your/package",
    "type": "easybaidu-extension",
    "extra": {
        "observers": [
            "Acme\\Observers\\Handler"
        ]
    }
}
```

Examples
---
* [easywechat-composer/open-platform-testcase](https://github.com/mingyoung/open-platform-testcase)

Server Delegation
---

> 目前仅支持 Laravel

1. 在 `config/app.php` 中添加 `EasyBaiduComposer\Laravel\ServiceProvider::class`

2. 在**本地项目**的 `.env` 文件中添加如下配置：

```
EASYBAIDU_DELEGATION=true # false 则不启用
EASYBAIDU_DELEGATION_HOST=https://example.com # 线上域名
```
