<?php

enum NonBackedEnum
{
    case one;
    case two;
}

enum StringEnum: string
{
    case one = 'one';
    case two = 'two';
}