# doctrine-Italian-inflector-

## italian language for the pluraliazer

### Author: Mattias Raiani

This is a first step for the italian language for Inflector. I'll improve it in the future


#### SET UP
 1. In the Inflector's Doctrine vendor pack, there is a folder named `Rules`; 
  Paste the [`Italian` folder](https://github.com/riettotek/doctrine-Italian-inflector-#:~:text=Commit%20time-,italian,-Italian%20Package) in such folder. Here is fully path:
  ```
  vendor/doctrine/inflector/lib/Doctrine/Inflector/Rules
  ```
2. Add the const Italian in the `Language.php` file 

<img width="395" alt="Language" src="https://user-images.githubusercontent.com/75453324/166954294-d8dab91c-d91a-407d-9144-6c97bb02ec70.png">


3. Add the `case` line in the createForLanguage() method at the end of the `InflectorFactory.php` file;
...and don't forget to apply the use statement at the top of file to allow loading the language files

<img width="432" alt="inflectorFactory" src="https://user-images.githubusercontent.com/75453324/166954301-b3b1896b-cb24-4c9f-a182-c5aaafd04285.png">

### USAGE
By default it will create an English inflector. To use Italian language, just pass it to the createForLanguage() method:
```
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;

$inflector = InflectorFactory::createForLanguage(Language::ITALIAN)->build();
```
### USAGE in LARAVEL
In the Pluraliazer.php file locate in the Illuminate\Support namespace.
In here, then u have to set the value of the $language property to `italian` instead of 'english'.

<img width="395" alt="Pluralizer" src="https://user-images.githubusercontent.com/75453324/166954350-77b4e8ce-da54-4b10-a65c-7795013558cd.png">
