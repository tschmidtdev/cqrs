# Configuration

Every option in the configuration is optional. Not defining a default for request decoder, DTO constructor or response constructor will lead to an exception when there is no component defined in the route.

```php
return static function (CqrsConfig $cqrsConfig) {
    
    // -- Query controller

    $cqrsConfig->queryController()
        ->defaultRequestValidatorClasses([
            GuardAgainstTokenInHeaderRequestValidator::class => null,
        ])
        ->defaultRequestDecoderClass(JsonRequestDecoder::class)
        ->defaultRequestDataTransformerClasses([
            AddActionIdRequestDataTransformer::class => null,
        ])
        ->defaultDtoConstructorClass(SerializerDTOConstructor::class)
        ->defaultDtoValidatorClasses([
            CourseIdValidator::class => null,
            UserIdValidator::class => null,
        ])
        ->defaultHandlerWrapperClasses([
            ConnectionTransactionWrapper::class => null,
        ])
        ->defaultResponseConstructorClass(SerializerJsonResponseConstructor::class);

    // -- Command controller

    $cqrsConfig->commandController()
        ->defaultRequestValidatorClasses([
            GuardAgainstTokenInHeaderRequestValidator::class => null,
        ])
        ->defaultRequestDecoderClass(JsonRequestDecoder::class)
        ->defaultRequestDataTransformerClasses([
            AddActionIdRequestDataTransformer::class => null,
        ])
        ->defaultDtoConstructorClass(SerializerDTOConstructor::class)
        ->defaultDtoValidatorClasses([
            CourseIdValidator::class => null,
            UserIdValidator::class => null,
        ])
        ->defaultHandlerWrapperClasses([
            ConnectionTransactionWrapper::class => null,
        ])
        ->defaultResponseConstructorClass(EmptyJsonResponseConstructor::class);
};
```

Or if your configuration still uses yaml, it looks like this:

```yaml
cqrs:

  command_controller:

    # Classes of the default request validator of command controller when there is none defined for the route
    default_request_validator_classes:
      'App\CQRS\RequestValidator\GuardAgainstTokenInHeaderRequestValidator': null

    # Class of the default request decoder of command controller when there is none defined for the route
    default_request_decoder_class: 'DigitalCraftsman\CQRS\RequestDecoder\JsonRequestDecoder'

    # Classes of the default request data transformer of command controller when there is none defined for the route
    default_request_data_transformer_classes:
      'App\CQRS\RequestDataTransformer\AddActionIdRequestDataTransformer': null
    
    # Class of the default DTO constructor of command controller when there is none defined for the route
    default_dto_constructor_class: 'DigitalCraftsman\CQRS\DTOConstructor\SerializerDTOConstructor'

    # Classes of the default DTO validator of command controller when there is none defined for the route
    default_dto_validator_classes:
      'App\CQRS\DTOValidator\CourseIdValidator': null
      'App\CQRS\DTOValidator\UserIdValidator': null

    # Classes of the default wrapper handler of command controller when there is none defined for the route
    default_handler_wrapper_classes:
      'App\CQRS\HandlerWrapper\ConnectionTransactionWrapper': null

    # Class of the default response constructor of command controller when there is none defined for the route
    default_response_constructor_class: 'DigitalCraftsman\CQRS\ResponseConstructor\EmptyJsonResponseConstructor'

  query_controller:

    # Classes of the default request validator of query controller when there is none defined for the route
    default_request_validator_classes:
      'App\CQRS\RequestValidator\GuardAgainstTokenInHeaderRequestValidator': null
    
    # Class of the default request decoder of query controller when there is none defined for the route
    default_request_decoder_class: 'DigitalCraftsman\CQRS\RequestDecoder\JsonRequestDecoder'

    # Classes of the default request data transformer of query controller when there is none defined for the route
    default_request_data_transformer_classes:
      'App\CQRS\RequestDataTransformer\AddActionIdRequestDataTransformer': null
    
    # Class of the default DTO constructor of query controller when there is none defined for the route
    default_dto_constructor_class: 'DigitalCraftsman\CQRS\DTOConstructor\SerializerDTOConstructor'
    
    # Classes of the default DTO validator of query controller when there is none defined for the route
    default_dto_validator_classes:
      'App\CQRS\DTOValidator\CourseIdValidator': null
      'App\CQRS\DTOValidator\UserIdValidator': null

    # Classes of the default wrapper handler of query controller when there is none defined for the route
    default_handler_wrapper_classes:
      'App\CQRS\HandlerWrapper\ConnectionTransactionWrapper': null
    
    # Class of the default response constructor of query controller when there is none defined for the route
    default_response_constructor_class: 'DigitalCraftsman\CQRS\ResponseConstructor\SerializerJsonResponseConstructor'
```
