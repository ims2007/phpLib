<?php
$str = 'asd<b=1>asd<a=1>asdasd<a=2>dsa<a=3>ddd</b>vv<b=2>asd<a=4>asdasd<a=5>dsa<a=6>ddd</b>czxxc';                                                                                  
$pat = '#(?:<b=1>|\G>)[^<>]+<a=\K\d#';
preg_match_all($pat,$str,$m);  
print_r($m);    
/**
Array
(
    [0] => Array
        (
            [0] => 1
            [1] => 2
            [2] => 3
        )

)
*/ 

/*
1.(?:):非捕获模式.
2.(?=):右预测等于模式.
3.(?!):右预测不等于模式.
4.(?<=):左预测等于模式.
5.(?<!):左预测不等于模式.
模式:|(?<!%)%s|
首先两竖线不用管了,模式起始标志,从Perl遗传过来的.
对应(?<!%)为第5种情况,可知,在匹配到%s字符时需要进行回退判断,即%s前的字符不等于%
quote the strings, avoiding escaped strings like %%s
从E文翻译过来再去理解模式.
*/
