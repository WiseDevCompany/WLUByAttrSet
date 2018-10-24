![Wise Ltd.](docs/static/wise_logo.jpg)

## Magento 2 Extension for update widget layout options for adding CMS PageLink by Attribute set 

### ⚠️ Magento versions compatibility for extension: Magento 2.2.x

## Installation guide

#### Install manually

1. Download zip archive from current repository
2. Copy all files and folders from WLUByAttrSet-* folder into 
<your-magento-root-folder>/app/code/Wise/WidgetLayoutUpdatesByAttributeSet
3. To complete the installation, you need to run the following command lines: <br>
````
php bin/magento setup:upgrade
php bin/magento setup:di:compile
````
#### Install via composer:
Run the following command in Magento 2 root folder:
````
composer require wise/module-wlubyattrset
php bin/magento setup:upgrade
php bin/magento setup:di:compile
````
