<?php
#author: selfimpr
#blog: http://blog.csdn.net/lgg201
#mail: lgg860911@yahoo.com.cn

$pattern    = <<< eot
/
<                                                            #开始标签
    (?P<tagname>(?>\w+))                                    #标签名
    (?P<attr>                                                #单个属性子组
        (?>\s+)                                                #前置空白
        (?P<attr_name>\w+)                                    #属性名
        =                                                    #赋值符号
        (?P<quote>(?P<single_quote>')?(?P<double_quote>")?)    #读取包裹属性值的引号
        (?P<attr_value>                                        #值处理子组
            (?:                                                #将值分解处理: 分解为1) 偶数个转义字符的部分; 2) 单个转义字符+引号或非当前使用引号的字符
                (?P<slash>(?>(?:\\\\\\\\)*)*)                #消耗掉当前位置起偶数个转义字符
                (?P<chars>                                    #非转义字符自身的处理
                    \\\\(?P=quote)|(?(5)[^']|[^"])            #这里用了分支, 一边是转义字符+引号, 另一边是条件匹配的非当前引号字符
                )
            )*                                                #对值进行的分组进行0次或多次处理
        )
        (?P=quote)                                            #引号闭合
    )*                                                        #属性的重复
    \s*                                                        #后置空白
\/?>                                                        #标签闭合处理(这里的焦点在于对属性值的处理, 所以没有对<(反斜线)tagname>的方式进行处理)
/x
eot;

#示例输入
$content1    = <<< eot
<a href='\\\\\'aaaa\\\\"\\' alt='中国<a href=\\"www.baidu.com\'\\" >战神啊</a>共和国'>
eot;
$content2    = <<< eot
<a href="\\\\\"aaaa\\\\" alt="中华人民<a href=\\"www.baidu.com\\" >战神啊</a>共和国">
eot;
$content3 = <<< eot
<a href='aaaa' alt="aaa'bbb" >
eot;

echo $pattern . chr(10);
preg_match($pattern, $content1, $matches);
print_r($matches);
preg_match($pattern, $content2, $matches);
print_r($matches);
preg_match($pattern, $content3, $matches);
print_r($matches);
