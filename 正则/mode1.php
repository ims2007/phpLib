<?php
#author: selfimpr
#blog: http://blog.csdn.net/lgg201
#mail: lgg860911@yahoo.com.cn

$pattern    = <<< eot
/
<                                                            #��ʼ��ǩ
    (?P<tagname>(?>\w+))                                    #��ǩ��
    (?P<attr>                                                #������������
        (?>\s+)                                                #ǰ�ÿհ�
        (?P<attr_name>\w+)                                    #������
        =                                                    #��ֵ����
        (?P<quote>(?P<single_quote>')?(?P<double_quote>")?)    #��ȡ��������ֵ������
        (?P<attr_value>                                        #ֵ��������
            (?:                                                #��ֵ�ֽ⴦��: �ֽ�Ϊ1) ż����ת���ַ��Ĳ���; 2) ����ת���ַ�+���Ż�ǵ�ǰʹ�����ŵ��ַ�
                (?P<slash>(?>(?:\\\\\\\\)*)*)                #���ĵ���ǰλ����ż����ת���ַ�
                (?P<chars>                                    #��ת���ַ�����Ĵ���
                    \\\\(?P=quote)|(?(5)[^']|[^"])            #�������˷�֧, һ����ת���ַ�+����, ��һ��������ƥ��ķǵ�ǰ�����ַ�
                )
            )*                                                #��ֵ���еķ������0�λ��δ���
        )
        (?P=quote)                                            #���űպ�
    )*                                                        #���Ե��ظ�
    \s*                                                        #���ÿհ�
\/?>                                                        #��ǩ�պϴ���(����Ľ������ڶ�����ֵ�Ĵ���, ����û�ж�<(��б��)tagname>�ķ�ʽ���д���)
/x
eot;

#ʾ������
$content1    = <<< eot
<a href='\\\\\'aaaa\\\\"\\' alt='�й�<a href=\\"www.baidu.com\'\\" >ս��</a>���͹�'>
eot;
$content2    = <<< eot
<a href="\\\\\"aaaa\\\\" alt="�л�����<a href=\\"www.baidu.com\\" >ս��</a>���͹�">
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
