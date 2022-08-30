## Обстановка

Это песочница с работающим Symfony Validator, настроенным согласно [https://deworker.pro/edu/series/interactive-site/validation](https://deworker.pro/edu/series/interactive-site/validation).

В качестве DI используется PHP-DI.

Сделан свой кастомный Constraint, который должен лезть в базу через репозиторий, для проверки свободен ли телефонный номер. Цель: унифицировать механизм вывода юзеру ошибок формы: как простых, так и сложных.

Кастомный Constraint сделан согласно https://symfony.com/doc/current/validation/custom_constraint.html.

### Проблема

Кастомный валидатор PhoneNumAvailableValidator (extends Symfony\Component\Validator\ConstraintValidator) для  PhoneNumAvailable работает, пока в его констуктор не передать  зависимость от PHP-DI! 
При этом, говорит что зависимости не подтягиваются:

```
Too few arguments to function Gt\Validator\PhoneNumAvailableValidator::__construct(), 0 passed
```

@Inject в аннотации также не работает. 

Во все прочие классы PHP-DI прекрасно инжектит зависимости.

Есть подозрение, что кастомный валидатор может работать только с родным Symfony DI компонентом.

Но чем же Symfony\Component\Validator\ConstraintValidator так отличается от других классов, что PHP-DI не может  подсунуть ему Autowiring?

Как можно решить сию проблему, чтобы не создавать и не запускать на каждый запрос  два контейнера одновременно: от PHP-DI и от Symphony?

Есть супер - древний bridge [PHP-DI in Symfony](https://php-di.org/doc/frameworks/symfony2.html) но мне неясен его принцип работы, т.к. я не знаю как сделаны зависимости в Symfony.
К тому же он не втыкается composer-ом напрямую из за своей древности.

---

## Демонстрация проблемы:


### с зависимостью в конструкторе

```
php public/index.php "+7(456)789-4567"
```

получаем:

>Too few arguments to function Gt\Validator\PhoneNumAvailableValidator::__construct(), 0 passed in /home/vladp/dev/learn/php-di-symf-dep/vendor/symfony/validator/ConstraintValidatorFactory.php on line 43 and exactly 1 expected

---

### Без зависимости в конструкторе

**Если убрать зависимость** (private DriverRepository $driverRepo) из конструктора PhoneNumAvailableValidator.php, то всё ок - штатно срабатывает PhoneNumAvailableValidator->validate() :

```
php public/index.php "+7(456)789-4567"
```
вывод из $exception->getViolations():

>пусто - проверка пройдена

```
php public/index.php null
```
>Object(Gt\TestDi\DriverFormDtoDriver).phoneNumber:
    Телефон не должен быт пустым (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)

```
php public/index.php "+7(456)789"
```
>+7(456)789-Object(Gt\TestDi\DriverFormDtoDriver).phoneNumber:
    Длина номера телефона "+7(456)789-" менее 15 символов

Последний вывод сгенерирован самими PhoneNumAvailableValidator

