<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class TypeSpec extends ObjectBehavior
{
    function it_tests_a_null_against_null()
    {
        $this->is(
            new NullTypeMetadata(),
            new NullTypeMetadata()
        )->shouldReturn(true);
    }

    function it_tests_a_null_against_a_bool()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_boolean()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_an_int()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_an_integer()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_float()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_decimal()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_double()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_numeric()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_number()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_string()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_binary()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_an_iterable()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_callable()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_resource()
    {
        $this->is(
            new NullTypeMetadata(),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_an_array()
    {
        $this->is(
            new NullTypeMetadata(),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_class()
    {
        $this->is(
            new NullTypeMetadata(),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_collection()
    {
        $this->is(
            new NullTypeMetadata(),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_null_against_a_list()
    {
        $this->is(
            new NullTypeMetadata(),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_null()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(true);
    }

    function it_tests_a_bool_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(true);
    }

    function it_tests_a_bool_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_bool_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('bool'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(true);
    }

    function it_tests_a_boolean_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(true);
    }

    function it_tests_a_boolean_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_boolean_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('boolean'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(true);
    }

    function it_tests_an_int_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(true);
    }

    function it_tests_an_int_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_an_int_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_an_int_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_int_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('int'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(true);
    }

    function it_tests_an_integer_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(true);
    }

    function it_tests_an_integer_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_an_integer_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_an_integer_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_integer_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('integer'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(true);
    }

    function it_tests_a_float_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(true);
    }

    function it_tests_a_float_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(true);
    }

    function it_tests_a_float_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_a_float_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_a_float_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_float_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('float'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(true);
    }

    function it_tests_a_decimal_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(true);
    }

    function it_tests_a_decimal_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(true);
    }

    function it_tests_a_decimal_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_a_decimal_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_a_decimal_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_decimal_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('decimal'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(true);
    }

    function it_tests_a_double_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(true);
    }

    function it_tests_a_double_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(true);
    }

    function it_tests_a_double_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_a_double_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_a_double_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_double_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('double'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_a_numeric_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_a_numeric_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_numeric_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('numeric'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(true);
    }

    function it_tests_a_number_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(true);
    }

    function it_tests_a_number_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_number_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('number'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(true);
    }

    function it_tests_a_string_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_string_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('string'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(true);
    }

    function it_tests_a_binary_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_binary_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('binary'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(true);
    }

    function it_tests_an_iterable_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_iterable_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('iterable'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(true);
    }

    function it_tests_an_callable_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_callable_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('callable'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_null()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_bool()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_boolean()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_an_int()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_an_integer()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_float()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_decimal()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_double()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_numeric()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_number()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_string()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_binary()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_an_iterable()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_callable()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_resource()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(true);
    }

    function it_tests_a_resource_against_an_array()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_class()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_collection()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_resource_against_a_list()
    {
        $this->is(
            new ScalarTypeMetadata('resource'),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_null()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_bool()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_boolean()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_an_int()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_an_integer()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_float()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_decimal()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_double()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_numeric()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_number()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_string()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_binary()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_an_iterable()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_callable()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_resource()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_an_array()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ArrayTypeMetadata()
        )->shouldReturn(true);
    }

    function it_tests_an_array_against_a_class()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_collection()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_an_array_against_a_list()
    {
        $this->is(
            new ArrayTypeMetadata(),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_null()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_bool()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_boolean()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_an_int()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_an_integer()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_float()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_decimal()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_double()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_numeric()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_number()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_string()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_binary()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_an_iterable()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_callable()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_resource()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_an_array()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_class_with_anonymous_types()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ClassTypeMetadata(null)
        )->shouldReturn(true);
    }

    function it_tests_a_class_against_a_class_with_same_type()
    {
        $this->is(
            new ClassTypeMetadata('Foo'), new ClassTypeMetadata('Foo')
        )->shouldReturn(true);
    }

    function it_tests_a_class_against_a_class_with_different_type()
    {
        $this->is(
            new ClassTypeMetadata('Foo'), new ClassTypeMetadata('Bar')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_an_anonymous_class()
    {
        $this->is(
            new ClassTypeMetadata('Foo'), new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_an_anonymous_class_against_a_class()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ClassTypeMetadata('Foo')
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_collection()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_class_against_a_list()
    {
        $this->is(
            new ClassTypeMetadata(null),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_null()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_bool()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_boolean()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_an_int()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_an_integer()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_float()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_decimal()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_double()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_numeric()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_number()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_string()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_binary()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_an_iterable()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_callable()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_resource()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_an_array()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_class()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_collection()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(true);
    }

    function it_tests_a_foo_collection_against_a_bar_collection()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata('Foo'), new NullTypeMetadata()),
            new CollectionTypeMetadata(new ClassTypeMetadata('Bar'), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_collection_against_a_collection_with_different_inner_type()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata('Foo'), new ClassTypeMetadata('Baz')),
            new CollectionTypeMetadata(new ClassTypeMetadata('Foo'), new ClassTypeMetadata('Baz'))
        )->shouldReturn(true);
    }

    function it_tests_a_collection_against_a_list()
    {
        $this->is(
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata()),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_null()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new NullTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_bool()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('bool')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_boolean()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('boolean')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_an_int()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('int')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_an_integer()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('integer')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_float()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('float')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_decimal()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('decimal')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_double()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('double')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_numeric()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('numeric')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_number()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('number')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_string()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('string')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_binary()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('binary')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_an_iterable()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('iterable')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_callable()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('callable')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_resource()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ScalarTypeMetadata('resource')
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_an_array()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ArrayTypeMetadata()
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_class()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ClassTypeMetadata(null)
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_collection()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new CollectionTypeMetadata(new ClassTypeMetadata(null), new NullTypeMetadata())
        )->shouldReturn(false);
    }

    function it_tests_a_list_against_a_list()
    {
        $this->is(
            new ListTypeMetadata(new NullTypeMetadata()),
            new ListTypeMetadata(new NullTypeMetadata())
        )->shouldReturn(true);
    }

    function it_tests_a_list_against_a_list_with_same_inner_type()
    {
        $this->is(
            new ListTypeMetadata(new ClassTypeMetadata('Foo')),
            new ListTypeMetadata(new ClassTypeMetadata('Foo'))
        )->shouldReturn(true);
    }

    function it_tests_a_list_against_a_list_with_different_inner_type()
    {
        $this->is(
            new ListTypeMetadata(new ClassTypeMetadata('Foo')),
            new ListTypeMetadata(new ClassTypeMetadata('Bar'))
        )->shouldReturn(false);
    }
//
//    function it_can_extract_a_subset_of_types()
//    {
//        $this->isSubsetOf(
//            [
//                new ScalarTypeMetadata('float'),
//                new NullTypeMetadata(),
//            ],
//            [
//                new ScalarTypeMetadata('float'),
//                new ScalarTypeMetadata('string'),
//                new ScalarTypeMetadata('bool'),
//            ]
//        )->shouldIterateAs([
//            new ScalarTypeMetadata('float'),
//        ]);
//    }
}
