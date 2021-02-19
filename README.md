# Raw Framework Bare 2
Raw Framework Bare is a simple, easy to use PHP MVC framework.

## Requirements
Raw Framework requires at least PHP 7.0.0 or higher and works with PHP 8.

## Installation
Download the zip or via Composer.

`composer require dwilsondev/raw-framework-bare:2.0.*`

## Installation from Zip
Download zip from GitHub. It will have everything set up for you already. All you have to do is adjust your .htaccess.

## Prep
### Prepare Project Folder
Assuming you used to composer command from inside your project folder, move everything out of 

`vendor/dwilsondev/raw-framework-bare` to the root of your project folder.

### Configure .htaccess
Configure the root .htaccess if you rename the folder. 

`RewriteBase /my-website`

If you're using virtual host, set RewriteBase to `/`

## Loading Views
Use `$this->view` to load PHP or HTML files.

EXAMPLE (app/controllers/view.php):

```php
// In controllers/view.php, Load the homepage page with a title.
$this->view("homepage", array("title" => "My Awesome Website"));
```

## Accessing Data
Access data using the data array in your views like this `echo $data['title'];`

EXAMPLE (app/views/index.php):

`<h1><?php echo $data['title']; ?></h1>`

## Loading a Model
As a construct property
```php
class User extends Controller
    {

        private $user;

        public function __construct()
        {
            $this->user = $this->model("User_Model");
        }
```

In a method
```php
        public function store()
        {
            $products = $this->model("Product_Model");
            
            $products->listInStock();
        }
```

## Controller Methods
`view (string $view_name, array $data = [])`

Loads a PHP or HTML file from views folder.

* $view_name (String) filename in the views folder. If the file is named homepage.php, you would enter "homepage" without the file extension. For names inside of folders you can enter something like "pages/hompage".

* $data (Array) optional array with the data to be passed into the view.

`model (string $model_name)`

Load and instantiate a model.
* $model_name (String) name of the model file. If the file is named store_model.php, you would enter "store_model".

## Model Methods
`db ()`

Connect to database using PDO. Available when extending the main model. Be sure to configure your database connection before using this method.
EXAMPLE
```php
Class Store extends Model {
    
    private function listInStock() {
        $connect = $this->db();

        $sql = "SELECT `product_name` FROM `products` WHERE `instock` = ?";
        $statement = $connect->prepare($sql);
        $statement->execute(array("true"));
        $results = $statement->fetchAll();
        
        if(empty($results)) {
            return false;
        }
        
        return $results;
    }
    
}
```

## Config File
Located inside of the app folder is config.php. It contains a global constant which has configuration options for your project. Raw Framework only requires one option defining the default template engine. You can use this config file to store additional options for your project.

Please do not store database config data, API keys, or any data that could put your project at risk as the CONFIG constant is accessible throughout the entire project. Instead, store database config in its own file or in the main model. Store API keys in their respective config files, via environment variables, or outside your project entirely.

* ssl - Set SSL. This only effects the DOMAIN constant.

## Global Constants
Global constants are accessible throughout the entire project, mostly to set paths to important folders.

`APP_PATH` (Default: "app/") - App folder contains the main MVC.

`SYS_PATH` (Default: "system/") - System folder contains core of the framework.

`CONTROLLER_PATH` (Default: "app/controllers/") - Controllers folder contains all the app controllers.

`MODEL_PATH` (Default: "app/models/") - Models folder contains all the app models.

`VIEW_PATH` (Default: "app/views/") - Views folder contains all the app views.

`DEFAULT_CONTROLLER` (Default: "view") - Sets the default controller.

`DOMAIN` - Web address of the site. Will automatically switch to HTTPS if SSL is set to `true` in config.php. Can be used for setting absolute paths in your project.

`ROOT_FOLDER` - Name of project folder.

## Version History

### 2.0.0 - Feb 18th, 2021
* Updated global constants
* Moved config.php to app/
* Removed app_folder and default_controller from config.php. (redundant since they are defined constants)
* Support for sub folders in app/controllers (one level deep).
* Initial release.
